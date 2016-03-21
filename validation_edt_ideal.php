<?php
session_start();

$num = $_SESSION['num'];
require_once('config.php'); // Acces Base de donnees
//On verifie que les voeux ideaux n'aient pas deja ete faits
$sql = "SELECT * FROM edt_ideal WHERE numetu=" . $_SESSION['num'] . " AND voeux=1";
$requete = mysql_query($sql) or die(mysql_error());

if (!(mysql_num_rows($requete) > 0)) {

    $mailetu = $_SESSION['mail'];
    $spe = $_SESSION['spe'];
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];

    $edt = $_GET['ideal'];

    $tabEdt = explode(",", $edt); //(nomUe,groupe)

    $choix = []; //choix de type complet (ex:[["Conferences","1"],["ca","1"],["sup1x","1"],["cpa","2"],["cps","2"],["pc2r","3"]])
    $uec = []; ////choix de type leger ([["Conferences","ca,"sup1x,"cpa,"cps","pc2r]) 

    for ($i = 0; $i < sizeof($tabEdt) / 2; $i++) {//sizeof (tabedt) est toujours un  multiple de 2
        $choix[$i] = [$tabEdt[2 * $i], $tabEdt[2 * $i + 1]];
        $uec[$i] = $tabEdt[2 * $i];
    }


    $_SESSION['choix'] = $choix; //Choix au complet avec les ue supnX
    $_SESSION['uec'] = $uec; //Choix legers(sans les groupes) avec les ue supnX 
//print_r($choix); //Debug
    //On cherche a se debarasser des supnX
    $_SESSION['EDT_IDEAL'] = [];
    $i = 0;
    $j = 1;
    //echo " & sizeof choix:" . sizeof($choix);
    while ($i < sizeof($choix)) {
        if (substr($choix[$i][0], 0, 3) != 'sup') { //Dangereux : si un nom d'ue commence par sup elle sera eliminee : moveTo xyz  by egg
            $_SESSION['EDT_IDEAL']['ue' . $j] = $choix[$i][0];
            $_SESSION['EDT_IDEAL']['ue' . $j . 'gpe'] = $choix[$i][1];
            $j++;
        }
        $i++;
    }

     
    //On ecrit la requete sql dans edt_ideal : on enregistre l'etudiant
    $sql = "INSERT INTO edt_ideal(numetu, voeux) VALUES(" . $num .  ", 1)";
    mysql_query($sql) or die(mysql_error());

    $ue = "";
    for ($i = 1; $i <= sizeof($_SESSION['EDT_IDEAL']) / 2; $i++) {
        $ue .= "ue" . $i . "='" . $_SESSION['EDT_IDEAL']['ue' . $i] . "', ue" . $i . "gpe=" . $_SESSION['EDT_IDEAL']['ue' . $i . 'gpe'];
        if ($i < sizeof($_SESSION['EDT_IDEAL']) / 2)
            $ue .= ", ";
    }
    //echo $ue; //Debug
    //Ici on mets a jour les champs UEi et UEigpe de la table edt_ideal
    $sql = "UPDATE edt_ideal SET " . $ue . " WHERE numetu=" . $num;
    mysql_query($sql) or die(mysql_error());

    //Fermeture connexion base de donnees
    mysql_close();

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title>UPMC, Master Informatique : Saisie des voeux d\'UE du S1</title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="description" content="Inscriptions des etudiants au master informatique de l'Upmc"/>
        <meta name="keywords" content="EDT,UPMC,MASTER,INFO,CHOIX,UE,ANAGBLA,NOUIRA"/>
        <meta name="author" content="ANAGBLA Joan & NOUIRA Chafik"/> 

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"/>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>         
    </head>


    <body style="background-color:lightgrey;">
        <?php include("navbar_1.php"); ?>
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">  

                <h2>  <b>  Pr&eacute;-inscription termin&eacute;e, vous pouvez &agrave; pr&eacute;sent quitter le site. </b></h2> <br/>
                <h3>
                    Toute demande de modification se fera directement aupr&egrave;s des responsables de la sp&eacute;cialit&eacute; le jour des inscriptions p&eacute;dagogiques.
                </h3>

            </div>
        </div>  
    </body>
</html>
