function description(desc){

var descs = {

"desc1":"<p> Chaque sp&eacute;cialit&eacute; du Master Informatique pr&eacute;sente au plus 2 UE obligatoires parmi les 5 UE suivies au premier semestre.\n\
Dans la liste ci-dessous, les <font color='red'>UE obligatoires</font> apparaissent en rouge et sont gris&eacute;es.\n\
Il vous reste alors &agrave; compl&eacute;ter le choix afin d'en s&eacute;lectionner 5 en tout.\n\
Chaque sp&eacute;cialit&eacute; indique certaines <font color='blue'>UE recommand&eacute;es </font>.\n\
La <a target='_blank' href='http://www-master.ufr-info-p6.jussieu.fr/lmd'>description compl&egrave;te du master</a> est consultable.</p>",

"desc2" : "<p>Tous les emplois du temps compatibles avec les 5 UE que vous avez choisies sont affich&eacute;s ci-dessous. \n\
 Ils sont r&eacute;pertori&eacute;s en 3 classes suivant le taux de remplissage actuel des groupes. \n\
La <font color='green'>classe 1</font> consiste en les emplois du temps, dont les groupes contiennent encore de la place. \n\
La <font color='orange'>classe 2</font> contient les emplois du temps dont certains groupes sont presque pleins. \n\
Enfin, la <font color='red'>classe 3</font> contient les emplois du temps dont certains groupes sont d&eacute;j&agrave; pleins.\n\
<br/>Vous avez la possbilit&eacute; de choisir <b>UN SEUL</b> emploi du temps parmi tous les emplois du temps. \n\
Ainsi, en choisissant un emploi du temps dans la derni&egrave;re classe, il est probable que vos voeux soient modifi&eacute;s &agrave; la rentr&eacute;e.\n\
 <br/> Nous vous rappelons qu'il s'agit de voeux d'UE et d'emploi du temps, et quels que soient vos choix, il est possible qu'ils soient modifi&eacute;s\n\
 lors de la pr&eacute;-rentr&eacute;e, pour des raisons p&eacute;dagogiques ou de contraintes de remplissage de groupes.</p>"
};

printHTML("#description_master",descs[desc]);
}