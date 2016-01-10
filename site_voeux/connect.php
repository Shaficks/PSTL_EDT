<?php
    
    session_start();
    
if ($_GET['num'] and $_GET['num2'] and $_GET['nom'] and $_GET['prenom'] and $_GET['mail']) {
    
    $_SESSION['num'] = htmlspecialchars($_GET['num']);
    $num2 = htmlspecialchars($_GET['num2']);
    $nom = htmlspecialchars($_GET['nom']);
    $prenom = htmlspecialchars($_GET['prenom']);
    $_SESSION['mail'] = htmlspecialchars($_GET['mail']);
    $_SESSION['spe'] = htmlspecialchars($_GET['spe']);
    
    
    if ( $_SESSION['num'] != $num2 or  $_SESSION['num']<2000000) {
        $mess = "Il y a une erreur de numéro de dossier.";
        header("Location: index2.php?mess=$mess&num=".$_SESSION['num']."&num2=$num2&nom=$nom&prenom=$prenom&mail=".$_SESSION['mail']."&spe=".$_SESSION['spe']);
        exit();
    }
    
    if ( ! filter_var($_SESSION['mail'], FILTER_VALIDATE_EMAIL) ) {
        $mess = "L\'adresse mail est invalide.";
        header("Location: index2.php?mess=$mess&num=".$_SESSION['num']."&num2=$num2&nom=$nom&prenom=$prenom&mail=".$_SESSION['mail']."&spe=".$_SESSION['spe']);
        exit();
    }
    
    
    require('config.php'); // On réclame le fichier
    
    $sql = "SELECT * FROM ListeEtudiants WHERE numero=".$_SESSION['num']." AND voeux=1";
    
    // On vérifie que les voeux n'aient pas déjà été faits
    $requete = mysql_query($sql) or die ( mysql_error() );
    
    if(mysql_num_rows($requete) > 0)
    {
        echo 'Vous avez déjà enregistré vox voeux. Vous pourrez éventuellement les modifier en septembre lors de la pré-rentrée. <br>';
        exit();
    }
    
    // On efface les données issues d'une procédure non terminée
    $sql = "DELETE FROM ListeEtudiants WHERE numero=".$_SESSION['num'];
    $requete = mysql_query($sql) or die ( mysql_error() );
    
    // on écrit enregistre l'etudiant
    $sql = "INSERT INTO ListeEtudiants(numero,nom,prenom,mail,spe,voeux) VALUES(".$_SESSION['num'].",'".$nom."','".$prenom."','".$_SESSION['mail']."','".$_SESSION['spe']."',0)";
    mysql_query($sql) or die ( mysql_error() );
    
    
 //   mysql_close();
    
    header("Location: redoublant.html");
    exit();
    
    
    
}
else
{
    $num = $_GET['num'];
    $num2 = $_GET['num2'];
    $nom = $_GET['nom'];
    $prenom = $_GET['prenom'];
    $mail = $_GET['mail'];
    $spe = $_GET['spe'];
    
    $mess = "Tous les champs doivent être renseignés.";
    header("Location: index2.php?mess=$mess&num=$num&num2=$num2&nom=$nom&prenom=$prenom&mail=$mail&spe=$spe");
    exit();
    
}
    
?>