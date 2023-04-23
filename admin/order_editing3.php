<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/admin_style.css" >
        <script src="../resources/ckeditor/ckeditor.js"></script>
    </head>
    <body>
            <div id="admin-heading-panel">
                <div class="container">
                    <div class="left-panel">
                        Xin chào <span>Admin</span>
                    </div>
                    <div class="right-panel">
                        <img height="24" src="../images/home.png" />
                        <a href="../index.php">Trang chủ</a>
                        <img height="24" src="../images/logout.png" />
                        <a href="logout.php">Đăng xuất</a>
                    </div>
                </div>
            </div>
            <div id="content-wrapper">
                <div class="container">
                    <div class="left-menu">
                        <div class="menu-heading">Admin Menu</div>
                        <div class="menu-items">
                            <ul>
                                <li><a href="dashboard.php">Thông tin hệ thống</a></li>
                                    <li><a href="product_listing.php">Sản phẩm</a></li>
                                    <li><a href="order_listing.php">Đơn hàng</a></li>
                                    <li><a href="member_listing.php">Quản lý thành viên</a></li>
                                    <li><a href="customer_listing.php">Quản lý khách hàng</a></li>

                               
                            </ul>
                        </div>
                    </div>

<?php
$requires_auth = false; // set this to true for pages that require authentication

if ($requires_auth && !is_authenticated()) {
    header("Location: index.php");
    exit();
}

?>
	<div class="main-content">
		<h1> Thêm đơn hàng</h1>
		<div id="content-box">
			<?php
            	?>
            	<form id="editing-form" method="POST" action="">
					
    <label for="username">Username:</label>
    <input class= type="text" name="username" id="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <label for="re_password">Confirm Password:</label>
    <input type="password" name="re_password" id="re_password" required>
    <br>
    <label for="fullname">Full Name:</label>
    <input class=type="text" name="fullname" id="fullname">
    <br>
    <input type="submit" value="Submit">
</form>
<?php
$requires_auth = false; // set this to true for pages that require authentication

if ($requires_auth && !is_authenticated()) {
    header("Location: login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && !empty($_POST['username']) 
        && isset($_POST['password']) && !empty($_POST['password'])
        && isset($_POST['re_password']) && !empty($_POST['re_password'])) {
        if ($_POST['password'] != $_POST['re_password']) {
            $error = "Mật khẩu xác nhận không khớp";
        } else {
            $username = mysqli_real_escape_string($con, $_POST['username']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
            $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
            $result = mysqli_query($con, "INSERT INTO `user` (`id`, `username`, `fullname`, `password`, `birthday`, `created_time`, `last_updated`) VALUES (NULL, '$username', '$fullname', '$password', '".time()."', '".time()."', ".time().");");
            if (!$result) {
                $error = "Có lỗi xảy ra trong quá trình thực hiện.";
            } else {
                // Success
            }
        }
    } else {
        $error = "Bạn phải nhập đầy đủ thông tin.";
    }
	
}?>
            	<div class="clear-both"></div>
            	<script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('product-content');
                </script>
        </div>
    </div>
    <div class="clear-both"></div>
    </div>
    </div>
    <div id="admin-footer">
        <div class="container">
            <div class="left-panel">
                © Copyright 2019 - Andn Php Training
            </div>
            <div class="right-panel">
                <a target="_blank" href="https://www.facebook.com/andn.training/" ><img height="48" src="../images/facebook.png" /></a>
                <a target="_blank" href="https://www.youtube.com/channel/UCL0TRguwV_cNU-YEuYLo2Mw" ><img height="48" src="../images/youtube.png" /></a>
            </div>
            <div class="clear-both"></div>
        </div>
    </div>