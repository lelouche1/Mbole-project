<?php
include_once "../Model/Reclamation.php";
include_once "ReclamationC.php";

//$_SESSION[]

if(isset($_POST['contenu']) && !isset($_POST['prive']))
{
    $control = new ReclamationC();
    $contenu = $_POST['contenu'];
    $nouvelleReclamtion = new Reclamation("test@gmail.com",$contenu);
    $control->addReclamation($nouvelleReclamtion,$pdo);
    header("location:../View/Reclamation.php");
}