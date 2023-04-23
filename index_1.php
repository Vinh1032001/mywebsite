<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Bài 32: Hướng dãn ghép giao diện cho website bán giày</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="libs/fancybox/jquery.fancybox.min.css"/>
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" type="text/css" href="css/cart.css" >
    </head>
    <body>
        <?php
        $param = "";
        $sortParam = "";
        $orderConditon = "";
        //Tìm kiếm
        $search = isset($_GET['name']) ? $_GET['name'] : "";
        if ($search) {
            $where = "WHERE `name` LIKE '%" . $search . "%'";
            $param .= "name=" . $search . "&";
            $sortParam = "name=" . $search . "&";
        }

        //Sắp xếp
        $orderField = isset($_GET['field']) ? $_GET['field'] : "";
        $orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";
        if (!empty($orderField) && !empty($orderSort)) {
            $orderConditon = "ORDER BY `product`.`" . $orderField . "` " . $orderSort;
            $param .= "field=" . $orderField . "&sort=" . $orderSort . "&";
        }

        include './connect_db.php';
        $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 4;
        $current_page = !empty($_GET['page']) ? $_GET['page'] : 1; //Trang hiện tại
        $offset = ($current_page - 1) * $item_per_page;
        if ($search) {
            $products = mysqli_query($con, "SELECT * FROM `product` WHERE `name` LIKE '%" . $search . "%' " . $orderConditon . "  LIMIT " . $item_per_page . " OFFSET " . $offset);
            $totalRecords = mysqli_query($con, "SELECT * FROM `product` WHERE `name` LIKE '%" . $search . "%'");
        } else {
            $products = mysqli_query($con, "SELECT * FROM `product` " . $orderConditon . " LIMIT " . $item_per_page . " OFFSET " . $offset);
            $totalRecords = mysqli_query($con, "SELECT * FROM `product`");
        }
        $totalRecords = $totalRecords->num_rows;
        $totalPages = ceil($totalRecords / $item_per_page);
        ?>
        <div id="wrapper-product" class="container">
            <h1>Danh sách sản phẩm</h1>
            <div id="filter-box">
                <form id="product-search" method="GET">
                    <label>Tìm kiếm sản phẩm</label>
                    <input type="text" value="<?= isset($_GET['name']) ? $_GET['name'] : "" ?>" name="name" />
                    <input type="submit" value="Tìm kiếm" />
                </form>
                <select id="sort-box" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                    <option value="">Sắp xếp giá</option>
                    <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "desc") { ?> selected <?php } ?> value="?<?= $sortParam ?>field=price&sort=desc">Cao đến thấp</option>
                    <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "asc") { ?> selected <?php } ?> value="?<?= $sortParam ?>field=price&sort=asc">Thấp đến cao</option>
                </select>
                <div style="clear: both;" ></div>
            </div>
            <div class="product-items">
                <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>
                    <div class="product-item">
                        <div class="product-img">
                            <a href="detail.php?id=<?= $row['id'] ?>"><img src="<?= $row['image'] ?>" title="<?= $row['name'] ?>" /></a>
                        </div>
                        <strong><a href="detail.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></strong><br/>
                        <label>Giá: </label><span class="product-price"><?= number_format($row['price'], 0, ",", ".") ?> đ</span><br/>
                        <p><?= $row['content'] ?></p>
                        <div class="buy-button">
                            <?php if ($row['quantity'] > 0) { ?>
                                <form class="quick-buy-form" action="cart.php?action=add" method="POST">
                                    <input type="hidden" value="1" name="quantity[<?= $row['id'] ?>]" />
                                    <input type="submit" value="Mua ngay" />
                                </form>
                            <?php } else { ?>
                                <strong>Hết hàng</strong>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="clear-both"></div>
                <?php
                include './pagination.php';
                ?>
                <div class="clear-both"></div>
            </div>
        </div>
        <div id="cart-icon">
            <a data-fancybox data-type="ajax" data-src="ajax-cart.php" href="javascript:;">
                <img width="100" src="images/cart.png" alt="alt"/>
            </a>
        </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="libs/fancybox/jquery.fancybox.min.js"></script>
        <script>
                    $(".quick-buy-form").submit(function (event) {
                        event.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: './process_cart.php?action=add',
                            data: $(this).serializeArray(),
                            success: function (response) {
                                response = JSON.parse(response);
                                if (response.status == 0) { //Có lỗi
                                    alert(response.message);
                                } else { //Mua thành công
                                    alert(response.message);
//                                    location.reload();
                                }
                            }
                        });
                    });
        </script>
    </body>
</html>