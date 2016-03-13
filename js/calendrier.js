/**
 * Retourne une liste d'horaires des ues representant le calendrier du semestre
 * @returns {getCalendrier.listeUE}
 */

function getCalendrier() {
//Liste de chaque UE avec son horaire de cours, et les horaires de ses groupes de TD/TME  
//Remplacement de 14 par 13 (ex : lu14 est devenu lu13)
//Ajout de sup5x dans le cadre du passage a 6 ues
//TODO : replace sup by xyz    

    var listeUE;
    if (SEMNUM==1)  //S1
        listeUE = {'4m062': ['lu16', ['me10', 've04']], 'sup1x': ['lu00', ['lu02', 'lu04']], 'sup2x': ['ma00', ['ma02', 'ma04']],
            'sup3x': ['me00', ['me02', 'me04']], 'sup4x': ['je00', ['je02', 'je04']], 'sup5x': ['ve00', ['ve02', 've04']],
            'rtel': ['lu08', ['ma08', 'ma10'], [], ['me08', 'me10']],
            'mobj': ['lu08', ['me08', 'me10']],
            'elecana1': ['lu10', ['ma08', 'ma10']],
            'aagb': ['lu10', ['me16', 've16']],
            'ares': ['lu10', [], [], ['me08', 'me10'], ['me13', 'me16'], ['je08', 'je10'], ['je13', 'je16']],
            'pr': ['lu13', ['me08', 'me10'], ['me13', 'me16'], ['ve08', 've10'], ['ve10', 've13']],
            'noyau': ['lu16', [], ['ma13', 'ma16'], ['ma13', 'ma16'], ['me13', 'me16'], ['je13', 'je16']],
            'dlp': ['ma08', ['je13', 'je16'], ['je13', 'je16'], ['ve08', 've10']],
            'algav': ['ma10', ['ma13', 'ma16'], ['je08', 'je10'], ['je08', 'je10']],
            'bima': ['ma13', ['je13', 'je16']],
            'mapsi': ['ma16', ['lu08', 'lu10'], ['lu08', 'lu10'], ['ma08', 'ma10'], ['ma08', 'ma13']],
            'il': ['me08', ['lu08', 'lu10'], ['lu08', 'lu10'], ['ma08', 'ma10'], ['me10', 'me13'], ['je13', 'je16'], ['ve10', 've13']],
            'lrc': ['me13', ['lu13', 'lu16'], ['lu13', 'lu16'], ['ma13', 'ma16'], ['je08', 'je10']],
            'mlbda': ['me16', ['lu08', 'lu10'], ['me08', 'me10'], ['je08', 'je10'], ['je10', 've13']],
            'model': ['je08', ['ve13', 've16']],
            'complex': ['je10', ['me08', 'me10'], ['lu08', 've10']], //TD et TME pas le même jour !!!!!!
            'archi1': ['je13', ['ma13', 'ma16'], ['ma13', 'ma16'], ['me13', 'me16'], ['ve13', 've16']],
            'vlsi1': ['je16', ['me13', 'me16'], ['ve13', 've16']],
            'mogpl': ['ve08', ['lu13', 'lu16'], ['je13', 'je16'], ['je13', 'je16'], ['ve10', 've13']],
            'signal': ['ve10', ['ma13', 'ma16'], ['je08', 'je10']]};
    else if (SEMNUM==2 ) //S2
        listeUE = {
            'Conferences':['ma13', ['sa04','sa05']],
            'dj': ['lu13', ['je08', 'je10'], ['ve08', 've10']],
            'ihm': ['ma16', ['ma08', 'ma10']],
            'rp': ['ve13', ['je08', 'je10'], ['ve08', 've10']],
            'fosyma': ['ve16', ['ma08', 'ma10'], ['me08', 'me10']],
            'sbas': ['ma08', ['lu13', 'lu16']], 
            'mmcn': ['gi10', ['ve08', 've10']],
            'mv418': ['ve13', ['ve16', 'ma10']],
            'bi': ['lu13', ['ve13', 've16']],
            'tal': ['lu16', ['je13', 'je16'], ['je13', 'je16']], 
            'bdr': ['ma16', ['ma08', 'ma10'], ['ve08', 've10']], 
            'arf': ['me16', ['me08', 'me10'], ['je08', 'je10']],
            'iamsi': ['me13', ['me08', 'me10'], ['je13', 'je16']],
            'ig3d': ['ma16', ['je13', 'je16']],
            'rout': ['lu08', ['lu13', 'lu16'], ['je13', 'je16']],
            'mob': ['lu10', ['lu13', 'lu16'], ['ma13', 'ma16']],
            'algores': ['ma08', ['je13', 'je16']],
            'progres': ['ma10', ['me08', 'me10']],
            'sev': ['ve08', ['je08', 'je10']],
            'comnum': ['ve10', ['ve13', 've16']],
            'ar': ['lu08', ['lu13', 'lu16']],
            'pnl': ['lu10', ['je13', 'je16']], 
            'specif': ['me08', ['ma08', 'ma10']],
            'srcs': ['me10', ['je13', 'je16'], ['ve13', 've16']],
            'sas': ['je10', ['lu13', 'lu16'], ['ma08', 'ma10']],
            'fpga1': ['ma16', ['lu08', 'lu10'], ['ma08', 'ma10']], 
            'anumdsp': ['ma10', ['je13', 'je16']],
            'archi2': ['me10', ['ve13', 've16']],
            'peri': ['je08', ['je13', 'je16'], ['ve08', 've10']],
            'elecana2': ['je10', ['lu13', 'lu16']],
            'hpc': ['ve10', ['ma08', 'ma10']],
            'isec': ['je16', ['ma16', 'je13']],
            'flag': ['ve08', ['me08', 'me10']], 
            'rna': ['ve00', ['ma18', 'je18']],
            'aps': ['me16', ['ve08', 've10']], 
            'ca': ['ma10', ['je13', 'je16']],
            'cpa': ['je08', ['me08', 'me10'], ['me08', 'me10']], 
            'cps': ['me13', ['je13', 'je16'], ['ve13', 've16']], 
            'pc2r': ['je10', ['lu13', 'lu16'], ['lu13', 'lu16'], ['ve08', 've10']],
            'sup1x': ['lu00', ['lu02', 'lu04']], 'sup2x': ['ma00', ['ma02', 'ma04']], 'sup3x': ['me00', ['me02', 'me04']], 'sup4x': ['je00', ['je02', 'je04']], 'sup5x': ['ve00', ['ve02', 've04']]};
    return listeUE;
}

