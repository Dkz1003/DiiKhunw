<?php
require_once(__DIR__."/../connect.php");
if (!isset($_SESSION["Category_session"])){
		$_SESSION["Category_session"]="";
}

$CateID= $_GET["CateID"];
$sql1 ="select * from categories where CateID=$CateID";
$rs1 = $conn->query($sql1);
$row1 = $rs1->fetch_assoc();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Sửa Danh Mục</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    </head>

    <body>
        <h1 class="container text-primary text-center"> Chỉnh Sửa Danh Mục</h1>
        <div class="row">
            <div class="col-sm-10"></div>
            <a href="/QLDA/admin/?page_layout=quan_ly_danh_muc" class="col-sm-1 btn btn-secondary">Trở Về</a>
        </div>
        <form method="post" action="/../QLDA/controller/categories_action.php?action=edit&CateID=<?php echo $CateID ?>" class="container container-fluid" onsubmit="return validateForm()" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="CateName" class="form-label">Tên Danh Mục</label>
                <input type="text" class="form-control" id="CateName" name="CateName" value="<?php echo $row1["CateName"] ?>">
            </div>
            <div class="form-check">
                <?php 
                    if($row1['CateStatus']==1){
                        echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"CateStatus\" id=\"CateStatus\" checked>
                            <label class=\"form-check-label\" for=\"CateStatus\">
                            Hoạt Động
                            </label>";
                    }else {
                        echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"CateStatus\" id=\"CateStatus\">
                            <label class=\"form-check-label\" for=\"CateStatus\">
                            Hoạt Động
                            </label>";
                    }
                ?>
            </div>
            <div class="row">
                <div class="col-11"></div>
                <button  type="submit" class="btn btn-primary col-1">Sửa</button>
            </div>
        </form>
    </body>
    </html>