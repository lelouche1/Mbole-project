<?php
session_start();

if(!$_SESSION['nom'])
{
    header('location: login.php');
}

?>