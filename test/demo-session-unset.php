<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
    //meny
    include "demo-session-menu.php";

// remove all session variables
session_unset();


?>

</body>
</html>
