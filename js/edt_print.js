function print_edts(listeEDT, classe) {
    var listeUE = getCalendrier(); //recuperation du calendrier du semestre
    printSupHTML("#edts", "<br/><span class=\"nbedt\" id=\"nbedt_" + classe + "\">Il y a " + listeEDT.length + " emplois du temps de classe " + classe + " </span><br/><br/>");
    tri(listeEDT, 0, listeEDT.length - 1); //Tri decroissant des listes des EDT en se basant sur la valeur s
    var asso = {}; //tableau associatif de type horaire=>ue (exemple : ma14 => algav-1)

    for (var i = 0; i < listeEDT.length; i++) {
        asso = {}; //Reinitialiser asso //remise a zero de l'edt
        //affichage du boutton radio correspondant a un edt (value=liste des cases horaires(cours + td/tme) de l'edt)
        printSupHTML("#edts", "<span class=\"edtbox\" id=\"edtbox_" + classe + "_" + i + "\">\n\
        <input onclick=\"showValidator(this)\" id=\"edt_" + classe + "_" + i + "\" class=\"edt\" type=\"radio\" name=\"edt\" value=\"" + listeEDT[i][1] + "\" />\n\
        </span>");
        //alert(JSON.stringify(listeEDT[i][1]));
        //Pour chaque horaire on cree une entree dans le tableau asso de type horaire=>ue (exemple : ma14 => algav-1)
        for (var horaire = 0; horaire < 5; horaire++) {//change to nb horaires=6 aft maj a 6 edt.js
            asso[listeUE[ listeEDT[i][1] [horaire][0] ][0]] = listeEDT[i][1] [horaire][0].toUpperCase();
            asso[listeUE[ listeEDT[i][1] [horaire][0] ][listeEDT[i][1] [horaire][1]] [0]] = listeEDT[i][1] [horaire][0].toUpperCase() + "-" + listeEDT[i][1] [horaire][1];
            asso[listeUE[ listeEDT[i][1] [horaire][0] ][listeEDT[i][1] [horaire][1]] [1]] = listeEDT[i][1] [horaire][0].toUpperCase() + "-" + listeEDT[i][1] [horaire][1];
        }
        print_edt(asso, classe, i);
    }
}

function print_edt(asso, classe, num) {
//alert(JSON.stringify(asso));
    var time = {"jours": ["lundi", "mardi", "mercredi", "jeudi", "vendredi"],
        "heures": ["08:30 - 10:30", "10:45 - 12:45", "13:45 - 15:45", "16:00 - 18:00"]};

    printSupHTML("#edtbox_" + classe + "_" + num, "<table id=\"edttab_" + classe + "_" + num + "\" class=\"edttab\"></table></br>");
    printSupHTML("#edttab_" + classe + "_" + num, "<tr id=\"tr_" + classe + "_" + num + "\"> <th id=\"th_" + classe + "_" + num + "\" class=\"classe_" + classe + "\"></th></tr>");

    for (var j = 0; j < time["jours"].length; j++)
        printSupHTML("#tr_" + classe + "_" + num, "<th class=\"jour\">" + time["jours"][j] + "</th>");

    for (var h = 0; h < time["heures"].length; h++)
        printSupHTML("#edttab_" + classe + "_" + num, "<tr id=\"tr_" + classe + "_" + num + "_" + h + "\"> <th class=\"heure\">" + time["heures"][h] + "</th></tr>");

    for (var j = 0; j < time["jours"].length; j++)
        for (var h = 0; h < time["heures"].length; h++) {
            var jh = (time["jours"][j]).substr(0, 2) + (time["heures"][h]).substr(0, 2);
            //alert(jh + "->" + asso[jh]);
            if (asso[jh] != undefined)
                printSupHTML("#tr_" + classe + "_" + num + "_" + h, "<td class=\"jhue\" id =\"" + asso[jh] + "\" align=center>" + asso[jh] + "</td>");
            else
                printSupHTML("#tr_" + classe + "_" + num + "_" + h, "<td class=\"jhue\" id =\"" + jh + "\" align=center></td>");
        }
}

function showValidator(input) {
    var cn = input.getAttribute("id").split("_");//classeNum (cn)   
    printHTML("#th_" + cn[1] + "_" + cn[2], "<input class=\"boutton\" id=\"bedt\" type=\"submit\" name=\"submit\" value=\"Valider\"/>");
    for (var e = 1; e <= 2; e++) {
        var edts = document.getElementsByClassName("classe_" + e);
        for (var i = 0; i < edts.length; i++)
            if (edts[i].getAttribute("id") != "th_" + cn[1] + "_" + cn[2])
                printHTML(edts[i], "");
    }
}