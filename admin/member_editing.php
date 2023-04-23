<?php
include 'header.php';

if (!empty($_SESSION['current_user'])) {
	?>
	<div class="main-content">
		<h1><?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "Copy thành viên" : "Sửa thành viên") : "Thêm thành viên" ?></h1>
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
            <td>Username:</td>
            <td><input class= type="text" name="username" id="username" required></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" id="password" required></td>
        </tr>
        <tr>
            <td>Confirm Password:</td>
            <td><input type="password" name="re_password" id="re_password" required></td>
        </tr>
        <tr>
            <td>Full Name:</td>
            <td> <input class=type="text" name="fullname" id="fullname"></td>
        </tr>
    </table>
    <input type="submit" value="Submit">
</form>
<?php
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

<?php
}
include './footer.php';
?>