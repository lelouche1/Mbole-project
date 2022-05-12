<?php

include_once "../model/Reclamation.php";
include_once "../../Front/Controller/ReclamationC.php";


if(isset($_GET['id']))
{
    $control = new ReclamationC();
    $id=$_GET['id'];
    $control->deleteReclamationPublique($id,$pdo);
    header("location:../View/pages/notifications.php");

}


?>