<?php


require "../includes/wsp1-funktions.php";

// define variables and set to empty values
$nameErr = $lastnameErr = $emailErr = $genderErr = $websiteErr = $bdayErr = $PWErr = $PWAErr = $usernameErr = "";
$name = $lastname = $email = $gender = $website = $bday = $PW = $PWA = $username = "";

$errors = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty($_POST["username"])) {
    $usernameErr = "Användarnamn krävs.";
    $errors++;
  } else {
    $username = test_input($_POST["username"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-'_ åäöÅÄÖ0123456789]*$/",$username)) {
      $usernameErr = "Endast bokstäver, understreck och siffror är tillåtna.";
      $errors++;
    }
    else{
      if(testUserExist($username)){
        $usernameErr = "Användarnamnet existerar redan. välj ett nytt.";
        $errors++;
      }
    }
  }

  if (empty($_POST["name"])) {
    $nameErr = "Namn krävs.";
    $errors++;
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-'åäöÅÄÖ]*$/",$name)) {
      $nameErr = "Endast bokstäver och bindestreck";
      $errors++;
    }
  }
  
  if (empty($_POST["lastname"])) {
    $lastnameErr = "Efternamn krävs.";
    $errors++;
  } else {
    $lastname = test_input($_POST["lastname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-'åäöÅÄÖ]*$/",$lastname)) {
      $lastnameErr = "Endast bokstäver och bindestreck ät tillåtna.";
      $errors++;
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "E-post krävs.";
    $errors++;
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "E-postadressen är ogiltig.";
      $errors++;
    }
  }

  if (empty($_POST["bday"])) {
    $bdayErr = "Födelsedatum krävs.";
    $errors++;
  } else {
    $bday = test_input($_POST["bday"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9-']*$/",$bday)) {
      $bdayErr = "Endast nummer och bindestreck är tillåtna.";
      $errors++;
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;åäöÅÄÖ]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "URL är ogiltig.";
      $errors++;
    }
  }

  if (empty($_POST["PW"])) {
    $PWErr = "Lösenord krävs.";
    $errors++;
  }

    if (empty($_POST["PWA"])) {
    $PWAErr = "Lösenordet krävs igen";
    $errors++;
  } 

  if (empty($_POST["gender"])) {
    $genderErr = "Kön krävs.";
    $errors++;
  } else {
    $gender = test_input($_POST["gender"]);
  }

  if(empty($_POST["PW"])){
    $PWErr = "Du måste ange ett lösenord.";
    $errors++;
  }
  if ($_POST["PW"] != $_POST["PWA"]) {
    $PWAErr = "Lösenorden måste vara identiska.";
    $errors++;
  }
 
  if($errors == 0){

    include "../includes/settings.php";
  
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $hashed_PW = password_hash($PW, PASSWORD_DEFAULT);
      $sql = "INSERT INTO users (username, name, lastname, email, bday, kon, Website, password)
      VALUES ('$username', '$name', '$lastname', '$email', '$bday', '$gender', '$website', '$hashed_PW');";
      // use exec() because no results are returned
      $conn->exec($sql);
    
      //Stäng databas anslutningen
      $conn = null;
      //Sätter en kaka
      setcookie("wsp1-user", $username, time() + 86400 , "/");
      //Ta användaren till annan sida.
      header("Location: sida.php");
    
    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }
  else{
    echo "En eller flera uppgifter är inte korrekt inskrivna.";
  }
}

$title = "Registrera ny anvndare";
require "../templates/head.php";


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//om errors inte finns så lägger du till i db, allt på samma gång, byt variabelnamn om det behövs. (i admin) ge username primärnyckel på nått sätt. 

?>

<h2>Registrering</h2>
<br>
<p><span class="error">* Uppgifter krävs</span></p>
<br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Användarnamn: <input type="text" name="username" value="<?php echo $username;?>">
  <span class="error">* <?php echo $usernameErr;?></span>
  <br><br>
  Namn: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Efternamn: <input type="text" name="lastname" value="<?php echo $lastname;?>">
  <span class="error">* <?php echo $lastnameErr;?></span>
  <br><br>
  E-post: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Födelsedag: <input type="text" name="bday" value="<?php echo $bday;?>">
  <span class="error">* <?php echo $bdayErr;?></span>
  <br><br>
  Kön:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value=1>Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value=2>Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value=3>Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  Vebbsida: <input type="text" name="website" value="<?php echo $website;?>">
  <span class="error"> <?php echo $websiteErr;?></span>
  <br><br>
  Lösenord: <input type="password" name="PW" value="<?php echo $PW;?>">
  <span class="error">* <?php echo $PWErr;?></span>
  <br><br>
  Reppetera lösenord: <input type="password" name="PWA" value="<?php echo $PWA;?>">
  <span class="error">* <?php echo $PWAErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Skicka in"> 

</form>

<?php

require "../templates/foot.php";

?>