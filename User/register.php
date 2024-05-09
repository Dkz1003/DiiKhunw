<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Đăng kí </title>
    <link rel="stylesheet" href="register.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">ĐĂNG KÝ THÀNH VIÊN</div>
    <div class="content">
      <form action="register_action.php" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Họ và tên</span>
            <input type="text" name='txtMemName'>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name='txtMemEmail'>
          </div>
          <div class="input-box">
            <span class="details">Mật khẩu</span>
            <input type="text" name='txtMemPassword'>
          </div>
          </label>          
          </div>
        </div>
        <div class="button">
          <input type="submit" value="ĐĂNG KÝ">
        </div>
		<div class="signup-link">
			Bạn đã có tài khoản? <a href="login.php" style="color: black;">Đăng nhập ngay</a>
		</div>
      </form>
      <br>
      <center><a href="/../QLDA/index.php" style="padding: 4px 15px; background-color: #265073; color: white;">Quay lại</a></center>
    </div>
  </div>

</body>
</html>