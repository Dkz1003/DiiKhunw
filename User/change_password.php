<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Đổi mật khẩu</title> 
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>ĐỔI MẬT KHẨU</span></div>
        <form method=POST name=f action="change_password_action.php">
          <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" name='txtMemEmail' placeholder="Email" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" name='txtMemPassword_old' placeholder="Mật khẩu cũ" required>
          </div>
		  <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" name='txtMemPassword_new' placeholder="Mật khẩu mới" required>
          </div>
          <div class="row button">
            <input type="submit" name="change_password" value="ĐỔI MẬT KHẨU">
          </div>        
        </form>
        <center><a href="/../QLDA/index.php" style="padding: 4px 15px; background-color: #265073; color: white;">Quay lại</a></center>
    </div>
      </div>
    </div>

  </body>
</html>
