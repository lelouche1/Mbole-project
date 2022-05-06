<?php

include_once "../Config.php";
include_once "../Model/Reclamation.php";

class ReclamationC{

    function addReclamation($newReclamation){
        $db = config::getConnexion();
        
        try {
            
            $query = $db->prepare(
                'INSERT INTO reclamation_publique (date,email_utilisateur,contenu) 
                    VALUES (:date,:email_utilisateur,:contenu)'
            );
            $query->execute([
                'date' => $newReclamation->get_date(),
                'email_utilisateur' => $newReclamation->get_email(),
                'contenu' => $newReclamation->get_text(),
            ]);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function deleteReclamationPublique($ReclamationId){

        $db = config::getConnexion();
        try {
            $query = $db->prepare(
                'DELETE FROM reclamation_publique WHERE Id_recla = :Id_recla'
            );
            $query->execute([
                'Id_recla' => $ReclamationId
            ]);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }


    function UpdateReclamation($contenu,$id){
        $db = config::getConnexion();
        $dateActuel = date('y-m-d');
        try {
            
            $query = $db->prepare(
                'UPDATE reclamation_publique set date=:date,contenu=:contenu 
                    where Id_recla=:Id_recla'
            );
            $query->execute([
                'date' => $dateActuel,
                'contenu' => $contenu,
                'Id_recla' => $id
            ]);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}

?>
