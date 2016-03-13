function old_print_edt(listeEDT1,listeEDT2,listeEDT3,listeUE){
//Affichage du message concernant le nombre d'emlpois trouvés pour chaque couleur
                document.write("<br></br><table><tr><td width='20'></td><td width='300'><font color='green'> Il y a " + listeEDT1.length + " emplois du temps de classe 1.</font></td><td width='20'></td>");
                document.write("<td width='300'><font color='orange'> Il y a " + listeEDT2.length + " emplois du temps de classe 2.</font></td><td  width='20'></td>");
                document.write("<td width='300'><font color='red'>  Il y a " + listeEDT3.length + " emplois du temps de classe 3.</font></td>");
                document.write("</tr></table><br></br>");

                //Tri décroissant des listes des EDT en se basant sur la valeur s
                tri(listeEDT1, 0, listeEDT1.length - 1);
                tri(listeEDT2, 0, listeEDT2.length - 1);
                tri(listeEDT3, 0, listeEDT3.length - 1);

                //Affichage du bouton de modification d'UEs au cas où l'étudiant change d'avis
                document.write("<table><tr><td width='60'></td><td> Modifier les 5 UE <br> <input type='submit' name='modif' value='modifier' onclick='retour()'/></td>");
                //Si le nombre d'EDTs n'est pas nul, afficher le bouton Valider
                if (listeEDT1.length + listeEDT2.length + listeEDT3.length > 0) {
                    document.write("<form method='get' action='soumission.php'>");
                    document.write("<td width='60'></td><td> Valider l'emploi du temps coch&eacute; <br> <input type='submit' name='submit' value='valider'/></td><table><tr><td width='60'></td></tr></table>");


                    var asso = {};
                    var r = 0;
                    var l = [];
                    var ll = 0;

                    document.write("<br></br><table>");
                    if (listeEDT1.length > 0) {

                        i = 0;
                        //Ajout du premier tableau qui sera coché par défaut
                        document.write("<tr><td width='20'><input type='radio' name='edt' value=" + listeEDT1[i][1] + " checked='checked'/></td><td width='500'>");

                        /****Traitement des horaires !!!!!!!!!!!!!!!!!!!!!!!!!****/

                        asso = {};
                        //Récupération du cours, td et tme de chaque UE dans la variable asso 
                        //C'est des associations de type horaire=>ue (exemple : ma14 => algav-1)
                        for (r = 0; r < 5; r++) {
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
                        for (ll = 0; ll < l.length; ll++) {
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
                        for (ll = 0; ll < l.length; ll++) {
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
                        for (ll = 0; ll < l.length; ll++) {
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
                        for (ll = 0; ll < l.length; ll++) {
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
                        for (i = 1; i < listeEDT1.length; i++) {

                            document.write("<tr><td width='20'><input type='radio' name='edt' value=" + listeEDT1[i][1] + " /></td><td width='500'>");

                            asso = {};
                            for (r = 0; r < 5; r++) {
                                asso[listeUE[ listeEDT1[i][1] [r][0] ][0]] = listeEDT1[i][1] [r][0].toUpperCase();
                                asso[listeUE[ listeEDT1[i][1] [r][0] ][listeEDT1[i][1] [r][1]] [0]] = listeEDT1[i][1] [r][0].toUpperCase() + "-" + listeEDT1[i][1] [r][1];
                                asso[listeUE[ listeEDT1[i][1] [r][0] ][listeEDT1[i][1] [r][1]] [1]] = listeEDT1[i][1] [r][0].toUpperCase() + "-" + listeEDT1[i][1] [r][1];
                            }

                            document.write("<table border='1' bordercolor='green'>");
                            document.write("<tr> <th bgcolor='green'></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");

                            document.write("<tr> <th>8:30 - 10:30</th>");
                            txt = "";
                            l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
                            for (ll = 0; ll < l.length; ll++) {
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
                            for (ll = 0; ll < l.length; ll++) {
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
                            for (ll = 0; ll < l.length; ll++) {
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
                            for (ll = 0; ll < l.length; ll++) {
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
                        for (i = 0; i < listeEDT2.length; i++) {

                            document.write("<tr><td width='20'><input type='radio' name='edt' value=" + listeEDT2[i][1] + " /></td><td width='500'>");

                            asso = {};
                            for (r = 0; r < 5; r++) {
                                asso[listeUE[ listeEDT2[i][1] [r][0] ][0]] = listeEDT2[i][1] [r][0].toUpperCase();
                                asso[listeUE[ listeEDT2[i][1] [r][0] ][listeEDT2[i][1] [r][1]] [0]] = listeEDT2[i][1] [r][0].toUpperCase() + "-" + listeEDT2[i][1] [r][1];
                                asso[listeUE[ listeEDT2[i][1] [r][0] ][listeEDT2[i][1] [r][1]] [1]] = listeEDT2[i][1] [r][0].toUpperCase() + "-" + listeEDT2[i][1] [r][1];
                            }

                            document.write("<table border='1' bordercolor='orange'>");
                            document.write("<tr> <th bgcolor='orange'></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");

                            document.write("<tr> <th>8:30 - 10:30</th>");
                            txt = "";
                            l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
                            for (ll = 0; ll < l.length; ll++) {
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
                            for (ll = 0; ll < l.length; ll++) {
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
                            for (ll = 0; ll < l.length; ll++) {
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
                            for (ll = 0; ll < l.length; ll++) {
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
                        for (i = 0; i < listeEDT3.length; i++) {

                            document.write("<tr><td width='20'><input type='radio' name='edt' value=" + listeEDT3[i][1] + " /></td><td width='500'>");

                            asso = {};
                            for (r = 0; r < 5; r++) {
                                asso[listeUE[ listeEDT3[i][1] [r][0] ][0]] = listeEDT3[i][1] [r][0].toUpperCase();
                                asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [0]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
                                asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [1]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
                            }

                            document.write("<table border='1' bordercolor='red'>");
                            document.write("<tr> <th bgcolor='red'></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");

                            document.write("<tr> <th>8:30 - 10:30</th>");
                            txt = "";
                            l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
                            for (ll = 0; ll < l.length; ll++) {
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
                            for (ll = 0; ll < l.length; ll++) {
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
                            for (ll = 0; ll < l.length; ll++) {
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
                            for (ll = 0; ll < l.length; ll++) {
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

                            i = 0;
                            document.write("<tr><td width='20'><input type='radio' name='edt' value=" + listeEDT2[i][1] + " checked='checked'/></td><td width='500'>");

                            asso = {};
                            for (r = 0; r < 5; r++) {
                                asso[listeUE[ listeEDT2[i][1] [r][0] ][0]] = listeEDT2[i][1] [r][0].toUpperCase();
                                asso[listeUE[ listeEDT2[i][1] [r][0] ][listeEDT2[i][1] [r][1]] [0]] = listeEDT2[i][1] [r][0].toUpperCase() + "-" + listeEDT2[i][1] [r][1];
                                asso[listeUE[ listeEDT2[i][1] [r][0] ][listeEDT2[i][1] [r][1]] [1]] = listeEDT2[i][1] [r][0].toUpperCase() + "-" + listeEDT2[i][1] [r][1];
                            }

                            document.write("<table border='1' bordercolor='orange'>");
                            document.write("<tr> <th  bgcolor='orange'></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");

                            document.write("<tr> <th>8:30 - 10:30</th>");
                            txt = "";
                            l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
                            for (ll = 0; ll < l.length; ll++) {
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
                            for (ll = 0; ll < l.length; ll++) {
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
                            for (ll = 0; ll < l.length; ll++) {
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
                            for (ll = 0; ll < l.length; ll++) {
                                txt = txt + "<td align=center>";
                                if (asso[l[ll]] != undefined) {
                                    txt = txt + asso[l[ll]];
                                }
                                txt = txt + "</td>";
                            }
                            document.write(txt + "</tr>");
                            document.write("</table>");
                            document.write("</td><td width='20'></td></tr>");


                            for (i = 1; i < listeEDT2.length; i++) {


                                document.write("<tr><td width='20'><input type='radio' name='edt' value=" + listeEDT2[i][1] + " /></td><td width='500'>");

                                asso = {};
                                for (r = 0; r < 5; r++) {
                                    asso[listeUE[ listeEDT2[i][1] [r][0] ][0]] = listeEDT2[i][1] [r][0].toUpperCase();
                                    asso[listeUE[ listeEDT2[i][1] [r][0] ][listeEDT2[i][1] [r][1]] [0]] = listeEDT2[i][1] [r][0].toUpperCase() + "-" + listeEDT2[i][1] [r][1];
                                    asso[listeUE[ listeEDT2[i][1] [r][0] ][listeEDT2[i][1] [r][1]] [1]] = listeEDT2[i][1] [r][0].toUpperCase() + "-" + listeEDT2[i][1] [r][1];
                                }

                                document.write("<table border='1' bordercolor='orange'>");
                                document.write("<tr> <th  bgcolor='orange'></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");

                                document.write("<tr> <th>8:30 - 10:30</th>");
                                txt = "";
                                l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
                                for (ll = 0; ll < l.length; ll++) {
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
                                for (ll = 0; ll < l.length; ll++) {
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
                                for (ll = 0; ll < l.length; ll++) {
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
                                for (ll = 0; ll < l.length; ll++) {
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
                            for (i = 0; i < listeEDT3.length; i++) {

                                document.write("<tr><td width='20'><input type='radio' name='edt' value=" + listeEDT3[i][1] + " /></td><td width='500'>");

                                asso = {};
                                for (r = 0; r < 5; r++) {
                                    asso[listeUE[ listeEDT3[i][1] [r][0] ][0]] = listeEDT3[i][1] [r][0].toUpperCase();
                                    asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [0]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
                                    asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [1]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
                                }

                                document.write("<table border='1' bordercolor='red'>");
                                document.write("<tr> <th  bgcolor='red'></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");

                                document.write("<tr> <th>8:30 - 10:30</th>");
                                txt = "";
                                l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
                                for (ll = 0; ll < l.length; ll++) {
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
                                for (ll = 0; ll < l.length; ll++) {
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
                                for (ll = 0; ll < l.length; ll++) {
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
                                for (ll = 0; ll < l.length; ll++) {
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

                                i = 0;
                                document.write("<tr><td width='20'><input type='radio' name='edt' value=" + listeEDT3[i][1] + " checked='checked'/></td><td width='500'>");

                                asso = {};
                                for (r = 0; r < 5; r++) {
                                    asso[listeUE[ listeEDT3[i][1] [r][0] ][0]] = listeEDT3[i][1] [r][0].toUpperCase();
                                    asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [0]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
                                    asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [1]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
                                }

                                document.write("<table border='1' bordercolor='red'>");
                                document.write("<tr> <th bgcolor='red'></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");

                                document.write("<tr> <th>8:30 - 10:30</th>");
                                txt = "";
                                l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
                                for (ll = 0; ll < l.length; ll++) {
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
                                for (ll = 0; ll < l.length; ll++) {
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
                                for (ll = 0; ll < l.length; ll++) {
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
                                for (ll = 0; ll < l.length; ll++) {
                                    txt = txt + "<td align=center>";
                                    if (asso[l[ll]] != undefined) {
                                        txt = txt + asso[l[ll]];
                                    }
                                    txt = txt + "</td>";
                                }
                                document.write(txt + "</tr>");
                                document.write("</table>");
                                document.write("</td><td width='20'></td></tr>");


                                for (i = 1; i < listeEDT3.length; i++) {

                                    document.write("<tr><td width='20'><input type='radio' name='edt' value=" + listeEDT3[i][1] + " /></td><td width='500'>");

                                    asso = {};
                                    for (r = 0; r < 5; r++) {
                                        asso[listeUE[ listeEDT3[i][1] [r][0] ][0]] = listeEDT3[i][1] [r][0].toUpperCase();
                                        asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [0]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
                                        asso[listeUE[ listeEDT3[i][1] [r][0] ][listeEDT3[i][1] [r][1]] [1]] = listeEDT3[i][1] [r][0].toUpperCase() + "-" + listeEDT3[i][1] [r][1];
                                    }

                                    document.write("<table border='1' bordercolor='red'>");
                                    document.write("<tr> <th></th> <th>lundi</th> <th>mardi</th> <th>mercredi</th> <th>jeudi</th> <th>vendredi</th> </tr>");

                                    document.write("<tr> <th>8:30 - 10:30</th>");
                                    txt = "";
                                    l = ['lu08', 'ma08', 'me08', 'je08', 've08'];
                                    for (ll = 0; ll < l.length; ll++) {
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
                                    for (ll = 0; ll < l.length; ll++) {
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
                                    for (ll = 0; ll < l.length; ll++) {
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
                                    for (ll = 0; ll < l.length; ll++) {
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