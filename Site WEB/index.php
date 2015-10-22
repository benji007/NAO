<?php
if (isset($_COOKIE["login"])) {
    
} else {
    if (isset($_GET["disconnect"])) {
        echo '<div id="danger" class="alert alert-danger"> Vous êtes déconnecté.</div>';
    }
    if (isset($_GET["register"])) {
        echo '<div id="danger" class="alert alert-success"> Vous vous êtes inscrit avec succés.</div>';
    }
}

//SI LE COOKIE EST DEFINI ALORS LA SESSION EST OUVERTE 

if (isset($_COOKIE['login'])) {

    //DESTRUCTION DU COOKIE POUR FERMER LA SESSION 

    setcookie('login', '', time() - 1);

    setcookie('nom', '', time() - 1);

    setcookie('prenom', '', time() - 1);

    $message = "Vous êtes déconnecté !";
}

//SEQUENCE D'AUTHENTIFICATION 

if (isset($_POST['connexion'])) {

    //VARIABLES CONTENANT LE BON LOGIN ET MOT DE PASSE 

    $connexion_serveur = mysqli_connect("localhost", "root", "", "nao");



    //RECUPERATION DES VARIABLES DU FORMULAIRE 

    if (isset($_POST['login']))
        $login_saisi = $_POST['login'];

    if (isset($_POST['mot_passe']))
        $mot_passe_saisi = $_POST['mot_passe'];



    //REQUETE SQL POUR DETERMINER SI LES PARAMETRES D'IDENTIFICATION 
    //CORRESPONDENT A UN DES UTILISATEURS DE LA TABLE 

    $sql_utilisateur = "SELECT * FROM utilisateurs WHERE 

    email='" . $login_saisi . "' AND motdepasse='" . $mot_passe_saisi . "'";

    $req_utilisateur = mysqli_query($connexion_serveur, $sql_utilisateur);


    $data_utilisateurs = mysqli_fetch_array($req_utilisateur);



    //VERIFICATION DES PARAMETRES DE COMPTES 

    if ($data_utilisateurs != false) {

        //IDENTIFACTION REUSSIE 
        //CREATION DES COOKIES 

        setcookie("login", $login_saisi, time() + 3600);
//30 secondes de vie
        //REDIRECTION VERS UNE AUTRE PAGE ET SCRIPT INTERROMPU 

        header("location:vos_dictees.php");

        exit;
    } else {

        //IDENTIFICATION ERRONEE 

        $message = "Login ou mot de passe incorrect";
    }
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <script src="js/jquery-2.1.0.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css">
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href='css/moncss.css' type='text/javascript'>
        
        <title>Connexion</title>
        <script>
            $('#danger').show(0).delay(2000).hide("slow");
        </script>
        
    </head>
    <body class="col-sm-12 background-body">
        <div class="navbar  navbar-inverse navbar-fixed-top">
            <nav class="nav-collapse" role="navigation">
                <ul class="nav navbar-nav">
                    <li><a class="navbar-brand" href="vos_dictees.php">Connexion à la base de données</a></li>

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


                <form class="login form-inline" action="index.php" method="POST" role="form" name="form1" id="form1"> 

                    <button type="button" class=" btn btn-default btn-group btn-group-justified"> 
                        <span class="glyphicon glyphicon-user"></span> Connexion
                    </button>
                    
                    <div class="panel-body">
                        
                        
                        <div class='form-group has-feedback'>
                                <label name="login" class='control-label'>Login :</label>
                                <input  class="form-control" type="text" name="login" id="login" placeholder="Email" >
                        </div><br><br>

                         <div class='form-group has-feedback'>
                                <label name="mot_passe" class='control-label'>Mot de passe :</label>
                                <input  class="form-control" type="password" name="mot_passe" id="mot_passe" placeholder="Mot de passe">
                        </div><br><br>
                         

                        <?php if (!empty($message)) echo "<div style='color : red;'>$message</div><br>"; ?> 

                        <button type="submit" class=" btn btn-primary" name="connexion"> 
                            <span class="glyphicon glyphicon-ok"></span> Connexion
                        </button>

                        <a href="register.php" style="margin-left: 10px;">S'enregistrer</a>

                </form> 
            </div>
        </div>    
    </div>


</ul>
</html>


