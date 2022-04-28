
<?php
	include_once "../Model/billetvip.php";
	include '../Controller/billetvipC.php';
	$billetvipC=new billetvipC();
	$billetvipC->supprimerbilletvip($_POST['id']);
	header('Location:afficherbilletvip.php');
?>
