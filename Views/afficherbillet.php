<?PHP

 include '../Controller/billetC.php';

$billetC=new billetC();
$listebillet=$billetC->afficherbillet();

?>
<html>
	<head></head>
		<body>
			<button><a href="ajouterbillet.php">Ajouter une billet</a></button>
			<center><h1>Liste des billets</h1></center>
			<table border="1">
				<tr>
					
					<td>nom_client</td>
					<td>date</td>
					<td>prix</td>
					<td>ville_depart</td>
					<td>ville_arrivee</td>
					<td>numero_vol</td>
				</tr>

			<?PHP
			foreach($listebillet as $billet){
			?>
				<tr>
					<td><?PHP echo $billet['nom_client']; ?></td>
					<td><?PHP echo $billet['date']; ?></td>
					<td><?PHP echo $billet['prix']; ?></td>
					<td><?PHP echo $billet['ville_depart']; ?></td>
					<td><?PHP echo $billet['ville_arrivee']; ?></td>
					<td><?PHP echo $billet['numero_vol'] ?></td>


					
					<td>
						<form method="POST" action="modifierbillet.php">
						<input type="hidden" value="<?PHP echo $billet['id_client']; ?>" name="id_client1">
						<input type="submit" name="modifier" value="modifier">
						</form>
					</td>
					<td>
					<form method="POST" action="supprimerbillet.php">
					<input type="hidden" value="<?PHP echo $billet['id_client']; ?>" name="id_client1">
						<input type="submit" name="modifier" value="supprimer">
					</form>
					</td>
				</tr>
				<?PHP
			}
			?>
			</table>
	</body>
</html>


