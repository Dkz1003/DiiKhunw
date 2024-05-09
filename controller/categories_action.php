<?php 
    require_once(__DIR__."/../connect.php");
    session_start();
    if (isset($_GET['action'])){
        switch ($_GET['action']){
            case 'add':{
                $CateName =$_POST['CateName'];
                $sql = "INSERT INTO Categories (CateName, CateStatus) 
                VALUES ('$CateName', 1)";
                $conn->query($sql) ;
                if($conn->error==""){
                    $_SESSION["Category_session"] ="<div class=\"container container-fluid alert alert-success\" role=\"alert\">Thêm Thành Công</div>";
                    header("Location:/../QLDA/admin/?page_layout=quan_ly_danh_muc");
                } else {
                    $_SESSION["Category_session"] ="<div class=\"container container-fluid alert alert-warning\" role=\"alert\">Lỗi Khi Thêm</div>";
                    header("Location:/../QLDA/admin/?page_layout=quan_ly_danh_muc");
                }
                break;
            }
            case 'edit':{
                $CateID =$_GET['CateID'];
                $CateName = $_POST['CateName'];
                if($_POST['CateStatus'] =="on"){
                    $CateStatus = 1;
                }else {
                    $CateStatus= 0;
                }
                $sql = "update Categories set CateName='$CateName',CateStatus=$CateStatus where CateID=$CateID";
                $conn->query($sql) ;
                if($conn->error==""){
                    $_SESSION["Category_session"] ="<div class=\"container container-fluid alert alert-success\" role=\"alert\">Sửa Thành Công</div>";
                    header("Location:/../QLDA/admin/?page_layout=quan_ly_danh_muc");
                } else {
                    $_SESSION["Category_session"] ="<div class=\"container container-fluid alert alert-warning\" role=\"alert\">Lỗi Khi sửa</div>";
                    header("Location:/../QLDA/admin/?page_layout=quan_ly_danh_muc");
                }
                break;
            }
            case 'remove':{
                $CateID =$_GET['CateID'];
                $sql = "update Categories set CateStatus=-1 where CateID=$CateID";
                $conn->query($sql) ;
                if($conn->error==""){
                    $_SESSION["Category_session"] ="<div class=\"container container-fluid alert alert-success\" role=\"alert\">Xóa Thành Công</div>";
                    header("Location:/../QLDA/admin/?page_layout=quan_ly_danh_muc");
                    exit();
                } else {
                    $_SESSION["Category_session"] ="<div class=\"container container-fluid alert alert-warning\" role=\"alert\">Lỗi Khi xóa</div>";
                    header("Location:/../QLDA/admin/?page_layout=quan_ly_danh_muc");
                }
                break;
            }
        }
    }
    
?>