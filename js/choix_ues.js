/**
 * *TRAITEMENT DU FORMULAIRE DE SAISIE DU CHOIX DES UES SUIVIES
 * !NB: Les 'alert' ne servent qu'au debug (alert ne doit pas intervenir dans le control d erreur)(seulement utile au developpeur)
 * Les messages d'erreur sur les entrees du formulaire sont geres par jquery (modification du dom)
 * */

/**
 * retourne un tableau de noms d'ues valides selectionnees
 * @returns {Array|uec}
 */
function getUES() {
    uec = [];
    var ue_nodes = document.getElementsByClassName("choix"); //tableau des ues choisies (input type=hiden class=choix )
    for (var i = 0; i < ue_nodes.length; i++)
        uec.push(ue_nodes[i].getAttribute("value"));
    //alert("uec=[" + uec + "]");
}

//Duplication complete de add_ue(je ne l'ai pas reutilisee car il faudrait faire 2 appels a add_ue pour 2 ues oblig ce qui lance generateEDTs 
//si l'ajout de la premiere ue met nb_ue_restant a 0 sans attendre l'ajjout de la deuxieme ue oblig ce qui afficherait un msg d'erreur : trop d'ues
//Il faut que l'ajout des deux ues soit consecutif et atomique
function add_oblig(nb_suivi) { //ajout automatique des ues obligatoires dans le DOM et dans le tableau global obligs
    description("desc1"); //affichage des instructions sur le choix des ues
    var span_oblig_tab = document.getElementsByClassName("box_ue_oblig"); //tableau des ues commises d'office
    obligs = [];
    for (var i = 0; i < span_oblig_tab.length; i++) {
        var ue = span_oblig_tab[i].firstChild;
        obligs.push(ue.getAttribute("name"));
        var choix = "<input type=\"hidden\" class =\"choix\" id=\"choix_" + ue.getAttribute("name") + "\" \n\
        name=\"choix_" + ue.getAttribute("name") + "\" value=\"" + ue.getAttribute("name") + "\"/>";
        printSupHTML("#choices", choix);
    }
    getUES();//mise a jour des ues choisies
    //prevention depassement capacite ues choisirs
    if (uec.length >= nb_suivi) { //si nombre d'ues choisies >= nombre d'ues suivies annonce =>alors griser les autres ues
        var all_ue = document.getElementsByClassName("check_ue"); //all_ue : tableau de toutes les ues
        for (var i = 0; i < all_ue.length; i++) {
            var nomUE = all_ue[i].getAttribute("name");
            if (uec.indexOf(nomUE) == -1)
                all_ue[i].setAttribute("disabled", "true");
        }
        description("desc2");
        generateEDTs(nb_suivi); //generation de l'edt ou non(depassement-> show error)  
    }
}

//Pour chaque checkbox d'ue choisie on rajoute(resp. retire) du formulaire(en mode cache) l'ue selectionnee/deselectionnee
function add_ue(ue, nb_suivi) { //le parametre ue est la checkbox correspondant a l'ue qu'elle represente
    if (ue.checked == true) {
        var choix = "<input type=\"hidden\" class =\"choix\" id=\"choix_" + ue.getAttribute("name") + "\" \n\
        name=\"choix_" + ue.getAttribute("name") + "\" value=\"" + ue.getAttribute("name") + "\"/>";
        printSupHTML("#choices", choix);

        //mise a jour des ues choisies
        getUES();

        //prevention depassement capacite ues choisirs
        if (uec.length >= nb_suivi) { //si nombre d'ues choisies >= nombre d'ues suivies annonce =>alors griser les autres ues
            var all_ue = document.getElementsByClassName("check_ue"); //all_ue : tableau de toutes les ues
            for (var i = 0; i < all_ue.length; i++) {
                var nomUE = all_ue[i].getAttribute("name");
                if (uec.indexOf(nomUE) == -1)
                    all_ue[i].setAttribute("disabled", "true");
            }
            description("desc2");
            generateEDTs(nb_suivi); //generation de l'edt ou non(depassement-> show error)  
        }
    } else {
        //mise a jour des ues choisies
        getUES(); //etat des ues choisies avant deselection

        //Degrisement de toutes les ues 
        if (uec.length >= nb_suivi) { //si nombre d'ues choisies >= nombre d'ues suivies annonce =>alors degriser toutes les ues
            var all_ue = document.getElementsByClassName("check_ue"); //ues : tableau de toutes les ues
            for (var i = 0; i < all_ue.length; i++) {
                var nomUE = all_ue[i].getAttribute("name");
                if (obligs.indexOf(nomUE) == -1) {
                    all_ue[i].removeAttribute("disabled");
                    //alert(nomUE+" : enabled");
                }
            }
            description("desc1");
            eraseEDTs();
        }
        //les ues deselectionnees sont retirees de la balise cachee choices(maj des ues chisies)
        var choices = document.getElementById("choices");
        choices.removeChild(document.getElementById("choix_" + ue.getAttribute("name")));
    }
}

function generateEDTs(nb_suivi) { //le parametre form ne sera pas utilise
    var nb_ue_restant = nb_suivi - uec.length;
    //alert("nb_restant=" + nb_ue_restant);

    if (nb_ue_restant == 0) {
        var choix = uec.slice(0); //Tableau des UEs choisies
        //ne surtout pas modifier uec en concurence (gestion edt!= gestion ues)

        //Ajout des UEs fictives (bourrage)
        var MAX = 6; //format 6 ues 
        for (var i = uec.length + 1; i <= MAX; i++)
            choix.push('sup' + (i - uec.length) + 'x');

        edt(choix); //calcul puis affichage dynamique de l'edt

    } else if (nb_ue_restant < 0) {
        var msg = "Vous avez " + (-nb_ue_restant) + " UE en trop, veuillez verifier vos UEs  validees. <br/> \n\
        Si vous avez eu un parcours multi-specialites, merci de contactez-le secretariat!";
        printHTML("#con_error_choix", msg);
    } else {
        var msg = "Il vous faut choisir encore " + nb_ue_restant + " UE avant de valider";
        printHTML("#con_error_choix", msg);
    }
}

function eraseEDTs() {
    printHTML("#edts", "");
}

function chooseEDT(form) { //le parametre form ne sera pas utilise
    var edt = $('input[name="edt"]:checked').val();
//    alert("edt=" + edt);
    edt=edt.replace(/,/g, "%2C");
    //alert("edt=" + edt);
    window.location.href = "confirmation.php?edt=" + edt;
}