<?php
	session_start();
	require_once("connect.php"); 
	$MemID = $_GET["MemID"];
	$MemName = $_POST["txtMemName"];
	$MemEmail = $_POST["txtMemEmail"];
	if( !$MemName || !$MemEmail){
		 echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
		 exit;
	}
	$sql = "select * from member where MemEmail like '$MemEmail' and MemID<>$MemID";
	$result = $conn->query($sql);
	if ($result->num_rows>0){
		echo "Email đã được đăng ký. <a href='javascript: history.go(-1)'>Trở lại</a>";
		exit;
	}else{
		$sql ="update member set
				MemName = '$MemName',
				MemEmail = '$MemEmail'
			where MemID=$MemID";
		$conn->query($sql) or die($conn->error);
		if ($conn->error==""){
			$_SESSION["login"] = true;
			$_SESSION["MemName"] = $MemName;
			$_SESSION["MemID"] = $MemID;
			if ($_SESSION["login"]==true){
				header("Location:/../QLDA/index.php");
			} else {
				header("Location:/../QLDA/index.php");
			}
		} else {
			echo "Lỗi. <a href='javascript: history.go(-1)'>Trở lại</a>";
			exit;
		}
	}
	
?>