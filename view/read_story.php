<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!--header-->
<div class="header">
    <div class="container">
        <div class="navbar_header">
            <div class="navbar_title">
                <a class="title" href="../index.php"><h1>TruyenTranh.net</h1></a>
            </div>
            <div class="navbar_account">
                <?php
                if (isset($_SESSION["login"])) { ?>
                <?php } else { ?>
                <a class="link_btn" href="../user/login.php">Đăng nhập</a>
                <a class="link_btn" href="../user/register.php">Đăng ký</a>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="col-md-2  d_none" style="float:right;">
            <ul class="email text_align_right">
                <?php if (isset($_SESSION["MemName"])) { ?>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo "Xin chào, " . $_SESSION["MemName"]; ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item"
                               href="../user/change_infor.php?MemID=<?php echo $_SESSION["MemID"]; ?>">Thông Tin Cá Nhân</a>
                            <a class="dropdown-item" href="../user/change_password.php">Đổi Mật Khẩu</a>
                            <a class="dropdown-item" href="../user/logout.php">Đăng Xuất</a>
                        </div>
                    </div>
                <?php } ?>
            </ul>
        </div>

        <div class="search-container">
            <form action="../search.php" method="GET" style="display:flex;">
                <input type="text" name="search" id="search-input" placeholder="Tìm kiếm..." style="width: 600px;">
                <button type="submit" class="link_btn">Search</button>
            </form>
        </div>
    </div>
</div>
<div class="cat_bar">
    <div class="container">
        <div class="sideway-category-list">
            <ul>
                <li><a href="../index.php/hot">Hot</a></li>
                <li><a href="../index.php/follow">Theo Dõi</a></li>
                <li><a href="../index.php/history">Lịch sử</a></li>
                <li><a href="../index.php/category">Thể loại</a></li>
                <li><a href="../index.php/ranking">Xếp hạng</a></li>
            </ul>
        </div>
    </div>
</div>
<br>
<br>
<!--header end-->
<div class="comic_controls">
    <?php
     ob_start();
     session_start();
     require_once(__DIR__."/../connect.php");
     
     if (!$conn) {
         die("Connection failed: " . mysqli_connect_error());
     }

    // Truy vấn dữ liệu từ cơ sở dữ liệu

    if(isset($_GET['ChapID'])) {
        $chap_id = $_GET['ChapID'];
        // Lấy StoryID tương ứng với ChapID để sử dụng trong các truy vấn sau
        $sql_story_id = "SELECT StoryID FROM chapter WHERE ChapID = $chap_id";
        $result_story_id = mysqli_query($conn, $sql_story_id);
        $row_story_id = mysqli_fetch_assoc($result_story_id);
        $story_id = $row_story_id['StoryID'];
    
        // Truy vấn danh sách các chương
        $sql = "SELECT MIN(ChapID) AS minChap, MAX(ChapID) AS maxChap FROM chapter WHERE StoryID = $story_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $minChapID = $row['minChap'];
        $maxChapID = $row['maxChap'];
    
        // Hiển thị nút "Trang trước" với điều kiện kiểm tra
        if ($minChapID != $chap_id) {
            echo '<a href="?StoryID=' . $story_id . '&ChapID=' . ($chap_id - 1) . '"><</a>';
        } else {
            echo '<span class="disabled"><</span>';
        }
        
        // Truy vấn danh sách các chương
        $sql = "SELECT * FROM chapter WHERE StoryID = $story_id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo '<select id="chapterSelect" onchange="changeChapter()">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row["ChapID"] . '"';
                if ($row["ChapID"] == $chap_id) {
                    echo ' selected';
                }
                echo '>' . $row["ChapName"] . '</option>';
            }
            echo '</select>';
        }
    
        // Hiển thị nút "Trang sau" với điều kiện kiểm tra
        if ($maxChapID != $chap_id) {
            echo '<a href="?StoryID=' . $story_id . '&ChapID=' . ($chap_id + 1) . '">></a>';
        } else {
            echo '<span class="disabled">></span>';
        }
    }
    ?>
</div>

<div class="comic_viewer">
    <?php
    if(isset($_GET['ChapID'])) {
        // Truy vấn dữ liệu từ cơ sở dữ liệu
        $chap_id = $_GET['ChapID'];
        $sql = "SELECT ChapContend FROM chapter WHERE ChapID = $chap_id";
        $result = mysqli_query($conn, $sql);

        $sql_story = "SELECT * FROM chapter WHERE ChapID = $chap_id";
        $result_story = mysqli_query($conn, $sql_story);
        $row_story = mysqli_fetch_assoc($result_story);
        $story_id = $row_story['StoryID'];
        $chap_name = $row_story['ChapName'];
        
        // Hiển thị các trang truyện
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Phân tích cú pháp chuỗi JSON thành một mảng
                $images = json_decode($row["ChapContend"]);
                
                // Hiển thị các tệp ảnh trong mảng
                foreach ($images as $image) {
                    echo '<div class="comic_page">';
                    echo '<img src="../img-contend/' . $story_id .'/' . $chap_name . '/' . $image . '" alt="Comic Page">';
                    echo '</div>'; 
                }
            }
        } else {
            echo "No comic pages found.";
        }
    }
    ?>
</div>

<script>
// Hàm thay đổi chương
function changeChapter() {
    var selectedChapID = document.getElementById("chapterSelect").value;
    window.location.href = '?StoryID=<?php echo $story_id; ?>&ChapID=' + selectedChapID;
}
</script>
</body>
</html>