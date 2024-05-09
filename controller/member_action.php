<?php 
    require_once(__DIR__."/../connect.php");
    session_start();
    if (!isset($_SESSION["Member_session"])){
        $_SESSION["Member_session"]="";
    }
    if (isset($_GET['action'])){
        switch ($_GET['action']){
            case 'add':{
                $MemName = $_POST['MemName'];
                $MemPassword = $_POST['MemPassword'];
                $MemEmail = $_POST['MemEmail'];
                if($_POST['MemStatus'] =="on"){
                    $MemStatus = 1;
                }else {
                    $MemStatus= 0;
                }
                $sql = "INSERT INTO Member 
                (MemName, MemPassword, MemEmail, MemStatus)
                VALUES
                ('$MemName', '$MemPassword', '$MemEmail', $MemStatus)";
                $conn->query($sql) ;
                if($conn->error==""){
                    $_SESSION["Member_session"] ="<div class=\"container container-fluid alert alert-success\" role=\"alert\">Thêm Thành Công</div>";
                    header("Location:/../QLDA/admin/?page_layout=quan_ly_thanh_vien");
                } else {
                    $_SESSION["Member_sessioqn"] ="<div class=\"container container-fluid alert alert-warning\" role=\"alert\">Lỗi Khi Thêm</div>";
                    header("Location:/../QLDA/admin/?page_layout=quan_ly_thanh_vien");
                }
                break;
            }
            case 'edit':{
                $MemID = $_GET["MemID"];
                $MemName = $_POST["MemName"];
                $MemPassword = $_POST["MemPassword"];
                $MemEmail = $_POST["MemEmail"];
                if($_POST['MemStatus'] =="on"){
                    $MemStatus = 1;
                }else {
                    $MemStatus= 0;
                }
                    $sql = "update member set 
                    MemName = '$MemName',
                    MemPassword = '$MemPassword',
                    MemEmail = '$MemEmail',
                    MemStatus = '$MemStatus'
                        where MemID = $MemID";
                        $conn->query($sql) or die($conn->error);
                        if($conn->error==""){
                            $_SESSION["Member_session"] ="<div class=\"container container-fluid alert alert-success\" role=\"alert\">Sửa Thành Công</div>";
                            header("Location:/../QLDA/admin/?page_layout=quan_ly_thanh_vien");
                        } else {
                            $_SESSION["Member_session"] ="<div class=\"container container-fluid alert alert-warning\" role=\"alert\">Lỗi Khi Sửa</div>";
                            header("Location:/../QLDA/admin/?page_layout=quan_ly_thanh_vien");
                        }
                break;
            }
            case 'remove':{
                $MemID =$_GET['MemID'];
                $sql = "update member set MemStatus=-1 where MemID=$MemID";
                $conn->query($sql) ;
                if($conn->error==""){
                    $_SESSION["Member_session"] ="<div class=\"container container-fluid alert alert-success\" role=\"alert\">Xóa Thành Công</div>";
                    header("Location:/../QLDA/admin/?page_layout=quan_ly_thanh_vien");
                } else {
                    $_SESSION["Member_session"] ="<div class=\"container container-fluid alert alert-warning\" role=\"alert\">Lỗi Khi Xóa</div>";
                    header("Location:/../QLDA/admin/?page_layout=quan_ly_thanh_vien");
                }
                break;
            }
        }
    }
    
?>