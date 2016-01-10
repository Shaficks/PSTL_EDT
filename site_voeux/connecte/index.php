<?php

    session_start();
    $num = $_SESSION['num'];
    $spe = $_SESSION['spe']
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title>UPMC, Master Informatique : Saisie des voeux d'UE du S1</title>

    </head>

    <body>

        <h1>
            UPMC : Master Informatique
        </h1>

        <h3>
            Site de saisie des voeux de modules pour le S1
        </h3>


        <table>
            <tr>
                <td width="10%"> </td>
                <td>
                    <p>
                        Chaque sp&eacute;cialit&eacute; du Master Informatique pr&eacute;sente au plus 2 UE obligatoires parmi les 5 UE suivies au premier semestre.
                        Dans la liste ci-dessous, les UE obligatoires apparaissent en gris&eacute;es (et sont not&eacute;es <font color='red'>(oblig.)</font>).
			Il vous reste alors &agrave; compl&eacute;ter le choix afin d'en s&eacute;lectionner 5 en tout.
                        Chaque sp&eacute;cialit&eacute; indique certaines UE recommand&eacute;es (et sont not&eacute;es <font color='blue'>(recom.)</font>).
                        La description compl&egrave;te du master est consultable <a href="http://www-master.ufr-info-p6.jussieu.fr">ici.</a>
                    </p>
                </td>
                <td width="10%"> </td>
            </tr>
        </table>

        <table>
            <tr>
                <td width="25%"> </td>
                <td>
                    <fieldset><legend>Liste des UE propos&eacute;es : </legend>

<?php if ($spe != 'DAC' and $spe != 'ANDROIDE' and $spe != 'BIM') { ?>
                        <table>
                            <tr>
                                <td width="180"> <input type="checkbox" name="aagb" id="aagb"
                                    <?php
                                        if($spe=='BIM')
                                        {
                                            echo 'disabled=true checked=checked';
                                        }
                                    ?>
                                    /><label for="aagb">AAGB
                                    <?php
                                        if($spe=='BIM')
                                        {
                                            echo "<font color='red'>(oblig.)</font>";
                                        }
                                    ?>
                                    </label> </td>
                                <td width="10%"> </td>
                                <td width="180"> <input type="checkbox" name="mapsi" id="mapsi"
                                    <?php
                                        if($spe=='BIM' or $spe=='IMA')
                                            {
                                                echo 'disabled=true checked=checked';
                                            }
                                    ?>
                                    /><label for="mapsi">MAPSI
                                    <?php
                                        if($spe=='BIM' or $spe=='IMA')
                                        {
                                            echo "<font color='red'>(oblig.)</font>";
                                        }
                                        else {
                                            if($spe=='DAC' or $spe=='SFPN') {
                                                echo "<font color='blue'>(recom.)</font>";
                                            }
                                        }
                                    ?>
                                    </label>
				</td>
                            </tr>
                            <tr>
                                <td width="180"> <input type="checkbox" name="algav" id="algav"
                                    <?php
                                        if($spe=='STL')
                                        {
                                            echo 'disabled=true checked=checked';
                                        }
                                    ?>
                                    /><label for="algav">ALGAV
                                    <?php
                                        if($spe=='STL')
                                            {
                                                echo "<font color='red'>(oblig.)</font>";
                                            }
                                        else {
                                            if($spe=='SAR') {
                                                echo "<font color='blue'>(recom.)</font>";
                                            }
                                        }
                                    ?>
                                    </label> </td>
                                <td width="10%"> </td>
                                <td width="180"> <input type="checkbox" name="mlbda" id="mlbda"
                                    <?php
                                        if($spe=='DAC')
                                            {
                                                echo 'disabled=true checked=checked';
                                            }
                                    ?>
                                    /><label for="mlbda">MLBDA
                                    <?php
                                        if($spe=='DAC')
                                        {
                                            echo "<font color='red'>(oblig.)</font>";
                                        }
                                        else {
                                            if($spe=='STL') {
                                                echo "<font color='blue'>(recom.)</font>";
                                            }
                                        }
                                    ?>
                                    </label>
				</td>
                            </tr>
                            <tr>
                                <td width="180"> <input type="checkbox" name="archi1" id="archi1"
                                    <?php
                                        if($spe=='SESI')
                                        {
                                            echo 'disabled=true checked=checked';
                                        }
                                    ?>
                                    /><label for="archi1">ARCHI1
                                    <?php
                                        if($spe=='SESI')
                                        {
                                            echo "<font color='red'>(oblig.)</font>";
                                        }
                                        else {
                                            if($spe=='RES' or $spe=='SAR' or $spe=='SFPN') {
                                                echo "<font color='blue'>(recom.)</font>";
                                            }
                                        }
                                    ?>
                                    </label> </td>
                                <td width="10%"> </td>
                                <td width="180"> <input type="checkbox" name="mobj" id="mobj"/><label for="mobj">MOBJ</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="180"> <input type="checkbox" name="ares" id="ares"
                                    <?php
                                        if($spe=='RES')
                                        {
                                            echo 'disabled=true checked=checked';
                                        }
                                    ?>
                                    /><label for="ares">ARES
                                    <?php
                                        if($spe=='RES')
                                        {
                                            echo "<font color='red'>(oblig.)</font>";
                                        }
                                        else {
                                            if($spe=='SAR' or $spe=='SFPN') {
                                                echo "<font color='blue'>(recom.)</font>";
                                            }
                                        }
                                        ?>
                                    </label> </td>
                                <td width="10%"> </td>
                                <td width="180"> <input type="checkbox" name="model" id="model"
                                    <?php
                                        if($spe=='SFPN')
                                            {
                                                echo 'disabled=true checked=checked';
                                            }
                                    ?>
                                    /><label for="model">MODEL
                                    <?php
                                        if($spe=='SFPN')
                                        {
                                            echo "<font color='red'>(oblig.)</font>";
                                        }
                                        else {
                                            if($spe=='BIM' or $spe=='IMA') {
                                                echo "<font color='blue'>(recom.)</font>";
                                            }
                                        }
                                    ?>
                                    </label>
				</td>
                            </tr>
                            <tr>
                                <td width="180"> <input type="checkbox" name="bima" id="bima"
                                    <?php
                                        if($spe=='IMA')
                                        {
                                            echo 'disabled=true checked=checked';
                                        }
                                    ?>
                                    /><label for="bima">BIMA
                                    <?php
                                        if($spe=='IMA')
                                        {
                                            echo "<font color='red'>(oblig.)</font>";
                                        }
                                        else {
                                            if($spe=='BIM') {
                                                echo "<font color='blue'>(recom.)</font>";
                                            }
                                        }
                                        ?>
                                    </label> </td>
                                <td width="10%"> </td>
                                <td width="180"> <input type="checkbox" name="mogpl" id="mogpl"
                                    <?php
                                        if($spe=='ANDROIDE')
                                            {
                                                echo 'disabled=true checked=checked';
                                            }
                                    ?>
                                    /><label for="mogpl">MOGPL
                                    <?php
                                        if($spe=='ANDROIDE')
                                        {
                                            echo "<font color='red'>(oblig.)</font>";
                                        }
                                        else {
                                            if($spe=='BIM' or $spe=='IMA' or $spe=='RES') {
                                                echo "<font color='blue'>(recom.)</font>";
                                            }
                                        }
                                        ?>
                                    </label>
				</td>
                            </tr>
                            <tr>
                                <td width="180"> <input type="checkbox" name="complex" id="complex"/><label for="complex">COMPLEX
                                    <?php
                                        if($spe=='BIM' or $spe=='RES' or $spe=='SFPN') {
                                            echo "<font color='blue'>(recom.)</font>";
                                        }
                                    ?>
                                    </label> </td>
                                <td width="10%"> </td>
                                <td width="180"> <input type="checkbox" name="noyau" id="noyau"
                                    <?php
                                        if($spe=='SAR')
                                            {
                                                echo 'disabled=true checked=checked';
                                            }
                                    ?>
                                    /><label for="noyau">NOYAU
                                    <?php
                                        if($spe=='SAR')
                                        {
                                            echo "<font color='red'>(oblig.)</font>";
                                        }
                                        else {
                                            if($spe=='RES' or $spe=='STL' or $spe=='SFPN') {
                                                echo "<font color='blue'>(recom.)</font>";
                                            }
                                        }
                                    ?>
                                </label>
				</td>
                            </tr>
                            <tr>
                                <td width="180"> <input type="checkbox" name="dlp" id="dlp"
                                    <?php
                                        if($spe=='STL')
                                        {
                                            echo 'disabled=true checked=checked';
                                        }
                                    ?>
                                    /><label for="dlp">DLP
                                    <?php
                                        if($spe=='STL')
                                        {
                                            echo "<font color='red'>(oblig.)</font>";
                                        }
                                        else {
                                            if($spe=='SAR') {
                                                echo "<font color='blue'>(recom.)</font>";
                                            }
                                        }
                                    ?>
                                    </label> </td>
                                <td width="10%"> </td>
                                <td width="180"> <input type="checkbox" name="pr" id="pr"
                                    <?php
                                        if($spe=='SAR')
                                            {
                                                echo 'disabled=true checked=checked';
                                            }
                                    ?>
                                    /><label for="pr">PR
                                    <?php
                                        if($spe=='SAR')
                                        {
                                            echo "<font color='red'>(oblig.)</font>";
                                        }
                                        else {
                                            if($spe=='RES' or $spe=='STL' or $spe=='SFPN') {
                                                echo "<font color='blue'>(recom.)</font>";
                                            }
                                        }
                                    ?>
                                    </label>
				</td>
                            </tr>
                            <tr>
                                <td width="180"> <input type="checkbox" name="elecana1" id="elecana1"/><label for="elecana1">ELECANA1 </label> </td>
                                <td width="10%"> </td>
                                <td width="180"> <input type="checkbox" name="rtel" id="rtel"
                                    <?php
                                        if($spe=='RES')
                                            {
                                                echo 'disabled=true checked=checked';
                                            }
                                    ?>
                                    /><label for="rtel">RTEL
                                    <?php
                                        if($spe=='RES')
                                        {
                                            echo "<font color='red'>(oblig.)</font>";
                                        }
                                    ?>
                                    </label>
				</td>
                            </tr>
                            <tr>
                                <td width="180"> <input type="checkbox" name="il" id="il" /><label for="il">IL
                                <?php
                                    if($spe=='BIM' or $spe=='DAC' or $spe=='SAR' or $spe=='STL') {
                                        echo "<font color='blue'>(recom.)</font>";
                                    }
                                ?>
                                </label> </td>
                                <td width="10%"> </td>
                                <td width="180"> <input type="checkbox" name="signal" id="signal"/><label for="signal">SIGNAL
                                <?php
                                    if($spe=='RES') {
                                        echo "<font color='blue'>(recom.)</font>";
                                    }
                                ?>
                                </label> </td>
                            </tr>
                            <tr>
                                <td width="180"> <input type="checkbox" name="lrc" id="lrc"
                                    <?php
                                        if($spe=='DAC')
                                        {
                                            echo 'disabled=true checked=checked';
                                        }
                                    ?>
                                    /><label for="lrc">LRC
                                    <?php
                                        if($spe=='DAC')
                                        {
                                            echo "<font color='red'>(oblig.)</font>";
                                        }
                                        else {
                                            if($spe=='BIM' or $spe=='STL') {
                                                echo "<font color='blue'>(recom.)</font>";
                                            }
                                        }
                                    ?>
                                    </label> </td>
                                <td width="10%"> </td>
                                <td width="180"> <input type="checkbox" name="vlsi1" id="vlsi1"
                                    <?php
                                        if($spe=='SESI')
                                            {
                                                echo 'disabled=true checked=checked';
                                            }
                                    ?>
                                    /><label for="vlsi1">VLSI1
                                    <?php
                                        if($spe=='SESI')
                                        {
                                            echo "<font color='red'>(oblig.)</font>";
                                        }
                                    ?>
                                    </label>
				</td>
                            </tr>

                        </table>
<?php } else { if ($spe == 'ANDROIDE') { ?>

<table>
<tr>
<td width="180"> <input type="checkbox" name="aagb" id="aagb"/><label for="aagb">AAGB</label> </td>
<td width="10%"> </td>
<td width="180"> <input type="checkbox" name="lrc" id="lrc" disabled="true" checked="checked"><label for="lrc">LRC <font color='red'>(oblig.)</font></label> </td>
</tr>
<tr>
<td width="180"> <input type="checkbox" name="bima" id="bima"/><label for="bima">BIMA</label> </td>
<td width="10%"> </td>
<td width="180"> <input type="checkbox" name="mapsi" id="mapsi"/><label for="mapsi">MAPSI <font color='blue'>(recom.)</font></label></td>
</tr>
<tr>
<td width="180"> <input type="checkbox" name="complex" id="complex"/><label for="complex">COMPLEX <font color='blue'>(recom.)</font></label> </td>
<td width="10%"> </td>
<td width="180"> <input type="checkbox" name="mlbda" id="mlbda"/><label for="mlbda">MLBDA</label></td>
</tr>
<tr>
<td width="180"> <input type="checkbox" name="il" id="il" /><label for="il">IL</label> </td>
<td width="10%"> </td>
<td width="180"> <input type="checkbox" name="mogpl" id="mogpl" disabled="true" checked="checked"/><label for="mogpl">MOGPL <font color='red'>(oblig.)</font></label></td>
</tr>
</table>

<?php } else { if ($spe == 'DAC') { ?>

<table>
<tr>
<td width="180"> <input type="checkbox" name="bima" id="bima"/><label for="bima">BIMA</label> </td>
<td width="10%"> </td>
<td width="180"> <input type="checkbox" name="mapsi" id="mapsi"/><label for="mapsi">MAPSI <font color='blue'>(recom.)</font></label></td>
</tr>
<tr>
<td width="180"> <input type="checkbox" name="complex" id="complex"/><label for="complex">COMPLEX</label> </td>
<td width="10%"> </td>
<td width="180"> <input type="checkbox" name="mlbda" id="mlbda" disabled="true" checked="checked"/><label for="mlbda">MLBDA <font color='red'>(oblig.)</font></label></td>
</tr>
<tr>
<td width="180"> <input type="checkbox" name="il" id="il" /><label for="il">IL <font color='blue'>(recom.)</font></label> </td>
<td width="10%"> </td>
<td width="180"> <input type="checkbox" name="model" id="model"/><label for="model">MODEL</label></td>
</tr>
<tr>
<td width="180"> <input type="checkbox" name="lrc" id="lrc" disabled="true" checked="checked"><label for="lrc">LRC <font color='red'>(oblig.)</font></label> </td>
<td width="10%"> </td>
<td width="180"> <input type="checkbox" name="mogpl" id="mogpl"/><label for="mogpl">MOGPL</label></td>
</tr>
</table>

<?php } else { ?>

<table>
<tr>
<td width="180"> <input type="checkbox" name="aagb" id="aagb" disabled="true" checked="checked"/><label for="aagb">AAGB <font color='red'>(oblig.)</font></label> </td>
<td width="10%"> </td>
<td width="180"> <input type="checkbox" name="4m062" id="4m062" disabled="true" checked="checked"/><label for="4m062">4M062 <font color='red'>(oblig.)</font></label></td>
</tr>
<tr>
<td width="180"> <input type="checkbox" name="mapsi" id="mapsi" disabled="true" checked="checked"/><label for="mapsi">MAPSI  <font color='red'>(oblig.)</font></label></td>
<td width="10%"> </td>
<td width="180"> <input type="checkbox" name="bima" id="bima"/><label for="bima">BIMA <font color='blue'>(recom.)</label> </td>
</tr>
<tr>
<td width="180"> <input type="checkbox" name="mogpl" id="mogpl"/><label for="mogpl">MOGPL <font color='blue'>(recom.)</label></td>
<td width="10%"> </td>
<td width="180"> <input type="checkbox" name="lrc" id="lrc"><label for="lrc">LRC <font color='blue'>(recom.)</label> </td>
</tr>
<tr>
<td width="180"> <input type="checkbox" name="complex" id="complex"/><label for="complex">COMPLEX <font color='blue'>(recom.)</label> </td>
<td width="10%"> </td>
<td width="180"> <input type="checkbox" name="algav" id="algav"><label for="algav">ALGAV</label> </td>
</tr>
<tr>
<td width="180"> <input type="checkbox" name="il" id="il" /><label for="il">IL <font color='blue'>(recom.)</font></label> </td>
<td width="10%"> </td>
<td width="180"> <input type="checkbox" name="mlbda" id="mlbda"/><label for="mlbda">MLBDA</font></label></td>
</tr>
</table>

<?php }}} ?>


                    </fieldset>
                </td>

                <td width="25%"> </td>
            </tr>
            <tr>
                <td width="25%"> </td>
                <td>
                    <?php
                        $verif = 'onclick="verif(' . $num . ", '" . $spe . "'" . ')"';
                    ?>
                    <input type="submit" name="submit" value="valider" <?php echo $verif; ?> />
                </td>
                <td width="25%"> </td>
            </tr>
        </table>


    </body>

    <script>

        function verif(num, spe) {
            
            UE = [];
            
            cpt = 0;
            liste = ["aagb","mapsi","algav","mlbda","archi1","mobj","ares","model","bima","mogpl","complex","noyau","dlp","pr","elecana1","rtel","il","signal","lrc","vlsi1"];
           
            if (spe == 'DAC') {
                liste = ["mapsi","mlbda","model","bima","mogpl","complex","il","lrc"];
            }
            else {
                if (spe == 'ANDROIDE') {
                    liste = ["mapsi","mlbda","aagb","bima","mogpl","complex","il","lrc"];
                }
                else {
                    if (spe == 'BIM') {
                        liste = ["4m062","aagb","mapsi","algav","mlbda","bima","mogpl","complex","il","lrc"];
                    }
                }
            }
            
            for (i = 0; i < liste.length; i++) {
                if(document.getElementById(liste[i]).checked) {
                    cpt++;
                    UE.push(liste[i]);
                }
            }
            
            if (cpt < 5) {
                alert('Il n y a que ' + cpt + ' UE choisies. Il en faut 5 en tout.');
            } else {
                if (cpt > 5) {
                    alert('Il y a ' + cpt + ' UE choisies. Il n\'en faut que 5 en tout.');
                } else {
                    
                   str = "";
                    for (i=1; i<6; i++) {
                        str = str + "ue" + i + "=" + UE[i-1];
                        if (i < 5) {
                            str = str + "&";
                        }
                    }
                    document.location.replace("edt.php?"+str);
                }
            }
        }
    </script>


</html>
