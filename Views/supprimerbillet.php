
<?php
	include_once "../Model/billet.php";
	include '../Controller/billetC.php';
	$billetC=new billetC();
	$billetC->supprimerbillet($_POST['id_client1']);
	header('Location:afficherbillet.php');
?>
