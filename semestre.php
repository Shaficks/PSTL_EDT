<?php

/*
 * Smestre.php 
 * A appeler en debut de session (index.php) pour initialiser la session avec les donnees du semestre en cours
 */

session_start(); //recuperation de la session
$month = date("m"); //1->jan ... 12->dec
//echo "month : $month";

//$month=5;//pour tests 

$ALLSPE = array('ANDROIDE', 'BIM', 'DAC', 'IMA', 'RES', 'SAR', 'SESI', 'SFPN', 'STL');  //useless 

if ($month >=3 && $month <= 10) {// pour l'instant : Avril->Septembre (S1) //ask genitrini les periodes
    $_SESSION['SEMESTRE'] = 1; //Definition du numero de semestre
    //Definition de la liste complete des ues du semestre
    $_SESSION['ALLUES'] = array("aagb", "mapsi", "algav", "mlbda", "archi1", "mobj", "ares", "model", "bima", "mogpl", "complex", "noyau", "dlp", "pr", "elecana1", "rtel", "il", "signal", "lrc", "vlsi1");
    //Definition des contraintes sur  les ues du semestre pour chaque specialite
    $_SESSION['MASTER'] = array(
        "ANDROIDE" => array(
            "oblig" => array("lrc", "mogpl"),
            "recom" => array("mapsi", "il", "complex"), //ajout de il recommande (sur le site du master)
            "libre" => array("mlbda", "bima", "aagb")
        ),
        "BIM" => array(
            "oblig" => array("mapsi", "aagb", "4m062"), //mm062 ou 4m062?
            "recom" => array("bima", "lrc", "mogpl", "complex", "il"), //model est recommande ajout ou non ?
            "libre" => array("algav", "mlbda")
        ),
        "DAC" => array(
            "oblig" => array("mlbda", "lrc"),
            "recom" => array("il", "mapsi"),
            "libre" => array("bima", "complex", "model", "mogpl")
        ),
        "IMA" => array(
            "oblig" => array("bima", "mapsi"),
            "recom" => array("model", "mogpl"),
            "libre" => array("aagb", "algav", "mlbda", "archi1", "mobj", "ares", "complex", "noyau", "dlp", "pr", "elecana1", "rtel", "il", "signal", "lrc", "vlsi1")
        ),
        "RES" => array(
            "oblig" => array("ares", "rtel"),
            "recom" => array("archi1", "complex", "signal", "mogpl", "noyau", "pr"),
            "libre" => array("aagb", "mapsi", "algav", "mlbda", "mobj", "model", "bima", "dlp", "elecana1", "il", "lrc", "vlsi1")
        ),
        "SAR" => array(
            "oblig" => array("noyau", "pr"),
            "recom" => array("archi1", "ares", "dlp", "il", "algav",),
            "libre" => array("aagb", "mapsi", "mlbda", "mobj", "model", "bima", "mogpl", "complex", "elecana1", "rtel", "signal", "lrc", "vlsi1")
        ),
        "SESI" => array(
            "oblig" => array("archi1", "vlsi1"),
            "recom" => array(), //ajout des "ue au choix" du site de sesi en recom ou pas ?
            "libre" => array("aagb", "mapsi", "algav", "mlbda", "mobj", "ares", "model", "bima", "mogpl", "complex", "noyau", "dlp", "pr", "elecana1", "rtel", "il", "signal", "lrc")
        ),
        "SFPN" => array(
            "oblig" => array("model"),
            "recom" => array("complex", "noyau", "pr", "archi1", "ares", "mapsi"),
            "libre" => array("aagb", "algav", "mlbda", "mobj", "bima", "mogpl", "dlp", "elecana1", "rtel", "il", "signal", "lrc", "vlsi1")
        ),
        "STL" => array(
            "oblig" => array("algav", "dlp"),
            "recom" => array("il", "mlbda", "lrc", "noyau", "pr"),
            "libre" => array("aagb", "mapsi", "archi1", "mobj", "ares", "model", "bima", "mogpl", "complex", "elecana1", "rtel", "signal", "vlsi1")
        )
    );
} else if ($month >=11 && $month <= 12 || $month >=1 && $month <= 2 ) { // pour l'instant : Novembre ->Fevrier(S1) //ask genitrini les periodes
    $_SESSION['SEMESTRE'] = 2;

    $_SESSION['ALLUES'] = array('Conferences', 'dj', 'ihm', 'rp', 'fosyma', 'sbas', 'mmcn', 'mv418', 'bi','tal',
        'bdr', 'arf', 'iamsi', 'ig3d', 'rout', 'mob', 'algores', 'progres','sev', 'comnum','ar', 'pnl', 'specif', 'srcs', 'sas', 'fpga1',
        'anumdsp','archi2', 'peri', 'elecana2', 'hpc', 'isec', 'flag', 'rna', 'aps', 'ca', 'cpa', 'cps', 'pc2r');

    $_SESSION['MASTER'] = array(
        'ANDROIDE' => array(
            'oblig' => array('Conferences'),
            'recom' => array('dj', 'ihm', 'rp', 'fosyma'),
            'libre' => array('sbas', 'mmcn', 'mv418', 'bi','tal',
        'bdr', 'arf', 'iamsi', 'ig3d', 'rout', 'mob', 'algores', 'progres','sev', 'comnum','ar', 'pnl', 'specif', 'srcs', 'sas', 'fpga1',
        'anumdsp','archi2', 'peri', 'elecana2', 'hpc', 'isec', 'flag', 'rna', 'aps', 'ca', 'cpa', 'cps', 'pc2r')
        ),
        'BIM' => array(
            'oblig' => array('Conferences'),
            'recom' => array('sbas', 'mmcn', 'mv418'),
            'libre' => array('dj', 'ihm', 'rp', 'fosyma', 'bi','tal',
        'bdr', 'arf', 'iamsi', 'ig3d', 'rout', 'mob', 'algores', 'progres','sev', 'comnum','ar', 'pnl', 'specif', 'srcs', 'sas', 'fpga1',
        'anumdsp','archi2', 'peri', 'elecana2', 'hpc', 'isec', 'flag', 'rna', 'aps', 'ca', 'cpa', 'cps', 'pc2r')
        ),
        'DAC' => array(
            'oblig' => array('Conferences'),
            'recom' => array('bi', 'tal', 'bdr', 'arf', 'iamsi'),
            'libre' => array('dj', 'ihm', 'rp', 'fosyma', 'sbas', 'mmcn', 'mv418',
        'ig3d', 'rout', 'mob', 'algores', 'progres','sev', 'comnum','ar', 'pnl', 'specif', 'srcs', 'sas', 'fpga1',
        'anumdsp','archi2', 'peri', 'elecana2', 'hpc', 'isec', 'flag', 'rna', 'aps', 'ca', 'cpa', 'cps', 'pc2r')
        ),
        'IMA' => array(
            'oblig' => array('Conferences'),
            'recom' => array('ig3d'),
            'libre' => array('dj', 'ihm', 'rp', 'fosyma', 'sbas', 'mmcn', 'mv418', 'bi','tal',
        'bdr', 'arf', 'iamsi', 'rout', 'mob', 'algores', 'progres','sev', 'comnum','ar', 'pnl', 'specif', 'srcs', 'sas', 'fpga1',
        'anumdsp','archi2', 'peri', 'elecana2', 'hpc', 'isec', 'flag', 'rna', 'aps', 'ca', 'cpa', 'cps', 'pc2r')
        ),
        'RES' => array(
            'oblig' => array('Conferences'),
            'recom' => array('rout', 'mob', 'algores', 'progres', 'sev', 'comnum'),
            'libre' => array('dj', 'ihm', 'rp', 'fosyma', 'sbas', 'mmcn', 'mv418', 'bi','tal',
        'bdr', 'arf', 'iamsi', 'ig3d', 'ar', 'pnl', 'specif', 'srcs', 'sas', 'fpga1',
        'anumdsp','archi2', 'peri', 'elecana2', 'hpc', 'isec', 'flag', 'rna', 'aps', 'ca', 'cpa', 'cps', 'pc2r')
        ),
        'SAR' => array(
            'oblig' => array('Conferences'),
            'recom' => array('ar', 'pnl', 'specif', 'srcs', 'sas'),
            'libre' => array('dj', 'ihm', 'rp', 'fosyma', 'sbas', 'mmcn', 'mv418', 'bi','tal',
        'bdr', 'arf', 'iamsi', 'ig3d', 'rout', 'mob', 'algores', 'progres','sev', 'comnum', 'fpga1',
        'anumdsp','archi2', 'peri', 'elecana2', 'hpc', 'isec', 'flag', 'rna', 'aps', 'ca', 'cpa', 'cps', 'pc2r')
        ),
        'SESI' => array(
            'oblig' => array('Conferences'),
            'recom' => array('fpga1', 'anumdsp', 'archi2', 'peri', 'elecana2'),
            'libre' => array('dj', 'ihm', 'rp', 'fosyma', 'sbas', 'mmcn', 'mv418', 'bi','tal',
        'bdr', 'arf', 'iamsi', 'ig3d', 'rout', 'mob', 'algores', 'progres','sev', 'comnum','ar', 'pnl', 'specif',
        'srcs', 'sas', 'hpc', 'isec', 'flag', 'rna', 'aps', 'ca', 'cpa', 'cps', 'pc2r')
        ),
        'SFPN' => array(
            'oblig' => array('Conferences'),
            'recom' => array('hpc', 'isec', 'flag', 'rna'),
            'libre' => array('dj', 'ihm', 'rp', 'fosyma', 'sbas', 'mmcn', 'mv418', 'bi','tal',
        'bdr', 'arf', 'iamsi', 'ig3d', 'rout', 'mob', 'algores', 'progres','sev', 'comnum','ar', 'pnl', 'specif', 'srcs', 'sas', 'fpga1',
        'anumdsp','archi2', 'peri', 'elecana2', 'aps', 'ca', 'cpa', 'cps', 'pc2r')
        ),
        'STL' => array(
            'oblig' => array('Conferences'),
            'recom' => array('aps', 'ca', 'cpa', 'cps', 'pc2r'),
            'libre' => array('dj', 'ihm', 'rp', 'fosyma', 'sbas', 'mmcn', 'mv418', 'bi','tal',
        'bdr', 'arf', 'iamsi', 'ig3d', 'rout', 'mob', 'algores', 'progres','sev', 'comnum','ar', 'pnl', 'specif', 'srcs', 'sas', 'fpga1',
        'anumdsp','archi2', 'peri', 'elecana2', 'hpc', 'isec', 'flag', 'rna')
        )
    );
} else {
    $msg="Le site n'est pas encore ouvert.";
    $url="http://www-master.ufr-info-p6.jussieu.fr/lmd/";
    echo '<html><head><title>Redirection ..</title></head>' .
        '<body onload="timer = setTimeout(function(){ window.location =\'' . $url . '\';},5000)">' .
        '<p><b><font color=red>' . $msg . '</font></b> <br/> Vous allez etre redirige vers la page du master dans 5 secondes</p>' .
        '</body></html>';
}
?>

