function edt(choix) {
    alert(choix);  //verification conformite apres transmition
    /*Declarations*/
    var MAX = 5;  //PASSER AU format 6 ues
    var listeUE = getCalendrier();
    var l = [];
    var choix_poids = [[], [], [], [], []]; //Tableau des poids locaux (nombre de cases horaires) de chaque ue
    var i = 0;
    //Calcul des poids locaux,paires (lentgh,nom_ue)
    for (i = 0; i < MAX; i++) {
        choix_poids[i] = [listeUE[choix[i]].length, choix[i]];//paires (lentgh(nombre de cases horaires de l'ue),nom_ue)
    }
    alert(choix_poids);
    //Tri des UEs selon leur poids local (tri croissant) 
    var tmp = [];
    var rep = true;
    while (rep) {
        rep = false;
        for (i = 0; i < 4; i++) {
            if (choix_poids[i][0] > choix_poids[i + 1][0]) {
                tmp = choix_poids[i];
                choix_poids[i] = choix_poids[i + 1];
                choix_poids[i + 1] = tmp;
                rep = true;
            }
        }
    }
    alert(choix_poids);


    //EDT1 vert , EDT2 orange , EDT3 rouge
    var listeEDT1 = [];
    var listeEDT2 = [];
    var listeEDT3 = [];
    var EDT = [];
    //Variables qui seront utilisees dans les boucles for
    var ue1 = 0;
    var ue2 = 0;
    var ue3 = 0;
    var ue4 = 0;
    var ue5 = 0;

    //Ici on a 5 boucles imbriquees, pour enumerer tous les EDT possibles 
    //A chaque tour de boucle EDT est remis a vide pour pouvoir generer une nouvelle combinaison d'horaires
    //Ex : ue1(ue2(ue3(ue4(ue5)))) 
    for (ue1 = 1; ue1 < choix_poids[0][0]; ue1++) {//On incremente en fonction du lentgh des tableaux des matieres 
        //Initialisation
        EDT = [listeUE[choix_poids[0][1]] [0]]; //Ajout de l'horaire du cours de l'UE1 dans EDT

        for (i = 1; i < 5; i++) { //i commence par 1 car le cours de l'UE1 est ajoute dans l'instructions precedente
            //Si l'horaire du cours de l'UE est libre(absent) dans EDT on l'ajoute. Ajout des cours et Traitement des  chevauchent associes
            if (EDT.indexOf(listeUE[choix_poids[i][1]][0]) == -1) {
                EDT.push(listeUE[choix_poids[i][1]][0]); //On ajoute ici les cours des autres UEs
            }
        }
        //Si la longueur de EDT differente de 5 on sort.
        // (Chevauchement detecte(EDT.length<5 => certains horaires n'ont pas pu etre ajoutes (collision)))
        if (EDT.length != 5) {
            break;
        }

        //Il faut que les seances de TD/TME existent et que ue1 soit encore inferieur au nombre de ses tranches horaires (groupes+cours)
        //le condition (listeUE[choix_poids[0][1]][ue1].length == 0) concerne les tableaux vides ==> Pour les etudiants en alternance
        while (ue1 < choix_poids[0][0] && (listeUE[choix_poids[0][1]][ue1].length == 0 || EDT.indexOf(listeUE[choix_poids[0][1]][ue1][0]) != -1 || EDT.indexOf(listeUE[choix_poids[0][1]][ue1][1]) != -1)) {
            ue1++;
        }
        //On est arrive a la fin du tableau associe a UE1 : on quitte la boucle car plus rien a ajouter a EDT (presence importante due au while)
        if (ue1 == choix_poids[0][0]) {
            break;
        }
        //Ajout des 2 seances de TD/TME correspondantes a l'UE1
        EDT.push(listeUE[choix_poids[0][1]][ue1][0]);
        EDT.push(listeUE[choix_poids[0][1]][ue1][1]);

        //Boucle de la 2eme UE, idem que Ue1
        for (ue2 = 1; ue2 < choix_poids[1][0]; ue2++) {
            while (ue2 < choix_poids[1][0] && (listeUE[choix_poids[1][1]][ue2].length == 0 || EDT.indexOf(listeUE[choix_poids[1][1]][ue2][0]) != -1 || EDT.indexOf(listeUE[choix_poids[1][1]][ue2][1]) != -1)) {
                ue2++;
            }
            if (ue2 == choix_poids[1][0]) {
                break;
            }
            EDT.push(listeUE[choix_poids[1][1]][ue2][0]);
            EDT.push(listeUE[choix_poids[1][1]][ue2][1]);

            //Boucle de l'UE3
            for (ue3 = 1; ue3 < choix_poids[2][0]; ue3++) {
                while (ue3 < choix_poids[2][0] && (listeUE[choix_poids[2][1]][ue3].length == 0 || EDT.indexOf(listeUE[choix_poids[2][1]][ue3][0]) != -1 || EDT.indexOf(listeUE[choix_poids[2][1]][ue3][1]) != -1)) {
                    ue3++;
                }
                if (ue3 == choix_poids[2][0]) {
                    break;
                }
                EDT.push(listeUE[choix_poids[2][1]][ue3][0]);
                EDT.push(listeUE[choix_poids[2][1]][ue3][1]);

                //Boucle de l'UE4,idem que Ue1
                for (ue4 = 1; ue4 < choix_poids[3][0]; ue4++) {
                    while (ue4 < choix_poids[3][0] && (listeUE[choix_poids[3][1]][ue4].length == 0 || EDT.indexOf(listeUE[choix_poids[3][1]][ue4][0]) != -1 || EDT.indexOf(listeUE[choix_poids[3][1]][ue4][1]) != -1)) {
                        ue4++;
                    }
                    if (ue4 == choix_poids[3][0]) {
                        break;
                    }
                    EDT.push(listeUE[choix_poids[3][1]][ue4][0]);
                    EDT.push(listeUE[choix_poids[3][1]][ue4][1]);

                    //Boucle de l'UE5,idem que Ue1
                    for (ue5 = 1; ue5 < choix_poids[4][0]; ue5++) {
                        while (ue5 < choix_poids[4][0] && (listeUE[choix_poids[4][1]][ue5].length == 0 || EDT.indexOf(listeUE[choix_poids[4][1]][ue5][0]) != -1 || EDT.indexOf(listeUE[choix_poids[4][1]][ue5][1]) != -1)) {
                            ue5++;
                        }
                        if (ue5 == choix_poids[4][0]) {
                            break;
                        }
                        EDT.push(listeUE[choix_poids[4][1]][ue5][0]);
                        EDT.push(listeUE[choix_poids[4][1]][ue5][1]);

                        //Liste contenant les paires (nomUE, groupe)
                        l = [[choix_poids[0][1], ue1], [choix_poids[1][1], ue2], [choix_poids[2][1], ue3], [choix_poids[3][1], ue4], [choix_poids[4][1], ue5]];

                        pds = poids(l); //Appel de la fonction calculant le poids
                        if (pds[0] == 1) {
                            listeEDT1.push([pds[1], l]); //Si c'est un EDT vert, on le rajoute a listeEDT1 sous le format(s,liste des UEsl) 
                            //alert(JSON.stringify(listeEDT1)); // pk null au lieu de pds (s)
                            // s est le poids precis de la liste l (edt trouve)
                        } else {
                            if (pds[0] == 2) { //Si c'est un orange, on le rajoute a listeEDT2
                                listeEDT2.push([pds[1], l]);
                            } else {//Sinon si c'est un rouge, on le rajoute a listeEDT2
                                listeEDT3.push([pds[1], l]);
                            }
                        }
                        //On supprime les seances de TD/TME de l'ue5 (remise a vide pour combinaison suivante)
                        //PAS BESOIN DE LE FAIRE POUR UE1 CAR INITIALISATION EDT AU DEBUT
                        EDT.splice(EDT.indexOf(listeUE[choix_poids[4][1]][ue5][0]), 1);
                        EDT.splice(EDT.indexOf(listeUE[choix_poids[4][1]][ue5][1]), 1);
                    }
                    //On supprime les seances de TD/TME de l'ue4 
                    EDT.splice(EDT.indexOf(listeUE[choix_poids[3][1]][ue4][0]), 1);
                    EDT.splice(EDT.indexOf(listeUE[choix_poids[3][1]][ue4][1]), 1);
                }
                //On supprime les seances de TD/TME de l'ue3
                EDT.splice(EDT.indexOf(listeUE[choix_poids[2][1]][ue3][0]), 1);
                EDT.splice(EDT.indexOf(listeUE[choix_poids[2][1]][ue3][1]), 1);
            }
            //On supprime les seances de TD/TME de l'ue2
            EDT.splice(EDT.indexOf(listeUE[choix_poids[1][1]][ue2][0]), 1);
            EDT.splice(EDT.indexOf(listeUE[choix_poids[1][1]][ue2][1]), 1);
        }
    }
    
    print_edts(listeEDT1,1); //Appel de la fonction d'ecriture des edt sur le document html pour edt de classe 1
    print_edts(listeEDT2,2); //Appel de la fonction d'ecriture des edt sur le document html pour edt de classe 2
}