<?php
    session_start();
    
    //Récupération de l'EDT choisi
    $edt = $_GET['edt'];

    //Fonction explode sert à retourner un tableau des résultats JSON récupérés dans $edt
    $tabEdt = explode(",", $edt);
    
    //Tableau qui va contenir les choix des UEs et groupes
    $choix = [[],[],[],[],[]];
    
    //Sert à stocker les paires (UE, groupe)
    for ($i=0; $i<5; $i++) {
        $choix[$i] = [$tabEdt[2*$i], $tabEdt[2*$i+1]];
    }
    

    //Préparation des variables de Session qui vont être stockées dans la base de données
    //UEs et groupes
    for ($i=1; $i<6; $i++) {
        $ue = 'ue'.$i;
        $gp = 'ue'.$i.'gpe';
        $_SESSION[$ue] = $choix[$i-1][0];
        $_SESSION[$gp] = $choix[$i-1][1];
    }
    
    
    $tab = []; //Contiendra les paires (UE, groupe) qui seront stockées dans la base
    $ue = ""; //Sert à accéder aux champs des ues et groupes dans les requêtes dans la base
    for ($i=1; $i<6; $i++) {
        $tab[$i-1] = $_SESSION['ue'.$i].'-'.$_SESSION['ue'.$i.'gpe'];
    }
    
   
    
    require('config.php'); // On réclame le fichier
    
    $nb = $_SESSION['num'];

    // on écrit la requête sql dans Master, ce qui donne le rang d'enregistrement des voeux (au sein du master)
    $sql = "INSERT INTO edt_ideal(numetu,ue1gpe,ue2gpe,ue3gpe,ue4gpe,ue5gpe) ".
             "VALUES('$nb','$tab[0]','$tab[1]','$tab[2]','$tab[3]','$tab[4]')";
    mysql_query($sql) or die( mysql_error() );   
    

    session_destroy();
    mysql_close();
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title>UPMC, Master Informatique : Saisie des voeux d\'UE du S1</title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

      </head>

    <body>


    <h3>
        UPMC : Master Informatique - Pré-inscription validée <br/>
        Toute demande de modification se fera directement auprès des responsables le jour des inscriptions.
    </h3>

    <script> 
       alert("Votre pré-inscription est finalisée, vous pouvez quitter le site web.");
    </script>

    </body>


</html>

