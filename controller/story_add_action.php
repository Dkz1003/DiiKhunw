<?php
    require_once(__DIR__."/../connect.php"); // ket noi CSDL
    session_start();
    $storyName = $_POST["StoryName"];
    $storyDesc = $_POST["StoryDesc"];

    $AuName = $_POST["AuName"];
    $sql1 = "SELECT AuID FROM authors";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        $row = $result1->fetch_assoc();
        $AuID = $row['AuID'];
    }
    if ($_POST['StoryStatus'] =="on") {
        $StoryStatus = 1; 
    } else {
        $StoryStatus = 0;
    }

    $sql = "select MAX(StoryID) from stories ";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        //print_r($row);
        $NewID = $row["MAX(StoryID)"] + 1; 
    }
    
    $CateName = $_POST["CateName"];
    $sql2 = "SELECT CateID FROM categories WHERE CateName = '$CateName'";
    $result2 = $conn->query($sql2);
    // lấy id danh mục
    if ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
        $CateID = $row['CateID'];
    }

            $storyImage = array();
            foreach ($_FILES["imageStory"]["name"] as $name) {
                array_push($storyImage, "image/".$NewID."/".$name);
            }
            $storyImage = json_encode($storyImage);

                $sql = "INSERT INTO stories (StoryName, StoryDes, StoryImage, StoryStatus, StoryDate, CateID, AuID)
                VALUES ('$storyName','$storyDesc', '$storyImage','$StoryStatus',CURDATE(),'$CateID','$AuID')";
                $conn->query($sql) ;
                if($conn->error==""){		
                    $duong_dan_day_du = __DIR__."/../image/$NewID"."/";
                    // Tạo thư mục mới
                    if (!file_exists($duong_dan_day_du)) {
                        mkdir($duong_dan_day_du, 0777, true); // 0777 là quyền truy cập, true để tạo cả các thư mục cha nếu chưa tồn tại
                    }
                    
                    for($i=0; $i<count($_FILES["imageStory"]["name"]); $i++){
                        $ImageTourCopy = $duong_dan_day_du.$_FILES["imageStory"]["name"][$i];
                        copy($_FILES['imageStory']['tmp_name'][$i],$ImageTourCopy);
                        
                        //move_uploaded_file($_FILES['StoryImage']['tmp_name'][$i],$duong_dan_day_du.$_FILES["StoryImage"]["name"][$i]);
                    }
        
                    $_SESSION["story_add_error"] ="<div class=\"container container-fluid alert alert-success\" role=\"alert\">Thêm Thành Công</div>";
                } else {
                   
                    $_SESSION["story_add_error"] ="<div class=\"container container-fluid alert alert-warning\" role=\"alert\">Lỗi Khi Thêm</div>";
                }

        
        
        header("Location:/../QLDA/admin/?page_layout=quan_ly_truyen");

?>