<?php
    $title = "Sida";
    include "../templates/head.php";
?>

<h2>Detta är en sida</h2>

<?php

    echo "<p>Välkommen till sidan " . $_COOKIE["wsp1-user"] . "</p>";

    require "../templates/foot.php";