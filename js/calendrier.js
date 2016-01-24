/**
 * Retourne une liste d'horaires des ues representant le calendrier du semestre
 * @returns {getCalendrier.listeUE}
 */

function getCalendrier() {
//Liste de chaque UE avec son horaire de cours, et les horaires de ses groupes de TD/TME  
    var listeUE = {'4m062': ['lu16', ['me10', 've04']], 'sup1x': ['lu00', ['lu02', 'lu04']], 'sup2x': ['ma00', ['ma02', 'ma04']],
        'sup3x': ['me00', ['me02', 'me04']], 'sup4x': ['je00', ['je02', 'je04']], 'rtel': ['lu08', ['ma08', 'ma10'], [], ['me08', 'me10']],
        'mobj': ['lu08', ['me08', 'me10']], 'elecana1': ['lu10', ['ma08', 'ma10']], 'aagb': ['lu10', ['me16', 've16']],
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
        'model': ['je08', ['ve13', 've16']], 'complex': ['je10', ['me08', 'me10'], ['lu08', 've10']], //TD et TME pas le même jour !!!!!!
        'archi1': ['je13', ['ma13', 'ma16'], ['ma13', 'ma16'], ['me13', 'me16'], ['ve13', 've16']],
        'vlsi1': ['je16', ['me13', 'me16'], ['ve13', 've16']],
        'mogpl': ['ve08', ['lu13', 'lu16'], ['je13', 'je16'], ['je13', 'je16'], ['ve10', 've13']],
        'signal': ['ve10', ['ma13', 'ma16'], ['je08', 'je10']]};
    return listeUE;
}

//Remplacement de 14 par 13