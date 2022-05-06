<?php

include_once "../Model/Reclamation.php";
include_once "../../Front/Controller/ReclamationC.php";


if(isset($_GET['id']))
{
    $control = new ReclamationC();
    $id=$_GET['id'];
    $control->deleteReclamationPublique($id);
    header("location:../View/pages/notifications.php");

}


?>