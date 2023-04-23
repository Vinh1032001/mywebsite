<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
?>
    <div class="main-content">
        <h1><?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "Copy sản phẩm" : "Sửa sản phẩm") : "Thêm đơn hàng" ?></h1>
        
        <div id="content-box">
                <a>Xin vui lòng nhập mã khách hàng để tiến hành nhập đơn hàng</a><br><br><br>
                <?php
                ?>
                <form method="POST" action="order_editing1.php">
                <label for="customer_id">Mã khách hàng:</label>
                <input type="text" id="customer_id" name="customer_id" required>
                <input type="submit" value="Gửi">
                </form>
<?php
if (!empty($_POST['customer_id'])) {
    $customer_id = $_POST['customer_id'];
// Kết nối tới cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra xem mã khách hàng có tồn tại trong bảng khách hàng hay không
$sql = "SELECT * FROM customers WHERE id = '$customer_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Nếu tồn tại, chuyển hướng tới trang khác
    header("Location: order_editing3.php?id=".$customer_id);
    exit();
} else {
    // Nếu không tồn tại, chuyển hướng tới trang quản lý khách hàng
    echo "<script>alert('Chưa có thông tin khách hàng , vui lòng tạo thông tin khách hàng!'); window.location.href = 'customer_editing.php';</script>";
    exit();
}
$conn->close();
 } }?>
        </div>
    </div>
<?php
include './footer.php';
?>