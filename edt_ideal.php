<?php
    
    session_start(); //Démarrage de la session
    
    //Récupération du numéro de l'étudiant et de sa spécialité
    $num = $_SESSION['num'];
    $spe = $_SESSION['spe'];
    
    $nb = 6; 
    
    //Tableau qui contiendra la liste des UEs choisis
    $choix = ['','','','',''];
    
    //Ajout des UEs dans la liste des choix
    //6ème élément à revoir !!!!!!!!!!
    for ($i=1; $i<$nb+1; $i++) {
        $choix[$i-1] = $_SESSION['ue'.$i];
        //echo $choix[$i-1];
    }
    
    //Ajout des UEs supplémentaires cachés (pour les redoublants ayant validé certains UEs)
    //Il faut rajouter le 6ème - A REVOIR !!!!!!!!!!!!!!
    for ($i=$nb+1; $i<6; $i++) {
        $j = $i - $nb;
        $choix[$i-1] = 'sup' . $j . 'x';
    }
    
    //Cette variable contient la chaine à afficher en HTML dans le body, 
    //Comme cette chaine contient un appel de fonction elle sera exécutée.
    $ue = 'edt_ideal('.  $num . ", '" . $spe . "',"; //Ajout des 2 premiers paramètres
    for ($i=0; $i<5; $i++) {
        //Ajout des UEs comme paramètres
        $ue = $ue . "'" . $choix[$i] . "'";
        if ($i<4) {
            $ue = $ue . ",";
        }
    }
        $ue = $ue . ')';
    
    require('config.php'); //On aura besoin de config.php afin de se connecter à la base
    
    $reponse = mysql_query("SELECT * FROM UEGroupes"); //On récupère tous les groupes existants 
    $groupes = []; //Tableau qui contiendra les paires (groupe ue ==> effectif)
    //Exemple : groupe : algav1, effectif : 30 
    while ($donnees = mysql_fetch_array($reponse)) {
        $groupes[$donnees['groupe']] = $donnees['effectif'];
    }
    //Ajout des UEs supNx1 (N entier) qui ne seront pas traités
    for ($i=1; $i<5; $i++) {
        $groupes['sup' . $i . 'x1'] = 0; //Pas besoin d'effectif ici
    }
    
    
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title>UPMC, Master Informatique : Saisie des voeux d'UE du S1</title>

        <script language=JavaScript>


//Reçoit une liste l contenant des paires (s,l) : s calculée par la fct poids
function rearrange(l, d, f) {
    var piv = l[f][0]; //C'est la variable s calculée dans la fonction poids
    var k = d;
    var tmp = [];
    for (var i=d; i<f; i++) {
        //On teste la variable s calculée dans la fonction poids
        if (l[i][0] > piv) {
            tmp = l[i];
            l[i] = l[k];
            l[k] = tmp;
            k++;
        }
    }
    tmp = l[k];
    l[k] = l[f];
    l[f] = tmp;
    return k;
}

//Tri en fonction du poids ? 
//Tri dichotomique récursif on faisant appel à la fonction rearrange - A REVOIR !!!!!!!!!
function tri(l, d, f) {
    if (d < f) {
        var q = rearrange(l, d, f);
        tri(l, d, q-1);
        tri(l, q+1, f);
    }
}

//Fonction de calcul de poids
function poids(l) {
    //json_encode : Retourne la représentation JSON d'une valeur
    var groupes = <?php echo json_encode($groupes); ?>;
    var i = 0;
    var g = ['','','','',''];
    //Ici les groupes sont gérés comme des chaines de caractères
    //Exemple = 'algav' + '1' donne algav1
    for (i=0; i<5; i++) {
        g[i] = l[i][0]+l[i][1];
    }
    
    var m = 0; //Contiendra l'effectif le plus grand
    var p = [0,0,0,0,0]; //Tableau contenant les poids (effectifs des groupes)
    for (i=0; i<5; i++) {
        p[i] = groupes[g[i]];
        //Fonction parseInt : parse le premier entier rencontré
        //Attention, il faut que l'entier soit la première chose rencontrée dans la chaine
        //Si on passe "10" et 16, c'est le 16 qui sera prioritaire
        //Pour les redoublants, les UEs sup ne sont pas traités
        if (parseInt(p[i]) > m && l[i][0].substring(0,4) != 'sup') {
        	m = parseInt(p[i]);
       } 
    }
	    
    var res = [];
    var s = 0.0;
    //Si on est dans le cas VERT
    if (m > 27) {
        for (i=0; i<5; i++) {
            //s va contenir la somme des différences entre 27 et p[i]
            s += 27 - p[i]
        }
        res = [3, s]; //3 = vert
    }
    else {
        s = 1.0
        for (i=0; i<5; i++) {
            //s va contenir le produit des différences entre 28 et p[i]
            s *= 28 - p[i]
        }
        if (m > 24) {     
            res = [2, s]; //2 = orange
        }
        else {
            res = [1, s]; //1 = rouge
        }
    }
    //On retourne notre tableau res avec l'id couleur et le s calculé
    return res;
}

//Fonction qui retourne en arrière
function retour() {
    document.location.replace('index.php');
}


function edt_ideal(num, spe, ue1, ue2, ue3, ue4, ue5) {
    //json_encode : Retourne la représentation JSON d'une valeur
    //Paires (groupe:effectif) exemple : algav1:30
    var groupes = <?php echo json_encode($groupes); ?>;
    
    //Chaque UE avec son cours associé à ses groupes de TD/TME
    //4m062 WHY ve04 ???? - ASK_PROF
    //Représontation JSON
    var listeUE = {'4m062':['lu16', ['me10', 've04']], 'sup1x':['lu00', ['lu02', 'lu04']], 'sup2x':['ma00', ['ma02', 'ma04']], 
        'sup3x':['me00', ['me02', 'me04']], 'sup4x':['je00', ['je02', 'je04']], 'rtel':['lu08', ['ma08','ma10'], [], ['me08','me10']], 
        'mobj':['lu08', ['me08','me10']], 'elecana1':['lu10', ['ma08','ma10']], 'aagb':['lu10', ['me16', 've16']], 
        'ares':['lu10', [], [], ['me08','me10'], ['me14','me16'], ['je08','je10'], ['je14','je16']], 
        'pr':['lu14', ['me08','me10'], ['me14','me16'], ['ve08','ve10'], ['ve10','ve14']], 
        'noyau':['lu16', [], ['ma14','ma16'], ['ma14','ma16'], ['me14','me16'], ['je14','je16']], 
        'dlp':['ma08', ['je14','je16'], ['je14','je16'], ['ve08','ve10']], 
        'algav':['ma10', ['ma14','ma16'], ['je08','je10'], ['je08','je10']], 
        'bima':['ma14', ['je14','je16']], 
        'mapsi':['ma16', ['lu08','lu10'], ['lu08','lu10'], ['ma08','ma10'], ['ma08','ma14']], 
        'il':['me08', ['lu08','lu10'], ['lu08','lu10'], ['ma08','ma10'], ['me10','me14'], ['je14','je16'], ['ve10','ve14']], 
        'lrc':['me14', ['lu14','lu16'], ['lu14','lu16'], ['ma14','ma16'], ['je08','je10']], 
        'mlbda':['me16', ['lu08','lu10'], ['me08','me10'], ['je08','je10'], ['je10','ve14']], 
        'model':['je08', ['ve14','ve16']], 'complex':['je10', ['me08','me10'], ['lu08','ve10']], //TD et TME pas le même jour !!!!!!
        'archi1':['je14', ['ma14','ma16'], ['ma14','ma16'],['me14','me16'],['ve14','ve16']], 
        'vlsi1':['je16', ['me14','me16'], ['ve14','ve16']], 
        'mogpl':['ve08', ['lu14','lu16'], ['je14','je16'], ['je14','je16'], ['ve10','ve14']], 
        'signal':['ve10', ['ma14','ma16'], ['je08','je10']]};
    
    var l = [];
    
    var choix = [ue1, ue2, ue3, ue4, ue5]; //Stockage des UEs choisis dans ce tableau

    var choix_poids = [[],[],[],[],[]]; //Tableau de poids des ues ???
    var i = 0;
    //Calcul des poids (paires lentgh,ue)
    for (i = 0; i < 5; i++)  {
        choix_poids[i] = [listeUE[choix[i]].length, choix[i]];
    }
 //          alert(choix_poids);
    
    var tmp = []; //
    var rep = true;
    //Tri des poids 
    while (rep) {
        rep = false;
        //Tri des poids des UEs
        //Une fois c'est trié, la condition if ne sera pas exzcuté et rep restera false
        for (i = 0; i < 4; i++) {
            if (choix_poids[i][0] > choix_poids[i+1][0]) {
                tmp = choix_poids[i];
                choix_poids[i] = choix_poids[i+1];
                choix_poids[i+1] = tmp;
                rep = true;
            }
        }
    }
 //          alert(choix_poids);
    
 
    //EDT1 vert , EDT2 orange , EDT3 rouge
    var listeEDT1 = [];var listeEDT2 = [];var listeEDT3 = [];
    var EDT = [];
    //Variables qui seront utilisées dans les boucles for
    var ue1 = 0;var ue2 = 0;var ue3 = 0;var ue4 = 0;var ue5 = 0;
    
    //Ici on a 5 boucles imbriquées, pour énumérer tous les EDT possibles 
    //ue1(ue2(ue3(ue4(ue5))))
    //On incrémente en fonction du lentgh des tableaux des matières 
    for (ue1 = 1; ue1 < choix_poids[0][0]; ue1++) {
        //Initialisation
        EDT = [ listeUE[choix_poids[0][1]] [0] ]; //Récupération de la séance de cours de l'UE dans EDT
        
        //i commence par 1 car la première matière est gérée dans l'instructions précédente
        for (i=1; i<5; i++) {
            //Si le cours n'existe pas on l'ajoute || C'est là qu'on traite les séances qui se chevauchent
            if (EDT.indexOf(listeUE[choix_poids[i][1]][0]) == -1) {
                EDT.push(listeUE[choix_poids[i][1]][0]); //On ajoute ici les cours des autres UEs
            }
        }
        
        //Si la longueur de EDT différente de 5, on sort (Chevauchement détecté)
        if (EDT.length != 5) {
            break;
        }
        
        //Il faut que les séances de TD/TME existent et que ue1 soit encore inférieur au length
        //La première condition entre () concerne les tableaux vides ==> Pour les étudiants en alternance
        while (ue1 < choix_poids[0][0] && (listeUE[choix_poids[0][1]][ue1].length == 0 || EDT.indexOf(listeUE[choix_poids[0][1]][ue1][0])!=-1 || EDT.indexOf(listeUE[choix_poids[0][1]][ue1][1])!=-1)) {
            ue1++;
        } 
        //On est arrivé à la fin du tableau associé à UE1
        if (ue1 == choix_poids[0][0]) {
            break;
        }
        
        //Ajout des 2 séances de TD/TME correspondantes à l'UE1
        EDT.push(listeUE[choix_poids[0][1]][ue1][0]); 
        EDT.push(listeUE[choix_poids[0][1]][ue1][1]);
        //          alert(EDT.length);
        
        //Boucle du 2ème UE, idem ici, la condition d'arrêt est l'atteinte du length
        for (ue2 = 1; ue2 < choix_poids[1][0]; ue2++) {
            //Ici, même condition que pour l'UE1
            while (ue2 < choix_poids[1][0] && (listeUE[choix_poids[1][1]][ue2].length == 0 || EDT.indexOf(listeUE[choix_poids[1][1]][ue2][0])!=-1 || EDT.indexOf(listeUE[choix_poids[1][1]][ue2][1])!=-1)) {
                ue2++;
            }
            //Pareil, si on a atteint le lenght on fait un break
            if (ue2 == choix_poids[1][0]) {
                break;
            }
            //Ajout des séances de TD/TME de l'UE2
            EDT.push(listeUE[choix_poids[1][1]][ue2][0]);
            EDT.push(listeUE[choix_poids[1][1]][ue2][1]);
            
            //Boucle de l'UE3
            for (ue3 = 1; ue3 < choix_poids[2][0]; ue3++) {
                //IDEM
                while (ue3 < choix_poids[2][0] && (listeUE[choix_poids[2][1]][ue3].length == 0 || EDT.indexOf(listeUE[choix_poids[2][1]][ue3][0])!=-1 || EDT.indexOf(listeUE[choix_poids[2][1]][ue3][1])!=-1)) {
                    ue3++;
                }
                //IDEM
                if (ue3 == choix_poids[2][0]) {
                    break;
                }
                //IDEM
                EDT.push(listeUE[choix_poids[2][1]][ue3][0]);
                EDT.push(listeUE[choix_poids[2][1]][ue3][1]);
                
                //Boucle de l'UE4
                for (ue4 = 1; ue4 < choix_poids[3][0]; ue4++) {
                    //IDEM
                    while (ue4 < choix_poids[3][0] && (listeUE[choix_poids[3][1]][ue4].length == 0 || EDT.indexOf(listeUE[choix_poids[3][1]][ue4][0])!=-1 || EDT.indexOf(listeUE[choix_poids[3][1]][ue4][1])!=-1)) {
                        ue4++;
                    }
                    //IDEM
                    if (ue4 == choix_poids[3][0]) {
                        break;
                    }
                    //IDEM
                    EDT.push(listeUE[choix_poids[3][1]][ue4][0]);
                    EDT.push(listeUE[choix_poids[3][1]][ue4][1]);
                    //Boucle de l'UE5
                    for (ue5 = 1; ue5 < choix_poids[4][0]; ue5++) {
                        //IDEM
                        while (ue5 < choix_poids[4][0] && (listeUE[choix_poids[4][1]][ue5].length == 0 || EDT.indexOf(listeUE[choix_poids[4][1]][ue5][0])!=-1 || EDT.indexOf(listeUE[choix_poids[4][1]][ue5][1])!=-1)) {
                            ue5++;
                        }
                        //IDEM
                        if (ue5 == choix_poids[4][0]) {
                            break;
                        }
                        //IDEM
                        EDT.push(listeUE[choix_poids[4][1]][ue5][0]);
                        EDT.push(listeUE[choix_poids[4][1]][ue5][1]);
                        
                        //Liste contenant les paires (UE, groupe)
                        l = [[choix_poids[0][1], ue1],[choix_poids[1][1], ue2], [choix_poids[2][1], ue3], [choix_poids[3][1], ue4], [choix_poids[4][1], ue5]];

                        pds = poids(l); //Appel de la fonction calculant le poids
                        //Si c'est un EDT vert, on le rajoute à listeEDT1
                        listeEDT1.push([pds[1], l]); //s avec la liste des UEs l (C'est un L pas un 1)
                        //On supprime les séances de TD/TME de l'ue5
                        //PAS BESOIN DE LE FAIRE POUR UE1 CAR INITIALISATION EDT AU DéBUT
                        EDT.splice(EDT.indexOf(listeUE[choix_poids[4][1]][ue5][0]),1);
                        EDT.splice(EDT.indexOf(listeUE[choix_poids[4][1]][ue5][1]),1);
                    }
                    //On supprime les séances de TD/TME de l'ue4
                    EDT.splice(EDT.indexOf(listeUE[choix_poids[3][1]][ue4][0]),1);
                    EDT.splice(EDT.indexOf(listeUE[choix_poids[3][1]][ue4][1]),1);
                }
                //On supprime les séances de TD/TME de l'ue3
                EDT.splice(EDT.indexOf(listeUE[choix_poids[2][1]][ue3][0]),1);
                EDT.splice(EDT.indexOf(listeUE[choix_poids[2][1]][ue3][1]),1);
            }
            //On supprime les séances de TD/TME de l'ue2
            EDT.splice(EDT.indexOf(listeUE[choix_poids[1][1]][ue2][0]),1);
            EDT.splice(EDT.indexOf(listeUE[choix_poids[1][1]][ue2][1]),1);
        }
    }
    
    //Affichage du message concernant le nombre d'emlpois trouvés pour chaque couleur
    document.write("<br></br><table><tr><td width='20'></td><td width='300'><font color='green'> Il y a " + listeEDT1.length + " emplois du temps de classe 1.</font></td><td width='20'></td>");
    document.write("<td width='300'><font color='orange'> Il y a " + listeEDT2.length + " emplois du temps de classe 2.</font></td><td  width='20'></td>");
    document.write("<td width='300'><font color='red'>  Il y a " + listeEDT3.length + " emplois du temps de classe 3.</font></td>");
    document.write("</tr></table><br></br>");
    
    //Tri décroissant des listes des EDT en se basant sur la valeur s
    /*
    tri(listeEDT1, 0, listeEDT1.length-1);
    tri(listeEDT2, 0, listeEDT2.length-1);
    tri(listeEDT3, 0, listeEDT3.length-1);
    */
    //Affichage du bouton de modification d'UEs au cas où l'étudiant change d'avis
    document.write("<table><tr><td width='60'></td><td> Modifier les 5 UE <br> <input type='submit' name='modif' value='modifier' onclick='retour()'/></td>");
    //Si le nombre d'EDTs n'est pas nul, afficher le bouton Valider
    if (listeEDT1.length+listeEDT2.length+listeEDT3.length > 0) {
    document.write("<form method='get' action='validation_edt_ideal.php'>");
    document.write("<td width='60'></td><td> Valider l'emploi du temps coch&eacute; <br> <input type='submit' name='submit' value='valider'/></td><table><tr><td width='60'></td></tr></table>");
    
        
    var asso = {};
    var r = 0;
    var l = [];
    var ll = 0;
    
    document.write("<br></br><table>");
    if (listeEDT1.length > 0) {

        i=0;
        //Ajout du premier tableau qui sera coché par défaut
        document.write("<tr><td width='20'><input type='radio' name='edt' value="+listeEDT1[i][1]+" checked='checked'/></td><td width='500'>");

        /****Traitement des horaires !!!!!!!!!!!!!!!!!!!!!!!!!****/
        
        asso = {};
        //Récupération du cours, td et tme de chaque UE dans la variable asso 
        //C'est des associations de type horaire=>ue (exemple : ma14 => algav-1)
        for (r=0; r<5; r++) {
            //Séances de cours
            asso[listeUE[ listeEDT1[i][1] [r][0] ][0]] = listeEDT1[i][1] [r][0].toUpperCase();
            //TDs et TMEs
            asso[listeUE[ listeEDT1[i][1] [r][0] ][listeEDT1[i][1] [r][1]] [0]] = listeEDT1[i][1] [r][0].toUpperCase() + "-" + listeEDT1[i][1] [r][1];
            asso[listeUE[ listeEDT1[i][1] [r][0] ][listeEDT1[i][1] [r][1]] [1]] = listeEDT1[i][1] [r][0].toUpperCase() + "-" + listeEDT1[i][1] [r][1];
        }
        
        //Affichage des tables
        document.write("<table border='1' bordercolor='green'>");
        document.write("<tr> <th bgcolor='green'></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");
        
        document.write("<tr> <th>8:30 - 10:30</th>");
        txt = "";
        l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
        //Affichage des séances qui ont lieu à 8h30 du mat
        for (ll=0; ll<l.length; ll++) {
            txt = txt + "<td align=center>";
            if (asso[l[ll]] != undefined) {
                txt = txt + asso[l[ll]];
            }
            txt = txt + "</td>";
        }
        document.write(txt + "</tr>");
        
        document.write("<tr> <th>10:45 - 12:45</th>");
        txt = "";
        l = ['lu10', 'ma10', 'me10', 'je10', 've10'];
        //Affichage des séances qui ont lieu à 10h45 du mat
        for (ll=0; ll<l.length; ll++) {
            txt = txt + "<td align=center>";
            if (asso[l[ll]] != undefined) {
                txt = txt + asso[l[ll]];
            }
            txt = txt + "</td>";
        }
        document.write(txt + "</tr>");
        
        document.write("<tr> <th>13:45 - 15:45</th>");
        txt = "";
        l = ['lu14', 'ma14', 'me14', 'je14', 've14'];
        //Affichage des séances qui ont lieu à 13h45
        for (ll=0; ll<l.length; ll++) {
            txt = txt + "<td align=center>";
            if (asso[l[ll]] != undefined) {
                txt = txt + asso[l[ll]];
            }
            txt = txt + "</td>";
        }
        document.write(txt + "</tr>");
        
        document.write("<tr> <th>16:00 - 18:00</th>");
        txt = "";
        l = ['lu16', 'ma16', 'me16', 'je16', 've16'];
        //Affichage des séances qui ont lieu à 16h00
        for (ll=0; ll<l.length; ll++) {
            txt = txt + "<td align=center>";
            if (asso[l[ll]] != undefined) {
                txt = txt + asso[l[ll]];
            }
            txt = txt + "</td>";
        }
        document.write(txt + "</tr>");
        document.write("</table>");
        document.write("</td><td width='20'></td></tr>");
        
        //On continue avec le reste des EDT verts 
        for (i=1; i<listeEDT1.length; i++) {
            
            document.write("<tr><td width='20'><input type='radio' name='edt' value="+listeEDT1[i][1]+" /></td><td width='500'>");
            
            asso = {};
            for (r=0; r<5; r++) {
                asso[listeUE[ listeEDT1[i][1] [r][0] ][0]] = listeEDT1[i][1] [r][0].toUpperCase();
                asso[listeUE[ listeEDT1[i][1] [r][0] ][listeEDT1[i][1] [r][1]] [0]] = listeEDT1[i][1] [r][0].toUpperCase() + "-" + listeEDT1[i][1] [r][1];
                asso[listeUE[ listeEDT1[i][1] [r][0] ][listeEDT1[i][1] [r][1]] [1]] = listeEDT1[i][1] [r][0].toUpperCase() + "-" + listeEDT1[i][1] [r][1];
            }

            document.write("<table border='1' bordercolor='green'>");
            document.write("<tr> <th bgcolor='green'></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");
         
            document.write("<tr> <th>8:30 - 10:30</th>");
            txt = "";
            l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            
            document.write("<tr> <th>10:45 - 12:45</th>");
            txt = "";
            l = ['lu10', 'ma10', 'me10', 'je10', 've10'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            
            document.write("<tr> <th>13:45 - 15:45</th>");
            txt = "";
            l = ['lu14', 'ma14', 'me14', 'je14', 've14'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            
            document.write("<tr> <th>16:00 - 18:00</th>");
            txt = "";
            l = ['lu16', 'ma16', 'me16', 'je16', 've16'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            document.write("</table>");
            document.write("</td><td width='20'></td></tr>");
        }
        //On gère les EDT orange de la même manière 
        for (i=0; i<listeEDT2.length; i++) {

            document.write("<tr><td width='20'><input type='radio' name='edt' value="+listeEDT2[i][1]+" /></td><td width='500'>");
            
            asso = {};
            for (r=0; r<5; r++) {
                asso[listeUE[ listeEDT2[i][1] [r][0] ][0]] = listeEDT2[i][1] [r][0].toUpperCase();
                asso[listeUE[ listeEDT2[i][1] [r][0] ][listeEDT2[i][1] [r][1]] [0]] = listeEDT2[i][1] [r][0].toUpperCase() + "-" + listeEDT2[i][1] [r][1];
                asso[listeUE[ listeEDT2[i][1] [r][0] ][listeEDT2[i][1] [r][1]] [1]] = listeEDT2[i][1] [r][0].toUpperCase() + "-" + listeEDT2[i][1] [r][1];
            }
            
            document.write("<table border='1' bordercolor='orange'>");
            document.write("<tr> <th bgcolor='orange'></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");
            
            document.write("<tr> <th>8:30 - 10:30</th>");
            txt = "";
            l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            
            document.write("<tr> <th>10:45 - 12:45</th>");
            txt = "";
            l = ['lu10', 'ma10', 'me10', 'je10', 've10'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            
            document.write("<tr> <th>13:45 - 15:45</th>");
            txt = "";
            l = ['lu14', 'ma14', 'me14', 'je14', 've14'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            
            document.write("<tr> <th>16:00 - 18:00</th>");
            txt = "";
            l = ['lu16', 'ma16', 'me16', 'je16', 've16'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            document.write("</table>");
            document.write("</td><td width='20'></td></tr>");
            
        }
        //On gère les EDT rouges de la même manière
        for (i=0; i<listeEDT3.length; i++) {
            
            document.write("<tr><td width='20'><input type='radio' name='edt' value="+listeEDT3[i][1]+" /></td><td width='500'>");
            
            asso = {};
            for (r=0; r<5; r++) {
                asso[listeUE[ listeEDT3[i][1] [r][0] ][0]] = listeEDT3[i][1] [r][0].toUpperCase();
                asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [0]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
                asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [1]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
            }
            
            document.write("<table border='1' bordercolor='red'>");
            document.write("<tr> <th bgcolor='red'></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");
            
            document.write("<tr> <th>8:30 - 10:30</th>");
            txt = "";
            l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            
            document.write("<tr> <th>10:45 - 12:45</th>");
            txt = "";
            l = ['lu10', 'ma10', 'me10', 'je10', 've10'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            
            document.write("<tr> <th>13:45 - 15:45</th>");
            txt = "";
            l = ['lu14', 'ma14', 'me14', 'je14', 've14'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            
            document.write("<tr> <th>16:00 - 18:00</th>");
            txt = "";
            l = ['lu16', 'ma16', 'me16', 'je16', 've16'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            document.write("</table>");
            document.write("</td><td width='20'></td></tr>");
        }
    }
    //Si listeEDT1 ne contient aucun EDT, on commence avec listeEDT2
    else {
        if (listeEDT2.length > 0) {
            
            i=0;
            document.write("<tr><td width='20'><input type='radio' name='edt' value="+listeEDT2[i][1]+" checked='checked'/></td><td width='500'>");
            
            asso = {};
            for (r=0; r<5; r++) {
                asso[listeUE[ listeEDT2[i][1] [r][0] ][0]] = listeEDT2[i][1] [r][0].toUpperCase();
                asso[listeUE[ listeEDT2[i][1] [r][0] ][listeEDT2[i][1] [r][1]] [0]] = listeEDT2[i][1] [r][0].toUpperCase() + "-" + listeEDT2[i][1] [r][1];
                asso[listeUE[ listeEDT2[i][1] [r][0] ][listeEDT2[i][1] [r][1]] [1]] = listeEDT2[i][1] [r][0].toUpperCase() + "-" + listeEDT2[i][1] [r][1];
            }
            
            document.write("<table border='1' bordercolor='orange'>");
            document.write("<tr> <th  bgcolor='orange'></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");
            
            document.write("<tr> <th>8:30 - 10:30</th>");
            txt = "";
            l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            
            document.write("<tr> <th>10:45 - 12:45</th>");
            txt = "";
            l = ['lu10', 'ma10', 'me10', 'je10', 've10'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            
            document.write("<tr> <th>13:45 - 15:45</th>");
            txt = "";
            l = ['lu14', 'ma14', 'me14', 'je14', 've14'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            
            document.write("<tr> <th>16:00 - 18:00</th>");
            txt = "";
            l = ['lu16', 'ma16', 'me16', 'je16', 've16'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            document.write(txt + "</tr>");
            document.write("</table>");
            document.write("</td><td width='20'></td></tr>");
            
            
            for (i=1; i<listeEDT2.length; i++) {
                
                
                document.write("<tr><td width='20'><input type='radio' name='edt' value="+listeEDT2[i][1]+" /></td><td width='500'>");
                
                asso = {};
                for (r=0; r<5; r++) {
                    asso[listeUE[ listeEDT2[i][1] [r][0] ][0]] = listeEDT2[i][1] [r][0].toUpperCase();
                    asso[listeUE[ listeEDT2[i][1] [r][0] ][listeEDT2[i][1] [r][1]] [0]] = listeEDT2[i][1] [r][0].toUpperCase() + "-" + listeEDT2[i][1] [r][1];
                    asso[listeUE[ listeEDT2[i][1] [r][0] ][listeEDT2[i][1] [r][1]] [1]] = listeEDT2[i][1] [r][0].toUpperCase() + "-" + listeEDT2[i][1] [r][1];
                }
                
                document.write("<table border='1' bordercolor='orange'>");
                document.write("<tr> <th  bgcolor='orange'></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");
                
                document.write("<tr> <th>8:30 - 10:30</th>");
                txt = "";
                l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                document.write(txt + "</tr>");
                
                document.write("<tr> <th>10:45 - 12:45</th>");
                txt = "";
                l = ['lu10', 'ma10', 'me10', 'je10', 've10'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                document.write(txt + "</tr>");
                
                document.write("<tr> <th>13:45 - 15:45</th>");
                txt = "";
                l = ['lu14', 'ma14', 'me14', 'je14', 've14'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                document.write(txt + "</tr>");
                
                document.write("<tr> <th>16:00 - 18:00</th>");
                txt = "";
                l = ['lu16', 'ma16', 'me16', 'je16', 've16'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                document.write(txt + "</tr>");
                document.write("</table>");
                document.write("</td><td width='20'></td></tr>");
                

            }
            for (i=0; i<listeEDT3.length; i++) {
                
                document.write("<tr><td width='20'><input type='radio' name='edt' value="+listeEDT3[i][1]+" /></td><td width='500'>");
                
                asso = {};
                for (r=0; r<5; r++) {
                    asso[listeUE[ listeEDT3[i][1] [r][0] ][0]] = listeEDT3[i][1] [r][0].toUpperCase();
                    asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [0]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
                    asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [1]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
                }
                
                document.write("<table border='1' bordercolor='red'>");
                document.write("<tr> <th  bgcolor='red'></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");
                
                document.write("<tr> <th>8:30 - 10:30</th>");
                txt = "";
                l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                document.write(txt + "</tr>");
                
                document.write("<tr> <th>10:45 - 12:45</th>");
                txt = "";
                l = ['lu10', 'ma10', 'me10', 'je10', 've10'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                document.write(txt + "</tr>");
                
                document.write("<tr> <th>13:45 - 15:45</th>");
                txt = "";
                l = ['lu14', 'ma14', 'me14', 'je14', 've14'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                document.write(txt + "</tr>");
                
                document.write("<tr> <th>16:00 - 18:00</th>");
                txt = "";
                l = ['lu16', 'ma16', 'me16', 'je16', 've16'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                document.write(txt + "</tr>");
                document.write("</table>");
                document.write("</td><td width='20'></td></tr>");
                
            }
        }
        //Si listeEDT1 et listeEDT2 sont vides, on traite listeEDT3
        else {
            if (listeEDT3.length > 0) {
                
                i=0;
                document.write("<tr><td width='20'><input type='radio' name='edt' value="+listeEDT3[i][1]+" checked='checked'/></td><td width='500'>");
                
                asso = {};
                for (r=0; r<5; r++) {
                    asso[listeUE[ listeEDT3[i][1] [r][0] ][0]] = listeEDT3[i][1] [r][0].toUpperCase();
                    asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [0]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
                    asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [1]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
                }
                
                document.write("<table border='1' bordercolor='red'>");
                document.write("<tr> <th bgcolor='red'></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");
                
                document.write("<tr> <th>8:30 - 10:30</th>");
                txt = "";
                l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                document.write(txt + "</tr>");
                
                document.write("<tr> <th>10:45 - 12:45</th>");
                txt = "";
                l = ['lu10', 'ma10', 'me10', 'je10', 've10'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                document.write(txt + "</tr>");
                
                document.write("<tr> <th>13:45 - 15:45</th>");
                txt = "";
                l = ['lu14', 'ma14', 'me14', 'je14', 've14'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                document.write(txt + "</tr>");
                
                document.write("<tr> <th>16:00 - 18:00</th>");
                txt = "";
                l = ['lu16', 'ma16', 'me16', 'je16', 've16'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                document.write(txt + "</tr>");
                document.write("</table>");
                document.write("</td><td width='20'></td></tr>");
                
                
                for (i=1; i<listeEDT3.length; i++) {
                
                    document.write("<tr><td width='20'><input type='radio' name='edt' value="+listeEDT3[i][1]+" /></td><td width='500'>");
                    
                    asso = {};
                    for (r=0; r<5; r++) {
                        asso[listeUE[ listeEDT3[i][1] [r][0] ][0]] = listeEDT3[i][1] [r][0].toUpperCase();
                        asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [0]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
                        asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [1]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
                    }
                    
                    document.write("<table border='1' bordercolor='red'>");
                    document.write("<tr> <th></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");
                    
                    document.write("<tr> <th>8:30 - 10:30</th>");
                    txt = "";
                    l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
                    for (ll=0; ll<l.length; ll++) {
                        txt = txt + "<td align=center>";
                        if (asso[l[ll]] != undefined) {
                            txt = txt + asso[l[ll]];
                        }
                        txt = txt + "</td>";
                    }
                    document.write(txt + "</tr>");
                    
                    document.write("<tr> <th>10:45 - 12:45</th>");
                    txt = "";
                    l = ['lu10', 'ma10', 'me10', 'je10', 've10'];
                    for (ll=0; ll<l.length; ll++) {
                        txt = txt + "<td align=center>";
                        if (asso[l[ll]] != undefined) {
                            txt = txt + asso[l[ll]];
                        }
                        txt = txt + "</td>";
                    }
                    document.write(txt + "</tr>");
                    
                    document.write("<tr> <th>13:45 - 15:45</th>");
                    txt = "";
                    l = ['lu14', 'ma14', 'me14', 'je14', 've14'];
                    for (ll=0; ll<l.length; ll++) {
                        txt = txt + "<td align=center>";
                        if (asso[l[ll]] != undefined) {
                            txt = txt + asso[l[ll]];
                        }
                        txt = txt + "</td>";
                    }
                    document.write(txt + "</tr>");
                    
                    document.write("<tr> <th>16:00 - 18:00</th>");
                    txt = "";
                    l = ['lu16', 'ma16', 'me16', 'je16', 've16'];
                    for (ll=0; ll<l.length; ll++) {
                        txt = txt + "<td align=center>";
                        if (asso[l[ll]] != undefined) {
                            txt = txt + asso[l[ll]];
                        }
                        txt = txt + "</td>";
                    }
                    document.write(txt + "</tr>");
                    document.write("</table>");
                    document.write("</td><td width='20'></td></tr>");
                
                }
            }
        }
    }
    document.write("</table></form>");
    }
    
}
</script>

    </head>


    <body>

    <h1>
        UPMC : Master Informatique
    </h1>

    <h3>
        Choix d'un emploi du temps idéal 
    </h3>

    <table>
        <tr>
            <td width="10%"> </td>
            <td>
            <p>
                Tous les emploi du temps compatibles avec les 5 UE que vous avez choisies sont
                affich&eacute;s ci-dessous. Ils sont r&eacute;pertori&eacute;s en 3 classes suivant le taux de remplissage actuel des groupes.
                La <font color='green'>classe 1</font> consiste en les emplois du temps, dont les groupes contiennent encore de la place.
                La <font color='orange'>classe 2</font> contient les emplois du temps dont certains groupes sont presque pleins.
                Enfin, la <font color='red'>classe 3</font> contient les emplois du temps dont certains groupes sont d&eacute;j&agrave; pleins.
            </p>
            <p>
                Vous avez la possbilit&eacute; de choisir UN SEUL emploi du temps parmi tous les emplois du temps. Ainsi, en choisissant
                un emploi du temps dans la derni&egrave;re classe, il est probable que vos voeux soient modifi&eacute;s &agrave; la rentr&eacute;e.
                <br>
                    Nous vous rappelons qu'il s'agit de voeux d'UE et d'emploi du temps, et quels que soient vos choix, il est possible qu'ils soient modifi&eacute;s lors
                    de la pr&eacute;-rentr&eacute;e, pour des raisons p&eacute;dagogiques ou de contraintes de remplissage de groupes.
                </br>
            </p>
            
            </td>
            <td width="10%"> </td>
        </tr>
    </table>

    <script>

        <?php echo $ue; ?>

    </script>

    </body>





</html>
