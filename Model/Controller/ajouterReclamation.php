<?php
session_start();
include_once "../Model/Reclamation.php";
include_once "ReclamationC.php";
include_once "ReclamationP.php";

//$_SESSION[]


if(isset($_POST['contenu']) && !isset($_POST['prive']) && isset($_SESSION['email_user']))
{
    $control = new ReclamationC();
    $contenu = $_POST['contenu'];
    $email_user = $_SESSION['email_user'];
    $nouvelleReclamtion = new Reclamation($email_user,$contenu);

    $control->addReclamation($nouvelleReclamtion,$pdo);
    header("location:../View/Reclamation.php");
}

else if(isset($_POST['contenu']) && isset($_POST['prive']) && isset($_SESSION['email_user']))
{
    $control = new ReclamationP();
    $contenu = $_POST['contenu'];
    $email_user = $_SESSION['email_user'];
    $nouvelleReclamtion = new Recla_prive($email_user,$contenu,"admin@gmail.com");
    $control->addReclamation($nouvelleReclamtion,$pdo);
    header("location:../View/Reclamation.php");

    $destinataire = "joyanaclet.bakonegiovanni@esprit.tn";
        $sujet ="Confirmation de reception";
        $message = "Ceci est le test du mailling de la compagnie Air Mbolé ;D.";
        $headers = "From: giovannijbakone@gmail.com";
        mail($destinataire,$sujet,$message,$headers);
}