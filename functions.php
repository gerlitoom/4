<?php
	/*function sum($x, $y){
		
		$answer = $x+$y;
		return $answer;
		
	}
	
	function hello($firstname, $lastname){
		
		return "Hello ".$firstname." ".$lastname.;
		
	}
	
	$firstname = "Gerli";
	$lastname = "Toom";
	
	echo sum(1246423, 23452453);
	echo"<br>";
	echo sum(1,2);
	echo "<br>";
	echo hello($firstname, $lastname);
	echo "<br>";
	*/
	
	function signup($username, $email, $password){
		
		$database = "if16_gerltoom";
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample (username, email, password) VALUES(?, ?, ?)");
		
		$stmt->bind_param("sss", $username, $email, $password);
		
		if ($stmt->execute() ) {
			
			echo "salvestamine onnestus";
			
		}
		else {
			echo "ERROR".$stmt->error;
		}
		
	}
	
?>