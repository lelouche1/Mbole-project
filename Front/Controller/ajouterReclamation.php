<?php
include_once "../Model/Reclamation.php";
include_once "ReclamationC.php";
include_once "ReclamationP.php";

//$_SESSION[]

if(isset($_POST['contenu']) && !isset($_POST['prive']))
{
    $control = new ReclamationC();
    $contenu = $_POST['contenu'];
    $nouvelleReclamtion = new Reclamation("test@gmail.com",$contenu);
    $control->addReclamation($nouvelleReclamtion);
    header("location:../View/Reclamation.php");
}

else if(isset($_POST['contenu']) && isset($_POST['prive']))
{
    $control = new ReclamationP();
    $contenu = $_POST['contenu'];
    $nouvelleReclamtion = new Recla_prive("test@gmail.com",$contenu,"admin@gmail.com");
    $control->addReclamation($nouvelleReclamtion);
    header("location:../View/Reclamation.php");

    $destinataire = "fedia.arfaoui@esprit.tn";
        $sujet ="Confirmation de reception";
        $message = "Ceci est le test du mailling de la compagnie Air Mbolé ;D.";
        $headers = "From: giovannijbakone@gmail.com";
        mail($destinataire,$sujet,$message,$headers);
}