<?php
    require_once(__DIR__."/../connect.php");
    session_start();
    if (!isset($_SESSION["Category_session"])){
        $_SESSION["Category_session"]="";
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
    <link rel="stylesheet" href="style1.css" />
    <title>Admin</title>
</head>

<body>
    <!-- phan nay -->
    <div class="container-fluid px-4">
        
            <div class="row my-1">
                <h3 class="fs-4 mb-3">Danh Mục</h3>
                <div class="col">
                    <alert class="container container-fluid ">
                        <?php echo $_SESSION["Category_session"] ?>
                    </alert>
                    <table class="container container-fluid table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên Danh Mục</th>
                                <th scope="col">Trạng Thái</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $sql = "SELECT * from categories where CateStatus!=-1";
                                    $result = $conn->query($sql) or die("Can't get recordset");
                                    if($result->num_rows>0){
                                        while($row = $result->fetch_assoc()){
                                ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $row["CateID"];?>
                                    </th>
                                    <td>
                                        <?php echo $row["CateName"]; ?>
                                    </td>
                                    <td>
                                        <?php if($row["CateStatus"]==1){
                                                    echo '<p class="text-success">Đang Hoạt Động</p>';
                                                }else {
                                                    echo '<p class="text-danger">Ngưng Hoạt Động</p>';
                                                }; ?>
                                    </td>
                                    <td>
                                        <a href="Cate_edit.php?CateID=<?php echo $row['CateID'] ?>" class="btn btn-primary">Sửa</a>
                                    </td>
                                    <td>
                                        <a href="/../QLDA/controller/categories_action.php?action=remove&CateID=<?php echo $row["CateID"]; ?>" id="deleteBtn" class="btn btn-danger" onclick="confirmDelete()">Xóa</a>
                                    </td>
                                </tr>
                                <?php 
                            }
                        }
                                        
                    ?>
                                <tr>
                                    <form method="post" action="/../QLDA/controller/categories_action.php?action=add" onsubmit="return validateForm()" enctype="multipart/form-data">
                                        <th scope="row">
                                        </th>
                                        <td>
                                            <input type="text" class="form-control" id="CateName" name="CateName" placeholder="Tên Danh Mục">
                                        </td>
                                        <td>
                                            <button type="submit" id="deleteBtn" class="btn btn-success">Thêm</button>
                                        </td>
                                    </form>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--  -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
        
    </script>
</body>

</html>
<?php 
    $_SESSION["Category_session"]="";
?>