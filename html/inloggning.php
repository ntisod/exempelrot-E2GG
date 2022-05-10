<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggning</title>
    <style>
    .error {color: #FF0000;}
    </style>
</head>
<body>

<?php

$username = $PW = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (empty($_POST["username"])) 
    {
        $usernameErr = "Användarnamn krävs.";
        $errors++;
    } 
    else 
    {
        $username = test_input($_POST["username"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-'_ åäöÅÄÖ0123456789]*$/",$username)) 
        {
          $usernameErr = "Endast bokstäver, understreck och siffror är tillåtna.";
          $errors++;
        }
    }
}

?>

<h2>Inloggning</h2>
<p><span class="error">* Uppgifter krävs</span></p>

<form> 

Användarnamn: <input type="text" name="username" value="<?php echo $username;?>">

<br><br>

Lösenord: <input type="password" name="PW" value="<?php echo $PW;?>">

<br><br>

<input type="submit" name="Skicka in" value="Submit"> 

</form>

</body>
</html>