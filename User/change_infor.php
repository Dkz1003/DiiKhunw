<?php
	session_start();
	include_once'connect.php';
	$MemID = $_SESSION["MemID"];
	$sql = "select * from member where MemID=$MemID";
	$result = $conn->query($sql);
	if ($result->num_rows==0){
		echo"Lỗi. <a href='javascript: history.go(-1)'>Trở lại</a>";
		exit;
	} else {
		$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> CHỈNH SỬA THÔNG TIN </title>
    <link rel="stylesheet" href="register.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">CHỈNH SỬA THÔNG TIN</div>
    <div class="content">
      <form action="change_infor_action.php?MemID=<?php echo $MemID; ?>" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Họ và tên</span>
            <input type="text" name='txtMemName' value="<?php echo $row["MemName"];?>">
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name='txtMemEmail' value="<?php echo $row["MemEmail"];?>" >
          </div>
        <div class="button">
          <input type="submit" value="LƯU">
        </div>
      </form>
      <br>
      <center><a href="/../QLDA/index.php" style="padding: 4px 15px; background-color: #265073; color: white;">Quay lại</a></center>
    </div>
    </div>
  </div>

</body>
</html>
<?php 
	}
?>