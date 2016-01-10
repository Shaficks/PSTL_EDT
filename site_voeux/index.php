

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
            Site de saisie des voeux d'emploi du temps
        </h3>


        <form method="get" onsubmit="special_chars()" action="connect.php">
        <table>
            <tr>
                <td width='300'>
                    <fieldset><legend>Num&eacute;ro de dossier : </legend><input type="text" id="num" name="num"/></fieldset>
Si le num&eacute;ro n'est pas connu, les donn&eacute;es ne seront pas enregistr&eacute;es.
                </td>
                <td width='300'>
                    <fieldset><legend>Confirmation du num&eacute;ro de dossier : </legend><input type="text" id="num2" name="num2"/></fieldset>
                </td>
            </tr>
            <tr>
                <td>
                    <fieldset><legend>Nom : </legend><input type="text" id="nom" name="nom"/></fieldset>
                </td>
                <td>
                    <fieldset><legend>Pr&eacute;nom : </legend><input type="text" id="prenom" name="prenom"/></fieldset>
                </td>
            </tr>
            <tr>
                <td>
                    <fieldset><legend>Adresse email : </legend><input type="text" id="mail" name="mail"/></fieldset>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <fieldset><legend>Sp&eacute;cialit&eacute; : </legend>
                        <select name="spe">
                            <option value='ANDROIDE'>ANDROIDE</option>
                            <option value='BIM'>BIM</option>
                            <option value='DAC'>DAC</option>
                            <option value='IMA'>IMA</option>
                            <option value='RES'>RES</option>
                            <option value='SAR'>SAR</option>
                            <option value='SESI'>SESI</option>
                            <option value='SFPN'>SFPN</option>
                            <option value='STL'>STL</option>
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
