<?php
    require_once(__DIR__."/../connect.php");
    session_start();
    if (!isset($_SESSION["story_add_error"])){
        $_SESSION["story_add_error"]="";

    }
    if (!isset($_REQUEST["page"])){
        $page=1;
    } else { 
        $page = $_REQUEST["page"];
    }
    $num_row = 20;
    $sql1 = "SELECT *
    from stories where StoryStatus=1 ";
    $result1 = $conn->query($sql1) or die("Can't get recordset");
    $num_of_page=ceil(($result1->num_rows / $num_row));
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Danh Sách Truyện</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>
            function confirmDelete() {
            // Hiển thị hộp thoại xác nhận và lưu kết quả vào biến userConfirmed
                var userConfirmed = confirm("Bạn có chắc chắn muốn xóa không?");
                // Nếu người dùng chọn "OK" (đồng ý), chuyển đến đường dẫn href
                if (!userConfirmed) {
                    // Hủy bỏ mặc định chuyển đến href
                    event.preventDefault();
                }
            }
            function find() {
            var StoryName = document.getElementById('StoryName').value;
            window.location.href = '/../QLDA/admin/?page_layout=quan_ly_truyen&StoryName=' + encodeURIComponent(StoryName);
        }
        </script>
    </head>

    <body>
        <alert class="container container-fluid "><?php echo $_SESSION["story_add_error"] ?></alert>
        <h1 class="container container-fluid text-primary text-center">Danh sách truyện</h1>
        <form class="row container container-fluid">
            <div class="mb-3 col-sm-2">
                <label for="StoryName" class="form-label">Tên truyện</label>
                <input type="text" class="form-control" id="StoryName" name="StoryName">
            </div>
            <div class="mb-3 col-sm-1">
                <label for="StoryName" class="form-label">.</label>
                <a onclick="find()" class="btn btn-primary form-control">Tìm</a>
            </div>
            <div class="col-sm-7"></div>
            <div class="mb-3 col-sm-2">
                <label for="StoryName" class="form-label"></label>
                <a class="col-sm-1 btn btn-success form-control" href="/../QLDA/admin/story_add.php">Thêm truyện</a>
            </div>
        </form>
            
        <table class="container-fluid table table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên Truyện</th>
                    <th scope="col" >Mô tả</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Lượng người xem</th>
                    <th scope="col">Trạng Thái</th>
                    <th scope="col">Cập nhật </th>
                    <th scope="col">Thể loại</th>
                    <th scope="col">Tác giả</th>
                    <th scope="col">Số chương</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                        if(!isset($_GET["StoryName"])){
                            $_GET["StoryName"] ="";
                        }
                        $StoryName = $_GET["StoryName"];
                        $sql = "SELECT 
                            s.*,
                            c.CateName,
                            b.AuName,
                            (SELECT COUNT(*) FROM chapter) AS ChapterCount,
                            CASE 
                                WHEN CHAR_LENGTH(s.StoryDes) <= 10 THEN s.StoryDes
                                ELSE CONCAT(SUBSTRING_INDEX(s.StoryDes, '.', 1), '...')
                            END AS StoryD
                            FROM 
                                stories AS s
                            JOIN 
                                categories AS c ON s.CateID = c.CateID
                            JOIN 
                                authors AS b ON s.AuID = b.AuID
                            LEFT JOIN 
                                chapter AS d ON s.StoryID = d.StoryID
                            WHERE 
                                s.storyName LIKE '%$StoryName%'
                            GROUP BY
                                s.StoryID
                            ORDER BY 
                                s.StoryID 
                            LIMIT ".$num_row*($page - 1).",".$num_row;
                            $result = $conn->query($sql) or die("Can't get recordset");
                            if($result->num_rows>0){
                                while($row = $result->fetch_assoc()){
                                    ?>
                    <tr>
                        <th scope="row">
                            <?php echo $row["StoryID"];?>
                        </th>
                        <td>
                            <?php echo $row["StoryName"];?>
                        </td>
                        <td >
                            <?php echo $row["StoryD"]; ?>
                        </td>
                        <td><?php echo $row["StoryImage"];?>
                         </td>
                        <td>
                            <?php echo $row["StoryView"]; ?>
                        </td>
                        <td>
                            <?php if ($row["StoryStatus"]==1) echo "<p class=\"text-success\">Hoạt Động</p>"; else echo"<p class=\"text-danger\">Ngưng Hoạt Động</p>";?>
                        </td>
                        <td>
                            <?php echo $row["StoryDate"]; ?>
                        </td>
                        <td>
                            <?php echo $row["CateName"]; ?>
                        </td>
                        <td>
                            <?php echo $row["AuName"]; ?>
                        </td>
                        <td>
                            <?php echo $row["ChapterCount"]; ?>
                        </td>
                        <td>
                            <a href="/../QLDA/admin/story_edit.php?StoryID=<?php echo $row["StoryID"]; ?>" class="btn btn-primary">Sửa</a>
                        </td>
                        <td>
                            <a href="/../QLDA/controller/story_remove_action.php?StoryID=<?php echo $row["StoryID"]; ?>" id="deleteBtn" class="btn btn-danger" onclick="confirmDelete()">Xóa</a>
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
                                                <a class=\"page-link\" href=\"?page_layout=quan_ly_truyen&page=$p\">Previous</a>        
                                            </li> ";
                                }
                                for($i=1;$i<=$num_of_page;$i++){
                                    if ($i == $page){
                                        echo "  <li class=\"page-item active\">
                                                    <a class=\"page-link \" href=\"?page_layout=quan_ly_truyen&page=$i\">$i</a>        
                                                </li> ";
                                    } else {
                                        echo "  <li class=\"page-item\">
                                                    <a class=\"page-link\" href=\"?page_layout=quan_ly_truyen&page=$i\">$i</a>        
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
                                                <a class=\"page-link\" href=\"?page_layout=quan_ly_truyen&page=$p\">Next</a>        
                                            </li> ";
                                }
                            ?>
                        </ul>
                    </nav>
    </body>
<?php 
$_SESSION["story_add_error"]="";
?>
    </html>