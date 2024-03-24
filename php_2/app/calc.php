<?php
require_once dirname(__FILE__).'/../config.php';

include _ROOT_PATH.'/app/security/check.php';

function getParams(&$kwota,&$lb_lat,&$procent){
    $kwota = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
    $lb_lat = isset($_REQUEST['lb_lat']) ? $_REQUEST['lb_lat'] : null;
    $procent = isset($_REQUEST['procent']) ? $_REQUEST['procent'] : null;	
}

function validate(&$kwota,&$lb_lat,&$procent,&$messages){
    if ( ! (isset($kwota) && isset($lb_lat) && isset($procent))) { return false; }

    if ( $kwota < 100000 ) { $messages [] = 'zasada: Nie pożyczam mniej niż 100 000 zł'; }
    if ( $lb_lat < 2 ) { $messages [] = 'zasada: Nie pożyczam na mniej niż 2 lata'; }
    if ( $kwota == "" ) { $messages [] = 'Nie podano kwoty'; }
    if ( $lb_lat == "" ) { $messages [] = 'Nie podano liczby lat'; }
    if ( $procent == "" ) { $messages [] = 'Nie podano wysokości oprocentowania'; }

    if (count($messages) != 0) { return false; }

    if (! is_numeric( $kwota )) { $messages [] = 'Kwota musi być liczbą całkowitą'; }
    if (! is_numeric( $lb_lat )) { $messages [] = 'Liczba lat musi być liczbą całkowitą'; }
    if (! (is_numeric( $procent ) || is_float( $procent )) ) { $messages [] = 'Oprocentowanie musi być liczbą'; }	

    if (count($messages) != 0) {
        return false;
    } else {
        return true;
    }
}

function process(&$kwota,&$lb_lat,$procent,&$result){
    global $role;

    if ($role == 'admin'){
        $result = round(($kwota * ($procent / 100)),2);
    } else {
        $result = round(($kwota * ($procent / 100 + 1)) / ($lb_lat * 12),2);
    }
}

$kwota = null;
$lb_lat = null;
$procent = null;
$result = null;
$messages = array();

getParams($kwota,$lb_lat,$procent);
if ( validate($kwota,$lb_lat,$procent,$messages) ) {
    process($kwota,$lb_lat,$procent,$result,$messages);
}

include 'calc_view.php';

