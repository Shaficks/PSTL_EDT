<?php
require_once ('master.php');

/* * GESTION UES* */
session_start(); //recuperation de la session
$spe = $_SESSION['spe'];  //recuperation de la specialite de l'etudiant
$max_ues = ($_SESSION['magister'] == 'true' ? 6 : 5);  //nombre max d'ues suivies (redoublant ou pas)
$nb_suivi = $max_ues; //nombre d'ues suivies ce semestre( default =max_ues)
$ue_valides = []; //tableau vide : necessaire car tout est base sur la presence de ce tableau
if ($_SESSION['redouble'] == 'true') { //recuperation des ues validees par un redoublant
    for ($i = 1; $i <= 4; $i++)
        if (isset($_GET["uev$i"]))
            $ue_valides[] = $_GET["uev$i"];

    $_SESSION['uevtab'] = $ue_valides; //Mise a jour de l'environement de session pour la suite du processus (ici nous utiliserons $ue_valides)
    $nb_suivi = $max_ues - sizeof($ue_valides); //nombre d'ues suivies = max_ues-nombre d'ues validees
    //echo "validees=[".implode(",", $_SESSION['uevtab'])."] ->nb_suivi=$nb_suivi";//debug
}
$_SESSION['nb_suivi'] = $nb_suivi; //ajout du nombre d' ues suivies a l'environnement de session (facilite)

/* * GESTION EDT* */
require_once('config.php'); //On aura besoin de config.php afin de se connecter a la base
$reponse = mysql_query("SELECT * FROM UEGroupes"); //On recupere tous les groupes existants (pk pas juste le groupe des ues concernees)?
$groupes = []; //Tableau qui contiendra les paires (groupe_ue => effectif) Exemple ( groupe : algav1, effectif : 30 )
while ($donnees = mysql_fetch_array($reponse))
    $groupes[$donnees['groupe']] = $donnees['effectif'];
//Ajout des groupes d'UEs supNx1 (N entier) qui ne seront pas traitees avec pour effectif 0
for ($i = 1; $i < 5; $i++) //changer ce 5 en nb_suivi
    $groupes['sup' . $i . 'x1'] = 0;
//echo "[". implode(",", $groupes)."]"; //Debug 
?>

<!--Page de saisie des ues suivies ce semestre par un etudiant: choix_ues.php--> <!--FUSIONNE THIS TO CHOIXEDT-->
<!--Page script gerant le calcul de l'emploie du temps de l'etudiant en fonction de ses ues choisies: edt.php-->
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
            <script type="text/javascript" src="js/descriptions.js"></script>
            <script type="text/javascript" src="js/choix_ues.js"></script>
            <script type="text/javascript" src="js/descriptions.js"></script>
            <script type="text/javascript" src="js/calendrier.js"></script>
            <script type="text/javascript" src="js/edt_utils.js"></script>
            <script type="text/javascript" src="js/edt_print.js"></script>
            <script type="text/javascript" src="js/edt.js"></script>
            <script type="text/javascript">/*verif position bf or af*/GRPES =<?php echo json_encode($groupes); ?> //variable global passee aux fichiers js</script>


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
    </head>

    <body onload="add_oblig(<?php echo(json_encode($nb_suivi)); ?>)">
        <h1>UPMC : Master Informatique</h1>
        <h3>Site de saisie des voeux d'emploi du temps</h3>

        <span class="note" id="description_master" > </span>

        <span id="span_tab_ues"><!-- une span pour plus de flexibilite dans l'affichage avec css-->

            <form id="formUes" name="formChoixUes" method="GET" onsubmit="javascript:chooseEDT(this)" action="javascript:(function(){return;})()">
                <!-- action="javascript:(function(){return;})()" permet : 
                Gestion par aiguillage centralisee avec javascript : js/file.js qui decidera en fonction des parametres transmis 
                ou aller ensuite / ou bien rester sur la meme page active( parametres incorrects par exemple )
                sans recharger la page (conservation de l etat du formulaire)  -->
                <h4>Informations sur l'&eacute;tudiant (Choix des unites d'enseignement)</h4>
                <fieldset>
                    <legend>Selectionnez les ues que vous souhaitez suivre : </legend>
                    <?php
                    $choix_ues = $master["$spe"];
                    foreach ($choix_ues as $key => $value) {
                        sort($value); //ordre alphabetique sur la liste d'ues
                        foreach ($value as $ue)
                            if (!in_array($ue, $ue_valides)) //retirer les ues deja valides pour un redoublant
                                if ($key == 'oblig')
                                    echo '<span class="box_ue_' . $key . '" id="span_' . $ue . '">' .
                                    '<input disabled="true" checked="checked" class="check_ue" type="checkbox" name="' . $ue . '" id="ue_' . $ue . '"/>' .
                                    '<label id="label_' . $ue . '" for="' . $ue . '">' . strtoupper($ue) . '</label>' .
                                    '</span>' . "\n";
                                //.'<br/>';
                                else
                                    echo '<span class="box_ue_' . $key . '" id="span_' . $ue . '">' .
                                    '<input class="check_ue" onclick="add_ue(this,' . $nb_suivi . ')" type="checkbox" name="' . $ue . '" id="ue_' . $ue . '"/>' .
                                    '<label id="label_' . $ue . '" for="' . $ue . '">' . strtoupper($ue) . '</label>' .
                                    '</span>' . "\n";
                        //.'<br/>';
                    }
                    ?>
                </fieldset>
                <div id="choices"></div>

                <div class="rollback" id="back_index">
                    <button class="boutton" id="bbackindex" onclick="javascript:rollback()">Retour</button>    
                </div>
                
                <div id="edts"></div>
            </form>

        </span>
    </body>
</html>
