<?php
    require_once("includes/configuration.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <script src="js/jquery-2.1.0.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css">
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href='css/moncss.css' type='text/javascript'>
        <title>Entreprises</title>

        <!--Javascript-->
        <script>
            $('#succes').show(0).delay(2000).hide("slow");
        </script>
		
        <style>
        #tab_search tr td{
            width: 100px;
        }
        #tab_search tr td input,#tab_search tr td select{
            width: 200px;
        }
        </style>
		
    </head>
    <body class="col-sm-12 background-body">
        <div class="navbar  navbar-inverse navbar-fixed-top">
            <nav class="nav-collapse" role="navigation">
                <div class="navbar-header">
                    <div class="navbar-brand color">
                        <div class="color">
                            NAO dictée
                        </div></div>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a class="navbar-brand" href="vos_dictees.php">Vos dictées</a></li>
                    <li><a class="navbar-brand" href="ajout_dictees.php">Ajout dictées</a></li>
                    <li><a class="navbar-brand" href="recherche_dictees.php">Recherche</a></li>
                 </ul>
                <ul class="nav navbar-nav navbar-right" style="margin-right: 10px;">
                    <li class="dropdown ">
                        <a href="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown"><?php
                            echo $_COOKIE['login'];
                            ?><b class="caret"></b></a>
                        <ul class="dropdown-menu ">
                            <li>
                                <a href="disconnect.php">
                                    <i class="glyphicon glyphicon-off" ></i>
                                    <span> Deconnexion </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav></div>

        <!--         Navbar bottom -->

        <div class="navbar navbar-inverse navbar-fixed-bottom">
            <nav class="nav-collapse" role="navigation">
                <ul class="navbar navbar-right">
                    <p class="navbar-text2">Created by Tic&Tac &nbsp;</p>
                </ul>
            </nav>
        </div>

        <blockquote>
            <p>LISTE DES DICTEES </p>
            
            <form class='form-horizontal' method='POST' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
                <fieldset>
                    <table id="tab_search">
                        <tr><td><label>Auteur</label></td><td><input type="text" name="autor"></td></tr>
                        <tr><td><label>Titre</label></td><td><input type="text" name="title"></td></tr>
                        <tr>
                            <td><label>Niveau</label></td>
                            <td>
                                <select name='niveau'>
                                    <option value='0'>Selectionner une classe</option>
                                    <?php
                                        $sql2= "SELECT * FROM niveau";
                                        $envoi_requete2= mysql_query($sql2);
                                        while ($resultats2=mysql_fetch_array($envoi_requete2)){
                                            $varid = $resultats2['idniveau'];
                                            $niveau=$resultats2['libelle_niveau'];
                                            echo "<option value='".$varid."' ";
                                            if($varid == $resultats['niveau']){echo "selected";}
                                            echo ">".$niveau."</option>";
                                        } 
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr><td colspan='2'><center><input type="submit" name="search" value="Rechercher"/></center></td></tr>
                    </table>
                </fieldset>
            </form>

            <br />

            <?php
            // Compte le nombre d'affichage
            if(isset($_POST['search'])){
                $title = $_POST['title'];
                $autor = $_POST['autor'];
                $niveau = $_POST['niveau'];
                $sql = "SELECT * FROM texte ";
                if(($niveau != 0)or(trim($title) != "")or(trim($autor) != "")){
                    $sql .= "WHERE ";
                    $a = 0;
                    if($niveau != 0){
                        $sql .= "niveau='".$niveau."' ";
                        $a = 1;
                    }
                    if(trim($title) != ""){
                        if($a==1){
                            $sql .= "AND ";
                        }
                        $sql .= "titre LIKE '%".$title."%' ";
                        $a = 2;
                    }
                    if(trim($autor) != ""){
                        if(($a==1) OR ($a==2)){
                            $sql .= "AND ";
                        }
                        $sql .= "auteur LIKE '%".$autor."%' ";
                    }
                }
            }else{$sql = "SELECT * FROM texte";}

            $envoi_requete = mysql_query($sql);
            $compt = 0;
            while ($resultats = mysql_fetch_array($envoi_requete)) {
                $compt++;
            }
            echo "<small>Nombre de dictées affichées : " . $compt . "</small></blockquote>";
            $envoi_requete = mysql_query($sql);
            $compt = 1;
			// Affichage de la table sous forme de tableaux
			while ($resultats = mysql_fetch_array($envoi_requete)) {
				$idtexte = $resultats['idtexte'] ;
				$titre =  $resultats['titre'] ;
				$corps = $resultats['corps'];
				$auteur = $resultats['auteur'];
				$idniveau = $resultats['niveau'];
				
				$sql2= "SELECT libelle_niveau FROM niveau WHERE idniveau = '".$idniveau."'";
				$envoi_requete2= mysql_query($sql2);
				while ($resultats2=mysql_fetch_array($envoi_requete2)) {
					 $niveau=$resultats2['libelle_niveau'];
					 echo "<div class='table-responsive col-md-3 .col-md-offset-3'><table class='table table-striped'>" .
					   "<tr><td>N° : </td><td>" . $compt++ . "</td><td ALIGN='right'>" . "<a href='modif_dictees.php?texte=" . $resultats['idtexte'] . "'><span class='glyphicon glyphicon-pencil' ></span> &nbsp;" . "<a href ='suppr_dictees.php?id=".$resultats['idtexte']."'><span class='glyphicon glyphicon-remove-circle red' ></span>" . "</td></tr>" . 
					   "<tr><td>Titre : </td><td COLSPAN=2> " . $titre. "</td></tr>" .
					   "<tr><td>Texte : </td><td COLSPAN=2>" . $corps. "</td></tr>" .
					   "<tr><td>Auteur: </td><td COLSPAN=2>" . $auteur. "</td></tr>" .
					   "<tr><td>Niveau: </td><td COLSPAN=2>".$niveau."</td></tr>".
					   "</table></div>";		
				}		
			}		
			?>
			

            </body>
            </html>
