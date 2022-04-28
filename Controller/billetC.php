<?php
	include '../config.php';
	include_once '../Model/billet.php';
	class billetC {
		function afficherbillet(){
			$sql="SELECT * FROM billet";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function supprimerbillet($id_client){
			$sql="DELETE FROM billet WHERE id_client=:id_client";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id_client', $id_client);
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function ajouterbillet($billet){
			$sql="INSERT INTO billet (id_client, nom_client, date, prix, ville_depart, ville_arrivee, numero_vol) 
			VALUES (:id_client, :nom_client, :date, :prix, :ville_depart, :ville_arrivee, :numero_vol)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'id_client' => $billet->getid_client(),
					'nom_client' => $billet->getnom_client(),
					'date' => $billet->getdate(),
					'prix' => $billet->getprix(),
					'ville_depart' => $billet->getville_depart(),
				    'ville_arrivee' => $billet->getville_arrivee(),
                    'numero_vol' => $billet->getnumero_vol()
				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
		
		function modifierbillet($billet, $id_client){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE billet SET 
					nom_client= :nom_client,
						date= :date, 
						prix= :prix, 
						ville_depart= :ville_depart, 
						ville_arrivee= :ville_arrivee,
                        numero_vol= :numero_vol
					WHERE id_client= :id_client'
				);
				$query->execute([
					'id_client' => $id_client,
					'nom_client' => $billet->getnom_client(),
					'date' => $billet->getdate(),
					'prix' => $billet->getprix(),
					'ville_depart' => $billet->getville_depart(),
					
					'ville_arrivee' => $billet->getville_arrivee(),
                    'numero_vol' => $billet->getnumero_vol(),

					
				]);
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

	}
?>