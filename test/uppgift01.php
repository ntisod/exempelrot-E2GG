<?php
header("Content-type: text/html; charset=utf-8");
if(empty($_GET['namn'])){
    echo'<h1>Välkommen!</h1>';
    echo"<p>http://localhost:8080/uppgift01.php?namn=Erik</p>";
}
else{
    $namn=filter_input(INPUT_GET, 'namn');
    echo "<h1>Välkommen {$namn}!</h1>";
    echo "<p>Namnet $namn inehåller ", strlen($namn), " tecken.</p>";
    //------------------------------------------------------------------
    echo strrev("Text fast bakochfram.");

    $gammal = "<p>STAR WARS</p>";
    echo str_replace("WARS", "TREK", $gammal);

    echo "<p>$gammal</p>";

    echo str_shuffle("ABCDEFGHIJKLMNOPQRSTUVXYZ");

    //Detta är en kommentar.

    #Detta är också en kommentar.

    /*
    Detta är också en kommentar
    fast den är på flera rader.
    */

    echo $string=("<p>Den här strängen har åtta ord.</p>");

    echo "<p>Alltså ", str_word_count($string) - 2, " ord.</p>";
    }
?>