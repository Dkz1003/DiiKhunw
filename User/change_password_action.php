<?php
session_start();
require_once("connect.php");

if (isset($_POST['change_password'])) {
    
    $MemEmail = $_POST['txtMemEmail'];
    $old_password = $_POST['txtMemPassword_old'];
    $new_password = $_POST['txtMemPassword_new'];

    if (empty($MemEmail) || empty($old_password) || empty($new_password)) {
		echo"Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }

    $query = "SELECT * FROM member WHERE MemEmail = ? AND MemPassword = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $MemEmail, $old_password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
       
        $update_query = "UPDATE member SET MemPassword = ? WHERE MemEmail = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ss", $new_password, $MemEmail);
        $update_stmt->execute();
		header("Location:login.php");
        

    } else {
		echo"Đổi mật khẩu không thành công. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
} else {
    
    header("Location: login.php"); 
    exit();
}
?>
