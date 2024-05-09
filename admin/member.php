<?php
    require_once(__DIR__."/../connect.php");
    session_start();
    if (!isset($_SESSION["Member_session"])){
        $_SESSION["Member_session"]="";
    }
    if (!isset($_REQUEST["page"])){
		$page=1;
	} else { 
		$page = $_REQUEST["page"];
	}
    $num_row = 20;
    $sql1 = "SELECT * from member where MemStatus!=-1 ";
    $result1 = $conn->query($sql1) or die("Can't get recordset");
    $num_of_page=ceil(($result1->num_rows / $num_row));
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
    <script src="/../js/Member.js"></script>
    <title>Admin</title>
</head>

<body>
    <!-- phan nay -->
    <div class="container-fluid px-4">
            <div class="row my-1">
                <h3 class="fs-4 mb-3 col-sm-10 ">Thành Viên</h3>
                <a class="btn btn-success mb-3 col-sm-1" href="member_add.php">Thêm</a>
                <div class="col">
                    <alert class="container container-fluid ">
                        <?php echo $_SESSION["Member_session"] ?>
                    </alert>
                    <table class="container container-fluid table">
                        <thead>
                            <tr>
                                <th scope="col">Mã thành viên</th>
                                <th scope="col">Tên thành viên</th>
                                <th scope="col">Mật khẩu</th>
                                <th scope="col">Email</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $sql = "SELECT * from member where MemStatus!=-1 limit ".$num_row*($page - 1).",".$num_row;
                                    $result = $conn->query($sql) or die("Can't get recordset");
                                    if($result->num_rows>0){
                                        while($row = $result->fetch_assoc()){
                                ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $row['MemID'];?>
                                    </th>
                                    <td>
                                        <?php echo $row['MemName'];?>
                                    </td>
                                    <td>
                                        <?php echo $row['MemPassword'];?>
                                    </td>
                                    <td>
                                        <?php echo $row['MemEmail'];?>
                                    </td>
                                    <td>
                                        <?php if($row["MemStatus"]==1){
                                                    echo '<p class="text-success">Đang Hoạt Động</p>';
                                                }else {
                                                    echo '<p class="text-danger">Ngưng Hoạt Động</p>';
                                                }; ?>
                                    </td>
                                    <td>
                                        <a href="member_edit.php?MemID=<?php echo $row["MemID"];?>" class="btn btn-primary">Sửa</a>
                                    </td>
                                    <td>
                                        <a href="/../QLDA/controller/member_action.php?action=remove&MemID=<?php echo $row["MemID"];?>" id="deleteBtn" class="btn btn-danger" onclick="confirmDelete()">Xóa</a>
                                    </td>
                                </tr>
                                <?php 
                            }
                        }
                                        
                    ?>
                        </tbody>
                    </table>
                    <nav aria-label="...">
                        <ul class="pagination justify-content-center">
                            <?php 
                                if($page == 1){
                                   
                                }else{
                                    $p = $page - 1;
                                    echo "  <li class=\"page-item\">
                                                <a class=\"page-link\" href=\"?page_layout=quan_ly_thanh_vien&page=$p\">Previous</a>        
                                            </li> ";
                                }
                                for($i=1;$i<=$num_of_page;$i++){
                                    if ($i == $page){
                                        echo "  <li class=\"page-item active\">
                                                    <a class=\"page-link \" href=\"?page_layout=quan_ly_thanh_vien&page=$i\">$i</a>        
                                                </li> ";
                                    } else {
                                        echo "  <li class=\"page-item\">
                                                    <a class=\"page-link\" href=\"?page_layout=quan_ly_thanh_vien&page=$i\">$i</a>        
                                                </li> ";
                                    }
                                    
                                }
                                if($page == $num_of_page){
                                    
                                }else{
                                    $p =$page + 1;
                                    echo "  <li class=\"page-item\">
                                                <a class=\"page-link\" href=\"?page_layout=quan_ly_thanh_vien&page=$p\">Next</a>        
                                            </li> ";
                                }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <?php 
                        $_SESSION["Member_session"]="";
                    ?>
            <!--  -->

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
    $_SESSION["Member_session"]="";
?>