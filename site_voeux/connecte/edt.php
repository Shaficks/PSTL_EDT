
<?php
    
    session_start();
    
    $num = $_SESSION['num'];
    $spe = $_SESSION['spe'];
    
    $choix = ['','','','',''];
    
    for ($i=1; $i<6; $i++) {
        $choix[$i-1] = $_GET['ue'.$i];
    }
    
    $ue = 'edt('.  $num . ", '" . $spe . "',";
    for ($i=0; $i<5; $i++) {
        $ue = $ue . "'" . $choix[$i] . "'";
        if ($i<4) {
            $ue = $ue . ",";
        }
    }
    $ue = $ue . ')';
    
    require('../config.php');
    
    $reponse = mysql_query("SELECT * FROM UEGroupes");
    $groupes = [];
    while ($donnees = mysql_fetch_array($reponse)) {
        $groupes[$donnees['groupe']] = $donnees['effectif'];
    }
    
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title>UPMC, Master Informatique : Saisie des voeux d'UE du S1</title>

        <script language=JavaScript>

function rearrange(l, d, f) {
    var piv = l[f][0];
    var k = d;
    var tmp = [];
    for (var i=d; i<f; i++) {
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

function tri(l, d, f) {
    if (d < f) {
        var q = rearrange(l, d, f);
        tri(l, d, q-1);
        tri(l, q+1, f);
    }
}


function poids(l) {
    
    var groupes = <?php echo json_encode($groupes); ?>;
    var i = 0;
    var g = ['','','','',''];
    for (i=0; i<5; i++) {
        g[i] = l[i][0]+l[i][1];
    }
    
    var m = 0;
    var p = [0,0,0,0,0];
    for (i=0; i<5; i++) {
        p[i] = groupes[g[i]];
        if (parseInt(p[i]) > m) {
        	m = parseInt(p[i]);
       } 
    }
	    
    var res = [];
    var s = 0.0;
    if (m > 27) {
        for (i=0; i<5; i++) {
            s += 27 - p[i]
        }
        res = [3, s];
    }
    else {
        s = 1.0
        for (i=0; i<5; i++) {
            s *= 28 - p[i]
        }
        if (m > 24) {     
            res = [2, s];
        }
        else {
            res = [1, s];
        }
    }
    
    return res;
}

function retour() {
    document.location.replace('index.php');
}


function edt(num, spe, ue1, ue2, ue3, ue4, ue5) {
    
    var listeUE = {'4m062':['lu16', ['me10', 've04']], 'rtel':['lu08', ['ma08','ma10'], [], ['me08','me10']], 'mobj':['lu08', ['me08','me10']], 'elecana1':['lu10', ['ma08','ma10']], 'aagb':['lu10', ['me16', 've16']], 'ares':['lu10', [], [], ['me08','me10'], ['me14','me16'], ['je08','je10'], ['je14','je16']], 'pr':['lu14', ['me08','me10'], ['me14','me16'], ['ve08','ve10'], ['ve10','ve14']], 'noyau':['lu16', [], ['ma14','ma16'], ['ma14','ma16'], ['me14','me16'], ['je14','je16']], 'dlp':['ma08', ['je14','je16'], ['je14','je16'], ['ve08','ve10']], 'algav':['ma10', ['ma14','ma16'], ['je08','je10'], ['je08','je10']], 'bima':['ma14', ['je14','je16']], 'mapsi':['ma16', ['lu08','lu10'], ['lu08','lu10'], ['ma08','ma10'], ['ma08','ma14']], 'il':['me08', ['lu08','lu10'], ['lu08','lu10'], ['ma08','ma10'], ['me10','me14'], ['je14','je16'], ['ve10','ve14']], 'lrc':['me14', ['lu14','lu16'], ['lu14','lu16'], ['ma14','ma16'], ['je08','je10']], 'mlbda':['me16', ['lu08','lu10'], ['me08','me10'], ['je08','je10'], ['je10','ve14']], 'model':['je08', ['ve14','ve16']], 'complex':['je10', ['me08','me10'], ['lu08','ve10']], 'archi1':['je14', ['ma14','ma16'], ['ma14','ma16'],['me14','me16'],['ve14','ve16']], 'vlsi1':['je16', ['me14','me16'], ['ve14','ve16']], 'mogpl':['ve08', ['lu14','lu16'], ['je14','je16'], ['je14','je16'], ['ve10','ve14']], 'signal':['ve10', ['ma14','ma16'], ['je08','je10']]};
    
    var l = [];
    
    var choix = [ue1, ue2, ue3, ue4, ue5];
    
    var choix_poids = [[],[],[],[],[]];
    var i = 0;
    for (i = 0; i < 5; i++)  {
        choix_poids[i] = [listeUE[choix[i]].length, choix[i]];
    }
 //           alert(choix_poids);
    
    var tmp = [];
    var rep = true;
    while (rep) {
        rep = false;
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
 
    
    var listeEDT1 = [];var listeEDT2 = [];var listeEDT3 = [];
    var EDT = [];
    var ue1 = 0;var ue2 = 0;var ue3 = 0;var ue4 = 0;var ue5 = 0;
    
    for (ue1 = 1; ue1 < choix_poids[0][0]; ue1++) {

        EDT = [ listeUE[choix_poids[0][1]] [0] ];
        for (i=1; i<5; i++) {
            if (EDT.indexOf(listeUE[choix_poids[i][1]][0]) == -1) {
                EDT.push(listeUE[choix_poids[i][1]][0]);
            }
        }
        if (EDT.length != 5) {
            break;
        }

        while (ue1 < choix_poids[0][0] && (listeUE[choix_poids[0][1]][ue1].length == 0 || EDT.indexOf(listeUE[choix_poids[0][1]][ue1][0])!=-1 || EDT.indexOf(listeUE[choix_poids[0][1]][ue1][1])!=-1)) {
            ue1++;
        }
        if (ue1 == choix_poids[0][0]) {
            break;
        }
        
        EDT.push(listeUE[choix_poids[0][1]][ue1][0]);
        EDT.push(listeUE[choix_poids[0][1]][ue1][1]);
        //          alert(EDT.length);
        
        for (ue2 = 1; ue2 < choix_poids[1][0]; ue2++) {
            while (ue2 < choix_poids[1][0] && (listeUE[choix_poids[1][1]][ue2].length == 0 || EDT.indexOf(listeUE[choix_poids[1][1]][ue2][0])!=-1 || EDT.indexOf(listeUE[choix_poids[1][1]][ue2][1])!=-1)) {
                ue2++;
            }
            if (ue2 == choix_poids[1][0]) {
                break;
            }
            
            EDT.push(listeUE[choix_poids[1][1]][ue2][0]);
            EDT.push(listeUE[choix_poids[1][1]][ue2][1]);
            
            for (ue3 = 1; ue3 < choix_poids[2][0]; ue3++) {
                while (ue3 < choix_poids[2][0] && (listeUE[choix_poids[2][1]][ue3].length == 0 || EDT.indexOf(listeUE[choix_poids[2][1]][ue3][0])!=-1 || EDT.indexOf(listeUE[choix_poids[2][1]][ue3][1])!=-1)) {
                    ue3++;
                }
                if (ue3 == choix_poids[2][0]) {
                    break;
                }

                EDT.push(listeUE[choix_poids[2][1]][ue3][0]);
                EDT.push(listeUE[choix_poids[2][1]][ue3][1]);
                
                for (ue4 = 1; ue4 < choix_poids[3][0]; ue4++) {
                    while (ue4 < choix_poids[3][0] && (listeUE[choix_poids[3][1]][ue4].length == 0 || EDT.indexOf(listeUE[choix_poids[3][1]][ue4][0])!=-1 || EDT.indexOf(listeUE[choix_poids[3][1]][ue4][1])!=-1)) {
                        ue4++;
                    }
                    if (ue4 == choix_poids[3][0]) {
                        break;
                    }
                    
                    EDT.push(listeUE[choix_poids[3][1]][ue4][0]);
                    EDT.push(listeUE[choix_poids[3][1]][ue4][1]);
                    
                    for (ue5 = 1; ue5 < choix_poids[4][0]; ue5++) {
                        while (ue5 < choix_poids[4][0] && (listeUE[choix_poids[4][1]][ue5].length == 0 || EDT.indexOf(listeUE[choix_poids[4][1]][ue5][0])!=-1 || EDT.indexOf(listeUE[choix_poids[4][1]][ue5][1])!=-1)) {
                            ue5++;
                        }
                        if (ue5 == choix_poids[4][0]) {
                            break;
                        }
                        
                        EDT.push(listeUE[choix_poids[4][1]][ue5][0]);
                        EDT.push(listeUE[choix_poids[4][1]][ue5][1]);
       
                        l = [[choix_poids[0][1], ue1],[choix_poids[1][1], ue2], [choix_poids[2][1], ue3], [choix_poids[3][1], ue4], [choix_poids[4][1], ue5]];

                        pds = poids(l);
                        if (pds[0] == 1) {
                            listeEDT1.push([pds[1], l]);
                        }
                        else {
                            if (pds[0] == 2) {
                                listeEDT2.push([pds[1], l]);
                            }
                            else {
                                listeEDT3.push([pds[1], l]);
                            }
                        }
                        EDT.splice(EDT.indexOf(listeUE[choix_poids[4][1]][ue5][0]),1);
                        EDT.splice(EDT.indexOf(listeUE[choix_poids[4][1]][ue5][1]),1);
                    }
                    EDT.splice(EDT.indexOf(listeUE[choix_poids[3][1]][ue4][0]),1);
                    EDT.splice(EDT.indexOf(listeUE[choix_poids[3][1]][ue4][1]),1);
                }
                EDT.splice(EDT.indexOf(listeUE[choix_poids[2][1]][ue3][0]),1);
                EDT.splice(EDT.indexOf(listeUE[choix_poids[2][1]][ue3][1]),1);
            }
            EDT.splice(EDT.indexOf(listeUE[choix_poids[1][1]][ue2][0]),1);
            EDT.splice(EDT.indexOf(listeUE[choix_poids[1][1]][ue2][1]),1);
        }
    }
    
    document.write("<br></br><table><tr><td width='20'></td><td width='300'><font color='green'> Il y a " + listeEDT1.length + " emplois du temps de classe 1.</font></td><td width='20'></td>");
    document.write("<td width='300'><font color='orange'> Il y a " + listeEDT2.length + " emplois du temps de classe 2.</font></td><td  width='20'></td>");
    document.write("<td width='300'><font color='red'>  Il y a " + listeEDT3.length + " emplois du temps de classe 3.</font></td>");
    document.write("</tr></table><br></br>");
    

    tri(listeEDT1, 0, listeEDT1.length-1);
    tri(listeEDT2, 0, listeEDT2.length-1);
    tri(listeEDT3, 0, listeEDT3.length-1);


    document.write("<table><tr><td width='60'></td><td> Modifier les 5 UE <br> <input type='submit' name='modif' value='modifier' onclick='retour()'/></td>");
    if (listeEDT1.length+listeEDT2.length+listeEDT3.length > 0) {
    document.write("<form method='get' action='soumission.php'>");
    document.write("<td width='60'></td><td> Valider l'emploi du temps coch&eacute; <br> <input type='submit' name='submit' value='valider'/></td><table><tr><td width='60'></td></tr></table>");
    
        
    var asso = {};
    var r = 0;
    var l = [];
    var ll = 0;
    
    document.write("<br></br><table>");
    if (listeEDT1.length > 0) {

        i=0;
        document.write("<tr><td width='20'><input type='radio' name='edt' value="+listeEDT1[i][1]+" checked='checked'/></td><td width='500'>");
       
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
        Choix d'un emploi du temps
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
