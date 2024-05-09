<?php
require_once(__DIR__."/../connect.php");
session_start();
if (!isset($_SESSION["story_add_error"])){
		$_SESSION["story_add_error"]="";
	
}
$storyID= $_GET["StoryID"];

$sql1 ="select * from categories where CateStatus =1";
$rs1 = $conn->query($sql1); 

$sql2 = "SELECT *
         FROM stories AS s
         JOIN authors AS a ON s.AuID = a.AuID
         JOIN chapter AS c ON s.StoryID = c.StoryID
         WHERE s.StoryID = ".$storyID."";

$rs2 = $conn->query($sql2);
if ($rs2->num_rows > 0) {
    $row2 = $rs2->fetch_assoc();     
    $CateID = $row2['CateID'];
}

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Sua</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>function validateForm() {
            var fileInput = document.getElementById('imagestory');
            
            // Kiểm tra xem có file nào được chọn hay không
            if (fileInput.files.length === 0) {
                alert('Vui lòng chọn ít nhất một file cho ảnh truyện.');
                return false; // Ngăn chặn biểu mẫu được gửi đi
            }

            var CateNames = document.getElementById('CateName');
            var CateName = CateNames.value;
            if (CateName === "Thể loại") {
                alert('Vui lòng chọn thể loại.');
                return false; // Ngăn chặn biểu mẫu được gửi đi
            }
            // Thêm các điều kiện kiểm tra khác nếu cần thiết
            
            return true; // Cho phép biểu mẫu được gửi đi
            }
        </script>
    </head>

    <body>
        <alert class="container container-fluid "><?php echo $_SESSION["story_add_error"] ?></alert>
        <h1 class="container text-primary text-center"> Sửa truyện <?php echo $row2["StoryName"]?></h1>
        <div class="row">
            <div class="col-sm-10"></div>
            <a href="/QLDA/admin/?page_layout=quan_ly_truyen" class="col-sm-1 btn btn-secondary">Trở Về</a>
        </div>
        <form method="post" action="/../QLDA/controller/story_edit_action.php?StoryID=<?php echo $storyID ?>" class="container container-fluid" onsubmit="return validateForm()" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="StoryName" class="form-label">Tên truyện</label>
                <input type="text" class="form-control" id="StoryName" name="StoryName" value="<?php echo $row2["StoryName"] ?>">
            </div>
            <div class="mb-3">
                <label for="StoryDes" class="form-label">Mô Tả</label>
                <textarea id="myTextarea" name="StoryDes"><?php echo $row2["StoryDes"] ?></textarea>
                <?php  ?>
            </div>
            <div class="mb-3">
                <label for="storyImage" class="form-label">Ảnh</label>
                <input class="form-control" type="file" id="storyImage" name="storyImage[]"  multiple>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="StoryStatus" id="StoryStatus" checked>
                <label class="form-check-label" for="StoryStatus">
              Hoạt Động
            </label>
            </div>
            <div class="mb-3"><select class="form-select" aria-label="Default select example" id="CateName" name="CateName">
            <option >Thể loại</option>
            <?php
            if ($rs1->num_rows > 0) {
                while ($row = $rs1->fetch_assoc()) {
                    if($row['CateID'] != $row2['CateID']){
                        echo "<option value='" . $row['CateName'] . "'>" . $row['CateName'] . "</option>";
                    }else{
                        echo "<option value='" . $row['CateName'] . "' selected>" . $row['CateName'] . "</option>";
                    }
                }
            } else {
                echo "<option value=''>Không có dữ liệu</option>";
            }
            ?>
                        
        </select></div>
        <div class="mb-3">
                <label for="AuthorName" class="form-label">Tác giả</label>
                <input type="text" class="form-control" id="AuName" name="AuName" value="<?php echo $row2["AuName"] ?>">
            </div>

            <div class="row">
                <div class="col-11"></div>
                <button  type="summit" class="btn btn-primary col-1">Sửa</button>
            </div>
        </form>
            
    </body>
    <?php 
	$_SESSION["story_add_error"]="";
?>
    </html>