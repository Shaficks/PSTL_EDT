//Reçoit une liste l contenant des paires (s,l) : s calculée par la fct poids
function rearrange(l, d, f) {
    var piv = l[f][0]; //C'est la variable s calculée dans la fonction poids
    var k = d;
    var tmp = [];
    for (var i=d; i<f; i++) {
        //On teste la variable s calculée dans la fonction poids
        if (l[i][0] > piv) {
            tmp = l[i];
            l[i] = l[k];
            l[k] = tmp;
            k++;
        }
    }
    tmp = l[k];
    l[k] = l[f];
    l[f] = tmp;
    return k;
}

//Tri en fonction du poids ? 
//Tri dichotomique récursif on faisant appel à la fonction rearrange - A REVOIR !!!!!!!!!
function tri(l, d, f) {
    if (d < f) {
        var q = rearrange(l, d, f);
        tri(l, d, q-1);
        tri(l, q+1, f);
    }
}

//Fonction de calcul de poids
function poids(l) {
    //json_encode : Retourne la représentation JSON d'une valeur
    var groupes = GRPES;
    var i = 0;
    var g = ['','','','',''];
    //Ici les groupes sont gérés comme des chaines de caractères
    //Exemple = 'algav' + '1' donne algav1
    for (i=0; i<5; i++) {
        g[i] = l[i][0]+l[i][1];
    }
    
    var m = 0; //Contiendra l'effectif le plus grand
    var p = [0,0,0,0,0]; //Tableau contenant les poids (effectifs des groupes)
    for (i=0; i<5; i++) {
        p[i] = groupes[g[i]];
        //Fonction parseInt : parse le premier entier rencontré
        //Attention, il faut que l'entier soit la première chose rencontrée dans la chaine
        //Si on passe "10" et 16, c'est le 16 qui sera prioritaire
        //Pour les redoublants, les UEs sup ne sont pas traitées
        if (parseInt(p[i]) > m && l[i][0].substring(0,4) != 'sup') {
        	m = parseInt(p[i]);
       } 
    }
	    
    var res = [];
    var s = 0.0;
    //Si on est dans le cas VERT
    if (m > 27) {
        for (i=0; i<5; i++) {
            //s va contenir la somme des différences entre 27 et p[i]
            s += 27 - p[i]
        }
        res = [3, s]; //3 = vert
    }
    else {
        s = 1.0
        for (i=0; i<5; i++) {
            //s va contenir le produit des différences entre 28 et p[i]
            s *= 28 - p[i]
        }
        if (m > 24) {     
            res = [2, s]; //2 = orange
        }
        else {
            res = [1, s]; //1 = rouge
        }
    }
    //On retourne notre tableau res avec l'id couleur et le s calculé
    return res;
}