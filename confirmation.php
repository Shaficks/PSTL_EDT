<?php
session_start();
//print_r($_POST);//debug
$edt = $_GET['edt'];

$tabEdt = explode(",", $edt); //(nomUe,groupe)

$choix = []; //choix de type complet (ex:[["Conferences","1"],["ca","1"],["sup1x","1"],["cpa","2"],["cps","2"],["pc2r","3"]])
$uec = []; ////choix de type leger ([["Conferences","ca,"sup1x,"cpa,"cps","pc2r]) 

for ($i = 0; $i < sizeof($tabEdt) / 2; $i++){//sizeof (tabedt) est toujours un  multiple de 2
    $choix[$i] = [$tabEdt[2 * $i], $tabEdt[2 * $i + 1]];
    $uec[$i]=$tabEdt[2 * $i];
}

$_SESSION['choix'] = $choix; //Choix au complet avec les ue supnX
$_SESSION['uec'] = $uec; //Choix legers(sans les groupes) avec les ue supnX 
//print_r($choix); //Debug
//On cherche a se debarasser des supnX
$_SESSION['FINALEDT'] = [];
$i = 0;
$j = 1;
//echo " & sizeof choix:" . sizeof($choix);
while ($i < sizeof($choix)) {
    if (substr($choix[$i][0], 0, 3) != 'sup') { //Dangereux : si un nom d'ue commence par sup elle sera eliminee : moveTo xyz  by egg
        $_SESSION['FINALEDT']['ue' . $j] = $choix[$i][0];
        $_SESSION['FINALEDT']['ue' . $j . 'gpe'] = $choix[$i][1];
        $j++;
    }
    $i++;
}
//echo "<br/>";
//print_r($_SESSION['FINALEDT']); //Debug
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head> 
        <meta name="description" content="Inscriptions des etudiants au master informatique de l'Upmc"/>
            <meta name="keywords" content="EDT,UPMC,MASTER,INFO,CHOIX,UE,ANAGBLA,NOUIRA"/>
            <meta name="author" content="ANAGBLA Joan & NOUIRA Chafik"/> 
        <title>UPMC, Master Informatique : Saisie des voeux d'UE du S1</title>
        <link rel="stylesheet" href="css/confirmation.css" type="text/css" />
        <link rel="stylesheet" href="css/ue.css" type="text/css" />
        <link rel="stylesheet" href="css/maincss.css" type="text/css" />
        <!-- Decommenter sur le seveur si connexion disponible
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        Contenu duplique en local dans js/jquery-latest.js  -->
        <script src="js/jquery-latest.js"></script> <!-- copie locale de jquery(realisee en 2014) -->
        <script type="text/javascript" src="js/utils.js"></script>
        <script type="text/javascript">
            SEMNUM =<?php echo json_encode($_SESSION['SEMESTRE']); ?>
            //alert("SEMNUM : "+JSON.stringify(SEMNUM));
        </script>
        <script type="text/javascript" src="js/calendrier.js"></script>
        <script type="text/javascript" src="js/edt_print.js"></script> <!--//composant d'affichage des edt (reutilisable)-->
        <script type ="text/javascript">
            function show_edt() {
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
                (document.getElementById('planning')).value = JSON.stringify(asso);//ajout de l'edt dans un hidden pour la suite(edtideal & pdf)
            }
        </script>
        <script type="text/javascript">
            function rollback() { //fonction de retour arriere en dur (l'url de retour est fixe et statique)  
                var uevtab = <?php
                if (isset($_SESSION['uevtab']))
                    echo json_encode($_SESSION['uevtab']);
                else
                    echo json_encode([]);
                ?>;
                //alert(JSON.stringify(uevtab));
                if (uevtab.length > 0) {  ///ATTENTION PEUT ETRE INCOHERENT UNLOAD ERASE SOUHAITABlE
                    var url = "choix_ues.php?uev1=" + uevtab[0];
                    for (var i = 1; i < uevtab.length; i++)
                        url += "&uev" + (i + 1) + "=" + uevtab[i];
                    window.location.href = url;
                } else
                    window.location.href = "choix_ues.php";
            }
        </script>
        
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"/>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>             
    </head>

    <body style="background-color:lightgrey;" onload="show_edt()">
        <?php include("navbar_1.php"); ?>

            <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">        
        <h2><b>Confirmation de l'Emploi du temps choisi</b></h2>
            <br/>
            <div style="display:inline-block;vertical-align:middle;" class="rollback" id="back_index ">
                <button class="btn btn-sm btn-primary" id="bbackindex" onclick="javascript:rollback()">Retour</button>    
            </div>
            <br/><br/><br/>
        <span class='note' id='noteVoeux'>
            <font color='red'>Les voeux ne seront enregistr&eacute;s que lorsque vous les aurez valid&eacute;s.</font>
        </span>
        
        <div class="edtbox" id="edtbox__"></div>


        <br/>
        <form method='get' action='validation.php'>
          <input type='hidden' name='planning' id='planning' value=""></input>
          <div>

 
            <div style="display:inline-block;vertical-align:middle;">
                <input class="btn btn-sm btn-primary" type='submit' name='submit' value='Valider cet emploi du temps'> </input>
            </div>
              
            <span class='note' id='noteVoeux'>
            <font color='red'> <b>La page peut prendre un certain temps a se charger. Merci de ne pas la recharger!</b></font>
            </span>
              
          </div>    
        </form>
      </div>
    </div>           
    </body>
</html>
