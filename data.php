<?php

	require("functions.php");
	
	if(!isset ($_SESSION["userId"])){
		
		header("Location: login.php");
		
	}

	if(isset($_GET["logout"])){
		
		session_destroy();
		header("Location: login.php");
		
	}
	
?>

<h1>Data</h1>
<p>Heluuu ! <?=$_SESSION["userEmail"];?></p>
<a href="?logout=1">Logi v�lja</a>