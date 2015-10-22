
<?php
	$hostname = "localhost";
	$user = "root";
	$pass = "";
	$db1="nao";
	$database = @mysql_connect("$hostname", "$user", "$pass");
	@mysql_select_db($db1, $database);
								 
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <script src="js/jquery-2.1.0.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css">
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href='css/moncss.css' type='text/javascript'>
        <title>Inscription</title>


        <script>



            $(document).ready(function() {

                //capture de l'événement keyup 

                $("#identifiant").keyup(function() {

                    //exéction du script verifId à chaque fois que l'on presse une touche 

                    $.ajax({
                        type: "post",
                        url: 'verifRegister.php',
                        data: "identifiant=" + $(this).val(),
                        success: function(data) {

                            //data contient la valeur afﬁchée par le script php 

                            if (data == "idUtilise") {


                                $("#divLogin").attr('class', "form-group has-error has-feedback");
                                $("#divLogin").css("margin-bottom", "0 px !important;");
                                $("#spanLogin").attr('class', 'glyphicon glyphicon-remove form-control-feedback');

                            } else {

                                $("#divLogin").attr('class', "form-group has-success has-feedback");
                                $("#divLogin").css("margin-bottom", "0 px !important;");
                                $("#spanLogin").attr('class', 'glyphicon glyphicon-ok form-control-feedback');
                            }
                            ;

                        }

                    });

                });


                $("#bouton_verif").click(function() {
                    var valid = true;
                    
                    //verification mot de passe
                    if ($("#mot_passe").val().length > 16) {
                        $('#mot_passe').popover('show');
                        valid = false;
                    }

                    if ($("#mot_passe").val().length < 6) {
                        $('#mot_passe').popover('show');
                        valid = false;
                    }
                    else {
                        $("#mot_passe").popover('hide');
                    }

                    // Confirmation mot de passe

                    if ($("#mot_passe2").val() != $("#mot_passe").val()) {
                        $('#mot_passe2').popover('show');
                        valid = false;
                    }
                    else {
                        $("#mot_passe2").popover('hide');
                    }
                    
                                // Confirmation mot de passe

            if ($("#mot_passe2").val() != $("#mot_passe").val()) {
            $('#mot_passe2').popover('show');
                    valid = false;
            }
            else {
            $("#mot_passe2").popover('hide');
            }

            // Verification syntaxe email

            if (($("#email").val.indexOf("@") >= 0) && ($("#email").val.indexOf(".") >= 0)) {
            $("#email").popover('show');
                    valid = false;
            }

//            else {
//            $("#email").popover('hide');
//            }
                    console.log(valid);
                    if (valid == true) {
                        $("#inscription").submit();
                    }

                });


            });

        </script>






    </head>
    <body class="col-sm-12 background-body">
        <div class="navbar  navbar-inverse navbar-fixed-top">
            <nav class="nav-collapse" role="navigation">
                <ul class="nav navbar-nav">
                    <li><a class="navbar-brand">Inscription à la base de données</a></li>

            </nav></div>

        <!--         Navbar bottom -->

        <div class="navbar navbar-inverse navbar-fixed-bottom">
            <nav class="nav-collapse" role="navigation">
                <ul class="navbar navbar-right">
                    <p class="navbar-text2">Created by Tic&Tac &nbsp;</p>
                </ul>
            </nav>
        </div><br>


        <div class='col-md-2 col-md-offset-5' id='panel'>

            <div class="panel panel-default panel-default ">

                <button type="button" class=" btn btn-default btn-group btn-group-justified"> 
                    <span class="glyphicon glyphicon-user"></span> Inscription
                </button>

                <div class="panel-body">
                    <form class="login form-inline" action="ajoutRegister.php" method="POST" role="form" name="inscription" id="inscription"> 
							 
							 <div class='form-group has-feedback'><br>
                                <label name="nom">Nom : </label>
                                <input  class="form-control" type="nom" name="nom" id="nom" placeholder="Nom" data-container="body" data-content="Veuillez entrer votre nom."> 
                            </div>
							
							<div class='form-group has-feedback'><br>
                                <label name="prenom"> Prenom : </label>
                                <input  class="form-control" type="prenom" name="prenom" id="prenom" placeholder="Prenom" data-container="body" data-content="Veuillez entrer votre prenom."> 
                            </div>__________________________<br><br> 
							 
							
							<div class='form-group has-feedback'><br>
                                <label name="email">Adresse email : </label>
                                <input  class="form-control" type="email" name="identifiant" id="identifiant" placeholder="Adresse email" data-container="body" data-content="Veuillez entrer correctement votre adresse mail."> 
                            </div>
                            
                            <div class='form-group has-feedback'><br>
                                <label name="email2">Confirmation adresse email : </label>
                                <input  class="form-control" type="email" name="identifiant2" id="identifiant2" placeholder="Confirmez adresse email" data-container="body" data-content="L'adresse email de confirmation doit être identique à l'adresse email."> 
                            </div>__________________________<br><br>
                        
                            <div class='form-group has-feedback'>
                                <br>
                                <label name="mot_passe" class='control-label'>Mot de passe : </label>
                                <input  class="form-control" type="password" name="mot_passe" id="mot_passe" placeholder="Mot de passe" data-container="body" data-content="La taille du mot de passe doit être comprise entre 6 et 16 caractères.">
                            </div>

                            <div class='form-group has-feedback'><br>
                                <label name="mot_passe2">Confirmation mot de passe : </label>
                                <input  class="form-control" type="password" name="mot_passe2" id="mot_passe2" placeholder="Confirmez mot de passe" data-container="body" data-content="Le mot de passe de confirmation doit être identique au mot de passe."> 
                            </div>__________________________<br><br>
							
							 <div class='form-group has-feedback'><br>
                                <label for="type">Type du compte</label>
								<select name="liste_type" id="liste_type">
								<option value="" selected="selected">Choississez votre profil</option>
								
								<?php
	
								 
								 $sql= "SELECT * FROM typecompte WHERE idtype > 0";
								 $req= mysql_query($sql);
								while ($res= mysql_fetch_array($req))
								{
									$id=$res['idtype'];
									$libelle=$res['libelle'];
									echo '<option value= "'.$id.'"> '.$libelle.' </option>';
									
								}
								
								?>
								</select>
							
							</div>__________________________<br><br>
							
         
							<input type='submit' class=" btn btn-primary" value="Enregistrer">
							<a href="index.php" style="margin-left: 10px;">Connexion</a>
							
                    </form>  
				</div>

                </div>
            </div>
       
    </ul>
	</body>
</html>

