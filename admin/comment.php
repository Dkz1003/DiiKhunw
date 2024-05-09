<?php
    require_once(__DIR__."/../connect.php");
    session_start();
    if (!isset($_SESSION["Comment_session"])){
        $_SESSION["Comment_session"]="";
    }
    if (!isset($_REQUEST["page"])){
        $page=1;
    } else { 
        $page = $_REQUEST["page"];
    }
    $num_row = 20;
    $sql1 = "SELECT * from comment where ComStatus!=-1 ";
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
    <title>Admin</title>
</head>

<body>
    <!-- phan nay -->
    <div class="container-fluid px-4">
            <div class="row my-1">
                <h3 class="fs-4 mb-3">Bình Luận</h3>
                <div class="col">
                    <alert class="container container-fluid ">
                        <?php echo $_SESSION["Comment_session"] ?>
                    </alert>
                    <table class="container container-fluid table">
                        <thead>
                            <tr>
                                <th>Mã bình luận</th>
                                <th>Thời gian</th>
                                <th>Nội dung</th>
                                <th>Tên Truyện</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $sql = "SELECT * from comment as c
                                    join stories as s on c.StoryID = s.StoryID
                                    join member as m on c.MemID = m.MemID
                                    where ComStatus!=-1 limit ".$num_row*($page - 1).",".$num_row;
                                    $result = $conn->query($sql) or die("Can't get recordset");
                                    if($result->num_rows>0){
                                        while($row = $result->fetch_assoc()){
                                ?>
                                <tr>
                                    <td class="">
                                        <?php echo $row['ComID'];?>
                                    </td>
                                    <td>
                                        <?php echo $row['ComDate'];?>
                                    </td>
                                    <td>
                                        <?php echo $row['ComContent'];?>
                                    </td>
                                    <td>
                                        <?php echo $row['StoryName'];?>
                                    </td>
                                    <td>
                                        <?php echo $row['MemEmail'];?>
                                    </td>
                                    <td>
                                        <a href="/../QLDA/controller/BinhLuan_action.php?action=remove&ComID=<?php echo $row["ComID"];?>" id="deleteBtn" class="btn btn-danger" onclick="confirmDelete()">Xóa</a>
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
                                    echo "  <li class=\"page-item disabled\">
                                                <a class=\"page-link\">Previous</a>        
                                            </li> ";
                                }else{
                                    $p = $page - 1;
                                    echo "  <li class=\"page-item\">
                                                <a class=\"page-link\" href=\"?page_layout=quan_ly_binh_luan&page=$p\">Previous</a>        
                                            </li> ";
                                }
                                for($i=1;$i<=$num_of_page;$i++){
                                    if ($i == $page){
                                        echo "  <li class=\"page-item active\">
                                                    <a class=\"page-link \" href=\"?page_layout=quan_ly_binh_luan&page=$i\">$i</a>        
                                                </li> ";
                                    } else {
                                        echo "  <li class=\"page-item\">
                                                    <a class=\"page-link\" href=\"?page_layout=quan_ly_binh_luan&page=$i\">$i</a>        
                                                </li> ";
                                    }
                                    
                                }
                                if($page == $num_of_page){
                                    echo "  <li class=\"page-item disabled\">
                                                <a class=\"page-link\">Next</a>        
                                            </li> ";
                                }else{
                                    $p =$page + 1;
                                    echo "  <li class=\"page-item\">
                                                <a class=\"page-link\" href=\"?page_layout=quan_ly_binh_luan&page=$p\">Next</a>        
                                            </li> ";
                                }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
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
    $_SESSION["Comment_session"]="";
?>