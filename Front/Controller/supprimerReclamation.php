<?php

include_once "../Model/Reclamation.php";
include_once "ReclamationC.php";


if(isset($_GET['id']))
{
    $control = new ReclamationC();
    $id=$_GET['id'];
    $control->deleteReclamationPublique($id);
    header("location:../View/Reclamation.php");

}

?>