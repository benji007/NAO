<?php

if (isset($_COOKIE['login'])) {
    
} else {
    header('Location: index.php');
}

require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();
?>

<!DOCTYPE html>


<html>
    <head>
        <script src="js/jquery-2.1.0.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css">
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href='css/moncss.css' type='text/javascript'>
        <title>Ajout entreprise</title>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">

    </head>
    <body class="col-sm-12 background-body">

        <!-- Lien vers toutes les pages -->
        <div class="navbar  navbar-inverse navbar-fixed-top">
            <nav class="nav-collapse" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand color">
                        <div class="color">
                            Base de données
                        </div></a>
                </div>
                <ul class="nav navbar-nav ">
                    <li><a class="navbar-brand" href="liste_entreprises.php">Entreprises</a></li>
                    <li><a class="navbar-brand" href="liste_contacts.php">Contacts</a></li>
                    <li><a class="navbar-brand" href="liste_rdv.php">Rendez-vous</a></li>
                    <li class="dropdown active">
                        <a href="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown">Ajout<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="ajouter_contact.php">Contact</a></li>
                            <li><a href="ajouter_entreprise.php">Entreprise</a></li>
                            <li><a href="ajouter_rdv.php">Rendez-Vous</a></li>
                        </ul>
                    </li>
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



        <form class="form-horizontal" role="form" method="POST" action="ajoutEntreprise.php">
            <div class="form-group">
                <label class="col-sm-2 control-label">Ajout d'une Entreprise</label>

            </div>
        </div>  

        <div class="form-group">
            <label class="col-sm-2 control-label">Raison sociale :</label>
            <div class="col-sm-10 col-lg-2">
                <input type="text" class="form-control" id="focusedInput" placeholder="" name="nom">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Adresse:</label>
            <div class="col-lg-2"><textarea class="form-control" rows="3" name="adresse"></textarea></div>      
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Téléphone :</label>
            <div class="col-lg-2"><input type="text" class="form-control" id="focusedInput" placeholder="Telephone" name="telephone"></div><br>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Fax :</label>
            <div class="col-lg-2"><input type="text" class="form-control" id="focusedInput" placeholder="Fax" name="fax"></div><br>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Mail :</label>
            <div class="col-lg-2"><input type="email" class="form-control" id="focusedInput" placeholder="Enter email" name="email"></div>     
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Observations :</label>
            <div class="col-lg-2"><textarea class="form-control" rows="3" name="observation"></textarea></div>     
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <button type="submit" method="POST" class="btn btn-primary col-lg-1 col-lg-offset-2">Envoyer</button>

        </div>

    </form>

</body>
</html>
