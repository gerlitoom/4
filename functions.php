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
	
	$database = "if16_gerltoom";
	
	
	
	function signup($email, $password) {
		
		$mysqli = new mysqli(
		
		$GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"],  
		$GLOBALS["serverPassword"],  
		$GLOBALS["database"]
		
		);
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		echo $mysqli->error;
		
		$stmt->bind_param("ss", $email, $password );
		if ( $stmt->execute() ) {
			echo "salvestamine õnnestus";	
		} else {	
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	
	function login($email, $password) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"],  $GLOBALS["serverPassword"],  $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("
		
			SELECT id, email, password, created
			FROM user_sample
			WHERE email = ?
		
		");
		// asendan ?
		$stmt->bind_param("s", $email);
		
		// määran muutujad reale mis kätte saan
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		
		$stmt->execute();
		
		// ainult SLECTI'i puhul
		if ($stmt->fetch()) {
			
			// vähemalt üks rida tuli
			// kasutaja sisselogimise parool räsiks
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb) {
				// õnnestus 
				echo "Kasutaja ".$id." logis sisse";
				
			} else {
				echo "Vale parool!";
			}
			
		} else {
			// ei leitud ühtegi rida
			echo "Sellist emaili ei ole!";
		}
	}
	
	
?>