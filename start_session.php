<?php

session_start();
//echo 'geturl['.$_GET['num'].','.$_GET['nom'].','.$_GET['prenom'].','.$_GET['mail'].
//','.$_GET['spe'] .','.$_GET['redouble'] .','. $_GET['magister'].']'.'<br/>';

if ($_GET['num'] and $_GET['nom'] and $_GET['prenom'] and $_GET['mail']
        and $_GET['spe'] and $_GET['redouble'] and $_GET['magister']) {

    //toutes les infos utiles sont stockees pour la session en cours 
    $_SESSION['num'] = $_GET['num'];
    $_SESSION['nom'] = $_GET['nom'];
    $_SESSION['prenom'] = $_GET['prenom'];
    $_SESSION['mail'] = $_GET['mail'];
    $_SESSION['spe'] = $_GET['spe'];
    $_SESSION['redouble'] = $_GET['redouble'];
    $_SESSION['magister'] = $_GET['magister'];
    $_SESSION['nbue'] = $_GET['nbue'];


    if (!filter_var($_SESSION['mail'], FILTER_VALIDATE_EMAIL)) {
        $msg = "<b>" . $_SESSION['mail'] . " </b> est une adresse mail est invalide.";
        $url = "index.php?num=" . $_SESSION['num'] . "&num2=" . $_SESSION['num'] .
                "&nom=" . $_SESSION['nom'] . "&prenom=" . $_SESSION['prenom'] .
                "&mail=" . "&spe=" . $_SESSION['spe'];
        echo '<html><head><title>Redirection ..</title></head>' .
        '<body onload="timer = setTimeout(function(){ window.location =\'' . $url . '\';},5000)">' .
        '<p>' . $msg . ' <br/> Vous allez etre rediriges vers la page precedente dans 5 secondes</p>' .
        '</body></html>';
        
    } else {
        require_once('config.php'); // config.php est requis //connexion implicite a la base de donnees
        //Recuperation de l'etudiant par son numero s'il a deja termine son inscription
        $sql = "SELECT * FROM ListeEtudiants WHERE numero = " . $_SESSION['num'] . " AND voeux = 1";

        //On verifie que les voeux n'aient pas deja ete faits
        $requete = mysql_query($sql) or die(mysql_error());
        if (mysql_num_rows($requete) > 0) {
            echo 'Vous avez déjà enregistré vox voeux.'
            . ' Vous pourrez éventuellement les modifier en septembre lors de la pré-rentrée. <br>';
            exit();
        }

        /* //A SUPPRIMER DANS LE CADRE D UNE BASE DE DONNEES SANS TROUS LIES A LA CONCURENCE
          //Si une procedure est en cours pour l etudiant
          // On efface les donnees issues d'une procedure non terminee (precedente)
          $sql = "DELETE FROM ListeEtudiants WHERE numero = " . $_SESSION['num'];
          $requete = mysql_query($sql) or die(mysql_error());

          // on enregistre l'etudiant
          $sql = "INSERT INTO ListeEtudiants(numero, nom, prenom, mail, spe, voeux) VALUES(" . $_SESSION['num'] . ", '" . $_SESSION['nom'] . "', '" . $_SESSION['prenom'] . "', '" . $_SESSION['mail'] . "', '" . $_SESSION['spe'] . "', 0)";
          mysql_query($sql) or die(mysql_error()); */

        //mysql_close(); 
        header("Location: send_id.php");  //Delegation envoi du mail a send_id
    }
} else {//Ne devrait jamais se produire (mais un bon programme prevoit des controles d'erreur multicouches)
    $msg = "le formulaire saisi est incomplet ou incorrect!";
    echo '<html><head><title>Redirection ..</title></head>'
    . '<body onload="timer = setTimeout(function(){ window.location = \'index.php\';},5000)">'
    . '<p>' . $msg . ' <br/> Vous allez etre rediriges vers la page precedente dans 5 secondes</p>'
    . '</body></html>';
}
?>