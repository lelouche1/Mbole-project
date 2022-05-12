<?php
session_start();

if(isset($_POST['btn_deconect']))
{header('location: vols.php');
    session_destroy();
    unset($_SESSION['user']);
    die();
    header('location: vols.php');
}