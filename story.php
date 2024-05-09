<?php
// Database connection
    ob_start();
    session_start();
    include_once 'connect.php'; 
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>

<html>
	<head>
   <meta charset="utf-8">
      <title>Web Đọc Truyện</title>
      <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
	</head>

    <body>
        <form method="post" id="main_form">
        <!--header-->
            <div class="header">
                <div class="container">
                    <div class="navbar_header">
                        <div class="navbar_title">
                            <a class="title" href="index.php"><h1>TruyenTranh.net</h1></a>
                        </div>
                        <div class="navbar_account">
                            <a class="link_btn" href="login.php">Đăng nhập</a>
                            <a class="link_btn" href="register.php">Đăng ký</a>
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
                        <img src="" width="250px" height="350px">
                    </div>
                    <div class="info-box">
                        <h2>Tên truyện</h2>
                        <ul class="info-list">
                            <li class="other_name">
                                <h2>Tên Khác:</h2>
                                <p class="info">123</p>
                            </li>
                            <li class="author">
                                <h2>Tác giả:</h2>
                                <p class="info">123</p>
                            </li>
                            <li class="status">
                                <h2>Tình trạng:</h2>
                                <p class="info">123</p>
                            </li>
                            <li class="genre">
                                <h2>Thể loại:</h2>
                                <p class="info">123</p>
                            </li>
                            <li class="viewed">
                                <h2>Lượt xem:</h2>
                                <p class="info">123</p>
                            </li>
                        </ul>
                        <button class="link_btn">Theo dõi</button>
                    </div>
                    <br>
                    <br>
                    <h2>Nội dung:</h2>
                    <hr>
                    <p class="desc">desc</p>
                    <h2>Danh sách chương:</h2>
                    <hr>
                    <div class="chapter_box">
                        <div class="chaptert_num">Số chương</div>
                        <div class="chaptert_update">Cập nhật</div>
                        <div class="chaptert_view">Lượt xem</div>
                    </div>
                    <ul class="chapter_list">
                        <li class="chapter_num">Chapter 1</li>
                        <li class="chapter_update">1 ngày trước</li>
                        <li class="chapter_view">1000</li>
                    </ul>
                    <div class="comment_section">
                        <div class="comment_box">
                        <textarea>bình luận</textarea>
                        </div>
                        <div class="comment_list">
                            <div class="cmt_avt"></div>
                            <div class="cmt_text"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right_row">
                <ul class="ranking">
                    <li>Top tháng</li>
                    <li>Top tuần</li>
                    <li>Top ngày</li>
                </ul>
            </div>
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

