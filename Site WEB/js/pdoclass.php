<?php

//implémentation du pattern singleton

class PdoSlam1 {

   private static $serveur = 'mysql:host=localhost';
   private static $bdd = 'dbname=tp11';
   private static $user = 'root';
   private static $mdp = 'root';
   private static $monPdo = null;
   private static $monPdoSlam1 = null;

   private function __construct() {
       PdoSlam1::$monPdo = new PDO(PdoSlam1::$serveur . ';' . PdoSlam1::$bdd, PdoSlam1::$user, PdoSlam1::$mdp);
       PdoSlam1::$monPdo->query("SET CHARACTER SET utf8");
   }

   public function _destruct() {
       PdoSlam1::$monPdo = null;
   }

   public static function getPdoSlam1() {
       if (PdoSlam1::$monPdoSlam1 == null) {
           PdoSlam1::$monPdoSlam1 = new PdoSlam1();
       }
       return PdoSlam1::$monPdoSlam1;
   }

   public function requeteAction2($requete) {
       $res = PdoSlam1::$monPdo->exec($requete);
       if ($res > 0) {
           return PdoSlam1::$monPdo->lastInsertId();
       }
       return false;
   }

   public function requeteAction($requete) {
       return PdoSlam1::$monPdo->exec($requete);
   }

   public function requeteSelection($requete) {

       $res = PdoSlam1::$monPdo->query($requete);

       if ($res == null) {
           return null;
       } else {
           return $res->fetchall(PDO::FETCH_NAMED);
       }
   }



}