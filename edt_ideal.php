<?php
session_start(); //recuperation de la session
//print_r($_SESSION['uec']); //Debug
?>

<!--Page script gerant les statistiques sur l'emploie du temps ideal de l'etudiant en fonction de ses ues choisies: edt.php-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <meta charset="UTF-8"> 
            <meta name="description" content="Inscriptions des etudiants au master informatique de l'Upmc">
            <meta name="keywords" content="EDT,UPMC,MASTER,INFO,CHOIX,UE,ANAGBLA,NOUIRA">
            <meta name="author" content="ANAGBLA Joan & NOUIRA Chafik"> 
            <title>UPMC, Master Informatique : Saisie des voeux d'UE du S1</title>
            <link rel="stylesheet" href="css/edt_ideal.css" type="text/css" />
            <link rel="stylesheet" href="css/ue.css" type="text/css" />
            <link rel="stylesheet" href="css/maincss.css" type="text/css" />
            <!-- Decommenter sur le seveur si connexion disponible
            <script src="http://code.jquery.com/jquery-latest.js"></script>
            Contenu duplique en local dans js/jquery-latest.js  -->
            <script src="js/jquery-latest.js"></script> <!-- copie locale de jquery(realisee en 2014) -->
            <script type="text/javascript" src="js/utils.js"></script>
            <script type="text/javascript" src="js/calendrier.js"></script>
            <script type="text/javascript" src="js/edt_utils.js"></script>
            <script type="text/javascript" src="js/edt_print.js"></script>
            <script type="text/javascript" src="js/edt.js"></script>
            <script type="text/javascript">
                GRPES = {};
                SEMNUM =<?php echo json_encode($_SESSION['SEMESTRE']); ?>;
                //alert("SEMNUM : " + JSON.stringify(SEMNUM));
                SAMPLE =<?php echo json_encode($_SESSION['uec']); ?>;
                //alert("SAMPLE : " + JSON.stringify(SAMPLE));
            </script>
            <script type="text/javascript" src="js/edt_ideal.js"></script>
            
            
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>                 
    </head>

    <body style="background-color:lightgrey;" onload="edt(SAMPLE);">
        <?php include("navbar_1.php"); ?>

            <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">         
          <h2><b>Emploi du Temps Id&eacute;al</b></h2>
          <font size = '4'><b>A des fins purement statistiques, nous aimerions savoir quel aurait &eacute;t&eacute; votre emploi du temps id&eacute;al.<br/>
           Cela ne modifiera en rien votre pr&eacute;-inscription!</b></font>
          <br/><br/>
          <span class="note" id="istats"> </span>      
        <form id="formUes" name="formChoixUes" method="GET" onsubmit="javascript:chooseIDEAL(this)" action="javascript:(function(){return;})()">
            
            <center>
            <div id="edts" class="form-inline"></div>
            </center>
            
        </form>
        
      </div>
    </div>           
    </body>
</html>
