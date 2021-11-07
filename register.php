<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/register.css">
    <link rel="icon" href="./assets/img/logo.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./themify-icons/themify-icons.css">
    <title>ShopOn | Đăng Ký Tài Khoản</title>
</head>
<body>
<?php include 'header.php'; ?>
<div id = "Content">
<div class="body-register">
    <div class="baner">
    <div class="logo">
    </div>
    <div class="banner-text">
    <h1>ShopOn</h1>
    <p>Đồ công nghệ Online</p>
    </div>
    </div>
    <div class="register">
    <div class="register-header">
        <h2>Đăng Ký</h2>
    </div>
    <div class="register-body">
        <form method="POST" enctype="multipart/form-data">
        <input type="email" required="" name="gmail" class="in email" placeholder = "Gmail">
        <input type="text" required="" name="name" class="in name" placeholder = "Tên Đăng nhập">
        <input type="password" required="" name="pass" class="in pass checkPass-Js" id="pass" placeholder = "Nhập mật khẩu">
        <label for="pass" class="check-js" ></label>
        <input type="number" required="" name="phone" class="in sdt" placeholder = "Số điện thoại">
        <button type="submit" class="btn-re btn-js" name="btnre">Đăng Ký Ngay</button>
    </form>
    </div>
    <?php 
    include 'databaseshopOn.php';
    if(isset($_POST['btnre'])){
        $gmail = $_POST["gmail"];
        $name = $_POST["name"];
        $pass = $_POST["pass"];
        $pass = md5($pass);
        $phone = $_POST["phone"];
        $tam = 0;
        $ktra = "select * from account where name_user='$name'";
        $query=mysqli_query($conn,$ktra);
        $kTraName=mysqli_num_rows($query);
        $ktra = "select * from account where gmail_user='$gmail'";
        $query=mysqli_query($conn,$ktra);
        $kTraGmail=mysqli_num_rows($query);
        $tam = strpos($name, ' ' );
        if($tam != 0 ) {
        ?>
        <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Cảnh Báo!</strong>Tên tài khoản không chứa khoảng trắng !!
</div>
        <?php   
    }

       else if($KTraName!=0 || $kTraGmail != 0 ){
        ?>

        <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Cảnh Báo!</strong>Tên Tài khoản hoặc Gmail đã tồn tại !!
</div>
        <?php
        }else if($tam == 0) {
            $dtbase="INSERT INTO account(gmail_user,name_user,user_password,user_phone) VALUES ('$gmail','$name','$pass','$phone')";
            $query=mysqli_query($conn,$dtbase);
            if(!$query){
            ?>
            <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Cảnh Báo!</strong>Đăng ký không thành công!!
</div>
    <?php
   } else{
        ?>
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Thông báo!</strong>Bạn đã đăng ký thành công!
</div>
    <?php
    }
        
    } 
     }
    ?>
    <div class="register-footer"></div>
    </div>
    </div>
</div>
   <?php include 'footer.php' ?>
   <script src="./assets/js/login.js"></script>
</body>
</html>