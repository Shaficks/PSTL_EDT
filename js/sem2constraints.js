/**
 * Gestions des contraintes specifiques au semestre 2
 * Entre autres : le fait qu'un etudiant ne peut pas choisir moins de 3 ues de sa specialite (Projet exclus)
 * pour faciliter l'insertion des contraintes avec la structure preexistante :
 *  on fait le choix pour le S2, de tagger les ues des specialites comme etant "recommandees"
 */

function checkNbSpeUE(choix){ 
    var nbrecom=0,minrecom=3;
    //console.log("checkNbSpeUE/uec : ["+choix+"] & UEVALIDES :["+UEVALIDES+"] & SPERECOM : ["+SPERECOM+"]"); 
    
    //On cherche parmis les ues choisies 
    for(var i=0;i<choix.length;i++)
        if(SPERECOM.indexOf(choix[i])!=-1)
            nbrecom++;
    //puis parmi les ues deja valides pour les redoublants
    for(var i=0;i<UEVALIDES.length;i++)
        if(SPERECOM.indexOf(UEVALIDES[i])!=-1)
            nbrecom++;
    
    //console.log("nbrecom : "+nbrecom);
    if(SEMNUM==2 && nbrecom < minrecom){
     var msg = "Au S2 il vous faut suivre au moins "+minrecom+" ues recommand&eacute;s";
        printHTML("#con_error_choix", msg);
        return false;
    }
    printHTML("#con_error_choix", "");
    return true;
}