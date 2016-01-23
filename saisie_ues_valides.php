<?php
session_start(); //recuperation de la session

$liste_ues = array("aagb", "mapsi", "algav", "mlbda", "archi1", "mobj", "ares", "model", "bima", "mogpl", "complex", "noyau", "dlp", "pr", "elecana1", "rtel", "il", "signal", "lrc", "vlsi1");
?>

<!--Page de saisie des ues deja validees par un redoublant : saisie_ues_valides.php-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <meta charset="UTF-8">
            <title>UPMC, Master Informatique : Saisie des voeux d'UE du S1</title>
            <link rel="stylesheet" href="css/maincss.css" type="text/css" />
            <!-- Decommenter sur le seveur si connexion disponible
            <script src="http://code.jquery.com/jquery-latest.js"></script>
            Contenu duplique en local dans js/jquery-latest.js  -->
            <script src="js/jquery-latest.js"></script> <!-- copie locale de jquery(realisee en 2014) -->
            <script type="text/javascript" src="js/utils.js"></script>
            <script type="text/javascript" src="js/saisie_ues_valides.js"></script>

            <script type="text/javascript">
                function rollback() { //fonction de retour arriere en dur (l'url de retour est fixe et statique)       
                    var num = <?php echo(json_encode($_SESSION['num'])); ?>;
                    var nom = <?php echo(json_encode($_SESSION['nom'])); ?>;
                    var spe = <?php echo(json_encode($_SESSION['spe'])); ?>;
                    var mail = <?php echo(json_encode($_SESSION['mail'])); ?>;
                    var prenom = <?php echo(json_encode($_SESSION['prenom'])); ?>;
                    var magister = <?php echo(json_encode($_SESSION['magister'])); ?>;
                    var redouble = <?php echo(json_encode($_SESSION['redouble'])); ?>;

                    window.location.href = "index.php?num=" + num + "&nom=" + nom + "&spe=" + spe +
                            "&mail=" + mail + "&prenom=" + prenom + "&magister=" + magister + "&redouble=" + redouble;
                }
            </script>
    </head>

    <body>
        <h1>UPMC : Master Informatique</h1>
        <h3>Site de saisie des voeux d'emploi du temps</h3>

        <span id="span_tab_ues_valides"><!-- une span pour plus de flexibilite dans l'affichage avec css-->

            <form id="formUev" name="formUeValides" method="POST" onsubmit="javascript:transmitValides(this)" action="javascript:(function(){return;})()">
                <!-- action="javascript:(function(){return;})()" permet : 
                Gestion par aiguillage centralisee avec javascript : js/file.js qui decidera en fonction des parametres transmis 
                ou aller ensuite / ou bien rester sur la meme page active( parametres incorrects par exemple )
                sans recharger la page (conservation de l etat du formulaire)  -->
                <h4>Informations sur l'&eacute;tudiant (Unites d'enseignement validees)</h4>
                <fieldset>
                    <legend>Selectionnez les ues que vous avez deja validees : </legend>
                    <?php
                    sort($liste_ues); //ordre alphabetique sur la liste d'ues
                    foreach ($liste_ues as $value) {
                        echo '<span class="box_ue" id="span_' . $value . '">' .
                        '<input class="check_ue" onclick="add_ue_valide(this)" type="checkbox" name="' . $value . '" id="ue_' . $value . '"/>' .
                        '<label id="label_' . $value . '" for="' . $value . '">' . strtoupper($value) . '</label>' .
                        '</span>' . "\n" .
                        '<br/>';
                    }
                    ?>
                </fieldset>
                <div id="hidens"></div>

                <div id="div_buttons">
                    <input class="boutton" id="buev" type="submit" name="submit" value="Valider"/> 
                    <span class="note" id="noteUev">Si vous n'avez valid&eacute; aucune ue, cliquez directement sur <b>Valider</b> Mdrr.</span>
                </div>
            </form>

            <div class="rollback" id="back_index">
                <button class="boutton" id="bbackindex" onclick="javascript:rollback()">Retour</button>    
            </div>
        </span>
    </body>
</html>


