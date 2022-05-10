<?php session_start();?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
       //meny
       include "demo-session-menu.php";

    //sessionsvariabler som sattes på föregående sida.
    echo "<p>favoritfärg: " . $_SESSION["favcolor"] . "<br>";
    
    echo "favoritdjur: " . $_SESSION["favanimal"] . "</p>";
    

?>
    
</body>
</html>