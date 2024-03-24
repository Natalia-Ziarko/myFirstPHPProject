<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Kalkulator</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>

<div style="width:90%; margin: 2em auto;">
    <a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>

<div style="width:90%; margin: 2em auto;">

<form action="<?php print(_APP_ROOT); ?>/app/calc.php" method="post" class="pure-form pure-form-stacked">
    <legend>Kalkulator kredytowy firmy Ziarko pożyczy Ci PLNy ( ͡❛ ᴗ ͡❛)</legend>
    <fieldset>
        <label for="id_kwota">Kwota: </label>
        <input id="id_kwota" type="text" name="kwota" value="<?php if (isset($kwota)) { print($kwota); } ?>" /><br />
        <label for="id_lb_lat">Liczba lat: </label>
        <input id="id_lb_lat" type="text" name="lb_lat" value="<?php if (isset($lb_lat)) { print($lb_lat); } ?>" /><br />
        <label for="id_procent">Oprocentowanie: </label>
        <input id="id_procent" type="text" name="procent" value="<?php if (isset($procent)) { print($procent); } ?>" /><br /><br />
    </fieldset>	 
    <input type="submit" value="Oblicz" style="background-color: blue; color: white; font-size: 16px; padding: 10px; border: none; border-radius: 5px;" />
</form>	

<?php
if (isset($messages) && count ($messages) > 0) {
    echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: lightblue; width:300px;">';
    foreach ( $messages as $msg ) {
        echo '<li>'.$msg.'</li>';
    }
    echo '</ol>';
}
?>

<?php if (isset($result)){ ?>
<br /><div style="padding: 10px; border-radius: 5px; background-color: lightblue; width:300px;">
<?php
    if ($role == 'admin'){
        $result = round(($kwota * ($procent / 100)),2);
        echo 'Na tym kredycie zarobię: '.$result.' zł';
    } else {
        $result = round(($kwota * ($procent / 100 + 1)) / ($lb_lat * 12),2);
        echo 'Twoja miesięczna rata wyniesie: '.$result.' zł';
    }   
?>
</div>
<?php } ?>

</div>

</body>
</html>

