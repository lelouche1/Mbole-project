<?php
include 'security.php';

if(isset($_POST['deconnexion']))
{
    session_destroy();
    unset($_SESSION['nom']);
    header('location: login.php');
}

?>