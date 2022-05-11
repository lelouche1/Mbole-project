<?php

include_once "../Config.php";
include_once "../Model/Reclamation.php";

class ReclamationP{

    function addReclamation($newRecla_prive){
        $db = config::getConnexion();
        
        try {
            
            $query = $db->prepare(
                'INSERT INTO reclamation_privée (date,contenu,email_admin,email_client) 
                    VALUES (:date,:contenu,:email_admin,:email_client)'
            );
            $query->execute([
                'date' => $newRecla_prive->get_date(),
                'contenu' => $newRecla_prive->get_text(),
                'email_admin' => $newRecla_prive->get_emailA(),
                'email_client' => $newRecla_prive->get_email(),
                
            ]);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function deleteReclamationPrivée($ReclamationId){

        $db = config::getConnexion();
        try {
            $query = $db->prepare(
                'DELETE FROM reclamation_privée WHERE Id_recla = :Id_recla'
            );
            $query->execute([
                'Id_recla' => $ReclamationId
            ]);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}