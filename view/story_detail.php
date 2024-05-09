
<?php
// Database connection
    ob_start();
    session_start();
    require_once(__DIR__."/../connect.php");
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_GET['StoryID'])) {

        $story_id = $_GET['StoryID'];


        $query = "SELECT *, SUM(c.ChapView) AS View 
        FROM stories AS s 
        JOIN chapter AS c ON s.StoryID = c.StoryID
        JOIN authors as a ON s.AuID = a.AuID 
        JOIN categories as cate ON s.CateID = cate.CateID
        WHERE s.StoryID = $story_id";
        $result = $conn->query($query);

        if($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            $story_name = $row['StoryName'];
            $story_desc = $row['StoryDes'];
            $story_image = $row['StoryImage'];
            $story_chap = $row['View'];
            $cate_name = $row['CateName'];
            $story_status = $row['StoryStatus'];
            $au_name = $row['AuName'];
            $chap_name = $row['ChapName'];
            $chap_date = $row['ChapDate'];
            $chap_view = $row['ChapView'];

            $story_status_text = ($story_status == 1) ? "Đang tiến hành" : "Đã hoàn thành";
        } else {
            echo "Không tìm thấy thông tin truyện.";
        }
    } else {
        echo "ID của truyện không được cung cấp.";
    }
    function addComment($conn, $story_id, $user_id, $content)
{
    $query = "INSERT INTO comment (StoryID, MemID, ComContent) VALUES ($story_id, $user_id, '$content')";
    return $conn->query($query);
}

// Hàm lấy danh sách bình luận
function getComments($conn, $story_id)
{
    $query = "SELECT c.*, m.MemName FROM comment c JOIN member m ON c.MemID = m.MemID WHERE c.StoryID = $story_id ORDER BY c.ComDate DESC";
    return $conn->query($query);
}

 $query = "SELECT c.*, m.MemName FROM comment c JOIN member m ON c.MemID = m.MemID WHERE c.StoryID = $story_id ORDER BY c.ComDate DESC";
// Kiểm tra đăng nhập và xử lý bình luận
if (isset($_POST['submit_comment'])) {
    if (isset($_SESSION['MemID'])) {
        $user_id = $_SESSION['MemID'];
        $content = $_POST['comment_content'];
        if (addComment($conn, $story_id, $user_id, $content)) {
            // Bình luận được thêm thành công, có thể cập nhật trang để hiển thị bình luận mới
            header("Refresh:0");
        } else {
            echo "Lỗi khi thêm bình luận.";
        }
    } else {
        // Nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
        header("Location: ../user/login.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
        exit();
    }
}
?>



<html>
	<head>
   <meta charset="utf-8">
      <title>Web Đọc Truyện</title>
      <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
	</head>

    <body>
        <form method="post" id="main_form">
        <!--header-->
            <div class="header">
                <div class="container">
                    <div class="navbar_header">
                        <div class="navbar_title">
                            <a class="title" href="../index.php"><h1>TruyenTranh.net</h1></a>
                        </div>
                        <div class="navbar_account">
                            <a class="link_btn" href="../user/login.php">Đăng nhập</a>
                            <a class="link_btn" href="../user/register.php">Đăng ký</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cat_bar">
                <div class="container">
                    <div class="sideway-category-list">
                        <ul>
                            <li><a href="index.php/hot">Hot</a></li>
                            <li><a href="index.php/follow">Theo Dõi</a></li>
                            <li><a href="index.php/history">Lịch sử</a></li>
                            <li><a href="index.php/category">Thể loại</a></li>
                            <li><a href="index.php/ranking">Xếp hạng</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <!--header end-->

        <main class="main">
        <div class="container">

        <div class="row">
            <div class="left_row">
                <div class="base">
                    <div class="cover">
                        <img src="../image/<?php echo $story_image; ?>" width="250px" height="350px">
                    </div>
                    <div class="info-box">
                        <h2>Tên truyện</h2>
                        <ul class="info-list">
                            <li class="other_name">
                                <h2>Tên Khác:</h2>
                                <p class="info"><?php echo $story_name;?></p>
                            </li>
                            <li class="author">
                                <h2>Tác giả:</h2>
                                <p class="info"><?php echo $au_name;?></p>
                            </li>
                            <li class="status">
                                <h2>Tình trạng:</h2>
                                <p class="info"><?php echo $story_status_text;?></p>
                            </li>
                            <li class="genre">
                                <h2>Thể loại:</h2>
                                <p class="info"><?php echo $cate_name;?></p>
                            </li>
                            <li class="viewed">
                                <h2>Lượt xem:</h2>
                                <p class="info"><?php echo $story_chap;?></p>
                            </li>
                        </ul>
                        <button class="link_btn">Theo dõi</button>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <h2>Nội dung:</h2>
                    <hr>
                    <p class="desc"><?php echo $story_desc;?></p>
                    <h2>Danh sách chương:</h2>
                    <hr>
                    <div class="chapter_box">
                        <div class="chaptert_num">Số chương</div>
                        <div class="chaptert_update">Cập nhật</div>
                        <div class="chaptert_view">Lượt xem</div>
                    </div>
                        <?php
                        $sql = "SELECT *, date(ChapDate) as DayUpdate FROM chapter WHERE StoryID = $story_id";
                        $result = $conn->query($sql) or die("Can't get recordset");
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <ul class="chapter_list">
                                <a href="read_story.php?ChapID=<?php echo $row['ChapID']; ?>">
                                    <li class="chapter_num"><?php echo $row['ChapName']; ?></li>
                                </a>
                                    <li class="chapter_update"><?php echo $row['DayUpdate']; ?></li>
                                    <li class="chapter_view"><?php echo $row['ChapView']; ?></li>
                                </ul>
                                <?php
                            }
                        }
                        ?>

                    <br>
                    <!-- Comment section -->
                <div class="comment_section">
                    <h2>Bình luận</h2>
                    <!-- Display comments -->
                    <?php
                    $comments = getComments($conn, $story_id);
                    if ($comments->num_rows > 0) {
                        while ($comment = $comments->fetch_assoc()) {
                            echo '<div class="comment">';
                            echo '<p><strong>' . $comment['MemName'] . '</strong>: ' . $comment['ComContent'] . '</p>';
                            // Hiển thị thông tin người đăng bình luận nếu cần
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Chưa có bình luận nào.</p>';
                    }
                    ?>
                    
                    <!-- Comment form -->
                    <div class="comment_form">
                        <textarea name="comment_content" placeholder="Nhập bình luận của bạn"></textarea>
                        <button type="submit" name="submit_comment">Gửi</button>
                    </div>
                </div>
            </div>
            </div>

            <!-- <div class="right_row">
                <ul class="ranking">
                    <li>Top tháng</li>
                    <li>Top tuần</li>
                    <li>Top ngày</li>
                </ul>
            </div> -->
        </div>
    </div>
</main>




        <footer>
            <div class="container">
                <p>This is the footer content.</p>
            </div>
        </footer>
    
        </form>
    </body>

