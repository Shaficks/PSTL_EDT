<?php

$master = array(
    "ANDROIDE" => array(
        "oblig" => array("lrc","mogpl"),
        "recom" => array("mapsi","il","complex"), //ajout de il recommande (sur le site du master)
        "libre" => array("mlbda","bima","aagb")
    ),
    "BIM" => array(
        "oblig" => array("mapsi","aagb","4m062"), //mm062 ou 4m062?
        "recom" => array("bima","lrc","mogpl","complex","il"), //model est recommande ajout ou non ?
        "libre" => array("algav","mlbda")
    ),
    "DAC" => array(
        "oblig" => array("mlbda","lrc"),
        "recom" => array("il","mapsi"),
        "libre" => array("bima","complex","model","mogpl")
    ),
    "IMA" => array(
        "oblig" => array("bima","mapsi"),
        "recom" => array("model","mogpl"),
        "libre" => array("aagb","algav","mlbda","archi1","mobj","ares","complex","noyau","dlp","pr","elecana1","rtel","il","signal","lrc","vlsi1")
    ),
    "RES" => array(
        "oblig" => array("ares","rtel"),
        "recom" => array("archi1","complex","signal","mogpl","noyau","pr"),
        "libre" => array("aagb","mapsi","algav","mlbda","mobj","model","bima","dlp","elecana1","il","lrc","vlsi1")
    ),
    "SAR" => array(
        "oblig" => array("noyau","pr"),
        "recom" => array("archi1","ares","dlp","il","algav",),
        "libre" => array("aagb","mapsi","mlbda","mobj","model","bima","mogpl","complex","elecana1","rtel","signal","lrc","vlsi1")
    ),
    "SESI" => array(
        "oblig" => array("archi1","vlsi1"),
        "recom" => array(), //ajout des "ue au choix" du site de sesi en recom ou pas ?
        "libre" => array("aagb","mapsi","algav","mlbda","mobj","ares","model","bima","mogpl","complex","noyau","dlp","pr","elecana1","rtel","il","signal","lrc")
    ),
    "SFPN" => array(
        "oblig" => array("model"),
        "recom" => array("complex","noyau","pr","archi1","ares","mapsi"),
        "libre" => array("aagb","algav","mlbda","mobj","bima","mogpl","dlp","elecana1","rtel","il","signal","lrc","vlsi1")
    ),
    "STL" => array(
        "oblig" => array("algav","dlp"),
        "recom" => array("il","mlbda","lrc","noyau","pr"),
        "libre" => array("aagb","mapsi","archi1","mobj","ares","model","bima","mogpl","complex","elecana1","rtel","signal","vlsi1")
    )
);

?>
