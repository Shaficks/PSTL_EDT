
<?php

    session_start();

    $c = $_SESSION['choix'];
    
    if(isset($_POST['week']))
        $_SESSION['week'] = $_POST['week'];
    
    if(isset($_POST['planning']))
        $_SESSION['planning'] = json_decode($_POST['planning'], true);
    
    //Récupérer la valeur de week qui est rien d'autre que le tableau contenant l'EDT
    $week = $_SESSION['week'];

    //Récupération du numéro d'étudiant et de sa spécialité
    $num = $_SESSION['num'];
    $spe = $_SESSION['spe'];
    
    
    //$_SESSION['planning'] = $_POST['planning'];
    
    
    $tab = [[],[],[],[],[]]; //Contiendra les paires (UE, groupe) qui seront stockées dans la base
    $ue = ""; //Sert à accéder aux champs des ues et groupes dans les requêtes dans la base
    for ($i=1; $i<6; $i++) {
        $tab[$i-1] = [$_SESSION['ue'.$i], $_SESSION['ue'.$i.'gpe']];
        $ue = $ue . "ue" . $i . "='" . $tab[$i-1][0] . "', ue" . $i . "gpe=" . $tab[$i-1][1];
        if ($i<5) {
            $ue = $ue . ", ";
        }
    }
    $_SESSION['liste_ues'] = $tab;
    
    require('config.php'); // On réclame le fichier
    
    // remplissge des groupes
    $effectif = [0,0,0,0,0];
    for ($i=1; $i<6; $i++) {
        $sql = "SELECT * FROM UEGroupes WHERE groupe='".$_SESSION['ue'.$i].$_SESSION['ue'.$i.'gpe']."'";
        $requete = mysql_query($sql) or die( mysql_error() );
        $donnees = mysql_fetch_array($requete);
        $effectif[$i-1] = $donnees['effectif']; //récupération des effectifs
    }
    
    $sql = "SELECT * FROM ListeEtudiants WHERE numero=".$_SESSION['num']." AND voeux=1";
    // On vérifie que les voeux n'aient pas déjà été faits
    $requete = mysql_query($sql) or die ( mysql_error() );
    
    if(mysql_num_rows($requete) > 0)
    {
        echo 'Vous avez déjà enregistré vox voeux. Vous pourrez éventuellement les modifier en septembre lors de la pré-rentrée. <br>';
        exit();
    }

    //On enregistre l'étudiant
    $sql = "INSERT INTO ListeEtudiants(numero, nom, prenom, mail, spe, voeux) VALUES(" . $_SESSION['num'] . ", '" . $_SESSION['nom'] . "', '" . $_SESSION['prenom'] . "', '" . $_SESSION['mail'] . "', '" . $_SESSION['spe'] . "', 1)";
    mysql_query($sql) or die(mysql_error());
    
    //Ici on mets à jour les champs UEi, UEigpe et voeux de la base
    // on écrit la requête sql dans ListEtudiants
    $sql = "UPDATE ListeEtudiants SET voeux=1, " . $ue . " WHERE numero=$num";
    mysql_query( $sql ) or die( mysql_error() );

    // on écrit la requête sql dans la SPE, ce qui donne le rang d'enregistrement des voeux
    $sql = "INSERT INTO $spe(numetu) VALUES($num)";
    mysql_query($sql) or die( mysql_error() );

    // on écrit la requête sql dans Master, ce qui donne le rang d'enregistrement des voeux (au sein du master)
    $sql = "INSERT INTO Master(numetu) VALUES($num)";
    mysql_query($sql) or die( mysql_error() );

    // on écrit la requête sql dans UEGroupes : incrementer le nb d'etudiant dans chaque groupe
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
   
    $_SESSION['rang'] = $rang;
    
    mysql_close();
    
    //Récupération des groupes
    $gpe = ['','','','',''];
    $i=1;
    $j=0;
    while ($i<6) {
        if (substr($_SESSION['ue'.$i],0,3) == 'sup') {
            $i++;
        }
        else {
            $gpe[$j] = $gpe[$j] . $_SESSION['ue'.$i.'gpe'];
            if ($effectif[$i-1] > 27) {
                $gpe[$j] = $gpe[$j] . '  (complet)';
            }
            $i++;
            $j++;
        }
    }
    //Récupération des ues
    $ues = ['','','','',''];
    $i=1;
    $j=0;
    while ($i<6) {
        if (substr($_SESSION['ue'.$i],0,3) == 'sup') {
            $i++;
        }
        else {
            $ues[$j] = $ues[$j] . $_SESSION['ue'.$i];
            $i++;
            $j++;
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
                    <td align="center"> ' . strtoupper($ues[0]) . ' </td>
                    <td align="center"> '. $gpe[0] .' </td>
                </tr>
                <tr>
                    <td align="center">  ' .  strtoupper($ues[1]) . ' </td>
                    <td align="center">  ' . $gpe[1] .' </td>
                </tr>
                <tr>
                    <td align="center">  ' .  strtoupper($ues[2]). ' </td>
                    <td align="center">  ' .  $gpe[2] . ' </td>
                </tr>
                <tr>
                    <td align="center">  ' .  strtoupper($ues[3]). ' </td>
                    <td align="center">  ' .  $gpe[3] . ' </td>
                </tr>
                <tr>
                    <td align="center">  ' .  strtoupper($ues[4]). ' </td>
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
        
        $_SESSION['message'] = $message;

    ?>

    <script>
        alert("Imprimer cette page et l\'apporter le jour des inscriptions.");

        alert("La saisie des voeux est finie, vous pouvez quitter le site web.");
    </script>

    <br>
    <input type="button" onclick="location.href='genererPDF.php';" value="Version Imprimable" />
    <input type="button" onclick="location.href='edt_ideal.php';" value="EDT IDEAL" />
    
    
    <script>
        
        function genererPDF() {
            document.location.replace("genererPDF.php");
        }
        
        function ideal() {
            
            
            UE = <?php echo json_encode($choix); ?>;
            
          //Sinon on ouvre la page edt.php avec le nb d'UEs et les UEs choisis
                   str = "nb=" + 5 + "&";
                    for (i=1; i<6; i++) {
                        str = str + "ue" + i + "=" + UE[i-1];
                        if (i < 5) {
                            str = str + "&";
                        }

                    }
            //On fait appel à la page edt.php avec les paramètres dans la chaine str
            location.href = "edt_ideal.php?"+str;
            str = "edt_ideal.php?" + str;
            var obj = document.getElementById('ideal');
            obj.action = str;   
            return str;
        }
    
    </script>


    </body>


</html>

