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

require "../templates/head.php";
require "../includes/wsp1-funktions.php";

// define variables and set to empty values
$PWErr = $usernameErr = "";
$PW = $username = "";

$errors = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty($_POST["username"])) {
    $usernameErr = "Användarnamn krävs.";
    $errors++;
  } else {
    $username = test_input($_POST["username"]);
    
        if(!testUserExist($username)){
          $usernameErr = "Användarnamnet existerar inte.";
          $errors++;
        }
    
    }


  if(empty($_POST["PW"])){
    $PWErr = "Du måste ange ett lösenord.";
    $errors++;
  }
 
  if($errors == 0){
    //hämta db inställningar
    require("..\includes\settings.php");
  
    //hämta hashat lösenord från db
    try {


      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT password FROM users WHERE username = $username";
      //SELECT `password` FROM `users` WHERE `username`="Lorenzo";
      // use exec() because no results are returned

      

      
      $hashed_pw = $conn->exec($sql);

      $verified = password_verify($PW, $hashed_pw);
          
      //Låt olika saker hända beroende på om man skrivit rätt lösenord eller inte
      if($verified){
          echo "Grattis, du är inloggad!";
      } else{
          echo "Fel lösenord, eller användarnamn.";
      }
      
    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }

    
  
    $conn = null;

    setcookie("wsp1-user", $username, time() + 86400 , "/");

    //Ta användaren till annan sida.
    header("Location: sida.php");
  
  }
  else{
    echo "En eller flera uppgifter är inte korrekt inskrivna.";
  }
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



?>

<h2>Logga in</h2>
<br>
<p><span class="error">* Uppgifter krävs</span></p>
<br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Användarnamn: <input type="text" name="username" value="<?php echo $username;?>">
  <span class="error">* <?php echo $usernameErr;?></span>
  <br><br>
  Lösenord: <input type="password" name="PW" value="<?php echo $PW;?>">
  <span class="error">* <?php echo $PWErr;?></span>
  <br><br>
  <input type="submit" name="Logga in" value="Submit"> 
</form>

<?php

include "../templates/foot.php";

?>

</body>
</html>