<?php

require_once ('uerl.php');

/** GESTION UES **/
session_start(); //recuperation de la session
$master=$_SESSION['MASTER'];

//print_r($_SESSION);//Debug

$spe = $_SESSION['spe'];  //recuperation de la specialite de l'etudiant
$max_ues = ($_SESSION['magister'] == 'true' ? 6 : 5);  //nombre max d'ues suivies (redoublant ou pas)
$nb_suivi = $max_ues; //nombre d'ues suivies ce semestre( default =max_ues)
$ue_valides = []; //tableau vide : necessaire car tout est base sur la presence de ce tableau
if ($_SESSION['redouble'] == 'true') { //recuperation des ues validees par un redoublant
    for ($i = 1; $i <= 4; $i++) //4 en dur : immuable on ne peut pas valider 5 ue et redoubler mm si on a fait un magistere
        if (isset($_GET["uev$i"]))
            $ue_valides[] = $_GET["uev$i"];

    $_SESSION['uevtab'] = $ue_valides; //Mise a jour de l'environement de session pour la suite du processus (ici nous utiliserons $ue_valides)
    $nb_suivi = $max_ues - sizeof($ue_valides); //nombre d'ues suivies = max_ues-nombre d'ues validees
    //echo "validees=[".implode(",", $_SESSION['uevtab'])."] ->nb_suivi=$nb_suivi";//debug
}
$_SESSION['nb_suivi'] = $nb_suivi; //ajout du nombre d' ues suivies a l'environnement de session 

/* * GESTION EDT* */
require_once('config.php'); //On aura besoin de config.php afin de se connecter a la base
$reponse = mysql_query("SELECT * FROM UEGroupes"); 
$groupes = []; //Tableau qui contiendra les paires (groupe_ue => effectif) Exemple ( groupe : algav1, effectif : 30 )
while ($donnees = mysql_fetch_array($reponse))
    $groupes[$donnees['groupe']] = $donnees['effectif'];

?>

<!--Page de saisie des ues suivies ce semestre par un etudiant: choix_ues.php--> <!--FUSIONNE THIS TO CHOIXEDT-->
<!--Page script gerant le calcul de l'emploie du temps de l'etudiant en fonction de ses ues choisies: edt.php-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <meta charset="UTF-8"> 
            <meta name="description" content="Inscriptions des etudiants au master informatique de l'Upmc">
            <meta name="keywords" content="EDT,UPMC,MASTER,INFO,CHOIX,UE,ANAGBLA,NOUIRA">
            <meta name="author" content="ANAGBLA Joan & NOUIRA Chafik"> 
            <title>UPMC, Master Informatique : Saisie des voeux d'UE du S1</title>
            <link rel="stylesheet" href="css/choix_ues.css" type="text/css" />
            <link rel="stylesheet" href="css/ue.css" type="text/css" />
            <link rel="stylesheet" href="css/maincss.css" type="text/css" />
            <!-- Decommenter sur le seveur si connexion disponible
            <script src="http://code.jquery.com/jquery-latest.js"></script>
            Contenu duplique en local dans js/jquery-latest.js  -->
            <script src="js/jquery-latest.js"></script> <!-- copie locale de jquery(realisee en 2014) -->
            <script type="text/javascript" src="js/utils.js"></script>
            <script type="text/javascript" src="js/choix_ues.js"></script>
            <script type="text/javascript">
                GRPES  =<?php echo json_encode($groupes); ?> ;
                //Modifs du aux besoin du s2 :
                SPERECOM =<?php echo json_encode($master[$spe]["recom"]); ?> ;
                SEMNUM =<?php echo json_encode($_SESSION['SEMESTRE']); ?> ;
                UEVALIDES =<?php echo json_encode($ue_valides); ?>;
                //alert("SPERECOM : "+JSON.stringify(SPERECOM));
                //alert("SEMNUM : "+JSON.stringify(SEMNUM));
                //alert("UEVALIDES : "+JSON.stringify(UEVALIDES));
            </script>
            <script type="text/javascript" src="js/descriptions.js"></script>
            <script type="text/javascript" src="js/calendrier.js"></script>
            <script type="text/javascript" src="js/edt_utils.js"></script>
            <script type="text/javascript" src="js/edt_print.js"></script>
            <script type="text/javascript" src="js/edt.js"></script>
            <script type="text/javascript" src="js/effectifs.js"></script>
            <script type="text/javascript" src="js/sem2constraints.js"></script>
            


            <script type="text/javascript">
                function rollback() { //fonction de retour arriere en dur (l'url de retour est fixe et statique)    
                    var num = <?php echo(json_encode($_SESSION['num'])); ?>;
                    var nom = <?php echo(json_encode($_SESSION['nom'])); ?>;
                    var spe = <?php echo(json_encode($_SESSION['spe'])); ?>;
                    var mail = <?php echo(json_encode($_SESSION['mail'])); ?>;
                    var prenom = <?php echo(json_encode($_SESSION['prenom'])); ?>;
                    var magister = <?php echo(json_encode($_SESSION['magister'])); ?>;
                    var redouble = <?php echo(json_encode($_SESSION['redouble'])); ?>;
                    if (redouble == 'true')
                        window.location.href = "saisie_ues_valides.php"; //sans memoire (y a que 4 cases au plus a cocher et la flem)
                    else
                        window.location.href = "index.php?num=" + num + "&nom=" + nom + "&spe=" + spe +
                                "&mail=" + mail + "&prenom=" + prenom + "&magister=" + magister + "&redouble=" + redouble;
                }
            </script>
            
            
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>             
    </head>

    <body style="background-color:lightgrey;" onload="add_oblig(<?php echo(json_encode($nb_suivi)); ?>)">
       
        <?php include("navbar_1.php"); ?>
         
            <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">        
        <h2><b>Choix des UEs</b></h2>

        <span class="note" id="description_master"> </span>      

        <div class="rollback" id="back_index"><!-- On est oblige de le mettre hors du formulaire sinon uncaught exception (pris pour un boutton de soumission du formulaire -> pb dans l'affichage )-->
            <button class="btn btn-primary" id="bbackindex" onclick="javascript:rollback()">Retour</button>    
        </div>
        <br/><br/>
        <span id="span_tab_ues"><!-- une span pour plus de flexibilite dans l'affichage avec css-->

            <form id="formUes" name="formChoixUes" method="GET" onsubmit="javascript:chooseEDT(this)" action="javascript:(function(){return;})()">
                <!-- action="javascript:(function(){return;})()" permet : 
                Gestion par aiguillage centralisee avec javascript : js/file.js qui decidera en fonction des parametres transmis 
                ou aller ensuite / ou bien rester sur la meme page active( parametres incorrects par exemple )
                sans recharger la page (conservation de l etat du formulaire)  -->
                <h3><b>Choix des unit&eacute;s d'enseignement</b></h3>
                <div>
                <fieldset>
                    <legend>Selectionnez les ues que vous souhaitez suivre, les emlpois du temps seront g&eacute;n&eacute;r&eacute;s ci-dessous : </legend>
                    <div class="error" id="con_error_choix"></div>
                    <?php
                    $choix_ues = $master["$spe"];
                    $cpt = 1;
                    echo "<div>";
                    foreach ($choix_ues as $key => $value) {
                        sort($value); //ordre alphabetique sur la liste d'ues 
                        switch($cpt) {
                            case 1 : echo "<b>UEs obligatoires :</b>"; break;
                            case 2 : echo "<b>UEs recommand&eacute;es :</b>"; break;
                            case 3 : echo "<b>Autres UEs :</b>"; break;
                            default : echo "<b>Should not occur !</b>"; break;
                        }
                        $cpt++;
                        echo "<br/>";
                        foreach ($value as $ue) {
                            //if($cpt != 0 && $cpt % 13 == 0) echo "<br/>";
                            if (!in_array($ue, $ue_valides)) {//retirer les ues deja valides pour un redoublant
                                if ($key == 'oblig') {
                                    echo "<div style=\"display:inline-block;float:left;\">";
                                    echo '<span class="box_ue_' . $key . '" id="span_' . $ue . '">' .
                                    '<input disabled="true" checked="checked" class="check_ue" type="checkbox" name="' . $ue . '" id="ue_' . $ue . '"/>' .
                                    '<a target="_blank" href="'.$uerl[$ue].'" id="label_' . $ue . '" for="' . $ue . '">' . strtoupper($ue) . '</a>' .
                                    '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . "\n";
                                }
                                else {
                                    echo "<div style=\"display:inline-block;float:left;\">";
                                    echo '<span class="box_ue_' . $key . '" id="span_' . $ue . '">' .
                                    '<input class="check_ue" onclick="add_ue(this,' . $nb_suivi . ')" type="checkbox" name="' . $ue . '" id="ue_' . $ue . '"/>' .
                                    '<a target="_blank" href="'.$uerl[$ue].'" id="label_' . $ue . '" for="' . $ue . '">' . strtoupper($ue) . '</a>' .
                                    '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . "\n";
                                }
                                echo "</div>";
                            }
                        }
                        echo "<br/><br/><br/>";
                    }
                    echo "</div>";
                    ?>
                </fieldset>
                <div id="choices"></div>
                <center>
                <div id="edts" ></div>
                </center>
                </div>
            </form>
        </span>
        
      </div>
    </div>        
    </body>
</html>
