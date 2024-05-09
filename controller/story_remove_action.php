<?php
    require_once(__DIR__."/../connect.php"); // ket noi CSDL
    session_start();
    $StoryID = $_GET["StoryID"];
        $sql = "update stories set StoryStatus=-1 WHERE StoryID = '$StoryID'";
        $conn->query($sql) or die($conn->error);
        if($conn->error==""){
            if($conn->error==""){
                $_SESSION["story_add_error"] ="<div class=\"container container-fluid alert alert-success\" role=\"alert\">Xóa Thành Công</div>";
                header("Location:/../QLDA/admin/?page_layout=quan_ly_truyen");
            }else {
                $_SESSION["story_add_error"] ="<div class=\"container container-fluid alert alert-warning\" role=\"alert\">LỖI</div>";
                header("Location:/../QLDA/admin/?page_layout=quan_ly_truyen");
            }
        }
?>