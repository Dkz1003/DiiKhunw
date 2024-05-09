<?php
	session_start();
	require_once("connect.php"); 
	$MemName = $_POST["txtMemName"];
	$MemPassword = $_POST["txtMemPassword"];
	$MemEmail = $_POST["txtMemEmail"];
	
	if( !$MemName || !$MemPassword || !$MemEmail){
		 echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
		 exit;
	}
	$MemPassword=($MemPassword);
	$sql = "select * from member where MemEmail like '$MemEmail'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
        echo "Email này đã có người dùng. Vui lòng chọn Email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
		exit;	
	}
	$sql1 ="insert into member(MemName,MemPassword,MemEmail,MemStatus) values ('$MemName','$MemPassword','$MemEmail',1)";
	$conn->query($sql1) or die($conn->error);
	$slq ="select * from member";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
	$_SESSION["login"] = true;
	$_SESSION["MemName"] = $MemName;
	$_SESSION["MemID"] = $row["MemID"];
	}
	if ($_SESSION["login"]==true){
		header("Location: /../QLDA/index.php");
	} else {
		header("Location:/../QLDA/index.php");
	}
	
	
?>