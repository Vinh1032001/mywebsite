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
		<h1><?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "Copy thành viên" : "Sửa thành viên") : "Thêm Khách hàng" ?></h1>
		<div id="content-box">
			<?php
			
            	if (!empty($_GET['id'])) {
            		$result = mysqli_query($con, "SELECT * FROM `user` WHERE `id` = " . $_GET['id']);
            		$user = $result->fetch_assoc();
            	}
				
            	?>
            	<form id="editing-form" method="POST" action="">
	<table>		
    <tr>
            <td>ID:</td>
            <td><input type="text" name="id"></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>Phone:</td>
            <td><input type="text" name="phone"></td>
        </tr>
        <tr>
            <td>Address:</td>
            <td><input type="text" name="address"></td>
        </tr>
        <tr>
            <td>Created At:</td>
            <td><input type="date" name="created_at"></td>
        </tr>
    </table>
    <input type="submit" value="Submit">
</form>
<?php
$requires_auth = false; // set this to true for pages that require authentication

if ($requires_auth && !is_authenticated()) {
    header("Location: login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['name']) && !empty($_POST['name'])
    && isset($_POST['email']) && !empty($_POST['email'])
    && isset($_POST['phone']) && !empty($_POST['phone'])
    && isset($_POST['address']) && !empty($_POST['address'])
    && isset($_POST['created_at']) && !empty($_POST['created_at'])) {
        $conn = mysqli_connect("localhost", "root", "", "demo_db");
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $created_at = date('Y-m-d H:i:s', strtotime($_POST['created_at']));
    $conn = mysqli_connect("localhost", "root", "", "demo_db");
    $result = mysqli_query($conn, "INSERT INTO customers (id, name, email, phone, address, created_at) VALUES ('$id', '$name', '$email', '$phone', '$address', '$created_at')");
    
    if (!$result) {
    $error = "Có lỗi xảy ra trong quá trình thực hiện.";
    } else {
        echo "<script>alert('Tạo khách hàng thành công  !'); </script>";
    }
    } else {
    $error = "Bạn phải nhập đầy đủ thông tin.";
    }
    }
    ?>
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