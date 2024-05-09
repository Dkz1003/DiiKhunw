<?php
require_once(__DIR__."/../connect.php");
session_start();
if (!isset($_SESSION["Member_session"])){
		$_SESSION["Member_session"]="";
	
}
$MemID= $_GET["MemID"];
$sql1 ="select * from member where MemID=$MemID";
$rs1 = $conn->query($sql1);
$row1 = $rs1->fetch_assoc();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Sửa Thành Viên</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>

        </script>
    </head>

    <body>
        <alert class="container container-fluid "><?php echo $_SESSION["Member_session"] ?></alert>
        <h1 class="container text-primary text-center"> THÊM THÀNH VIÊN</h1>
        <div class="row">
            <div class="col-sm-10"></div>
            <a href="/../QLDA/admin/?page_layout=quan_ly_thanh_vien" class="col-sm-1 btn btn-secondary">Trở Về</a>
        </div>
        <form method="post" action="/../QLDA/controller/member_action.php?action=edit&MemID=<?php echo $row1['MemID'] ?>" class="container container-fluid" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="MemName" class="form-label">Tên Thành Viên</label>
                <input type="text" class="form-control" id="MemName" name="MemName" value="<?php echo $row1['MemName'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="MemPassword" class="form-label">Mật Khẩu</label>
                <input type="text" class="form-control" id="MemPassword" name="MemPassword" value="<?php echo $row1['MemPassword'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="MemEmail" class="form-label">Email</label>
                <input type="text" class="form-control" id="MemEmail" name="MemEmail" value="<?php echo $row1['MemEmail'] ?>" required>
            </div>
            <div class="form-check">
                <?php 
                    if($row1['MemStatus']==1){
                        echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"MemStatus\" id=\"MemStatus\" checked>
                            <label class=\"form-check-label\" for=\"MemStatus\">
                            Hoạt Động
                            </label>";
                    }else {
                        echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"MemStatus\" id=\"MemStatus\">
                            <label class=\"form-check-label\" for=\"MemStatus\">
                            Hoạt Động
                            </label>";
                    }
                ?>
            </div>

            <div class="row">
                <div class="col-11"></div>
                <button type="submit" class="btn btn-primary col-1">Sửa</button>
            </div>
        </form>
    </body>
    </html>