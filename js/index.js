/**
 * *TRAITEMENT DU FORMULAIRE DE CONNEXION
 * !NB: Les 'alert' ne servent qu'au debug (alert ne doit pas intervenir dans le control d erreur)(seulement utile au developpeur)
 * Les messages d'erreur sur les entrees du formulaire sont geres par jquery (modification du dom)
 * */

//Get & Check formulaire Connexion
function connect(formulaire) {
    var num = formulaire.numetu.value.trim();
    var vnum = formulaire.numetu2.value.trim(); //verification du numero etudiant : vnum
    var nom = formulaire.nometu.value.trim();
    var prenom = formulaire.prenometu.value.trim();
    var mail = formulaire.email.value.trim();
    var spe = formulaire.spe.value;
    var redouble = document.getElementById("r2").checked; //est un redoublant 
    var magister = document.getElementById("m2").checked; //postule pour un magistere(6 ues)

    //Nombre d'ues (5:Pas de Magistere, 6:Magistere)(5 par defaut)  
    var nbue = 5;
    if(magister) nbue++;

    /*alert("MsgFrom : Connect.js/connect,\n msg:{num=" + num + " vnum=" + vnum + " nbues=" + nbue +
     " nom=" + nom + " prenom=" + prenom + " mail=" + mail + "\n\
     spe=" + spe + " redouble=" + redouble + " magister=" + magister + "}");*/

    var conform = verif_num(num) && verif_vnum(num, vnum)
            && verif_text("nom", nom) && verif_text("prenom", prenom) && verif_mail(mail);

    if (conform) { //les entrees du formulaire sont toutes conformes
        //redirection vers start_session avec les parametres utiles du formulaire 
        window.location.href = "start_session.php?num=" + num + "&nom=" + nom + "&prenom=" + prenom + "&mail=" + mail +
                "&spe=" + spe + "&redouble=" + redouble + "&magister=" + magister + "&nbue=" + nbue;
    }
    //alert("conform=" + conform);
}


//Fonctions de verification de conformite du formulaire

//verification numero d etudiant
function verif_num(num) {
    if (isNumber(num) && num.length == 7) { //un nombre de 7 chiffre (verifications supplementaires sur la couche html)
        //!attention cette 2eme verification est importante car elle protege des champs vides (non filtres par le pattern html) 
        printHTML("#con_error_num", ""); //remise a blanc du precedent message d'erreur eventuel
        return true;
    }
    func_erreur_connexion("#con_error_num", "Numero d'etudiant invalide");
    //alert("num rouge");
    return false;
}

//Verification unicite numero etudiant
function verif_vnum(num, num2) {
    if (num == num2) {
        printHTML("#con_error_num2", ""); //remise a blanc du precedent message d'erreur eventuel
        return true;
    }
    func_erreur_connexion("#con_error_num2", "La verification n'est pas identique au numero d'etudiant ");
    //alert("vnum rouge");
    return false;
}

//Verification taille des inputs de type texte (nom, prenom, etc)
function verif_text(desc, texte) {
    if (texte.length > 0) {
        printHTML("#con_error_" + desc, ""); //remise a blanc du precedent message d'erreur eventuel
        return true;
    }
    func_erreur_connexion("#con_error_" + desc, "Votre " + desc + " doit etre renseigne");
    // alert(desc + " is empty");
    return false;
}

//verification email
function verif_mail(mail) {
    //un mail contient au moins 5 caracteres (A@B.C) 
    //verification par simple pattern "email" (A@B (avec A et B sans espaces)) au niveau html. le ".nomDomaine" n'est pas verifie
    //une adresse de type nom@mailserver est acceptee au lieu du pattern srtict (nom@mailserver.nomDomaine)
    //Ceci est fait expres dans un esprit de permissivite large.
    //Il ne sert a rien de verifier le nom de domaine car celui-ci peut etre imbrique(.keio.ac.jp est un nom de domaine valable et existant)
    //Mais (.fr.fr) ou (.f.f) sont tout aussi valables mais inexistants : nom@mailserver.fr.fr est accepte par le pattern mais inexistant
    //un mail de verification est envoye a chaque etudiant pour palier cette largesse.
    if (mail.length > 4){
        printHTML("#con_error_email", ""); //remise a blanc du precedent message d'erreur eventuel.
        return true;
    }
    func_erreur_connexion("#con_error_email", "Votre email doit etre renseigne! Un mail de verification vous sera envoye.");
    //alert("mail="+mail);
    return false;
}

//affichage d'un message d'erreur personnalise pour le fieldset en cause (modifications sur le dom) 
function func_erreur_connexion(dom, msg) {
    //alert("Connect.js/func_erreur_connexion, \n msg=" + msg);
    var msg = "<span class=\"con_error_msg\">" + msg + "</span>";
    printHTML(dom, msg);
}