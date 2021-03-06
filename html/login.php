<?php

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
    require("../includes/settings.php");
  
    //hämta hashat lösenord från db
    
    try {


      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $sql = "SELECT password FROM users WHERE username = :username LIMIT 1";

      $stmt = $conn->prepare($sql);
      $stmt->bindValue("username", $username);
      $stmt->execute();

      // set the resulting array to associative
      $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

      //Kolla om inskrivet lösenord stämmer överens med lösenordet i DB.
      $verified = password_verify($pw, $resultat["password"]);
      
      
      
      //Låt olika saker hända beroende på om man skrivit rätt lösenord eller inte
      if($verified){  
        //Ta användaren till annan sida.
        header("Location: sida.php");

      } else{
        echo "Fel lösenord, eller användarnamn.";
      }
    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;

  }
  else{
    echo "En eller flera uppgifter är inte korrekt inskrivna.";
  }
}

$title = "Logga in";
require "../templates/head.php";

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