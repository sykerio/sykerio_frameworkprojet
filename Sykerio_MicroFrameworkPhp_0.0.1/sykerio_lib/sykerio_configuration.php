<?php 
session_start();

// Contenu de la balise html head
Class sykerio_integration{
public function sykerio_integration(){
	
}
public function meta_header($titre,$position){ ?>
		
		<head>
			<meta charset='utf-8'>
			<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
			<title><?php echo $titre; ?></title>
			<meta name='author' content='Sykerio_administrator'>

			<link href='<?php echo $position ?>sykerio_css/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
			<script src='<?php echo $position; ?>sykerio_css/js/jquery.min.js'></script>
			<script src='<?php echo $position; ?>sykerio_css/js/bootstrap.min.js'></script> 
			<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
			<link href="<?php echo $position ?>sykerio_css/css/flat-ui.css" rel="stylesheet">
			
		<!--	
			
			<script type="text/javascript" src="<?php //echo $position ?>sykerio_css/bootflat/js/site.min.js"></script>
			<link href='<?php //echo $position ?>sykerio_css/bootflat/css/site.min.css' rel='stylesheet' type='text/css' />
			
			<link href='<?php// echo $position ?>sykerio_css/bootflat/css/bootflat.min.css' rel='stylesheet' type='text/css' />
			<link href='<?php //echo $position ?>sykerio_css/bootflat/css/bootflat.css.map' rel='stylesheet' type='text/css' />
			<script src='<?php// echo $position;?>sykerio_css/bootflat/js/jquery.fs.selecter.min.js'></script> 
			<script src='<?php //echo $position;?>sykerio_css/bootflat/js/jquery.fs.stepper.min.js'></script>
    		 -->
		</head>


		<?php
		
}

public function template_btn_modal($nom_modal_cible,$text_boutton){

	echo '
	
	<button type="button" name="btn_'.$nom_modal_cible.'" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#'.$nom_modal_cible.'">
 	 '.$text_boutton.'
	</button>
	
	';
	
}
public function template_modal($id_modal,$titre,$contenu){

	echo'
	<div class="modal fade" id="'.$id_modal.'" tabindex="-1" role="dialog"  aria-labelledby="MymodalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					
					<h3 class="modal-title" id="MymodalLabel">'.$titre.'</h3>
				</div>
				<div class="modal-body">
					'.$contenu.'
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
				</div>
			</div>
		</div>
	</div>
	';
}
public function template_table($tableau_titre,$tableau_contenu,$format){

	if (empty($format)){
		$format = 'NORMAL';
	}
	//if ($format == 'SQL'){
	//	echo 'traitement SQL';
	//}
	else if ($format == 'NORMAL')
	{
	?><table class="table table-condensed">
		<thead>
			<?php foreach ($tableau_titre as $titre) {
				?><th><?php echo $titre; ?></th><?php
			} ?>

		</thead>
			<tbody>
				
				<?php  foreach ($tableau_contenu as $value_01) {
	 					?><tr><?php
	 						foreach ($value_01 as $cellule) {
	 							?><td><?php echo $cellule; ?></td><?php
	 														}
		
						?></tr><?php										} ?>
				
			</tbody>
			<?php
	
	}
	
}
}
// Intéraction avec la base de données
Class sykerio_basededonnees {

private $nom_bdd;
private $mdp_bdd;
private $id_bdd;
private $host_bdd;

//Le constructeur
public function sykerio_basededonnees()
{

	$this->nom_bdd = "sykerio_main_bdd";
	$this->id_bdd = "";
	$this->mdp_bdd = "";
	$this->host_bdd = "localhost";

}
public function get_nombdd(){
	return $this->$nom_bdd;
}
public function get_mdpbdd(){
	return $this->mdp_bdd;
}
public function get_idbdd(){
	return $this->$id_bdd;
}
public function get_hostbdd(){
	return $this->$host_bdd;
}

//Vérifie la connexion à la base de données
public function verification_bdd()
{
	try
	{
	$bdd = mysql_connect($this->host_bdd, $this->id_bdd, $this->mdp_bdd);
	echo '<p class="bg-success">Connecté</p>';
	}
	catch (Exception $e)
	{
//die('Erreur : ' . $e->getMessage());
	echo  die('<span class="label label-danger">Oups désolé : ' . $e->getMessage()) .'</span>';	
	}
}


//Exécute une requête SQL et renvois un tableau avec les resultats
public function execute_requete($requete)
{
	try{
	$bdd = mysql_connect($this->host_bdd, $this->id_bdd, $this->mdp_bdd);
	$reponse = $bdd->query($requete);
	return $reponse;
	}
	catch (Exception $e)
	{
	echo  die('<span class="label label-danger"> OUPS !! : ' . $e->getMessage()) .'</span>';
	
	}
}



//Gestion des utilisateur dans la base de données sykerio
//Vérifie si un utilisateur existe
public function existance_user($login,$password){
	//---
	if (empty($login))
		{
		return FALSE;
		}
	if (empty($password))
		{
		return FALSE;
		}
	$tab = array();
	//---
	$result = $this->execute_requete("Select * FROM sk_users");
	while ($rlt = $result->fetch())
	{
		if ($rlt['login_user'] == $login AND $rlt['mdp_user'] == $password) {
			$oui = 1;
			
		}
	} 
	//---
	if (isset($oui)) {
		return TRUE;
	}
	else {
		return FALSE;
	}
	//--
	}

//Connecte l'utilisateur à l'application
public function connecte_user($login,$password)
	{
	$tab = $this->execute_requete("Select * FROM sk_users,sk_rangs WHERE sk_rangs.id_rang=sk_users.id_rang AND login_user='".$login."' AND mdp_user='".$password."'");
	$data = $tab->fetch();
	return $data;
	}
//Vérifie si la session utilisateur est toujours actif
public function verifconnection_user()
	{
	if (empty($_SESSION['id_user'])) 
		{ 
		?>
		<script language="JavaScript" type="text/javascript">
				window.location.replace("../index.php");
		</script>
		<?php
		}
	}
	//déconnecte l'utilisateur avec une session actifs
public function deconnexion_session($id_user)
	{
	$_SESSION = array();
	session_destroy();
	}


public function pagination($nb_id_parpage,$total){
	$total = $this->execute_requete($total);
	$nb_id_max = $recup->fetch();
	$page_actuelle = $_GET['page'];	
	
	if (($nb_id_max['nb']/$nb_id_parpage) < 1) {
		
		$tab = array();
		$tab['page_actuelle'] = 1;
		$tab['premiere_entree'] = 0;
		$tab['nb_id_parpage'] = $nb_id_parpage;
		$tab['nb_id_max'] = $nb_id_max['nb']/$nbparpages;
		$tab['cacher'] = 'hidden';
		return $tab;
	}
	else{
		$nb_page = $nb_id_max['nb']/$nb_id_parpage;
	
			if (isset($_GET['page'])) {
				$page_actuelle=$_GET['page'];
				
				if ($page_actuelle > $nb_id_max['nb']){
				$page_actuelle = $nb_id_max['nb'];
				}
			}
		//$premiereEntree = ($nbparpages*($pageActuelle))-1;
		//if ($pageActuelle > 1){
		//	$premiereEntree = $_GET['page']*$nbparpages;
		//	$premiereEntree = ($premiereEntree - $nbparpages)-1;
		//}
		//else {
		$premiere_entree = $_GET['page']*$nb_id_parpage;
		$premiere_entree = $premiere_entree - $nb_id_parpage;
		//}
		
		$tab = array();
		$tab['page_actuelle'] = $page_actuelle;
		$tab['premiere_entree'] = $premiere_entree;
		$tab['nb_id_parpage'] = $nb_id_parpage;
		$tab['nb_id_max'] = $nb_id_max['nb']/$nb_id_parpage;
		$tab['cacher'] = '';
		return $tab;
		}
	

	
}

}
//-------------------------------------- Fin de class basededonnees
?>
