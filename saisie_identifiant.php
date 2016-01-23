<!--Page de verification d'email : saisie_identifiant.php-->

<?php
session_start();   //recuperation de la session
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <meta charset="UTF-8"/>
            <title>UPMC, Master Informatique : Saisie des voeux d'UE du S1</title>
            <link rel="stylesheet" href="css/maincss.css" type="text/css" />
            <!-- Decommenter sur le seveur si connexion disponible
            <script src="http://code.jquery.com/jquery-latest.js"></script>
            Contenu duplique en local dans js/jquery-latest.js  -->
            <script src="js/jquery-latest.js"></script> <!-- copie locale de jquery(realisee en 2014) --> 
            <script type="text/javascript" src="js/utils.js"></script>
            <script type ="text/javascript">
                function verifyId(formulaire) {
                    var id_client = formulaire.idetu.value.trim();
                    var id_server = <?php echo(json_encode($_SESSION['ident'])); ?>;
                    var redouble =<?php echo(json_encode($_SESSION['redouble'])); ?>;
                    alert("id2=" + id_server); //me sert pour l'instant je ne recoit pas de mail 
                    if (id_client == id_server) {
                        if (redouble == 'true')
                            window.location.href = "saisie_ues_valides.php";
                        else
                            window.location.href = "choix_ues.php";
                    } else {
                        printHTML("#con_error_id", "L'identifiant saisi ne correspond pas!");
                    }
                }
            </script>

            <script type="text/javascript">
                function rollback() { //fonction de retour arriere en dur (l'url de retour est fixe et statique)       
                    var num = <?php echo(json_encode($_SESSION['num'])); ?>;
                    var nom = <?php echo(json_encode($_SESSION['nom'])); ?>;
                    var spe = <?php echo(json_encode($_SESSION['spe'])); ?>;
                    var mail= <?php echo(json_encode($_SESSION['mail'])); ?>;
                    var prenom = <?php echo(json_encode($_SESSION['prenom'])); ?>;
                    var magister = <?php echo(json_encode($_SESSION['magister'])); ?>;
                    var redouble = <?php echo(json_encode($_SESSION['redouble'])); ?>;
                    
                    window.location.href = "index.php?num="+num+"&nom="+nom+"&spe="+spe+
                            "&mail="+mail+"&prenom="+prenom+"&magister="+magister+"&redouble="+redouble;
                }
            </script>
    </head>

    <!-- note perso : ptetr rajouter des id et class aux fieldset pour affich en dispo block les msg_err -->
    <body>
        <h1>UPMC : Master Informatique</h1>
        <h3>Site de saisie des voeux d'emploi du temps</h3>

        <div id="div_formVid">
            <!--formVid : formulaire Verification identifiant-->
            <form id="formVid" name="formVid" method="get" onsubmit="javascript:verifyId(this)" action="javascript:(function(){return;})()">
                <h4>Verification de l'email &eacute;tudiant</h4>

                <fieldset>
                    <legend>Identifiant de verification :</legend>
                    <input class="field" id="idetu" type="text" name="idetu"/>
                    <span id="span_verify_mail_button">
                        <input class="boutton" id="bmail" type="submit" name="submit" value="Verifier"/>
                    </span>
                    <div class="con_error" id="con_error_id"></div>
                    <span class="note" id="noteVid">Veuillez saisir l'identifiant qui vous a ete envoye a l'adresse <?php echo(json_encode($_SESSION['mail'])); ?>.</span>
                </fieldset>
            </form>
        </div>

        <div id="div_resend_mail_button">
            <span class="note" id="noteRemail">Vous n'avez pas recu de mail ? </span> 
            <button class="boutton" id="bremail" onclick="javascript:redirect('send_id.php')">Renvoyer un email</button>    
        </div>

        <div class="rollback" id="back_index">
            <button class="boutton" id="bbackindex" onclick="javascript:rollback()">Retour</button>    
        </div>
    </body>
</html>