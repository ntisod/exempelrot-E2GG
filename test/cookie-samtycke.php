<?php

if(!isset($_COOKIE['cookies'])){
	// om kakan inte är satt
    // fråga efter samtycke, om användaren kommer tillbbake inom 15 minuter så accepterar dom
	$show_consent = True;	
	$cookies = ['consent'=>0,'analytic' => 0, 'ads' => 0];
	$cookies_string = json_encode($cookies);
	setcookie("cookies",$cookies_string,time() + (60*15),'/');
}else{
    // We'll get the user preferences

	$show_consent = False; // Don't show the popup
	$cookies = json_decode($_COOKIE['cookies'],True);

	// If consent == 'asking', the user continued on the website and has accepted
	if($cookies['consent']==0){
		$cookies = ['consent'=>1,'analytic' => 1, 'ads' => 1];
		$cookies_string = json_encode($cookies);
		setcookie("cookies",$cookies_string,time() + (60*60*24*90),'/'); // Set cookie for 90 days
		$page = $_GET['page']; // Or whatever you reference your pages with
		if($page == "cookies"){ // user's second visit is the cookies page
			$cookies = ['consent'=>1,'analytic' => 0, 'ads' => 0];
		}
	}
}

?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie-banner test</title>
    <style>

#close_cookie{display:none;}
	#close_cookie:checked + #cookie_consent_popup{display:none;}	
#cookie_consent_popup{
	position:fixed;
	bottom:30px;left:30px;
	width:400px;
	height:180px;
	background-color:#fbb63e;
	padding:20px;
	 z-index:2;
}
	#cookie_consent_popup h1{
		font-size:1.2em;
	}
		#cookie_consent_popup h1:before{
			content:"";
			padding:0;
		}
	#cookie_consent_popup p{
		font-size:0.7em;
	}
	#cookie_consent_popup #close_cookie_box{
		position:absolute;
		top:20px;right:20px;
		cursor:pointer;
		font-size:1.3em;
	}
	#cookie_consent_popup #ok_cookie_box{
		position:absolute;
		bottom:20px;right:20px;
		cursor:pointer;
		font-size:1.6em;
		padding:10px 20px;
		font-weight:700;
		color:white;
	}

    </style>
</head>
<body>
    
<?php if($show_consent == True){ ?>
	<input type="checkbox" id="close_cookie"></input>
	<div id="cookie_consent_popup">
		<h1>Kakor</h1>
		<label for="close_cookie" id="close_cookie_box">X</label>
		<p>Den här sidan använder kakor för att spara inställningar, analysera trafik och möjliggöra personliga annonser. läs mer om vilka kakor som används och hur du gör inställningar för att inte använda i <a href="cookies" title="Cookie Policy">Cookie page</a>.Genom att klicka 'OK', 'X' eller att fortsätta använda den här sajten, godkänner du användandet av kakor om du inte själv har gjort inställningar så att det inte kan användas. </p>
		<label for="close_cookie" id="ok_cookie_box">OK</label>
	</div>
<?php }?>

</body>
</html>