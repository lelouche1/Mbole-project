<?php
session_start();

if(!$_SESSION['nom'])
{
    header('location: ../pages/login.php');
}

?>