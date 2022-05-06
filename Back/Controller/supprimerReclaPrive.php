<?php

include_once "../Model/Reclamation.php";
include_once "../../Front/Controller/ReclamationP.php";

if(isset($_GET['id']))
{
    $control = new ReclamationP();
    $id=$_GET['id'];
    $control->deleteReclamationPrivée($id);
    header("location:../View/pages/conversation.php");

}

?>