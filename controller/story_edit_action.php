<?php
require_once(__DIR__."/../connect.php"); // Kết nối CSDL
session_start();

$storyID = $_GET["StoryID"];
$storyImage = array();
if (!empty($_FILES["storyImage"]["name"])) {
    foreach ($_FILES["storyImage"]["name"] as $name) {
        array_push($storyImage, "image/".$storyID."/".$name);
    }
    // Kiểm tra nếu mảng không rỗng
    if (!empty($storyImage)) {
        // Chuyển đổi mảng thành chuỗi JSON
        $storyImageJSON = json_encode($storyImage);
        // Gỡ bỏ dấu ngoặc vuông từ chuỗi JSON
        $storyImageJSON = substr($storyImageJSON, 1, -1);
        // Sau khi gỡ bỏ dấu ngoặc vuông, bạn có thể gỡ bỏ dấu ngoặc kép từ chuỗi JSON
        $storyImageJSON = str_replace('"', '', $storyImageJSON);

    }
}

$storyName = $_POST["StoryName"];
$storyDesc = $_POST["StoryDes"];
$CateName = $_POST["CateName"]; 
$AuName = $_POST["AuName"];
$CateID = null;
if ($_POST['StoryStatus'] =="on") {
    $StoryStatus = 1; 
} else {
    $StoryStatus = 0;
}

$CateName = $_POST["CateName"];
$sql2 = "SELECT CateID FROM categories WHERE CateName = '$CateName'";
$result2 = $conn->query($sql2);
// lấy id danh mục
if ($result2->num_rows > 0) {
    $row = $result2->fetch_assoc();
    $CateID = $row['CateID'];
}

$sql = "UPDATE stories as s JOIN authors as a on s.AuID = a.AuID
        SET 
            s.StoryName = '$storyName', 
            s.StoryDes = '$storyDesc',
            s.StoryImage = '$storyImageJSON',
            s.StoryStatus = '$StoryStatus',
            s.CateID = '$CateID',
            a.AuName = '$AuName'
        WHERE 
            s.StoryID = '$storyID'";
$conn->query($sql);
if ($conn->error == "") {
    $duong_dan_day_du = __DIR__."/../image/$storyID"."/";
    // Tạo thư mục mới
    if (!file_exists($duong_dan_day_du)) {
        mkdir($duong_dan_day_du, 0777, true); // 0777 là quyền truy cập, true để tạo cả các thư mục cha nếu chưa tồn tại
        for ($i = 0; $i < count($_FILES["storyImage"]["name"]); $i++) {
            move_uploaded_file($_FILES['storyImage']['tmp_name'][$i], $duong_dan_day_du.$_FILES["storyImage"]["name"][$i]);
        }
    } else {
        $files = glob($duong_dan_day_du . '*');
        foreach ($files as $file) {
            // Kiểm tra xem là file không phải là thư mục
            if (is_file($file)) {
                // Sử dụng hàm unlink để xóa file
                if (unlink($file)) {
                    echo 'File ' . basename($file) . ' đã được xóa thành công.<br>';
                } else {
                    echo 'Không thể xóa file ' . basename($file) . '.<br>';
                }
            }
        }
        for ($i = 0; $i < count($_FILES["storyImage"]["name"]); $i++) {
            move_uploaded_file($_FILES['storyImage']['tmp_name'][$i], $duong_dan_day_du.$_FILES["storyImage"]["name"][$i]);
        }
    }

    $_SESSION["story_add_error"] = "<div class=\"container container-fluid alert alert-success\" role=\"alert\">Sửa Thành Công</div>";
    header("Location:/../QLDA/admin/?page_layout=quan_ly_truyen");
} else {
    $_SESSION["story_add_error"] = "<div class=\"container container-fluid alert alert-warning\" role=\"alert\">LỖI</div>";
    header("Location:/../QLDA/admin/?page_layout=quan_ly_truyen");
    echo $conn->error;
    die();
}
?>
