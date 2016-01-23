
<?php
    
    session_start();
    
    $num = $_SESSION['num'];
    $spe = $_SESSION['spe'];
    
    $edt = $_GET['edt'];

    $tabEdt = explode(",", $edt);
    
    $choix = [[],[],[],[],[],[]];
    
    for ($i=0; $i<5; $i++) {
        $choix[$i] = [$tabEdt[2*$i], $tabEdt[2*$i+1]];
    }
    
    for ($i=1; $i<$_SESSION['nb_suivi']+1; $i++) {
        $ue = 'ue'.$i;
        $gp = 'ue'.$i.'gpe';
        $_SESSION[$ue] = $choix[$i-1][0];
        $_SESSION[$gp] = $choix[$i-1][1];
    }
    
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title>UPMC, Master Informatique : Saisie des voeux d'UE du S1</title>

        <script>

            function ajout() {
                
                var mess = "";
                
    var listeUE = {'4m062':['lu16', ['me10', 've04']], 'sup1x':['lu00', ['lu02', 'lu04']], 'sup2x':['ma00', ['ma02', 'ma04']], 'sup3x':['me00', ['me02', 'me04']], 'sup4x':['je00', ['je02', 'je04']], 'rtel':['lu08', ['ma08','ma10'], [], ['me08','me10']], 'mobj':['lu08', ['me08','me10']], 'elecana1':['lu10', ['ma08','ma10']], 'aagb':['lu10', ['me16', 've16']], 'ares':['lu10', [], [], ['me08','me10'], ['me14','me16'], ['je08','je10'], ['je14','je16']], 'pr':['lu14', ['me08','me10'], ['me14','me16'], ['ve08','ve10'], ['ve10','ve14']], 'noyau':['lu16', [], ['ma14','ma16'], ['ma14','ma16'], ['me14','me16'], ['je14','je16']], 'dlp':['ma08', ['je14','je16'], ['je14','je16'], ['ve08','ve10']], 'algav':['ma10', ['ma14','ma16'], ['je08','je10'], ['je08','je10']], 'bima':['ma14', ['je14','je16']], 'mapsi':['ma16', ['lu08','lu10'], ['lu08','lu10'], ['ma08','ma10'], ['ma08','ma14']], 'il':['me08', ['lu08','lu10'], ['lu08','lu10'], ['ma08','ma10'], ['me10','me14'], ['je14','je16'], ['ve10','ve14']], 'lrc':['me14', ['lu14','lu16'], ['lu14','lu16'], ['ma14','ma16'], ['je08','je10']], 'mlbda':['me16', ['lu08','lu10'], ['me08','me10'], ['je08','je10'], ['je10','ve14']], 'model':['je08', ['ve14','ve16']], 'complex':['je10', ['me08','me10'], ['lu08','ve10']], 'archi1':['je14', ['ma14','ma16'], ['ma14','ma16'],['me14','me16'],['ve14','ve16']], 'vlsi1':['je16', ['me14','me16'], ['ve14','ve16']], 'mogpl':['ve08', ['lu14','lu16'], ['je14','je16'], ['je14','je16'], ['ve10','ve14']], 'signal':['ve10', ['ma14','ma16'], ['je08','je10']]};
                
                var ue = [ ["<?php echo $choix[0][0];?>", <?php echo $choix[0][1];?>], ["<?php echo $choix[1][0];?>", <?php echo $choix[1][1];?>], ["<?php echo $choix[2][0];?>", <?php echo $choix[2][1];?>],["<?php echo $choix[3][0];?>", <?php echo $choix[3][1];?>],["<?php echo $choix[4][0];?>", <?php echo $choix[4][1];?>]];
                
                var asso = {};
                var r = 0;
                var l = [];
                var ll = 0;
                
                mess = "<table>"; //document.write("<table>");
                
                for (r=0; r<5; r++) {
                    asso[listeUE[ ue[r][0] ][0]] = ue[r][0].toUpperCase();
                    asso[listeUE[ ue[r][0] ][ue[r][1]] [0]] = ue[r][0].toUpperCase() + "-" + ue[r][1];
                    asso[listeUE[ ue[r][0] ][ue[r][1]] [1]] = ue[r][0].toUpperCase() + "-" + ue[r][1];
                }
                
                mess = mess + "<table border='1'"; //document.write("<table border='1'");
                mess = mess + "<tr> <th></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>"; //document.write("<tr> <th></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");
                
                mess = mess + "<tr> <th>8:30 - 10:30</th>"; //document.write("<tr> <th>8:30 - 10:30</th>");
                txt = "";
                l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                mess = mess + txt + "</tr>"; //document.write(txt + "</tr>");
                
                mess = mess + "<tr> <th>10:45 - 12:45</th>"; //document.write("<tr> <th>10:45 - 12:45</th>");
                txt = "";
                l = ['lu10', 'ma10', 'me10', 'je10', 've10'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                mess = mess + txt + "</tr>"; //document.write(txt + "</tr>");
                
                mess = mess + "<tr> <th>13:45 - 15:45</th>"; //document.write("<tr> <th>13:45 - 15:45</th>");
                txt = "";
                l = ['lu14', 'ma14', 'me14', 'je14', 've14'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                mess = mess + txt + "</tr>"; //document.write(txt + "</tr>");
                
                mess = mess + "<tr> <th>16:00 - 18:00</th>"; //document.write("<tr> <th>16:00 - 18:00</th>");
                txt = "";
                l = ['lu16', 'ma16', 'me16', 'je16', 've16'];
                for (ll=0; ll<l.length; ll++) {
                    txt = txt + "<td align=center>";
                    if (asso[l[ll]] != undefined) {
                        txt = txt + asso[l[ll]];
                    }
                    txt = txt + "</td>";
                }
                mess = mess + txt + "</tr>"; //document.write(txt + "</tr>");
                mess = mess + "</table>"; //document.write("</table>");
                
                var obj = document.getElementById('week');
                obj.value = mess;
                
                var obj2 = document.getElementById('planning');
                obj2.value = JSON.stringify(asso);
                
                return mess;
            }
        </script>

      </head>

    <body>


    <h1>
        UPMC : Master Informatique
    </h1>

    <h3>
        Voil&agrave; vos voeux, &agrave; confirmer ci-dessous.
    </h3>


    <table>
        <tr>
            <td width="10%"> </td>
            <td>
                <font color='red'>Les voeux ne seront enregistr&eacute;s que lorsque vous les aurez valid&eacute;s.</font>
            </td>
            <td width="10%"> </td>
        </tr>

        <tr>
            <td width="10%"> </td>
            <td>
                Modifier les UE ou l'emploi du temps
                <br> <input type='submit' name='modif' value='modifier' onclick='document.location.replace("index.php")'/></td>
            </td>
            <td width="10%"> </td>
            <td>
                <font color='red'>Confirmer les voeux concernant les UE et l'emploi du temps</font>
                <br><form method='post' action='validation.php'>
                <input type='hidden' name='week' id='week' value=""> </input>
                <input type='hidden' name='planning' id='planning' value=""></input>
                <input type='submit' name='submit' value='confirmer'> </input>
                </form>
            </td>
            <td width="10%"> </td>
        </tr>

        <tr> </tr>

        <tr>
            <td width="10%"> </td>
            <td>
                <script>
                    var mes = "";
                    mes = ajout();
                    document.write(mes);
                    document.write("</td><td width='20'></td></tr>");
                </script>
            </td>
            <td width="10%"> </td>
        </tr>

    </table>


    </body>



</html>
