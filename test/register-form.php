<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reg-formulär</title>

<style>
    .error{color: #ff0000;}
</style>
</head>
<body>

    <h1>Registrering</h1>

    <?php
    $nameErr = $emailErr = $genderErr = $websiteErr = "";
    $name = $email = $gender = $comment = $website = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST ["name"])){
                $nameErr = "Du måste ange ett namn.";
            }else{
                $name = test_input($_POST["name"]);
            }

            if(empty($_POST ["email"])){
                $emailErr = "Du måste ange en e-postadress.";
            }else{
                $email = test_input($_POST["email"]);

                if (!preg_match("/^[a-zA-Z-' åäöÅÄÖ]*$/",$name)) {
                    $nameErr = "Only letters and white space allowed";
                }
            }

            if (empty($_POST["website"])) {
                $website = "";
              } else {
                $website = test_input($_POST["website"]);

                $website = test_input($_POST["website"]);
                if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
                  $websiteErr = "Invalid URL";
                }
              }


            $website = test_input($_POST["website"]);
            $comment = test_input($_POST["comment"]);
            $gender = test_input($_POST["gender"]);
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    Namn: <input type="text" name="name"><span Class="error">*<?php echo $nameErr;?></span>
    <br>
    <br>
    E-post: <input type="text" name="email"><span Class="error">*<?php echo $emailErr;?></span>
    <br>
    <br>
    Webbsajt: <input type="text" name="website">
    <br>
    <br>
    Kommentar: 
    <br>
    <textarea name="comment" rows="5" cols="40"></textarea>
    <br>
    <br>
    Gender:
    <input type="radio" name="gender" value="female">Kvinna
    <input type="radio" name="gender" value="male">Man
    <input type="radio" name="gender" value="other">Annat
    <span class="error">*<?php echo $genderErr;?></span>
    <br>
    <br>
    <input type="submit">
    </form>

    <?php
        echo "<h2>Your Input:</h2>";
        echo $name;
        echo "<br>";
        echo $email;
        echo "<br>";
        echo $website;
        echo "<br>";
        echo $comment;
        echo "<br>";
        echo $gender;
    ?>

</body>
</html>