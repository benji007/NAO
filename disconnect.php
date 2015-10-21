<?php
//DESTRUCTION DU COOKIE POUR FERMER LA SESSION 

    setcookie('login', '', time() - 1);

    setcookie('nom', '', time() - 1);

    setcookie('prenom', '', time() - 1);
    
    setcookie("temp", '', time() - 1);


header('Location: index.php?disconnect');

