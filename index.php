<?php
// Database connection
ob_start();
session_start();
include_once 'connect.php'; 

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Số item trên mỗi trang
$num_per_page = 12;

// Tính toán số trang
$sql_count = "SELECT COUNT(*) AS total FROM stories";
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_items = $row_count['total'];
$num_of_page = ceil($total_items / $num_per_page);

// Xác định trang hiện tại
if (!isset($_REQUEST["page"])) {
    $page = 1;
} else {
    $page = $_REQUEST["page"];
}

if ($page < 1) {
    $page = 1;
} elseif ($page > $num_of_page) {
    $page = $num_of_page;
}

// Tính toán vị trí bắt đầu của query
$start = ($page - 1) * $num_per_page;

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Web Đọc Truyện</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="style1.css?v=<?php echo time(); ?>">
</head>

<body>
<!--header-->
<div class="header">
    <div class="container">
        <div class="navbar_header">
            <div class="navbar_title">
                <a class="title" href="index.php"><h1>TruyenTranh.net</h1></a>
            </div>
            <div class="navbar_account">
                <?php
                if (isset($_SESSION["login"])) { ?>
                <?php } else { ?>
                <a class="link_btn" href="user/login.php">Đăng nhập</a>
                <a class="link_btn" href="user/register.php">Đăng ký</a>
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
                               href="user/change_infor.php?MemID=<?php echo $_SESSION["MemID"]; ?>">Thông Tin Cá Nhân</a>
                            <a class="dropdown-item" href="user/change_password.php">Đổi Mật Khẩu</a>
                            <a class="dropdown-item" href="user/logout.php">Đăng Xuất</a>
                        </div>
                    </div>
                <?php } ?>
            </ul>
        </div>

        <div class="search-container">
            <form action="search.php" method="GET" style="display:flex;">
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
        <h2>Truyện đề cử:</h2>
        <div class="reccomend_box">
            <?php
            $sql = "SELECT * FROM stories WHERE StoryStatus = 1 GROUP BY StoryName LIMIT 7";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="product-item">
                        <a href="view/story_detail.php?StoryID=<?php echo $row['StoryID']; ?>">
                            <div class="image"><img src="image/<?php echo $row["StoryImage"]; ?>" width="150px" height="200px"></div>
                            <div class="footer">
                                <div class="stitle"><?php echo $row["StoryName"]; ?></div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <div class="row">
            <div class="left_row">
                <h2>Truyện mới:</h2>
                <div class="grid_box">
                    <?php
                   $sql = "SELECT StoryID, StoryName, StoryImage FROM stories WHERE StoryStatus = 1 ORDER BY StoryDate DESC LIMIT $start, $num_per_page";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="product-item" style="margin: 20px;">
                                <a href="view/story_detail.php?StoryID=<?php echo $row['StoryID']; ?>">
                                    <div class="image"><img src="image/<?php echo $row["StoryImage"]; ?>" width="170px" height="240px"></div>
                                    <div class="footer">
                                        <div class="stitle"><?php echo $row["StoryName"]; ?></div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <center>
                    <?php
                        for ($i = 1; $i <= $num_of_page; $i++) {
                            if ($i == $page) {
                                echo " <" . $i . "> ";
                            } else {
                                echo " <a href=index.php?page=" . $i . ">" . $i . "</a> ";
                            }
                        }
                        ?>
                </center>
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
</body>
</html>
