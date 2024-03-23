<?php
require_once dirname(__FILE__).'/../config.php';

$kwota = $_REQUEST ['kwota'];
$lb_lat = $_REQUEST ['lb_lat'];
$procent = str_replace(',', '.', $_REQUEST ['procent']);

if (! (isset( $kwota ) && isset( $lb_lat ) && isset( $procent ))) {
    $messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

if ( $kwota < 10000000 ) {
    $messages [] = 'zasada: Nie pożyczam mniej niż 10 mln';
}
if ( $lb_lat < 10 ) {
    $messages [] = 'zasada: Nie pożyczam na mniej niż 10 lat żeby mi się opłacało';
}
if ( $kwota == "" ) {
    $messages [] = 'Nie podano kwoty';
}
if ( $lb_lat == "" ) {
    $messages [] = 'Nie podano liczby lat';
}
if ( $procent == "" ) {
    $messages [] = 'Nie podano wysokości oprocentowania';
}


if (empty( $messages )) {
    if (! is_numeric( $kwota )) {
        $messages [] = 'Kwota musi być liczbą całkowitą';
    }
    
    if (! is_numeric( $lb_lat )) {
        $messages [] = 'Liczba lat musi być liczbą całkowitą';
    }

    if (! (is_numeric( $procent ) || is_float( $procent )) ) {
        $messages [] = 'Oprocentowanie musi być liczbą';
    }	
}

if (empty ( $messages )) {
    //$kwota = intval( $kwota );
    //$lb_lat = intval( $lb_lat );
    $result = round(($kwota * ($procent / 100 + 1)) / ($lb_lat * 12),2);
}

include 'calc_view.php';

