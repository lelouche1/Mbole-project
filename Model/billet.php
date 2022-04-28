<?php
	class billet{
		private $id_client=null;
		private $nom_client=null;
		private $date=null;
		private $prix=null;
		private $ville_depart=null;	
		private $ville_arrivee=null;
        private $numero_vol=null;
		
		
		function __construct( $nom_client, $date, $prix, $ville_depart, $ville_arrivee,  $numero_vol){
           
			
			$this->nom_client=$nom_client;
			$this->date=$date;
			$this->prix=$prix;
			$this->ville_depart=$ville_depart;
			$this->ville_arrivee=$ville_arrivee;
            $this->numero_vol=$numero_vol;

			
		
	    }
		function getid_client(){
			return $this->id_client;
		}
		function getnom_client(){
			return $this->nom_client;
		}
		function getdate(){
			return $this->date;
		}
		function getprix(){
			return $this->prix;
		}
		function getville_depart(){
			return $this->ville_depart;
		}
		function getville_arrivee(){
			return $this->ville_arrivee;
		}
		function getnumero_vol(){
			return $this->numero_vol;
		}
	
		function setnom_client(string $nom_client){
			$this->nom_client=$nom_client;
		}
		function setdate(string $date){
			$this->date=$date;
		}
		function setprix(int $prix){
			$this->prix=$prix;
		}
		function setville_depart(string $ville_depart){
			$this->ville_depart=$ville_depart;
		}
		function setville_arrivee(string $ville_arrivee){
			$this->ville_arrivee=$ville_arrivee;
		}
		function setnum_vol(int $num_vol){
			$this->numero_vol=$num_vol;
		}
		
	}


?>
