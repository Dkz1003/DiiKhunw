<?php 
	session_start();
	require_once("connect.php");

	$MemEmail = $_POST['txtMemEmail'];
	$MemPassword = $_POST['txtMemPassword'];

	// Truy vấn dữ liệu admin từ bảng admin
	$adminResult = $conn->query("SELECT * FROM admin");
	if ($adminResult->num_rows > 0) {
		$row = $adminResult->fetch_assoc(); // Lấy ra dòng dữ liệu đầu tiên trong kết quả truy vấn
		$AdUserName = $row['AdUserName']; 
		$AdPassword = $row['AdPassWord'];

		// So sánh tên đăng nhập và mật khẩu với admin
		if($MemEmail == $AdUserName && $MemPassword == $AdPassword){
			header("Location: ../admin");
		} else {
			// Nếu không phải là admin, kiểm tra trong bảng member
			$result = $conn->query("SELECT * FROM member WHERE MemEmail='$MemEmail' AND MemPassword='$MemPassword'");
			if($result->num_rows > 0){
				$row = $result->fetch_assoc();
				$_SESSION["login_error"] = "";
				$_SESSION["login"] = true;
				$_SESSION["MemName"] = $row["MemName"];
				$_SESSION["MemID"] = $row["MemID"];
				header("Location: /../QLDA/index.php");
			} else {
				$_SESSION["login_error"] = "Email hoặc mật khẩu không đúng";
				$_SESSION["login"] = false;
				$_SESSION["MemName"] = "";
				$_SESSION["MemID"] = "";
				header("Location: login.php");
			}
		}
	} else {
		echo "Không có dữ liệu admin";
	}
?>
