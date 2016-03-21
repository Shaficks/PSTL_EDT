<?php
session_start();

$CRITEFF = 25; //Effectif critique 

$choix = $_SESSION['choix'];
$num = $_SESSION['num'];
$mailetu = $_SESSION['mail'];
$spe = $_SESSION['spe'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];


if(isset($_GET['planning']))
        $_SESSION['planning'] = json_decode($_GET['planning'], true);

/* print_r($choix); //Debug 
  echo "<br/>"; //Debug
  print_r($_SESSION['FINALEDT']); //Debug
  echo " & his.size =" . sizeof($_SESSION['FINALEDT']); //Debug
  echo "<br/>"; //Debug */

require_once('config.php'); // Acces Base de donnees
//On verifie que les voeux n'aient pas deja ete faits
$sql = "SELECT * FROM listeetudiants WHERE numero=" . $_SESSION['num'] . " AND voeux=1";
$requete = mysql_query($sql) or die(mysql_error());
if (mysql_num_rows($requete) > 0) {
    echo "<div id ='enddiv'>"
        . "<p id='endp'>"
                . "<span id='endspan'>Vous avez d&eacute;jà enregistr&eacute; vox voeux.<br>"
        . " Vous pourrez &eacute;ventuellement les modifier en septembre lors de la pr&eacute;-rentr&eacute;e."
                . "</span> <br>";
        echo "<a href='http://www-master.ufr-info-p6.jussieu.fr/lmd'>Retour sur le site du master informatique de l'Upmc</a> "
        . "</p>"
    . "</div>";
    exit();
}

//On ecrit la requete sql dans ListEtudiants : on enregistre l'etudiant
$sql = "INSERT INTO listeetudiants(numero, nom, prenom, mail, spe, voeux) VALUES(" . $num . ", '" . $nom . "', '" . $prenom . "', '" . $mailetu . "', '" . $spe . "', 0)";
mysql_query($sql) or die(mysql_error());

$ue = "";
for ($i = 1; $i <= sizeof($_SESSION['FINALEDT']) / 2; $i++) {
    $ue .= "ue" . $i . "='" . $_SESSION['FINALEDT']['ue' . $i] . "', ue" . $i . "gpe=" . $_SESSION['FINALEDT']['ue' . $i . 'gpe'];
    if ($i < sizeof($_SESSION['FINALEDT']) / 2)
        $ue .= ", ";
}
//echo $ue; //Debug
//Ici on mets a jour les champs UEi, UEigpe et voeux de la base dans ListEtudiants
$sql = "UPDATE listeetudiants SET voeux=1, " . $ue . " WHERE numero=$num";
mysql_query($sql) or die(mysql_error());

//On ecrit la requete sql dans la SPE, ce qui donne le rang d'enregistrement des voeux
$sql = "INSERT INTO ".strtolower($spe.'(numetu)')." VALUES($num)";
mysql_query($sql) or die(mysql_error());

//On recupere rang
$sql = "SELECT * FROM ". strtolower($spe) ." WHERE numetu=$num";
$requete = mysql_query($sql) or die(mysql_error());
$rang = mysql_fetch_array($requete)['rang'];

$_SESSION['rang'] = $rang;

//On ecrit la requete sql dans Master, ce qui donne le rang d'enregistrement des voeux (au sein du master)
$sql = "INSERT INTO master(numetu) VALUES($num)";
mysql_query($sql) or die(mysql_error());

//On ecrit la requete sql dans UEGroupes : incrementer le nb d'etudiant dans chaque groupe
$effectif = [];
for ($i = 1; $i <= sizeof($_SESSION['FINALEDT']) / 2; $i++) {
    $sql = "SELECT * FROM uegroupes WHERE groupe='" . $_SESSION['FINALEDT']['ue' . $i] . $_SESSION['FINALEDT']['ue' . $i . 'gpe'] . "'";
    $requete = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($requete) > 0) {
        $sql = "UPDATE uegroupes SET effectif = effectif+1 WHERE groupe = '" . $_SESSION['FINALEDT']['ue' . $i] . $_SESSION['FINALEDT']['ue' . $i . 'gpe'] . "'";
        mysql_query($sql) or die(mysql_error());
    }elseif($_SESSION['FINALEDT']['ue' . $i]!='Conferences'){//Ne pas tenir compte des conferences pour le calcul des effectifs
        $sql = "INSERT INTO uegroupes(groupe,effectif) VALUES('" . $_SESSION['FINALEDT']['ue' . $i] . $_SESSION['FINALEDT']['ue' . $i . 'gpe'] . "',0)";
        //echo "sql:$sql";//Debug : all right but 'Conference 0' in db
        mysql_query($sql) or die(mysql_error());
        //Update apres creation des groupes auparavant inexistant dans la base
        $sql = "UPDATE uegroupes SET effectif = effectif+1 WHERE groupe = '" . $_SESSION['FINALEDT']['ue' . $i] . $_SESSION['FINALEDT']['ue' . $i . 'gpe'] . "'";
        mysql_query($sql) or die(mysql_error());
    }
    $sql = "SELECT * FROM uegroupes WHERE groupe='" . $_SESSION['FINALEDT']['ue' . $i] . $_SESSION['FINALEDT']['ue' . $i . 'gpe'] . "'";
    $requete = mysql_query($sql) or die(mysql_error());
    $donnees = mysql_fetch_array($requete);
    $effectif[$i - 1] = $donnees['effectif'];
}
//print_r($effectif); //Debug
//Fermeture connexion base de donnees
mysql_close();

//Liste finale des ues et des groupes
$ues = [];
$gpe = [];
for ($i = 1; $i <= sizeof($_SESSION['FINALEDT']) / 2; $i++) {
    $ues[$i - 1] = '' . $_SESSION['FINALEDT']['ue' . $i];
    $gpe[$i - 1] = '' . $_SESSION['FINALEDT']['ue' . $i . 'gpe'];
    if ($effectif[$i - 1] > $CRITEFF)
        $gpe[$i - 1] = $gpe[$i - 1] . '  (complet)';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title>UPMC, Master Informatique : Saisie des voeux d'UE du S1</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <meta name="description" content="Inscriptions des etudiants au master informatique de l'Upmc"/>
            <meta name="keywords" content="EDT,UPMC,MASTER,INFO,CHOIX,UE,ANAGBLA,NOUIRA"/>
            <meta name="author" content="ANAGBLA Joan & NOUIRA Chafik"/> 
        <link rel="stylesheet" href="css/validation.css" type="text/css" />
        <link rel="stylesheet" href="css/ue.css" type="text/css" />
        <link rel="stylesheet" href="css/maincss.css" type="text/css" />
        <!-- Decommenter sur le seveur si connexion disponible
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        Contenu duplique en local dans js/jquery-latest.js  -->
        <script src="js/jquery-latest.js"></script> <!-- copie locale de jquery(realisee en 2014) -->
        <script type="text/javascript" src="js/utils.js"></script>
        <script type="text/javascript" src="js/edt_print.js"></script>
         <script type="text/javascript">
            SEMNUM =<?php echo json_encode($_SESSION['SEMESTRE']); ?>
            //alert("SEMNUM : "+JSON.stringify(SEMNUM));
        </script>
        <script type="text/javascript" src="js/calendrier.js"></script>
        <script type="text/javascript">
            function sayonara() { //deplacer vers la derniere page
                window.location.href = "edt_ideal.php"; //"http://www-master.ufr-info-p6.jussieu.fr/lmd/";
                //<span class='Final' id='AuRevoirSpan'><button class="boutton" id="ByeBye" onclick="javascript:sayonara()">Sayonara</button></span>
            }
            function recap() {
                var ue = <?php echo json_encode($choix); ?>;
                //alert(JSON.stringify(ue));
                var listeUE = getCalendrier(), asso = {};

                for (var r = 0; r < ue.length; r++) {
                    asso[listeUE[ ue[r][0] ][0]] = ue[r][0].toUpperCase();
                    asso[listeUE[ ue[r][0] ][ue[r][1]] [0]] = ue[r][0].toUpperCase() + "-" + ue[r][1];
                    asso[listeUE[ ue[r][0] ][ue[r][1]] [1]] = ue[r][0].toUpperCase() + "-" + ue[r][1];
                }
                //alert(JSON.stringify(asso));
                print_edt(asso, "", ""); //Precondition : Une balise d'id "edtbox__" doit exister dans le document html
                //Precondition : Une balise d'id "recapbox" doit exister dans le document html                
                printRecap(<?php echo json_encode($ues); ?>,<?php echo json_encode($gpe); ?>);
                
            }
        </script>
        
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"/>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>          
    </head>

    <body style="background-color:lightgrey;" onload="recap()">
        <?php include("navbar_1.php"); ?>

            <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">         
          <h2><b>R&eacute;capitulatif de votre pr&eacute;-inscription</b></h2>

        <div id="infosEtu">
            <span id="infoetu"><b>Dossier n&deg; : <?php echo $num; ?></b></span><br/>
            <span id="infoetu"><b>&Eacute;tudiant : <?php echo $prenom . " " . strtoupper($nom); ?></b></span><br/>     
        </div>

        <div id="contextInfos">
            <span id="contextinfo"><b><?php echo "Le " . date("d.m.y") . " à " . date("H:i:s"); ?></b></span><br/>
            <span id="contextinfo"><b>Master Sp&eacute;cialit&eacute; <?php echo $spe; ?></b></span><br/>
            <span id="contextinfo"><b>Rang : <?php echo $rang; ?></b></span><br/>
        </div>
        <br/>
        <div id="finalMsgDiv">
            <span class='note' id='finalMsg'><h4><b><font color="red">IMPORTANT : </font>Vous devez t&eacute;l&eacute;charger la Version Imprimable et l'apporter le jour des insctiptions p&eacute;dagogiques.</b>
                    <br/><b>Vous devez ensuite choisir votre Emploi du Temps id&eacute;al en cliquant sur "EDT Ideal" pour finaliser votre pr&eacute;-inscription.</b></h4></span>
        </div>

        <div id="recapbox"></div><br/>
        <div  id="edtbox__"></div>
        
        
        <br/><br/>
        <button class="btn btn-sm btn-primary" onclick="sayonara()">EDT Ideal</button> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input class="btn btn-sm btn-primary" type="button" onclick="location.href='genererPDF.php';" value="Version Imprimable" />
        
      </div>
    </div>           
    </body>
</html>

<?php

// Script servant à envoyer le mail à l'étudiant en mettant comme émetteur le secrétariat de sa spécialité
// Ensuite il envoi le même mail une 2ème fois mais cette fois de l'étudiant à l'admin et au secrétariat
require_once('genererMailPDF.php');

?>
