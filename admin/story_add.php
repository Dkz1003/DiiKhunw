<?php
require_once(__DIR__."/../connect.php");
session_start();
if (!isset($_SESSION["story_add_error"])){
		$_SESSION["story_add_error"]="";
	
}
$sql1 ="select * from categories where CateStatus = 1";
$rs1 = $conn->query($sql1);



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Thêm Truyện</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/Dattourdulich/js/TextArea.js"></script>
        <script>function checkFile() {
            var fileInput = document.getElementById('imageTour');
            // Kiểm tra xem có file nào được chọn hay không
            if (fileInput.files.length < 0) {
                alert('Vui lòng chọn ảnh truyện');
            }
        }
        function validateForm() {
            var fileInput = document.getElementById('imageStory');
            
            // Kiểm tra xem có file nào được chọn hay không
            if (fileInput.files.length === 0) {
                alert('Vui lòng chọn ít nhất một file cho ảnh Truyện.');
                return false; // Ngăn chặn biểu mẫu được gửi đi
            }

            var CateNames = document.getElementById('CateName');
            var CateName = CateNames.value;
            if (CateName === "Chọn Loại Truyện") {
                alert('Vui lòng chọn loại Truyện.');
                return false; // Ngăn chặn biểu mẫu được gửi đi
            }
            // Thêm các điều kiện kiểm tra khác nếu cần thiết
            
            return true; // Cho phép biểu mẫu được gửi đi
            }

        </script>
    </head>

    <body>
        <alert class="container container-fluid "><?php echo $_SESSION["story_add_error"] ?></alert>
        <h1 class="container text-primary text-center"> THÊM TRUYỆN</h1>
        <div class="row">
            <div class="col-sm-10"></div>
            <a href="/QLDA/admin/?page_layout=quan_ly_truyen" class="col-sm-1 btn btn-secondary">Trở Về</a>
        </div>
        <form method="post" action="/../QLDA/controller/story_add_action.php" class="container container-fluid" onsubmit="return validateForm()" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="StoryName" class="form-label">Tên Truyện</label>
                <input type="text" class="form-control" id="StoryName" name="StoryName" required>
            </div>
            <div class="mb-3">
                <label for="StoryDesc" class="form-label">Mô Tả</label>
                <textarea id="myTextarea" name="StoryDesc"></textarea>
            </div>
            <div class="mb-3">
                <label for="imageStory" class="form-label">Ảnh Truyện</label>
                <input class="form-control" type="file" id="imageStory" name="imageStory[]" multiple required>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="StoryStatus" id="StoryStatus" checked>
                <label class="form-check-label" for="StoryStatus">
              Hoạt Động
            </label>
            </div>
            <div class="mb-3"><select class="form-select" aria-label="Default select example" id="CateName" name="CateName" >
            <option selected >Chọn Loại Truyện</option>
            <?php
            if ($rs1->num_rows > 0) {
                while ($row = $rs1->fetch_assoc()) {
                    echo "<option value='" . $row['CateName'] . "'>" . $row['CateName'] . "</option>";
                }
            } else {
                echo "<option value=''>Không có dữ liệu</option>";
            }
            ?>          
        </select></div>

             <div class="mb-3">
                <label for="AuName" class="form-label">Tác giả</label>
                <input type="text" class="form-control" id="AuName" name="AuName" required>
            </div>
            <div class="row">
                <div class="col-11"></div>
                <button type="submit" class="btn btn-success col-1">Thêm</button>
            </div>
        </form>
    </body>
    <?php 
	$_SESSION["story_add_error"]="";
?>
    </html>