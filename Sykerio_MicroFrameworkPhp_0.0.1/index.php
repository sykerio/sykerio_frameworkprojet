<?php
include 'sykerio_lib/sykerio_configuration.php';
require_once 'sykerio_lib/sykerio_bdd.php';

$sykerio_integration = new sykerio_integration();
//$sykerio_basededonnees = new sykerio_basededonnees();

$sy_bdd = new sy_database ();
//$sykerio_integration -> medoo_config('');
?>


<html>
  <?php $sykerio_integration -> meta_header("Home",""); ?> <!-- DEBUT HEADER -->
  <body >            

                                         <!--  DEBUT BODY -->
  <div class="container-fluid ">
    <div class="row"> 
     <div class="col-md-8 col-md-offset-2 text-center ">
      <h1 class="logo"><img src="sykerio_css/icons/Retina-Ready@2x.png" alt="Map">Sykerio<small class="alert alert-primary">Micro Framwork php</small></h1>
    </div>
  </div>


  <div class="row"> <!-- LIGNE 1 -->
    <div class="col-md-6 col-md-offset-3 text-center"><!-- COLONNE 1 -->

        <blockquote >
          <p><code>Class sykerio_integration</code>  est la <code>class</code> d'intégration de code natif à SYKERIO_FRAMWORK.
            Elle comprend plusieurs fonctions de génération de code afin de rendre le code plus propre et facile</p>
        </blockquote>
        
        <?php  
        $table_t = array('Functions','Descriptions');
        $table_main = array(
        '1' => array('<code>meta_header($titre,$position)</code>','Génere le code du <code>head</code> dans le document <code>html</code>'), 
        '2' => array('<code>boutton_modal($id_cible,$text_boutton)</code>','Génere le code d\'un bouton activant un modal de la meme id'),
        '3' => array('<code>template_modal($id_cible,$titre_modal,$contenu_modal)</code>','Génére la vue du modal et s\'active avec le <code>boutton_modal</code> avec la même id'),
        '4' => array('<code>template_table($table_titre,$table_contenu,"NORMAL")</code>','Génère et incrémente un table HTML en prenant en paramètre un tableau de contenant des titres ainsi qu\'un autre avec le contenu'),
        '5' => array('<code>execute_requete($requete)</code>','exécute une requête SQL et renvois le résultat dans un tableau')
                                  );


          $sykerio_integration -> template_table($table_t,$table_main,'NORMAL');
          $sy_bdd->sy_database_connect();
          
          //$table_t = array('Nom utilisateur','Prénom utilisateur');
          //$table_c = array(
          //'ligne 1' => array('cellule1','cellule2','cellule3'),
          //'ligne 2' => array('cellule1','cellule2','cellule3'));
          //<?php $sykerio_integration -> template_modal('Test','Mon titre','mon contenu'); 
          
          //$sykerio_integration -> template_btn_modal('id1','Boutton');
          //$sykerio_integration -> template_modal('id1','Mon titre','');

           ?>
      </div>
    </div>
  </div>
  </body>
</html>
