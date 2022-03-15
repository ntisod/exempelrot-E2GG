<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  username: <input type="text" name="username">
  password: <input type="text" name="password">
  <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "post") {
  // collect value of input field
  $name = htmlspecialchars($_REQUEST['username']);
  if (empty($name)) {
    echo "Username is empty";
  } else {
    echo $name;
  }
}
?>

</body>
</html>