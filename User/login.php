<?php 
	session_start();
	if (!isset($_SESSION["login_error"])){
		$_SESSION["login_error"]="";
	}
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Đăng nhập</title> 
    <link rel="stylesheet" href="style2.css">
    
  </head>
  <body>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>ĐĂNG NHẬP</span></div>
		<center><div class="signup-link"><?php echo $_SESSION["login_error"];?></div></center>
        <form method=POST name=f action="login_action.php">
          <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" name='txtMemEmail' placeholder="Email" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" name='txtMemPassword' placeholder="Mật khẩu" required>
          </div>
          <div class="row button">
            <input type="submit" name="login" value="ĐĂNG NHẬP">
          </div>
          <div class="signup-link">Bạn chưa là thành viên? <a href="register.php" style="color: black;">Đăng ký ngay</a></div>
        </form>
        <br>
        <center><a href="/../QLDA/index.php" style="padding: 4px 15px; background-color: #265073; color: white;">Quay lại</a></center>
      </div>
    </div>

  </body>
</html>


