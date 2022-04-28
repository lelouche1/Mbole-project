<?php
	include '../config.php';
	include_once '../Model/billetvip.php';
	class billetvipC {
		function afficherbilletvip(){
			$sql="SELECT * FROM billetvip";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function supprimerbilletvip($id_client){
			$sql="DELETE FROM billetvip WHERE id=:id";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id', $id_client);
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function ajouterbilletvip($billetvip){
			$sql="INSERT INTO billetvip (id, nom_client, date, prix, ville_depart, ville_arrivee, numero_vol) 
			VALUES (:id, :nom_client, :date, :prix, :ville_depart, :ville_arrivee, :numero_vol)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'id' => $billetvip->getid(),
					'nom_client' => $billetvip->getnom_client(),
					'date' => $billetvip->getdate(),
					'prix' => $billetvip->getprix(),
					'ville_depart' => $billetvip->getville_depart(),
				    'ville_arrivee' => $billetvip->getville_arrivee(),
                    'numero_vol' => $billetvip->getnumero_vol()
				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
		
		function modifierbilletvip($billetvip, $id){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE billetvip SET 
					nom_client= :nom_client,
						date= :date, 
						prix= :prix, 
						ville_depart= :ville_depart, 
						
						ville_arrivee= :ville_arrivee
                        numero_vol= :numero_vol
					WHERE id= :id'
				);
				$query->execute([
					'id' => $id,
					'nom_client' => $billetvip->getnom_client(),
					'date' => $billetvip->getdate(),
					'prix' => $billetvip->getprix(),
					'ville_depart' => $billetvip->getville_depart(),
					
					'ville_arrivee' => $billetvip->getville_arrivee(),
                    'numero_vol' => $billetvip->getnumero_vol(),

					
				]);
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

	}
?>