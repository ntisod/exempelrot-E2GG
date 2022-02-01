<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>PHP</h1>
    <p>Ursprungligen var det en förkortning för "Personal Home Page".</p>

    <p>I dagens läge är det en akronym för "Hypertext Preprocessor".</p>

    <h2>Likheter till C#</h2>
    <ul>
        
    </ul>
    <?php

    echo "<p>Mitt första <strong>PHP script</strong></p>";

    $namn = "Erik";
    echo "<p>Mitt namn är $namn</p>";

    //Detta är en kommentar.

    #Detta är också en kommentar.
    
    /*
    Detta är också en kommentar
    fast den är på flera rader.
    :3
    */

    echo strlen("Den här strängen har 33 tecken.");
    
    echo strrev("Text fast bakochfram.");
    
    $gammal = "STAR WARS";
    echo str_replace("WARS", "TREK", $gammal);

    ?>


</body>
</html>
