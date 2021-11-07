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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="./themify-icons/themify-icons.css">
    <title>ShopOn | Đăng Nhập Tài Khoản</title>
</head>
<body>
<?php ob_start(); ?>
<?php include 'header.php'; 
if(isset($_COOKIE["tendn"]) && isset($_COOKIE['mk'])) {
    $tendn =$_COOKIE["tendn"];
    $pass = $_COOKIE['mk'];
    $check = true ;
    
}
?>
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
        <h2>Đăng Nhập</h2>
    </div>
    <div class="register-body">
        <form method="POST" enctype="multipart/form-data">
        <input type="text" required="" name="name" class="in name" value="<?php echo $tendn; ?>" placeholder = "Tên Đăng nhập">
        <input type="password" required="" name="pass" class="in pass checkPass-Js" value="<?php echo $pass; ?>" placeholder = "Nhập mật khẩu">
        <i class="far fa-eye eye-pass" id = "eye-js"></i>
        <div class = "eye-pass-mobile">Hiện mật khẩu</div>
        <div class="check">
        <input <?php echo isset($check)?"checked":""; ?> type="checkbox" name="nhomk"  class="checkPass" id="customCheck"  value="1" />
        <label class="labelCheck" for="customCheck" >Nhớ mật khẩu</label>
        </div>
        <button type="submit" class="btn-re" name="btnre">Đăng Nhập Ngay</button>
    </form>
    </div>
    <?php 
    include 'databaseshopOn.php';
    if(isset($_POST['btnre'])){
        $name = $_POST["name"];
        $pass = $_POST["pass"];
        if(isset($_POST["nhomk"])){
        setcookie("tendn",$name);
        setcookie("mk",$pass);
        }
        else if(isset($_COOKIE["tendn"]) || isset($_COOKIE["mk"])) {
        setcookie("tendn", "", time()-3600);
        setcookie("mk", "", time()-3600);
    }
        $pass = md5($pass);
        $ktra = "select * from account where name_user='$name' and user_password='$pass' ";
        $query=mysqli_query($conn,$ktra);
        $num=mysqli_num_rows($query);
        if($num == 0){
        ?>
        <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Cảnh Báo!</strong>Tên Tài khoản hoặc mật khẩu không chính xác !!
</div>
        <?php
        }else {
          $_SESSION['account']=$_POST;
         header('location: index.php');
    }
   
    }
    ?>
    <div class="register-footer"></div>
    </div>
    </div>
</div>
<script>
    var eyePass = document.querySelector("#eye-js");
    var eyePassMo = document.querySelector(".eye-pass-mobile");
var checkPass =document.querySelector(".checkPass-Js");
eyePass.addEventListener("click", function() {
        if(checkPass.type == "password") {
            checkPass.type = "text";
            eyePass.classList.remove("fa-eye");
            eyePass.classList.add("fa-eye-slash");
        }
        else {
            checkPass.type = "password";
            eyePass.classList.add("fa-eye");
            eyePass.classList.remove("fa-eye-slash");
        }
}) 
eyePassMo.addEventListener("click", function() {
        if(checkPass.type == "password") {
            checkPass.type = "text";
        }
        else {
            checkPass.type = "password";
        }
}) 
</script>
   <?php include 'footer.php' ?>
   <script src="./assets/js/login.js"></script>
</body>
</html>