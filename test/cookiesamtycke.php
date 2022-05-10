<form method="post" action="change-cookies-execute.php">
<!-- Your checkboxes and content here -->
	<?php
	if(!isset($_COOKIE['cookies']) || json_decode($_COOKIE['cookies'])['consent'],True) == 0){
	$cookies = ['consent'=>1,'analytic' => 1, 'ads' => 1];
	}else{
	$cookies = json_decode($_COOKIE['cookies'],True);
	}
	?>
</form>