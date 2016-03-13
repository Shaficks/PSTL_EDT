function description(desc){

var descs = {

"instructchoixue1":"<p><font size='4'>Dans la liste ci-dessous, les <font color='red'>UE obligatoires</font> sont gris&eacute;es.</br>\n\
Il vous reste alors &agrave; compl&eacute;ter le choix d'UE afin de g&eacute;n&eacute;rer les emplois du temps disponibles.</font></br>\n\
<font size='4'>Chaque sp&eacute;cialit&eacute; indique certaines <font color='blue'>UE recommand&eacute;es </font>.\n\
La <a class='rlink' target='_blank' href='http://www-master.ufr-info-p6.jussieu.fr/lmd'>description compl&egrave;te du master est consultable ICI.</font></a></br>\n\
<font size = '4'><b>Un clic sur un nom d'UE ouvre la page de sa description dans un nouvel onglet.</b></font></p>",

"instructchoixue2" : "<p><font size='4'>Tous les emplois du temps compatibles avec les UE que vous avez choisies sont affich&eacute;s ci-dessous.</br> \n\
Ils sont r&eacute;pertori&eacute;s en <b>2 classes</b> suivant le taux de remplissage actuel des groupes de TD/TME.</br> \n\
Les emplois du temps de <font color='green'> <b>classe 1 (contours VERT)</b></font> sont ceux, dont les groupes contiennent encore de la place.</br> \n\
Les emplois du temps de <font color='red'><b>classe 2 (contours ROUGE)</b></font> sont ceux, dont certains groupes sont presque pleins voire pleins.</br> \n\
<b><font color='red'>Attention:</b></font> En choisissant un emploi du temps <font color='red'>Rouge</font> ,\n\
 il est probable que vos voeux soient modifi&eacute;s &agrave; la rentr&eacute;e.\n\
 <br/> Nous vous rappelons qu'il s'agit de voeux d'UE et d'emploi du temps, et quels que soient vos choix, il est possible qu'ils soient modifi&eacute;s\n\
 lors de la pr&eacute;-rentr&eacute;e, pour des raisons p&eacute;dagogiques ou de contraintes de remplissage de groupes.</font></p>"
};

printHTML("#description_master",descs[desc]);
}