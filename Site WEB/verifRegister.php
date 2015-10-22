<?php

//Connection au serveur
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $bdd = 'nao';
    $base = mysql_connect($host, $user, $password);
    mysql_select_db($bdd) or die("Impossible de se connecter a la base de donnees $bdd");

    try {

       
        //évite les injections de code 

        $id = strip_tags($_POST['identifiant']);

        $id = htmlspecialchars($id);

        $sql = "select * from utilisateurs where email='$id'";

        $envoi_requete = mysql_query($sql);

        if (mysql_fetch_assoc($envoi_requete)>1 ) {

            echo 'idUtilise';
        } else {

            echo 'idNonUtilise';
        }
    } catch (PDOException $ex) {

        echo "Erreur lors de la connexion à la bd...";
    }
 
?>