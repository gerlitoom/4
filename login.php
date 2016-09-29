<?php

	require("../../config.php");
	require("functions.php");

	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	
	$signupUsernameError="";
	$signupUsername="";
	
		if(isset ($_POST["signupUsername"]))
		
			if (empty ($_POST["signupUsername"])){
				$signupUsernameError="See vali on kohustuslik";
			}
			else {
				$signupUsername=$_POST["signupUsername"];
			}
	$signupEmailError="";
	$signupEmail = "";
	
	if(isset ($_POST["signupEmail"]))
		
		if (empty ($_POST["signupEmail"])){
			$signupEmailError="See vali on kohustuslik";
		}
		else {
			$signupEmail=$_POST["signupEmail"];
		}
		
	$signupPasswordError="";
	
	
	if(isset ($_POST["signupPassword"])) {
		
		if (empty ($_POST["signupPassword"])){
			$signupPasswordError="See vali on kohustuslik";
		}	
	else
		if(strlen($_POST["signupPassword"]) < 8) {
			$signupPasswordError="Parool pole piisavalt pikk";
		}
		
	if (isset($_POST["signupUsername"]) &&
		isset($_POST["signupEmail"]) &&
		isset($_POST["signupPassword"]) &&
		$signupUsernameError == "" &&
		$signupEmailError == "" &&
		$signupPasswordError == ""
		) {
		
		echo "salvestan...<br>";
		echo "kasutaja ".$signupUsername."<br>";
		echo "email ".$signupEmail."<br>";
		echo "parool ".$_POST["signupPassword"]."<br>";
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo "räsi ".$password."<br>";
		
		signup($signupUsername, $signupEmail, $password);
		
		}
		
	}
	
	$notice = "";
		// mõlemad login vormi väljad on täidetud
		if (	isset($_POST["loginEmail"]) && 
				isset($_POST["loginPassword"]) && 
				!empty($_POST["loginEmail"]) && 
				!empty($_POST["loginPassword"]) 
		) {
			$notice = login($_POST["loginEmail"], $_POST["loginPassword"]);
			
		}

	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sisselogimise leht</title>
</head>
<body>

	<h1>Logi sisse</h1><br>
	<p style="color:red;"><?php echo $notice; ?></p>
	<form method="POST">
		<input placeholder="Kasutajanimi / Email" name="loginEmail" type="text"><br><br>
		<input placeholder="Parool" name="loginPassword" type="password"><br><br>
		<input type="submit" value="Logi sisse">
	</form>
	<h1>Loo kasutaja</h1><br>
	<form method="POST">
		<input placeholder="Kasjutajanimi" name="signupUsername" type="username" value="<?php echo $signupUsername ?>"><?php echo $signupUsernameError; ?><br><br>
		<input placeholder="Email" name="signupEmail" type="email" value="<?php echo $signupEmail ?>"><?php echo $signupEmailError; ?><br><br>
		<input placeholder="Parool" name="signupPassword" type="password"><?php echo $signupPasswordError; ?><br><br>
		<input type="submit" value="Loo kasutaja">
	</form>

</body>
</html>