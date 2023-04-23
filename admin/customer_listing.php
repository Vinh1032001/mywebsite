<?php
include 'header.php';
$config_name = "customer";
$config_title = "khách hàng";
if (!empty($_SESSION['current_user'])) {
	if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
		$_SESSION[$config_name.'_filter'] = $_POST;
		header('Location: '.$config_name.'_listing.php');exit;
	}
	$where = "id != ". $_SESSION['current_user']['id'];
	if(!empty($_SESSION[$config_name.'filter'])){
		foreach ($_SESSION[$config_name.'filter'] as $field => $value) {
			if(!empty($value)){
				switch ($field) {
					case 'first_name':
						$where .= (!empty($where))? " AND "."`".$field."` LIKE '%".$value."%'" : "`".$field."` LIKE '%".$value."%'";
						break;
					case 'last_name':
						$where .= (!empty($where))? " AND "."`".$field."` LIKE '%".$value."%'" : "`".$field."` LIKE '%".$value."%'";
						break;
					case 'email':
						$where .= (!empty($where))? " AND "."`".$field."` LIKE '%".$value."%'" : "`".$field."` LIKE '%".$value."%'";
						break;
					default:
						$where .= (!empty($where))? " AND "."`".$field."` = ".$value."": "`".$field."` = ".$value."";
						break;
				}
			}
		}
		extract($_SESSION[$config_name.'filter']);
	}
	$item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
	$current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
	$offset = ($current_page - 1) * $item_per_page;
	if(!empty($where)){
		$totalRecords = mysqli_query($con, "SELECT * FROM `user` where (".$where.")");
	}else{
		$totalRecords = mysqli_query($con, "SELECT * FROM `user`");
	}
	$totalRecords = $totalRecords->num_rows;
	$totalPages = ceil($totalRecords / $item_per_page);
	if(!empty($where)){
		$products = mysqli_query($con, "SELECT * FROM `user` where (".$where.") ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
	}else{
		$products = mysqli_query($con, "SELECT * FROM `user` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
	}
	mysqli_close($con);
	?>
	<div id="member-listing" class="main-content">
		<h1>Danh sách <?=$config_title?></h1>
		<div class="listing-items">
			<div class="buttons">
				<a href="./<?=$config_name?>_editing.php">Thêm <?=$config_title?></a>
			</div>
			<div class="listing-search">
				<form id="<?=$config_name?>-search-form" action="<?=$config_name?>_listing.php?action=search" method="POST">
					<fieldset>
						<legend>Tìm kiếm <?=$config_title?>:</legend>
						ID: <input type="text" name="id" value="<?=!empty($id)?$id:""?>" />
						Tên <?=$config_title?>: <input type="text" name="name" value="<?=!empty($name)?$name:""?>" />
						<input type="submit" value="Tìm" />
					</fieldset>
				</form>
			</div>
			<div class="total-items">
				<span>Có tất cả <strong><?=$totalRecords?></strong> <?=$config_title?> trên <strong><?=$totalPages?></strong> trang</span>
			</div>
			<ul>
			<?php $conn = mysqli_connect("localhost", "root", "", "demo_db");
			$sql = "SELECT * FROM customers";
			$result = mysqli_query($conn, $sql);			
			?>
				<li class="listing-item-heading"style="display: flex; border: 1px solid black;">
				<table>		
				<tr style="background-color: hsl(0, 0%, 50%)">
					<th style="color:white">ID</th>
					<th style="color:white">Họ và tên</th>
					<th style="color:white">Email</th>
					<th style="color:white">Địa chỉ</th>
					<th style="color:white">Ngày tạo</th>
					<th style="color:white">Ngày cập nhật</th>
					<th style="color:white" >Sửa</th>
					<th style="color:white">Xóa</th>
				</tr>
				<tr>
				<?php
				 while($row = mysqli_fetch_assoc($result)) {?>
					<a href="./order_listingdetail.php?id=<?= $row['id'] ?>">
    <div class="listing-prop listing-id"><?= $row['id'] ?></div>
</a>
					<th><?php echo  $row["name"]	?></th>
					<th><?php echo  $row["email"]	?></th>
					<th><?php echo  $row["address"]	?></th>
					<th><?php echo  $row["created_at"]	?></th>
					<th><?php echo  $row["last_update"]	?></th>
					<th><a href="./<?=$config_name?>_editing.php?id=<?= $row['id'] ?>">Sửa</a></th>
					<th><a href="./<?=$config_name?>_delete.php?id=<?= $row['id'] ?>">Xóa</a></th>
				</table>
				</li>
				<?php } ?>
			</ul>
			<?php
			include './pagination.php';
			?>
			<div class="clear-both"></div>
		</div>
	</div>
	<?php
}
include './footer.php';
?>