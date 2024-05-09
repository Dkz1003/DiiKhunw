<?php 
    require_once(__DIR__."/../connect.php");
    session_start();
    if (!isset($_SESSION["Comment_session"])){
        $_SESSION["Comment_session"]="";
    }
    if (isset($_GET['action'])){
        switch ($_GET['action']){
            case 'add':{
                break;
            }
            case 'edit':{
                break;
            }
            case 'remove':{
                $ComID =$_GET['ComID'];
                $sql = "update comment set ComStatus=-1 where ComID=$ComID";
                $conn->query($sql) ;
                if($conn->error==""){
                    $_SESSION["Comment_session"] ="<div class=\"container container-fluid alert alert-success\" role=\"alert\">Xóa Thành Công</div>";
                    header("Location:/../../QLDA/admin/?page_layout=quan_ly_binh_luan");
                } else {
                    $_SESSION["Comment_session"] ="<div class=\"container container-fluid alert alert-warning\" role=\"alert\">Lỗi Khi Xóa</div>";
                    header("Location:/../../QLDA/admin/?page_layout=quan_ly_binh_luan");
                }
                break;
            }
        }
    }
    
?>