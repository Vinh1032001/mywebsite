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
		<h1>Chi tiết đơn hàng</h1>
		<div id="content-box">
            <?php
$requires_auth = false; // set this to true for pages that require authentication

if ($requires_auth && !is_authenticated()) {
    header("Location: login.php");
    exit();
}
?>
        <?php $conn = mysqli_connect("localhost", "root", "", "demo_db");
			$sql = "SELECT product.name, order_detail.quantity,order_detail.price
            FROM order_detail
            JOIN product ON order_detail.product_id = product.id;";
			$result = mysqli_query($conn, $sql);			
			?>
				<li class="listing-item-heading"style="display: flex; border: 1px solid black;">
				<table>		
				<tr style="background-color: hsl(0, 0%, 50%)">
					<th style="color:white">Tên sản phẩm</th>
					<th style="color:white">Số lượng</th>
					<th style="color:white">Giá</th>
					<th style="color:white" ></th>
					<th style="color:white"></th>
				</tr>
				<?php
				 while($row = mysqli_fetch_assoc($result)) {?>
                 	<tr>
					<th><?php echo  $row["name"]?></th>
					<th><?php echo  $row["quantity"]?></th>
					<th><?php echo  $row["price"]?></th>
					<th><a>Sửa</a></th>
					<th><a>Xóa</a></th>
                    <?php } ?></tr>
				</table>
				</li>
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