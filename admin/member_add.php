<?php
session_start();
if (!isset($_SESSION["Member_session"])){
		$_SESSION["Member_session"]="";
	
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Thêm Thành Viên</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    </head>

    <body>
        <alert class="container container-fluid "><?php echo $_SESSION["Member_session"] ?></alert>
        <h1 class="container text-primary text-center"> THÊM THÀNH VIÊN</h1>
        <div class="row">
            <div class="col-sm-10"></div>
            <a href="/QLDA/admin/?page_layout=quan_ly_thanh_vien" class="col-sm-1 btn btn-secondary">Trở Về</a>
        </div>
        <form method="post" action="/../QLDA/controller/member_action.php?action=add" class="container container-fluid" onsubmit="return validateForm()" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="MemName" class="form-label">Tên Thành Viên</label>
                <input type="text" class="form-control" id="MemName" name="MemName" required>
            </div>
            <div class="mb-3">
                <label for="MemPassword" class="form-label">Mật Khẩu</label>
                <input type="text" class="form-control" id="MemPassword" name="MemPassword" required>
            </div>
            <div class="mb-3">
                <label for="MemEmail" class="form-label">Email</label>
                <input type="text" class="form-control" id="MemEmail" name="MemEmail" required>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="MemStatus" id="MemStatus" checked>
                <label class="form-check-label" for="MemStatus">
                Hoạt Động
                </label>
            </div>

            <div class="row">
                <div class="col-11"></div>
                <button type="submit" class="btn btn-success col-1">Thêm</button>
            </div>
        </form>
    </body>
    </html>