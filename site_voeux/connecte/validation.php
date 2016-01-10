
<?php
    
    $week = $_POST['week'];
    
    session_start();
    
    $num = $_SESSION['num'];
    $spe = $_SESSION['spe'];
    
    
    $tab = [[],[],[],[],[]];
    $ue = "";
    for ($i=1; $i<6; $i++) {
        $tab[$i-1] = [$_SESSION['ue'.$i], $_SESSION['ue'.$i.'gpe']];
        $ue = $ue . "ue" . $i . "='" . $tab[$i-1][0] . "', ue" . $i . "gpe=" . $tab[$i-1][1];
        if ($i<5) {
            $ue = $ue . ", ";
        }
    }
    
    require('../config.php'); // On réclame le fichier
    
    // remplissge des groupes
    $effectif = [0,0,0,0,0];
    for ($i=1; $i<6; $i++) {
        $sql = "SELECT * FROM UEGroupes WHERE groupe='".$_SESSION['ue'.$i].$_SESSION['ue'.$i.'gpe']."'";
        $requete = mysql_query($sql) or die( mysql_error() );
        $donnees = mysql_fetch_array($requete);
        $effectif[$i-1] = $donnees['effectif'];
    }
    
    $sql = "SELECT * FROM ListeEtudiants WHERE numero=".$_SESSION['num']." AND voeux=1";
    // On vérifie que les voeux n'aient pas déjà été faits
    $requete = mysql_query($sql) or die ( mysql_error() );
    
    if(mysql_num_rows($requete) > 0)
    {
        echo 'Vous avez déjà enregistré vox voeux. Vous pourrez éventuellement les modifier en septembre lors de la pré-rentrée. <br>';
        exit();
    }

    // on écrit la requête sql dans ListEtudiants
    $sql = "UPDATE ListeEtudiants SET voeux=1, " . $ue . " WHERE numero=$num";
    mysql_query( $sql ) or die( mysql_error() );

    // on écrit la requête sql dans la SPE, ce qui donne le rang d'enregistrement des voeux
    $sql = "INSERT INTO $spe(numetu) VALUES($num)";
    mysql_query($sql) or die( mysql_error() );

    // on écrit la requête sql dans Master, ce qui donne le rang d'enregistrement des voeux (au sein du master)
    $sql = "INSERT INTO Master(numetu) VALUES($num)";
    mysql_query($sql) or die( mysql_error() );

    // on écrit la requête sql dans UEGroupes : incrementer le nb d'etudiant dans chaq groupe
    for ($i=1; $i<6; $i++) {
        $sql = "UPDATE UEGroupes SET effectif = effectif+1 WHERE groupe = '".$_SESSION['ue'.$i].$_SESSION['ue'.$i.'gpe']."'";
        mysql_query($sql) or die( mysql_error() );
    }

    // on récupère nom, prénom et mail
    $sql = "SELECT * FROM ListeEtudiants WHERE numero=$num";
    $requete = mysql_query($sql) or die ( mysql_error() );
    $donnees = mysql_fetch_array($requete);
    
    // on récupère rang
    $sql = "SELECT * FROM $spe WHERE numetu=$num";
    $requete = mysql_query($sql) or die ( mysql_error() );
    $rang = mysql_fetch_array($requete)['rang'];
   
    
    mysql_close();
    
    
    $gpe = ['','','','',''];
    for ($i=1; $i<6; $i++) {
        $gpe[$i-1] = $gpe[$i-1] . $_SESSION['ue'.$i.'gpe'];
        if ($effectif[$i-1] > 27) {
            $gpe[$i-1] = $gpe[$i-1] . '  (complet)';
        }
    }
    
    
    $message = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title>UPMC, Master Informatique : Saisie des voeux d\'UE du S1</title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

      </head>

    <body>


    <h3>
        UPMC : Master Informatique
    </h3>

    <table>
        <tr>
            <td width="25%"></td>
            <td> Dossier n&deg; : </td>
            <td> ' . $num .' </td>
            <td width="25%"> </td>
            <td> ' . date("d.m.y") .' </td>
        </tr>
        <tr>
            <td> </td>
            <td> Etudiant : </td>
            <td> '. $donnees['prenom']. '  ' . $donnees['nom'] .' </td>
            <td></td>
            <td> ' . date("H:i:s") . ' </td>
        </tr>
        <tr> <td> <br> </td> <td> <br> </td> <td> <br> </td>  </tr>
        <tr>
            <td> </td>
            <td> Sp&eacute;cialit&eacute; : </td>
            <td> ' . $spe . ' </td>
            <td> </td>
            <td> Rang : ' . $rang . ' </td>
        </tr>
    </table>
    <br>
    <table>
    <tr>
        <td width="25%"></td>
        <td>
            <table border=1>
                <tr>
                    <td> Liste des UE </td>
                    <td> Groupe de TD/TME </td>
                </tr>
                <tr>
                    <td align="center"> ' . strtoupper($_SESSION['ue1']) . ' </td>
                    <td align="center"> '. $gpe[0] .' </td>
                </tr>
                <tr>
                    <td align="center">  ' .  strtoupper($_SESSION['ue2']) . ' </td>
                    <td align="center">  ' . $gpe[1] .' </td>
                </tr>
                <tr>
                    <td align="center">  ' .  strtoupper($_SESSION['ue3']). ' </td>
                    <td align="center">  ' .  $gpe[2] . ' </td>
                </tr>
                <tr>
                    <td align="center">  ' .  strtoupper($_SESSION['ue4']). ' </td>
                    <td align="center">  ' .  $gpe[3] . ' </td>
                </tr>
                <tr>
                    <td align="center">  ' .  strtoupper($_SESSION['ue5']). ' </td>
                    <td align="center">  ' .  $gpe[4] . ' </td>
                </tr>
            </table>
        </td>
    </tr>
    </table>

    <br> ';

        $message = $message . $week;
    
        echo $message;
    

       if ($spe == 'ANDROIDE') {
            $mail = 'ophelie.dacosta@ufr-info-p6.jussieu.fr';
        }
        elseif ($spe == 'BIM' or $spe == 'SAR') {
            $mail = 'alienor.leconte@ufr-info-p6.jussieu.fr';
        }
        elseif ($spe == 'DAC' or $spe == 'IMA') {
            $mail = 'geraldine.bompard@ufr-info-p6.jussieu.fr';
        }
        elseif ($spe == 'RES') {
            $mail = 'dominique.trouve@lip6.fr';
        }
        elseif ($spe == 'SESI') {
            $mail = 'Jennyta.bara@ufr-info-p6.jussieu.fr';
        }
        elseif ($spe == 'SFPN') {
            $mail = 'katia.pytel@ufr-info-p6.jussieu.fr';
        }
        else {
            $mail = 'emilie.auger@ufr-info-p6.jussieu.fr';
        }
        
        $to  = $mail  . ', ' . $donnees['mail'] . ', m1voeuxs1@gmail.com';

        // Sujet
        $subject = 'Voeux M1-S1 de ' . $num ;


        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        
        // En-têtes additionnels
        $headers .= 'From: ' . $donnees['mail'] . "\r\n";
        
        // Envoi
        mail($to, $subject, $message, $headers);
        
?>


    <script>
        alert("Imprimer cette page et l\'apporter le jour des inscriptions.");

        alert("La saisie des voeux est finie, vous pouvez quitter le site web.");
    </script>

        

    </body>


</html>

