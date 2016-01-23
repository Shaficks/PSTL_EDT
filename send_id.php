<?php

session_start(); //recuperation de la session php en cours
//Note sur les conditions requises :
//For the Mail functions to be available, 
//PHP must have access to the sendmail binary on your system during compile time
//If you use another mail program, such as qmail or postfix, be sure to use the appropriate sendmail wrappers that come with them. 
//PHP will first look for sendmail in your PATH, and then in the following: /usr/bin:/usr/sbin:/usr/etc:/etc:/usr/ucblib:/usr/lib.
//It's highly recommended to have sendmail available from your PATH.
//Also, the user that compiled PHP must have permission to access the sendmail binary


function generate_id(){
    //generation id avec une fonction de hash( sans insertion dans la base )
    //Je propose un id base sur une fonction de hash(infos etudiants) a la base pour eviter les collisions/acces base inutile pour verifier l unicite de l id
    //mais au final id sera gere en local mais pour fournir un id auto et contextuel hash est bien
    $algos = hash_algos(); //recuperation du tableau d'algos de hachage

    //au choix mais vu kil ya pa de collision timestamp seul suffit    
    //$data=$_SESSION['num']." ".$_SESSION['nom']." ".$_SESSION['prenom']." ".time();

    //Ajout de l id a la session : evite un acces base inutile
    $_SESSION['ident'] =  hash($algos[2], time()); //hash md5;
}

function send_mail_etu() {
    //generation de l' id
    generate_id();
    
    //Parametres du mail
    $subject = "[Master Upmc voeux inscription M1] Verification d'email";
    $message = "Votre identifiant est : " . $_SESSION['ident'];
    
    //envoi du mail
    if (mail($_SESSION['mail'], $subject, $message)) {
        echo $subject . " Msg:" . $message;
        header("Location: saisie_identifiant.php");
    } else {
        //trouver un traitement specifique en fonction des besoins du prof 
        echo "Une erreur s'est produite!";
        exit(); //sortie 
    }
}

send_mail_etu();
?>