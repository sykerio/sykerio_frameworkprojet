<?php
//Class gérant l'intéraction avec la base de données
Class sy_database {

	private $data_name = "sykerio_main";
	private $data_host = "localhost";
	private $data_user = "concepteur_admin";
	private $data_password = "";
	private $debug_mode;


//__constructeur
public function sy_database_connect(){
  
  try {

  	 $data = new pdo("mysql:host=".$this->data_host.";dbname=" .$this->data_name. "," .$this->data_user.",".$this->data_password);
  	 echo  "<span class='label label-succes'>Connecté</span>";
  	 return $data;
  } catch (Exception $e) {
  	
  	echo "<span class='label label-danger'>Monsieur sykerio : " . $e->getMessage() ."</span>";

  }
 

//Les autre function fermerons la connection après traitement
}

public function sy_query($query){

	
	$bd = $this->sy_database_connect();
	foreach ($bd->sy_query($query) as $key => $ligne){
		$data_table = $ligne ;
	 };
	$bd = null;
	return $data_table;
}

}
?>