<?php   
include 'databaseshopOn.php'; 
session_start();
?>
<div class="header">
    <?php
    if(isset($_SESSION['account'])){
     ?>
    <div class="header-header">
        <div class="info ">
        <button class="item nav nav-js"><?='Chào '.$_SESSION['account']['name']?></button>
        <a href="info.php" class=" item-user"><i class="ti-user item-cart item-user"></i></a>
        <a href="" class=" item-cart"><i class="ti-shopping-cart item-cart"></i></a>
         <ul class="subnav-info">
    <li><a href="info.php">Thông tin tài khoản</a></li>
    <li>
    <form method="post" enctype="multipart/form-data" >
    <button class="btn-logout" name="btnout"> Đăng xuất</button>
    </form></li>
    <?php 
    if(isset($_POST["btnout"])){
    unset($_SESSION['account']);
    header("location:login.php");
}
    ?>
    </ul>
    </div>
    </div>
    <?php
    }else { 
        ?>
        <div class="header-header">
        <div class="info ">
        <p class="item"><a href="login.php">Đăng nhập</a></p>
        <p class="item"><a href="register.php">Đăng Ký</a></p>
        <a href="" class=" item-cart"><i class="ti-shopping-cart item-cart"></i></a>
    </div>
    </div>
        <?php
    }
     ?>
        <div class="body-header "> 
            <a href="index.php" class="">
                <h1>ShopOn</h1>
                <h5>Đồ công nghệ Online</h5>
            </a>

            <div class="search">
                <div class="search-2">
                    <form action="">
                <input type="text" class="search-input">
                <input type="submit" class="search-btn" value="Tìm kiếm">
                <button type="button" class="menu-mobile"><i class="ti-menu"></i></button>
            </form>
            </div>
            </div>
        </div>
    <div class="nav-bar nav-js ">
        <ul class="">
            <a href=""><li class="phone"><i class="ti-mobile"></i> Điện Thoại</li></a>
            <a href=""><li class="pc"><i class="ti-desktop"></i>Máy Tính</li></a>
            <a href=""><li class="phukien"><i class="ti-headphone"></i>Phụ Kiện</li></a>
            <a href=""><li class="maycu"><i class="ti-gift"></i>Máy cũ</li></a>
            <a href=""><li class="news"><i class="ti-pencil-alt"></i>Tin Tức</li></a>
        </ul>
    </div>
</div>
<div class="Space"></div>
<script>
    const MenuBtn = document.querySelector(".body-header .menu-mobile");
    const nav = document.querySelector(".header .nav-bar");
    MenuBtn.addEventListener('click',function() {
        nav.classList.toggle('open');
    })
    var openNav = document.querySelector(".nav-js");
    var subNav = document.querySelector(".subnav-info");
    openNav.onmouseover = function() {
        subNav.style.display = "block";
    };
    subNav.onmouseover = function() {
        subNav.style.display = "block";
    }
    openNav.onmouseout = function() {
        subNav.style.display = "none";
    };
    subNav.onmouseout = function() {
        subNav.style.display = "none";
    }
    
    

</script>
