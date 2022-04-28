<?PHP

 include '../Controller/billetvipC.php';

$billetvipC=new billetvipC();
$listebilletvip=$billetvipC->afficherbilletvip();

?>
<html>
	<head></head>
		<body>
			<button><a href="ajouterbilletvip.php">Ajouter une billetvip</a></button>
			<center><h1>Liste des billets VIP</h1></center>
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
			foreach($listebilletvip as $billetvip){
			?>
				<tr>
					<td><?PHP echo $billetvip['nom_client']; ?></td>
					<td><?PHP echo $billetvip['date']; ?></td>
					<td><?PHP echo $billetvip['prix']; ?></td>
					<td><?PHP echo $billetvip['ville_depart']; ?></td>
					<td><?PHP echo $billetvip['ville_arrivee']; ?></td>
					<td><?PHP echo $billetvip['numero_vol'] ?></td>


					
					<td>
						<form method="POST" action="modifierbilletvip.php">
						<input type="submit" name="modifier" value="modifier">
						<input type="hidden" value="<?PHP echo $billetvip['id']; ?>" name="id">
					</form>
					</td>
					<td>
					<form method="POST" action="supprimerbilletvip.php">
						<input type="submit" name="modifier" value="supprimer">
						<input type="hidden" value="<?PHP echo $billetvip['id']; ?>" name="id">
					</form>
					</td>
				</tr>
				<?PHP
			}
			?>
			</table>
	</body>
</html>


