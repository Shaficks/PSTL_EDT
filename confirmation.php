<?php
session_start();
//print_r($_POST);//debug
$edt = $_GET['edt'];

$tabEdt = explode(",", $edt); //(nomUe,groupe)

$choix = [[], [], [], [], []];

for ($i = 0; $i < sizeof($tabEdt) / 2; $i++)
    $choix[$i] = [$tabEdt[2 * $i], $tabEdt[2 * $i + 1]];

for ($i = 1; $i < sizeof($choix) + 1; $i++) {
    $ue = 'ue' . $i;
    $gp = 'ue' . $i . 'gpe';
    $_SESSION[$ue] = $choix[$i - 1][0];
    $_SESSION[$gp] = $choix[$i - 1][1];
}
//print_r ($choix); //Debug

$_SESSION['choix'] = $choix;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title>UPMC, Master Informatique : Saisie des voeux d'UE du S1</title>
        <link rel="stylesheet" href="css/maincss.css" type="text/css" />
        <!-- Decommenter sur le seveur si connexion disponible
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        Contenu duplique en local dans js/jquery-latest.js  -->
        <script src="js/jquery-latest.js"></script> <!-- copie locale de jquery(realisee en 2014) -->
        <script type="text/javascript" src="js/utils.js"></script>
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
                ajout();
            }
        </script>
        
        <script type ="text/javascript">  

            function ajout() {
                
                var mess = "";
                
                var listeUE = getCalendrier();
                
                var ue = [ ["<?php echo $choix[0][0];?>", <?php echo $choix[0][1];?>], ["<?php echo $choix[1][0];?>", <?php echo $choix[1][1];?>], ["<?php echo $choix[2][0];?>", <?php echo $choix[2][1];?>],["<?php echo $choix[3][0];?>", <?php echo $choix[3][1];?>],["<?php echo $choix[4][0];?>", <?php echo $choix[4][1];?>]];
                
                var asso = {};
                var r = 0;
                var l = [];
                var ll = 0;
                
                mess = "<table>"; //document.write("<table>");
                
                for (r=0; r<5; r++) {
                    asso[listeUE[ ue[r][0] ][0]] = ue[r][0].toUpperCase();
                    asso[listeUE[ ue[r][0] ][ue[r][1]] [0]] = ue[r][0].toUpperCase() + "-" + ue[r][1];
                    asso[listeUE[ ue[r][0] ][ue[r][1]] [1]] = ue[r][0].toUpperCase() + "-" + ue[r][1];
                }
                
                mess = mess + "<table border='1'"; //document.write("<table border='1'");
                mess = mess + "<tr> <th></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>"; //document.write("<tr> <th></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");
                
                mess = mess + "<tr> <th>8:30 - 10:30</th>"; //document.write("<tr> <th>8:30 - 10:30</th>");
                txt = "";
                l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                mess = mess + txt + "</tr>"; //document.write(txt + "</tr>");
                
                mess = mess + "<tr> <th>10:45 - 12:45</th>"; //document.write("<tr> <th>10:45 - 12:45</th>");
                txt = "";
                l = ['lu10', 'ma10', 'me10', 'je10', 've10'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                mess = mess + txt + "</tr>"; //document.write(txt + "</tr>");
                
                mess = mess + "<tr> <th>13:45 - 15:45</th>"; //document.write("<tr> <th>13:45 - 15:45</th>");
                txt = "";
                l = ['lu13', 'ma13', 'me13', 'je13', 've13'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                mess = mess + txt + "</tr>"; //document.write(txt + "</tr>");
                
                mess = mess + "<tr> <th>16:00 - 18:00</th>"; //document.write("<tr> <th>16:00 - 18:00</th>");
                txt = "";
                l = ['lu16', 'ma16', 'me16', 'je16', 've16'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                mess = mess + txt + "</tr>"; //document.write(txt + "</tr>");
                mess = mess + "</table>"; //document.write("</table>");
                
                var obj = document.getElementById('week');
                obj.value = mess;                
            }            
        </script>
        <script type="text/javascript">
            function rollback() { //fonction de retour arriere en dur (l'url de retour est fixe et statique)  

                var uevtab = <?php if (isset($_SESSION['uevtab'])) echo json_encode($_SESSION['uevtab']); else echo json_encode([]);?>;
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
    </head>

    <body onload="show_edt()">
        <h1>UPMC : Master Informatique</h1>
        <h3>Voil&agrave; vos voeux, &agrave; confirmer ci-dessous.</h3>

        <span class='note' id='noteVoeux'>
            <font color='red'>Les voeux ne seront enregistr&eacute;s que lorsque vous les aurez valid&eacute;s.</font>
        </span>

        <div class="edtbox" id="edtbox__"></div>

        <div class="rollback" id="back_index">
            <button class="boutton" id="bbackindex" onclick="javascript:rollback()">Retour</button>    
        </div>

        <form method='post' action='validation.php'>
            <input type='hidden' name='planning' id='planning' value=""></input>
            <input type='hidden' name='week' id='week' value=""> </input>
            <input type='submit' name='submit' value='Valider cet emploi du temps'> </input>
        </form>
    </body>
</html>
