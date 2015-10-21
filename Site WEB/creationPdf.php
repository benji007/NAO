<?php

require './pdf/fpdf.php';
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();

//Connexion à la base de donnée
$host = 'localhost';
$user = 'root';
$password = 'root';
$bdd = 'tp11';
$base = mysql_connect($host, $user, $password);
mysql_select_db($bdd) or die("Impossible de se connecter a la base de donnees $bdd");
$id = $_GET['id'];
$pdf = new FPDF('L', 'mm', array(90, 55));

// Creation de la page pdf
$pdf->AddPage();
$pdf->SetFillColor(100,149,237);
// Requete d'affichage des datas du contact
$sql = "SELECT * FROM contacts where id =".$id;
$envoi_requete = mysql_query($sql);
$pdf->SetFont('arial', '', 9);

if ($resultats = mysql_fetch_assoc($envoi_requete)) {

$pdf->SetAutoPageBreak(false);

// Affichage photo
$pdf->SetLeftMargin(10);
$pdf->image($resultats['photo'],null,null,20);

// Affichage nom du contact
$pdf->SetFont('Arial', "B");
$pdf->SetTextColor(100,149,237);
$pdf->SetLeftMargin(50);
$pdf->SetY(-45);

$pdf->Cell(40, 6, $resultats['nom_prenom']);
$pdf->Ln();

// Affichage téléphone
$pdf->SetFont('Arial', "");
$pdf->SetTextColor('0', '0', '0');

$telephone = str_split($resultats['telephone'], 2);
    $num_tel = "";
    for($x=0; $x<count($telephone); $x++) {
        if($x>0 && $x<count($telephone)) {
            $num_tel .= ".".$telephone[$x];
        }
        else {
            $num_tel .= $telephone[$x];
        }
    }
    
    $pdf->Cell(40, 6, $num_tel);
    $pdf->Ln();
    
    // Affichage du mail
$pdf->Cell(40, 6, $resultats['email']); 
$pdf->Ln(); 
$pdf->Ln(); 
$pdf->Ln(); 

// Affichage entreprise
$pdf->SetLeftMargin(0);
$pdf->SetX(-90);
$sql = "SELECT id, nom FROM entreprises";
$envoi_requete = $pdo->requeteSelection($sql);
foreach ($envoi_requete as $tuple) {
$pdf->Cell(90, 5, $tuple['nom'],1,0,"C",true);
}
}
$pdf->Output();
?>