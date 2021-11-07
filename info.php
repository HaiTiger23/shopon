<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/info.css">
    <link rel="icon" href="./assets/img/logo.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="./themify-icons/themify-icons.css">
    <title>ShopOn | Thông tin tài khoản</title>
</head>
<body>
<?php include 'header.php'; ?>
<div id = "Content">
<div class="info-body">
<?php 
    if(isset($_POST["btnout"])){
    unset($_SESSION['account']);
    header("location:login.php");
        }
        $ktra = 0;
    $id = $_SESSION['account']["name"];
    $AvtInfo = "assets/img/avt_user/defaultAvt.png";
    $hoten = " ";
    $tinh = " ";
    $huyen = " ";
    $xa = " ";
    $dc = " ";
    $infodb =  mysqli_query($conn,"SELECT * FROM account WHERE name_user = '$id'");
     while($get_sp=mysqli_fetch_assoc($infodb)) {
        $user_id =$get_sp['id'];
           $infoUserdb =  mysqli_query($conn,"SELECT * FROM `user-info` WHERE user_id = $user_id");
        if($get_user=mysqli_fetch_assoc($infoUserdb)) {
                    $hoten = $get_user['hoTen'];
                    $tinh = $get_user['Tinh'];
                    $huyen = $get_user['Huyen'];
                    $xa = $get_user['Xa'];
                    $dc = $get_user['DiaChi'];
                    if($get_user['avt'] != "") {
                        $AvtInfo = $get_user['avt'];
                    }
                   
                   
        }else {
                    $ktra = 1;
                }
    ?>
    <div class="side-bar">
        <div class="avatar-info side-bar-item ">
        <label for="file-upload">
        <div class="avt preview" style="background-image: url('<?=$AvtInfo?>');">
        <form method="post" enctype="multipart/form-data">
            <label for="file-upload" class="custom-file-upload">
            <i class="fas fa-edit"></i> 
            </label>
            </label>
                <input id="file-upload" name="fileAnhTam" type="file" accept=".jpg, .jpeg, .png" />
                <input type="submit" name="SaveAvt" id="SaveAvt" />
            </form>
            <?php 
            if(isset($_POST["SaveAvt"])){
                 $target_dir = "assets/img/avt_user/";
                 $target_file = $target_dir.time().basename($_FILES["fileAnhTam"]["name"]); 
                 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $anhavt=$target_file;
                if($_FILES["fileAnhTam"]["size"] > 50000000){
                    echo "Ảnh cần nhỏ hơn 50Mb";
                    
                }else {
                    if(move_uploaded_file($_FILES["fileAnhTam"]["tmp_name"], $target_file)) {
                        if($ktra) {
                        $dtbavt = "insert into `user-info`(`user_id`,`hoTen`, `Tinh`, `Huyen`, `Xa`, `DiaChi`,`avt`)  values('','' , '', '', '', '','$$target_file' )";
                        }else { 
                        $dtbavt = "update `user-info` set avt = '$target_file' where user_id = $user_id";
                                }
                        if(mysqli_query($conn,$dtbavt)) {
                      ?>
                      <script >
                      alert("Cập Nhật Thành Công. Kết quả sẽ hiện sau khi tải lại trang");</script>
                      <?php
                        }
                       
                    }
                }
            }
            ?>
            </div>
            </label>
            <h3><?=$hoten?></h3>
            <form method="post" enctype="multipart/form-data" >
    <button class="btn-logout-mb" name="btnout"> Đăng xuất</button>
    </form>
    
        </div>
        <div class="cart-info side-bar-item ">
        <i class="fas fa-shopping-cart"></i>
        <h3>Giỏ Hàng</h3>
        </div>
    </div>
    <form class="info-content" method="post">
        <h1 class="Title-info">Thông Tin Tài Khoản</h1>
        <div class= "info-input">
            <div class=" info">
                <label for="name-label">Họ Tên: </label>
                <input class="in" id="name-label"type="text" name="hoten" value="<?=$hoten?>">
            </div>


            <div class=" info ">
                <label for="name-login-label">Tên đăng nhập: </label>
                <input class="in" id="name-login-label"type="text" disabled value="<?=$_SESSION['account']['name']?>">
            </div>


            <div class=" info">
                <label for="email-input-label">Địa chỉ Gmail: </label>
                <input class="in" id="email-input-label"type="text" disabled value="<?=$get_sp["gmail_user"]?>">
            </div>


            <div class=" info">
                <label for="phone-input-label">Số điện thoại</label>
                <input class="in" id="phone-input-label"type="text"  disabled value="<?=$get_sp["user_phone"]?>">
            </div>
            <div class="info dc">

                <div class="diachi">
                    <label>Tỉnh, Thành Phố</label>
                    <select class="TP in" name="Tinh" id="TP" value="<?=$tinh?>"></select>
                </div>   
                <div class="diachi">
                    <label for="TP">Huyện</label>
                    <select  class="Huyen in" name="Huyen" value="<?=$huyen?>"> </select>
                </div>
                <div class="diachi">
                    <label >Xã (phường, Thị trấn)</label>
                    <select  class="Xa in" name="Xa" value="<?=$xa?>"></select>
                </div>
                <div class="diachi">
                    <label >Địa chỉ cụ thể</label>
                    <input class="in" type="text" name="dc" value="<?=$dc?>">
                </div>
                <?php 
                }
                ?>
          <input type="file" id="fileAnhTam" style="display: none" name="fileAnhTam">
          <script src="./assets/js/info.js"></script>
            </div>
            </div>
            <input type="submit" class="submit-info btn-grad" name="submit"  value= "Lưu thông tin">
    </form>
    <?php
    if(isset($_POST["submit"])){
    $hoten =$_POST["hoten"];
    $tinh = $_POST["Tinh"];
    $huyen = $_POST["Huyen"];
    $xa = $_POST["Xa"];
    $dc = $_POST["dc"];
    if($ktra) {
        $dtbset = "insert into `user-info`(`user_id`,`hoTen`, `Tinh`, `Huyen`, `Xa`, `DiaChi`)  values($user_id,'$hoten' , '$tinh', '$huyen', '$xa', '$dc')";
    }else {
        $dtbset = "update `user-info` set hoTen = '$hoten',Tinh = '$tinh', Huyen = '$huyen', Xa = '$xa', DiaChi = '$dc' where user_id = $user_id"; ;
    }
     if(mysqli_query($conn,$dtbset)) {
         ?>
                      <script >
                      alert("Cập Nhật Thành Công.Kết quả sẽ hiện sau khi tải lại trang");</script>
                      <?php
                        
        }
    }
    ?> 
</div>
</div>
   <?php include 'footer.php' ?>
   <script src = "./assets/js/up_avt.js"></script>
</body>
</html>