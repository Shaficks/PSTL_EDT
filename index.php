<!--Page d'accueil : index.php-->
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
            <script type="text/javascript" src="js/index.js"></script>
            <script type="text/javascript" src="js/utils.js"></script>
    </head>

    <!-- note perso : ptetr rajouter des id et class aux fieldset pour affich en dispo block les msg_err -->
    <body>
        <h1>UPMC : Master Informatique</h1>
        <h3>Site de saisie des voeux d'emploi du temps</h3>

        <div id="div_formI">
            <!--formI : formulaire Informations personnelles-->
            <form id="formI" name="formInfos" method="get" onsubmit="javascript:connect(this)" action="javascript:(function(){return;})()">
                <!-- action="javascript:(function(){return;})()" permet : 
                Gestion par aiguillage centralisee avec javascript : js/file.js qui decidera en fonction des parametres transmis 
                ou aller ensuite / ou bien rester sur la meme page active( parametres incorrects par exemple )
                sans recharger la page (conservation de l etat du formulaire)  -->
                <h4>Informations sur l'&eacute;tudiant</h4>

                <fieldset>
                    <legend>Num&eacute;ro de dossier : </legend>
                    <?php
                    if (isset($_GET['num']))
                        echo "<input value='" . $_GET['num'] . "' pattern='(2|3)\d{6}' class='field' id='num' type='text' name='numetu'/>";
                    else
                        echo "<input pattern='(2|3)\d{6}' class='field' id='num' type='text' name='numetu'/>";
                    ?> 
                    <div class="con_error" id="con_error_num"></div> <!--Sert a l'affichage des messages d'erreur-->
                    <span class="note" id="noteN">Si le num&eacute;ro n'est pas connu, les donn&eacute;es ne seront pas enregistr&eacute;es.</span>
                </fieldset>  

                <fieldset>
                    <legend>Confirmation du num&eacute;ro de dossier : </legend>
                    <?php
                    if (isset($_GET['num']))
                        echo "<input value='" . $_GET['num'] . "' pattern='(2|3)\d{6}' class='field' id='num2' type='text' name='numetu2'/>";
                    else
                        echo "<input pattern='(2|3)\d{6}' class='field' id='num2' type='text' name='numetu2'/>";
                    ?> 
                    <div class="con_error" id="con_error_num2"></div>
                </fieldset>

                <fieldset>
                    <legend>Nom : </legend>
                    <?php
                    if (isset($_GET['nom']))
                        echo "<input value='" . $_GET['nom'] . "' class='field' id='nom' type='text' name='nometu'/>";
                    else
                        echo "<input class='field' id='nom' type='text' name='nometu'/>";
                    ?>
                    <div class="con_error" id="con_error_nom"></div>
                </fieldset>

                <fieldset>
                    <legend>Pr&eacute;nom : </legend>
                    <?php
                    if (isset($_GET['prenom']))
                        echo "<input value='" . $_GET['prenom'] . "' class='field' id='prenom' type='text' name='prenometu'/>";
                    else
                        echo "<input class='field' id='prenom' type='text' name='prenometu'/>";
                    ?>
                    <div class="con_error" id="con_error_prenom"></div>
                </fieldset>

                <fieldset>
                    <legend>Adresse email : </legend>
                    <?php
                    if (isset($_GET['mail']))
                        echo "<input value='" . $_GET['mail'] . "' class='field' type='email' id='email' name='email'/>";
                    else
                        echo "<input class='field' type='email' id='email' name='email'/>";
                    ?>
                    <div class="con_error" id="con_error_email"></div>
                </fieldset>

                <fieldset>
                    <legend>Sp&eacute;cialit&eacute; : </legend>
                    <select class="selectop" id="spe" name="spe">
                        <option value='ANDROIDE' <?php if (isset( $_GET['spe'] ) and $_GET['spe'] == 'ANDROIDE'){echo "selected='selected'";} ?> >ANDROIDE</option>
                        <option value='BIM' <?php if (isset( $_GET['spe'] ) and $_GET['spe'] == 'BIM') {echo "selected='selected'";} ?> >BIM</option>
                        <option value='DAC' <?php if (isset( $_GET['spe'] ) and $_GET['spe'] == 'DAC') {echo "selected='selected'";} ?> >DAC</option>
                        <option value='IMA' <?php if (isset( $_GET['spe'] ) and $_GET['spe'] == 'IMA') {echo "selected='selected'";} ?> >IMA</option>
                        <option value='RES' <?php if (isset( $_GET['spe'] ) and $_GET['spe'] == 'RES') {echo "selected='selected'";} ?> >RES</option>
                        <option value='SAR' <?php if (isset( $_GET['spe'] ) and $_GET['spe'] == 'SAR') {echo "selected='selected'";} ?> >SAR</option>
                        <option value='SESI'<?php if (isset( $_GET['spe'] ) and $_GET['spe'] == 'SESI'){echo "selected='selected'";} ?> >SESI</option>
                        <option value='SFPN'<?php if (isset( $_GET['spe'] ) and $_GET['spe'] == 'SFPN'){echo "selected='selected'";} ?> >SFPN</option>
                        <option value='STL' <?php if (isset( $_GET['spe'] ) and $_GET['spe'] == 'STL') {echo "selected='selected'";} ?> >STL</option>
                    </select>
                </fieldset>

                <fieldset>
                    <legend>Etes-vous redoublant du master Informatique de l'UPMC ? : </legend>
                    <?php
                    if (isset( $_GET['redouble'] ) and $_GET['redouble'] == 'true')
                        echo "<input class='radio' id='r1' type='radio' name='redoublant' value='non' />".
                        "<span class='opt' id='optR1'> Non </span>".
                        "<br>".
                        "<input class='radio' id='r2' type='radio' name='redoublant' value='oui' checked='checked' />".
                        "<span class='opt' id='optR2'> Oui</span>";
                    else 
                        echo "<input class='radio' id='r1' type='radio' name='redoublant' value='non' checked='checked' />".
                        "<span class='opt' id='optR1'> Non </span>".
                        "<br>".
                        "<input class='radio' id='r2' type='radio' name='redoublant' value='oui' />".
                        "<span class='opt' id='optR2'> Oui</span>";
                    ?>
                </fieldset>

                <fieldset> <!--ajout sytematique d'une ue au nombre d'ues choisies ou par defaut(5))-->
                    <legend>Etes-vous candidat au parcours magist&egrave;re du master Informatique de l'UPMC ? : </legend>
                    <?php
                    if (isset( $_GET['magister'] ) and $_GET['magister'] == 'true')
                        echo "<input class='radio' id='m1' type='radio' name='magistere' value='non' />" .
                        "<span class='opt' id='optM1'> Non </span>" .
                        "<br>" .
                        "<input class='radio' id='m2' type='radio' name='magistere' value='oui' checked='checked' />" .
                        "<span class='opt' id='optM2'> Oui </span>";
                    else
                        echo "<input class='radio' id='m1' type='radio' name='magistere' value='non' checked='checked' />".
                        "<span class='opt' id='optM1'> Non </span>".
                        "<br>".
                        "<input class='radio' id='m2' type='radio' name='magistere' value='oui' />".
                        "<span class='opt' id='optM2'> Oui </span>";
                    ?>
                    <br>
                        <span class="note" id="noteM">Le parcours magist&egrave;re est un parcours d'exellence à 6 ues du master Informatique de l'UPMC.</span>
                </fieldset>

                <div id="div_buttons">
                    <input class="boutton" id="b0" type="submit" name="submit" value="connexion"/>
                    <span class="note" id="noteF">Tous les champs sont obligatoires.</span>
                </div>
            </form>
        </div>

    </body>
</html>
