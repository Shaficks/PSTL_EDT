<?php
        //session_start(); //session has allready started in caller
        require('fpdf/fpdf.php');

        class PDF extends FPDF {
            // En-tête
            function Header() {
                // Logo
                $this->Image('UPMC_logo.jpg',10,6,50);
                // Police Arial gras 15
                $this->SetFont('Arial','B',15);
                // Décalage à droite
                $this->Cell(80);
                // Titre
                $this->Cell(70,10,'Voeux M1-S'.$_SESSION['SEMESTRE'].' de '.$_SESSION['num'],1,0,'C');
                // Saut de ligne
                $this->Ln(20);
            }

            // Pied de page
            function Footer() {
                // Positionnement à 1,5 cm du bas
                $this->SetY(-15);
                // Police Arial italique 8
                $this->SetFont('Arial','I',8);
                // Numéro de page
                $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
            }
            
            // Tableau coloré
            function FancyTableListeUEs($header, $data, $w) {
                // Couleurs, épaisseur du trait et police grasse
                $this->SetFillColor(255,0,0);
                $this->SetTextColor(255);
                $this->SetDrawColor(128,0,0);
                $this->SetLineWidth(.3);
                $this->SetFont('','B');
                
                for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
                $this->Ln();
                // Restauration des couleurs et de la police
                $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);
                $this->SetFont('');
                // Données
                $fill = false;
                foreach($data as $row) {
                    if(isset($row[0]))
                        if(stripos($row[0], 'SUP') === FALSE ) {
                            $this->Cell($w[0],10,  strtoupper($row[0]),'LR',0,'C',$fill);
                            if(isset($row[1]))
                                $this->Cell($w[1],10,$row[1],'LR',0,'C',$fill);                        
                            $this->Ln();
                            $fill = !$fill;
                        }
                }
                // Trait de terminaison
                $this->Cell(array_sum($w),0,'','T');
                $this->Ln(); $this->Ln();
            }
            
            
            
            // Tableau coloré
            function FancyTableEDT($header, $data, $w) {
                // Couleurs, épaisseur du trait et police grasse
                $this->SetFillColor(255,0,0);
                $this->SetTextColor(255);
                $this->SetDrawColor(128,0,0);
                $this->SetLineWidth(.3);
                $this->SetFont('','B');
                
                for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
                $this->Ln();
                // Restauration des couleurs et de la police
                $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);
                $this->SetFont('');
                // Données
                $fill = false;
                $horaire = ['8:30 - 10:30','10:45 - 12:45','13:45 - 15:45','16:00 - 18:00'];
                $tmp = ['08','10','13','16'];
                
                for($i = 0; $i < 4; $i++) {
                    $this->Cell($w[0],10,$horaire[$i],'LR',0,'C',$fill);
                    
                    //Lundi
                    if(isset($data['lu'.$tmp[$i]])) 
                            $this->Cell($w[1],10,$data['lu'.$tmp[$i]],'LR',0,'C',$fill);
                    else $this->Cell($w[1],10,'','LR',0,'C',$fill);
                    
                    //Mardi
                    if(isset($data['ma'.$tmp[$i]])) 
                            if(strcmp($data['ma'.$tmp[$i]], "CONFERENCES") == 0)
                                $this->Cell($w[2],10,"CONF.",'LR',0,'C',$fill);
                            else 
                                $this->Cell($w[2],10,$data['ma'.$tmp[$i]],'LR',0,'C',$fill);
                    else $this->Cell($w[2],10,'','LR',0,'C',$fill);
                    
                    //Mercredi
                    if(isset($data['me'.$tmp[$i]])) 
                            $this->Cell($w[3],10,$data['me'.$tmp[$i]],'LR',0,'C',$fill);
                    else $this->Cell($w[3],10,'','LR',0,'C',$fill);
                    
                    //Jeudi
                    if(isset($data['je'.$tmp[$i]])) 
                            $this->Cell($w[4],10,$data['je'.$tmp[$i]],'LR',0,'C',$fill);
                    else $this->Cell($w[4],10,'','LR',0,'C',$fill);
                    
                    //Vendredi
                    if(isset($data['ve'.$tmp[$i]])) 
                            $this->Cell($w[5],10,$data['ve'.$tmp[$i]],'LR',0,'C',$fill);
                    else $this->Cell($w[5],10,'','LR',0,'C',$fill);
                    
                    //Retour à la ligne
                    $this->Ln();
                    $fill = !$fill;
                }
                // Trait de terminaison
                $this->Cell(array_sum($w),0,'','T');
                $this->Ln(); $this->Ln();
            }            
        }

    // Instanciation de la classe dérivée
    $pdf = new PDF();
    $pdf->AliasNbPages(); //Numéroter les pages
    $pdf->AddPage(); //Ajouter une nouvelle page
    $pdf->SetFont('Times','B',25); //Initialiser la police et sa taille
    //écrire dans la page
    $pdf->Cell(0,10,utf8_decode('                                                          Rang : ').$_SESSION['rang'],0,1);
    $pdf->Cell(0,10,utf8_decode('Spécialité : '.$_SESSION['spe']),0,1);
    $pdf->SetFont('Times','',15);
    $pdf->Cell(0,10,utf8_decode('Ce fichier doit être imprimé et présenté le jour des inscriptions.'),0,1);
    $pdf->Cell(0,10,utf8_decode('Dossier n° : ').$_SESSION['num'],0,1);
    $pdf->Cell(0,10,utf8_decode('Étudiant : '.$_SESSION['prenom'].' '.strtoupper($_SESSION['nom'])),0,1);
    setlocale(LC_TIME, 'fra_fra');
    $pdf->Cell(0,10,utf8_decode('Créé le '.strftime('%A %d %B %Y à %H:%M:%S')),0,1);
    $pdf->Ln(); $pdf->Ln();
    
    // Titres des colonnes
    $header = array('Liste des UEs', 'Groupe de TD/TME');
    // En-tête
    $w = array(50, 50); //Sert à donner les tailles des colonnes
    $pdf->FancyTableListeUEs($header,$_SESSION['choix'],$w);
    
    // Titres des colonnes
    $header = array('', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi');
    // Texte centré dans une cellule 20*10 mm encadrée et retour à la ligne
    //$pdf->Cell(20,10,'Titre',1,1,'C');
    //Retour à la ligne
    $pdf->Cell(20,10,'',0,2,'C');
    $pdf->Cell(20,10,'',0,2,'C');
    $pdf->Cell(20,10,'',0,2,'C');
    
    //$pdf->Cell(0,10,utf8_decode('Emploi du temps choisi'),0,1);
    
    $planning = $_SESSION['planning'];
    $w = array(40,30,30,30,30,30); //Sert à donner les tailles des colonnes
    $pdf->FancyTableEDT($header,$planning,$w);       
    
    $edtfilename='edtmp/m1_s'.$_SESSION['SEMESTRE'].'_voeux_'.$_SESSION['num'].'.pdf';
    $pdf->Output($edtfilename,'F',true); //Enregistrer dans le dossier tmp

    
   /***** Envoie de mail *****/
    
   // Inclusion du fichier PHP contenant les adresses mail des secrétariats
   require_once('mailtests/MSN2.php');
   //require_once('MSN.php');
     
   // Inclusion de la bibliothèque PHPMailer nécessaire pour la suite
   require('phpmailer/class.phpmailer.php');
    
   // Déclaration des adresses mail de l'étudiant, de l'admin et du secrétariat de la spécialité
   $mailadmin = 'edtpstl@gmail.com'; // pour test : suppr after
   //$mailadmin = 'm1voeuxs1@gmail.com'; //decommenter  after tests
   $mailetu = $_SESSION['mail'];
   $spe = $_SESSION['spe'];
   $mailspe = $msn[$spe];

 
   // Création d'une nouvelle instance de mail
   $mail = new PHPMailer();
   
   // Codage des caractères
   $mail->CharSet = "UTF-8";
   
   // Adresse d'envoi et nom de l'émetteur
   $mail->setFrom($mailspe, "UPMC - Master Informatique");
   
   // Définition du sujet
   $mail->Subject = "UPMC - Master Informatique - Spécialité ".$_SESSION['spe']." - Voeux M1-S".
           $_SESSION['SEMESTRE']." de ".$_SESSION['num'];
 
   // Contenu du mail
   $mail->Body = "Bonjour ".$_SESSION['prenom'].",
       
Veuillez trouver ci-joint un fichier PDF contenant toutes les informations relatives à votre pré-inscription.
Vous devez l'imprimer et l'apporter le jour des inscriptions pédagogiques, la date et la salle vous seront communiquées par mail.
 
Cordialement,
Master Informatique de l'UPMC - Spécialité ".$_SESSION['spe'];
 
   // Ajout de l'adresse mail des destinataires
   $mail->AddAddress($mailetu);
   $mail->AddAddress($mailadmin);
   $mail->AddAddress($mailspe);
 
   // Ajout de la pièce jointe
   $mail->AddAttachment($edtfilename);
   
   // Envoi Mail  
   $mail->send();
   
   // Suppression du fichier PDF du dossier tmp (Pour économiser de l'espace mémoire sur le serveur)
   unlink($edtfilename);
?>