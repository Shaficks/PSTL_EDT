
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">



    <head>
        <title>UPMC, Master Informatique : Recherche d'Emploi du Temps M1-S2</title>


<script>
 
  var listeUE = {
				 'dj':['lu14', ['je08','je10'],['ve08','ve10']], 'ihm':['ma16', ['ma08','ma10']], 'rp':['ve14', ['je08','je10'],['ve08','ve10']], 'fosyma':['ve16', ['ma08','ma10'],['me08','me10']],
				 'sbas':['ma08',['lu14','lu16']], 'mmcn':['gi10',['ve08','ve10']], '4v118':['ve14',['ve16','ma10']],
            	 'bi':['lu14',['ve14','ve16']], 'tal':['lu16',['je14','je16'],['je14','je16']], 'bdr':['ma16',['ma08','ma10'],['ve08','ve10']], 'arf':['me16',['me08','me10'],['je08','je10']], 'iamsi':['me14',['me08','me10'],['je14','je16']],
                 'ig3d':['ma16', ['je14','je16']],
                 'rout':['lu08', ['lu14','lu16'], ['je14','je16']], 'mob':['lu10', ['lu14','lu16'], ['ma14','ma16']], 'algores':['ma08', ['je14','je16']], 'progres':['ma10', ['me08','me10']], 'sev':['ve08', ['je08','je10']], 'comnum':['ve10', ['ve14','ve16']],
                 'ar':['lu08', ['lu14','lu16']], 'pnl':['lu10', ['je14','je16']], 'specif':['me08', ['ma08','ma10']], 'srcs':['me10',['je14','je16'], ['ve14','ve16']], 'sas':['je10', ['lu14','lu16'], ['ma08','ma10']],
                 'fpga1':['ma16',['lu08','lu10'],['ma08','ma10']], 'anumdsp':['ma10',['je14','je16']], 'archi2':['me10',['ve14','ve16']], 'peri':['je08',['je14','je16'],['ve08','ve10']], 'elecana2':['je10',['lu14','lu16']],
				 'hpc':['ve10', ['ma08','ma10']], 'isec':['je16',['ma16','je14']], 'flag':['ve08',['me08','me10']], 'rna':['ve00',['ma18', 'je18']],
                 'aps':['me16',['ve08','ve10']], 'ca':['ma10',['je14','je16']], 'cpa':['je08',['me08','me10'],['me08','me10']], 'cps':['me14',['je14','je16'],['ve14','ve16']], 'pc2r':['je10',['lu14', 'lu16'],['lu14', 'lu16'],['ve08','ve10']],
                 'sup1x':['lu00', ['lu02', 'lu04']], 'sup2x':['ma00', ['ma02', 'ma04']], 'sup3x':['me00', ['me02', 'me04']], 'sup4x':['je00', ['je02', 'je04']]};
  var liste = ['dj', 'ihm', 'rp', 'fosyma', 'sbas', 'mmcn', '4v118', 'bi', 'tal', 'bdr', 'arf', 'iamsi', 'ig3d', 'rout', 'mob', 'algores', 'progres', 'sev', 'comnum',
      'ar', 'pnl', 'specif', 'srcs', 'sas', 'fpga1', 'anumdsp', 'archi2', 'peri', 'elecana2', 'hpc', 'isec', 'flag', 'rna', 'aps', 'ca', 'cpa', 'cps', 'pc2r'];
  
  var sep1 = ['dj', 'sbas', 'bi', 'ig3d', 'rout', 'ar', 'fpga1', 'hpc', 'aps'];
  var sep2 = ['fosyma', '4v118', 'iamsi', 'ig3d', 'comnum', 'sas', 'elecana2', 'rna', 'pc2r'];
  var spe = ['ANDROIDE', 'BIM', 'DAC', 'IMA', 'RES', 'SAR', 'SESI', 'SFPN', 'STL'];
  var UE = { 'ANDROIDE':['dj', 'ihm', 'rp', 'fosyma'], 'BIM':['sbas', 'mmcn', '4v118'], 'DAC':['bi', 'tal', 'bdr', 'arf', 'iamsi'], 
               'IMA':['ig3d'], 'RES':['rout', 'mob', 'algores', 'progres', 'sev', 'comnum'], 'SAR':['ar', 'pnl', 'specif', 'srcs', 'sas'], 'SESI':['fpga1', 'anumdsp', 'archi2', 'peri', 'elecana2'],
               'SFPN':['hpc', 'isec', 'flag', 'rna'], 'STL':['aps', 'ca', 'cpa', 'cps', 'pc2r']}
 
</script>


    </head>

    <body>

        <h1>
            UPMC : Master Informatique
        </h1>

<fieldset><legend>Sp&eacute;cialit&eacute; : </legend>
                        <select name="spe" id="spe">
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
                        
                        <input id="remplir" type="button" value="Valider" onclick="indispos(); suivre(); interdits();" />

                    </fieldset>

<fieldset><legend>        <h3>
            Groupes de TD indisponibles :
        </h3> </legend>

<div id='indispo'></div>

<script>
 function indispos(){

 
 	var doc = "";
 	
	
 	for (i=0; i<liste.length; i++) {

 	  if (sep1.indexOf(liste[i]) != -1) {
 	    doc = doc.concat(" <fieldset> <table> <tr> ");
 	    doc = doc.concat(spe[sep1.indexOf(liste[i])]);
 	    doc = doc.concat(" </tr> ");
 	  }
 	  doc = doc.concat("<tr>");
 	  for (j=0; j<listeUE[liste[i]].length-1; j++) {
   	    doc = doc.concat("<td width='180'> <input type='checkbox' name='");
 	    doc = doc.concat(liste[i]);
 	    doc = doc.concat("-");
 	    doc = doc.concat(j+1);
 	    doc = doc.concat("' id='");
 	    doc = doc.concat(liste[i]);
 	    doc = doc.concat("-");
 	    doc = doc.concat(j+1);
 	    doc = doc.concat("'");
 	    if ((liste[i]==='rout' && j===0) || (liste[i]==='mob' && j===1)) {
 	      doc = doc.concat(" checked='checked' ");
 	    }
 	    doc = doc.concat("/><label for='");
 	    doc = doc.concat(liste[i]);
 	    doc = doc.concat("-");
 	    doc = doc.concat(j+1);
 	    doc = doc.concat("'/>");
 	    doc = doc.concat(liste[i].toUpperCase());
 	    doc = doc.concat("-");
 	    doc = doc.concat(j+1);
 	    doc = doc.concat(" </label> </td><td width='2%'> </td>");
 	  }
 	  doc = doc.concat("</tr> ");
 	  if (sep2.indexOf(liste[i]) != -1) {
 	    doc = doc.concat("</table> </fieldset>");
 	  }
    }

    document.getElementById("indispo").innerHTML = doc; 
 	
 }
</script>


</fieldset>


<table><tr><td>

<fieldset><legend>
        <h3>
            UE &agrave; suivre :
        </h3></legend>

<div id='asuivre'></div>

<script>
 function suivre(){
 
 	var doc = "<table>";
 	
 	for (i=0; i<liste.length; i++) {
 	  doc = doc.concat("<tr><td width='180'> <input type='checkbox' name='");
 	  doc = doc.concat(liste[i]);
 	  doc = doc.concat("' id='");
 	  doc = doc.concat(liste[i]);
 	  doc = doc.concat("'/><label for='");
 	  doc = doc.concat(liste[i]);
 	  doc = doc.concat("'>");
 	  doc = doc.concat(liste[i].toUpperCase());
 	  doc = doc.concat("</label> </td></tr> ");
    }

    doc = doc.concat("<tr><td> <input type='hidden' name='sup1x' id='sup1x'/></td><td> <input type='hidden' name='sup2x' id='sup2x'/></td><td> <input type='hidden' name='sup3x' id='sup3x'/></td><td> <input type='hidden' name='sup4x' id='sup4x'/></td></tr></table>");
    document.getElementById("asuivre").innerHTML = doc; 
 	
 }
</script>


</fieldset>
</td>

<td>
<fieldset><legend>
        <h3>
            UE interdites :
        </h3></legend>


<div id='interdit'></div>

<script>
 function interdits(){

 
 	var doc = "<table>";
 	
 	for (i=0; i<liste.length; i++) {
 	  doc = doc.concat("<tr><td width='180'> <input type='checkbox' name='X");
 	  doc = doc.concat(liste[i]);
 	  doc = doc.concat("' id='X");
 	  doc = doc.concat(liste[i]);
 	  doc = doc.concat("'");
	  if (UE[document.getElementById("spe").value].indexOf(liste[i]) === -1) {
 	    doc = doc.concat(" checked='checked' ");
 	  }
 	  doc = doc.concat("/><label for='X");
 	  doc = doc.concat(liste[i]);
 	  doc = doc.concat("'>");
 	  doc = doc.concat(liste[i].toUpperCase());
 	  doc = doc.concat("</label> </td></tr> ");
    }

    doc = doc.concat("<tr><td> <input type='hidden' name='Xsup1x' id='Xsup1x'/></td><td> <input type='hidden' name='Xsup2x' id='Xsup2x'/></td><td> <input type='hidden' name='Xsup3x' id='Xsup3x'/></td><td> <input type='hidden' name='Xsup4x' id='Xsup4x'/></td></tr></table>");
    document.getElementById("interdit").innerHTML = doc; 
 	
 }
</script>


</fieldset>

</td>

<td>
<fieldset><legend><h3>            Nombre d'UE &agrave; suivre :        </h3></legend>
             <select name="nb" id="nb">
                <option value=5>5</option>
                <option value=4 selected>4</option>
                <option value=3>3</option>
                <option value=2>2</option>
                <option value=1>1</option>
              </select>
</fieldset>

</td></tr>

</table>



<hr>

<input id="Recherche" type="button" value="Recherche" onclick="prep();" />

<hr>


<div id='ues'></div>

<hr>


<div id='edt'></div>

<hr>


<script language=JavaScript>
        



 function test(ue) {

    
	for (i=0; i<liste.length; i++) {
		for (j=1; j<listeUE[liste[i]].length; j++) {
			if (document.getElementById(liste[i] + "-" + j.toString()).checked) {
				listeUE[liste[i]][j] = [];

			}
		}
	}
	
  
    var l = [];
    
    var choix = ue.split(',');
   // alert(choix);
    
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
  //         alert(choix_poids);
 
   
    var listeEDT = [];
    var EDT = [];
    var ue1 = 0;var ue2 = 0;var ue3 = 0;var ue4 = 0;var ue5 = 0;
    

    for (ue1 = 1; ue1 < choix_poids[0][0]; ue1++) {

        EDT = [ listeUE[choix_poids[0][1]] [0] ];
        for (i=1; i<5; i++) {
            if (EDT.indexOf(listeUE[choix_poids[i][1]][0]) == -1) {
                EDT.push(listeUE[choix_poids[i][1]][0]);
            }
        }
     // on introduit l'anglais
  		if (['ANDROIDE', 'IMA', 'DAC', 'STL'].indexOf(document.getElementById("spe").value) != -1) {
  		  if (EDT.indexOf('lu08') == -1) {
  	        EDT.push('lu08');
  	      }
  	      if (EDT.indexOf('lu10') == -1) {
  	        EDT.push('lu10');
  	      }
        }
  	    else {
  	      if (EDT.indexOf('me14') == -1) {
            EDT.push('me14');
          }
          if (EDT.indexOf('me16') == -1) {
  	        EDT.push('me16');
  	      }
  	    }  
  	// et la conf IP
  	    if (EDT.indexOf('ma14') == -1) {
  	      EDT.push('ma14') ;
  	    }
  	        

        if (EDT.length != 5+2+1) {   //+2 anglais +1IP
        	return false;
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

            			return true;            
            
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
   
	return false;

   
}
 
 
        
 function prep() {
 
 
 		// test meme UE à suivre et interdite
 		    var interdit = "X";
 		    for (i=0; i<liste.length; i++) {
                if(document.getElementById(liste[i]).checked && document.getElementById(interdit.concat(liste[i])).checked) {
                    alert("La même UE est sélectionnée 'à suivre' et 'interdite'");
                    return -1;
                }
            }
          
            UE = [];
            
    		var l = ['sup1x', 'sup2x', 'sup3x', 'sup4x'];
	
			interdit = "X";
			for (i=0; i<liste.length; i++) {
                if(document.getElementById(interdit.concat(liste[i])).checked != true) {
                    l.push(liste[i]);
                }
            }
  //       	alert(l);
         	
         	var liste2 = l;

           
            for (i=0; i<liste2.length; i++) {
                if(document.getElementById(liste2[i]).checked) {
                    UE.push(liste2[i]);
                }
            }
    //     	alert(UE);
         	
         	nb = document.getElementById("nb").value;
         	for (i=0; i<5-nb; i++) {
         		UE.push(liste2[i]);
         	}
   //      	alert(UE);
         	
         	l1 = [];
         	for (i=0; i<liste2.length; i++) {
                if (UE.indexOf(liste2[i]) == -1 & liste2[i].slice(0,3) != "sup") {
                    l1.push(liste2[i]);
                }
            }

 
            ue = [];
            afficheUES = "";
            
            if (UE.length == 0) {
            	for (ue1=0; ue1<l1.length-4; ue1++) {
            		l2 = l1.slice(ue1+1);
            		for (ue2=0; ue2<l2.length-3; ue2++) {
            			l3 = l2.slice(ue2+1);
            			for (ue3=0; ue3<l3.length-2; ue3++) {
            				l4 = l3.slice(ue3+1);
            				for (ue4=0; ue4<l4.length-1; ue4++) {
            					l5 = l4.slice(ue4+1);
            					for (ue5=0; ue5<l5.length; ue5++) {
            						ue = [l1[ue1],l2[ue2],l3[ue3],l4[ue4],l5[ue5]];
                                    uestr = "";
                                    for (i=0; i<5; i++) {
                                        uestr = uestr + "," + ue[i];
                                    }
                                    uestr = uestr.slice(1, uestr.length);
                                    if (test(uestr)) {
                                        ueSTR = "";
                                        for (i=0; i<5; i++) {
                                            if (ue[i].slice(0,3) != "sup") {
                                                ueSTR = ueSTR + "," + ue[i].toUpperCase();
                                            }
                                        }
                                        ueSTR = ueSTR.slice(1, ueSTR.length);
                                        afficheUES = afficheUES + '<input id="' + ueSTR + '" type="button" value="' + ueSTR + '" onclick=\"edt(\'' + ue +  '\');\" /><br>';
                                    }
                                }
            				}
            			}
            		}
            	}
            }
            if (UE.length == 1) {
            	for (ue1=0; ue1<l1.length-3; ue1++) {
            		l2 = l1.slice(ue1+1);
            		for (ue2=0; ue2<l2.length-2; ue2++) {
            			l3 = l2.slice(ue2+1);
            			for (ue3=0; ue3<l3.length-1; ue3++) {
            				l4 = l3.slice(ue3+1);
            				for (ue4=0; ue4<l4.length; ue4++) {
           						ue = [l1[ue1],l2[ue2],l3[ue3],l4[ue4]];
           						ue = ue.concat(UE);
                                uestr = "";
                                for (i=0; i<5; i++) {
                                    uestr = uestr + "," + ue[i];
                                }
                                uestr = uestr.slice(1, uestr.length);
                                if (test(uestr)) {
                                    ueSTR = "";
                                    for (i=0; i<5; i++) {
                                        if (ue[i].slice(0,3) != "sup") {
                                            ueSTR = ueSTR + "," + ue[i].toUpperCase();
                                        }
                                    }
                                    ueSTR = ueSTR.slice(1, ueSTR.length);
                                    afficheUES = afficheUES + '<input id="' + ueSTR + '" type="button" value="' + ueSTR + '" onclick=\"edt(\'' + ue +  '\');\" /><br>';
                                }
                            }
            			}
            		}
            	}
            }
            if (UE.length == 2) {
            	for (ue1=0; ue1<l1.length-2; ue1++) {
            		l2 = l1.slice(ue1+1);
            		for (ue2=0; ue2<l2.length-1; ue2++) {
            			l3 = l2.slice(ue2+1);
            			for (ue3=0; ue3<l3.length; ue3++) {
            				ue = [l1[ue1],l2[ue2],l3[ue3]];
           					ue = ue.concat(UE);
                            uestr = "";
                            for (i=0; i<5; i++) {
                                uestr = uestr + "," + ue[i];
                            }
                            uestr = uestr.slice(1, uestr.length);
                            if (test(uestr)) {
                                ueSTR = "";
                                for (i=0; i<5; i++) {
                                    if (ue[i].slice(0,3) != "sup") {
                                        ueSTR = ueSTR + "," + ue[i].toUpperCase();
                                    }
                                }
                                ueSTR = ueSTR.slice(1, ueSTR.length);
                                afficheUES = afficheUES + '<input id="' + ueSTR + '" type="button" value="' + ueSTR + '" onclick=\"edt(\'' + ue +  '\');\" /><br>';
                            }
                        }
            		}
            	}
            }
            if (UE.length == 3) {
            	for (ue1=0; ue1<l1.length-1; ue1++) {
            		l2 = l1.slice(ue1+1);
            		for (ue2=0; ue2<l2.length; ue2++) {
            			ue = [l1[ue1],l2[ue2]];
       					ue = ue.concat(UE);
       					uestr = "";
       					for (i=0; i<5; i++) {
            				uestr = uestr + "," + ue[i];
	            		}
	            		uestr = uestr.slice(1, uestr.length);
       					if (test(uestr)) {
            				ueSTR = "";
            				for (i=0; i<5; i++) {
            					if (ue[i].slice(0,3) != "sup") {
	            				ueSTR = ueSTR + "," + ue[i].toUpperCase();
	            				}
	            			}
            				ueSTR = ueSTR.slice(1, ueSTR.length);
            				afficheUES = afficheUES + '<input id="' + ueSTR + '" type="button" value="' + ueSTR + '" onclick=\"edt(\'' + ue +  '\');\" /><br>';
            			}
            		}
            	}
            }
            if (UE.length == 4) {
            	for (ue1=0; ue1<l1.length; ue1++) {
            		ue = [l1[ue1]];
       				ue = ue.concat(UE);
                    uestr = "";
                    for (i=0; i<5; i++) {
                        uestr = uestr + "," + ue[i];
                    }
                    uestr = uestr.slice(1, uestr.length);
                    if (test(uestr)) {
                        ueSTR = "";
                        for (i=0; i<5; i++) {
                            if (ue[i].slice(0,3) != "sup") {
                                ueSTR = ueSTR + "," + ue[i].toUpperCase();
                            }
                        }
                        ueSTR = ueSTR.slice(1, ueSTR.length);
                        afficheUES = afficheUES + '<input id="' + ueSTR + '" type="button" value="' + ueSTR + '" onclick=\"edt(\'' + ue +  '\');\" /><br>';
                    }
                }
            }
            if (UE.length == 5) {
            	ue = UE;
            	ueSTR = "";
            	for (i=0; i<5; i++) {
            		if (ue[i].slice(0,3) != "sup") {
	            		ueSTR = ueSTR + ", " + ue[i].toUpperCase();
	            	}
            	}
            	ueSTR = ueSTR.slice(2, ueSTR.length);
            	afficheUES = afficheUES + '<input id="' + ueSTR + '" type="button" value="' + ueSTR + '" onclick=\"edt(\'' + ue +  '\');\" /><br>';
            }
     
			document.getElementById("ues").innerHTML = afficheUES;         
		
			if(afficheUES=="") {
				alert('Il n\'y a aucun emploi du temps possible');
			}
           
}
        
 
 
function edt(ue) {
         
 
	for (i=0; i<liste.length; i++) {
		for (j=1; j<listeUE[liste[i]].length; j++) {
			if (document.getElementById(liste[i] + "-" + j.toString()).checked) {
				listeUE[liste[i]][j] = [];
			}
		}
	}
  
    var l = [];
    
    var choix = ue.split(',');
 //   alert(choix);
    
    var choix_poids = [[],[],[],[],[]];
    var i = 0;
    for (i = 0; i < 5; i++)  {
        choix_poids[i] = [listeUE[choix[i]].length, choix[i]];
    }
 //          alert(choix_poids);
    
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
  //         alert(choix_poids);
 
  
    var listeEDT = [];
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

                        listeEDT.push([1, l]);
                        
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
    


    doc = "<br></br><table><tr><td width='20'></td><td width='300'> ";
    doc = doc.concat(ue.toUpperCase());
    doc = doc.concat("<br><br> Il y a ");
    doc = doc.concat(listeEDT.length.toString());
    doc = doc.concat(" emplois du temps.</td><td width='20'></td></tr></table><br></br>");
    
    var asso = {};
    var r = 0;
    var l = [];
    var ll = 0;
    
    doc = doc.concat("<br></br><table>");
    if (listeEDT.length > 0) {

        
        for (i=0; i<listeEDT.length; i++) {
            
            doc = doc.concat("<tr><td width='20'></td> <td width='500'>");
            
            asso = {};
            for (r=0; r<5; r++) {
                asso[listeUE[ listeEDT[i][1] [r][0] ][0]] = listeEDT[i][1] [r][0].toUpperCase();
                asso[listeUE[ listeEDT[i][1] [r][0] ][listeEDT[i][1] [r][1]] [0]] = listeEDT[i][1] [r][0].toUpperCase() + "-" + listeEDT[i][1] [r][1];
                asso[listeUE[ listeEDT[i][1] [r][0] ][listeEDT[i][1] [r][1]] [1]] = listeEDT[i][1] [r][0].toUpperCase() + "-" + listeEDT[i][1] [r][1];
            }
 

            doc = doc.concat("<table border='1'><tr> <th></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");
         
            doc = doc.concat("<tr> <th>8:30 - 10:30</th>");
            txt = "";
            l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            doc = doc.concat(txt);
            
            doc = doc.concat("</tr><tr> <th>10:45 - 12:45</th>");
            txt = "";
            l = ['lu10', 'ma10', 'me10', 'je10', 've10'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            doc = doc.concat(txt);
            
            doc = doc.concat("</tr><tr> <th>13:45 - 15:45</th>");
            txt = "";
            l = ['lu14', 'ma14', 'me14', 'je14', 've14'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            doc = doc.concat(txt);
            
            doc = doc.concat("</tr><tr> <th>16:00 - 18:00</th>");
            txt = "";
            l = ['lu16', 'ma16', 'me16', 'je16', 've16'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            doc = doc.concat(txt);
            
            doc = doc.concat("</tr><tr> <th>18:15 - 20:15</th>");
            txt = "";
            l = ['lu18', 'ma18', 'me18', 'je18', 've18'];
            for (ll=0; ll<l.length; ll++) {
                txt = txt + "<td align=center>";
                if (asso[l[ll]] != undefined) {
                    txt = txt + asso[l[ll]];
                }
                txt = txt + "</td>";
            }
            doc = doc.concat(txt);

            
            doc = doc.concat("</tr></table></td></tr>");
        }
 
    } 
    doc = doc.concat("</table>");
    
    document.getElementById("edt").innerHTML = doc; 


}



    </script>

    </body>


</html>
