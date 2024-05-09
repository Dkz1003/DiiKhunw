<?php
// Database connection
    ob_start();
    session_start();
    include_once 'connect.php'; 
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    //pagination
	if (!isset($_REQUEST["page"])) {
        $page = 1;
    } else {
        $page = $_REQUEST["page"];
    }
    $num_row = 3;
    $sql1 = "SELECT a.*, b.catename FROM stories a, categories b WHERE a.cateid = b.cateid";
    $result1 = $conn->query($sql1) or die($conn->error);
    $num_of_page = round($result1->num_rows / $num_row, 0);
    if ($page < 1) {
        $page = 1;
    }
    if ($page > $num_of_page) {
        $page = $num_of_page;
    }
    $sql = "SELECT a.*, b.catename FROM stories a, Categories b WHERE a.cateid = b.cateid limit " . $num_row*($page-1).",".$num_row;
	//echo $num_of_page;
	$result = $conn->query($sql) or die($conn->error);
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
                        <div class="search-container">
                            <form action="search.php" method="GET" style="display:flex;">
                                <input type="text" name="search" id="search-input" placeholder="Tìm kiếm..." style="width: 600px;">
                                <button type="submit" class="link_btn">Search</button>
                            </form>
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
            <div class="search_title">
                <h2>Tìm truyện tranh:</h2>
            </div>
            <select class="category_list">
                <option value="">Thể loại</option>
                <option value="">Action</option>
                <option value="">Adventure</option>
                <option value="">Comedy</option>
                <option value="">Horror</option>
            </select>
            <br>
            <br>
            <select class="author_list">
                <option value="">Tác giả</option>
                <option value="">Junji Itto</option>
                <option value="">Ryoko Kui</option>
                <option value="">Ishiyama Hajime</option>
            </select>
            <br>
            <br>
            <div class="grid_box">
                <?php
                    // Check if search query is set
                    if(isset($_GET['search']) && !empty($_GET['search'])) {
                        $search = $_GET['search'];
                        // Your database connection code here
                        // Ensure to properly sanitize and validate user input to prevent SQL injection
                        $sql = "SELECT StoryName, StoryImage FROM stories WHERE StoryStatus = 1 AND StoryName LIKE '%$search%'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                ?>
                                <div class="product-item">
                                    <div class="image"><img src="image/<?php echo $row["StoryImage"]; ?>" width="150px" height="200px"></div>
                                    <div class="footer">
                                        <div class="stitle"><?php echo $row["StoryName"]; ?></div>
                                    </div>
                                </div>
                <?php
                            }
                        } else {
                            echo "No results found.";
                        }
                    } else {
                        echo "Please enter a search term.";
                    }
                ?>
            </div>

                <center>
                <?php 
                  for($i=1;$i<=$num_of_page;$i++){
                     if ($i == $page){
                        echo " <".$i."> ";
                     } else {
                        echo " <a href=index.php?page=".$i.">".$i."</a> ";
                     }
                  }
               ?>
                </center>
        </div>
        </main>




        <footer>
            <div class="container">
                <p>This is the footer content.</p>
            </div>
        </footer>
    
        </form>
    </body>

