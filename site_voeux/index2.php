
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
        <title>UPMC, Master Informatique : Saisie des voeux d'UE</title>

	</head>

   <body>

        <script>
            alert('<?php echo $_GET['mess']; ?>');
        </script>

        <h1>
            UPMC : Master Informatique
        </h1>

        <h3>
            Site de saisie des voeux d'emploi du temps
        </h3>


        <form method="get" action="connect.php">
        <table>
            <tr>
                <td width='300'>
                    <?php
                        if ($_GET['num']) {
                            echo "<fieldset><legend>Num&eacute;ro de dossier : </legend><input type='text' id='num' name='num' value='".$_GET['num']."'/></fieldset>";
                        }
                        else {
                            echo "<fieldset><legend>Num&eacute;ro de dossier : </legend><input type='text' id='num' name='num'/></fieldset>";
                        }
                    ?>
Si le num&eacute;ro n'est pas connu, les donn&eacute;es ne seront pas enregistr&eacute;es.
                </td>
                <td width='300'>
                    <?php
                        if ($_GET['num2']) {
                            echo "<fieldset><legend>Confirmation du num&eacute;ro de dossier : </legend><input type='text' id='num2' name='num2' value='".$_GET['num2']."'/></fieldset>";
                        }
                        else {
                            echo "<fieldset><legend>Confirmation du num&eacute;ro de dossier : </legend><input type='text' id='num2' name='num2'/></fieldset>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                        if ($_GET['nom']) {
                            echo "<fieldset><legend>Nom : </legend><input type='text' id='nom' name='nom' value='".$_GET['nom']."'/></fieldset>";
                        }
                        else {
                            echo "<fieldset><legend>Nom : </legend><input type='text' id='nom' name='nom'/></fieldset>";
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($_GET['prenom']) {
                            echo "<fieldset><legend>Pr&eacute;nom : </legend><input type='text' id='prenom' name='prenom' value='".$_GET['prenom']."'/></fieldset>";
                        }
                        else {
                            echo "<fieldset><legend>Pr&eacutenom : </legend><input type='text' id='prenom' name='prenom'/></fieldset>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                        if ($_GET['mail']) {
                            echo "<fieldset><legend>Adresse email : </legend><input type='text' name='mail' value='".$_GET['mail']."'/></fieldset>";
                        }
                        else {
                            echo "<fieldset><legend>Adresse email : </legend><input type='text' name='mail'/></fieldset>";
                        }
                    ?>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <fieldset><legend>Sp&eacutecialit&eacute : </legend>
                        <select name="spe">
                            <option value='ANDROIDE' <?php if ($_GET['spe']=='ANDROIDE') { echo "selected='selected'";} ?> >ANDROIDE</option>
                            <option value='BIM' <?php if ($_GET['spe']=='BIM') { echo "selected='selected'";} ?> >BIM</option>
                            <option value='DAC' <?php if ($_GET['spe']=='DAC') { echo "selected='selected'";} ?> >DAC</option>
                            <option value='IMA' <?php if ($_GET['spe']=='IMA') { echo "selected='selected'";} ?> >IMA</option>
                            <option value='RES' <?php if ($_GET['spe']=='RES') { echo "selected='selected'";} ?> >RES</option>
                            <option value='SAR' <?php if ($_GET['spe']=='SAR') { echo "selected='selected'";} ?> >SAR</option>
                            <option value='SESI' <?php if ($_GET['spe']=='SESI') { echo "selected='selected'";} ?> >SESI</option>
                            <option value='SFPN' <?php if ($_GET['spe']=='SFPN') { echo "selected='selected'";} ?> >SFPN</option>
                            <option value='STL' <?php if ($_GET['spe']=='STL') { echo "selected='selected'";} ?> >STL</option>
                        </select>
                    </fieldset>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit" value="connexion"/>
                </td>
                <td></td>
            </tr>
        </table>
        </form>

<script>
function special_chars() {
    var num = document.getElementById("num");
    num.value = num.value.replace(/[^0-9]/g,'');
    num = document.getElementById("num2");
    num.value = num.value.replace(/[^0-9]/g,'');
    var nom = document.getElementById("nom");
    nom.value = nom.value.replace(/[^a-zA-Z0-9]/g,'_');
    nom = document.getElementById("prenom");
    nom.value = nom.value.replace(/[^a-zA-Z0-9]/g,'_');
}
</script>

    </body>
</html>
