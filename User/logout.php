<?php 
	session_start();
	if(isset($_SESSION["login"])){
		session_destroy();
		header('location: /../QLDA/index.php');
	} else{
		header('location: /../QLDA/index.php');
	}
?>