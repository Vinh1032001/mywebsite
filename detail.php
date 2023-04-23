<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" href="css/detail.css">
<?php
include './connect_db.php';
$result = mysqli_query($con, "SELECT * FROM `product` WHERE `id` = " . $_GET['id']);
$product = mysqli_fetch_assoc($result);
$imgLibrary = mysqli_query($con, "SELECT * FROM `image_library` WHERE `product_id` = " . $_GET['id']);
$product['images'] = mysqli_fetch_all($imgLibrary, MYSQLI_ASSOC);
?>
<section id="product-filter">
    <section class="container">
        <label>Filter</label>
        <section id="brand-filter" class="filter-column">
            <h2>Brands</h2>
            <section id="brand-list">
                <ul>
                    <li><a href="#">Adidas</a></li>
                    <li><a href="#">Nike</a></li>
                    <li><a href="#">Camper</a></li>
                    <li><a href="#">Superga</a></li>
                    <li><a href="#">Tımberland</a></li>
                    <li><a href="#">New balance</a></li>
                    <li><a href="#">Converse</a></li>
                    <li><a href="#">Puma</a></li>
                    <li><a href="#">Tiger</a></li>
                    <li><a href="#">Lacoste</a></li>
                    <li><a href="#">Reebok</a></li>
                    <li><a href="#">Cat</a></li>
                    <li><a href="#">Dockers</a></li>
                    <li class="clear-both"></li>
                </ul>
            </section>
        </section>
        <section id="category-statistic" class="filter-column">
            <section class="category">
                <h3>Nữ</h3>
                <section class="category-image">
                    <img src="images/woman.jpg" />
                </section>
                <section class="total-product">Tổng</section>
                <section class="number-product">357 sản phẩm</section>
                <img src="images/product-list-icon.png" />
            </section>
            <section class="category center-block">
                <h3>Nam</h3>
                <section class="category-image">
                    <img src="images/men.jpg" />
                </section>
                <section class="total-product">Tổng</section>
                <section class="number-product">125 sản phẩm</section>
                <img src="images/product-list-icon.png" />
            </section>
            <section class="category">
                <h3>Trẻ em</h3>
                <section class="category-image">
                    <img src="images/kids.jpg" />
                </section>
                <section class="total-product">Tổng</section>
                <section class="number-product">251 sản phẩm</section>
                <img src="images/product-list-icon.png" />
            </section>
            <section class="clear-both"></section>
        </section>
        <section id="property-filter" class="filter-column">
            <img src="images/property-filter.jpg" />
        </section>
        <section class="clear-both"></section>
    </section>
</section>
<section id="hot-products">

    <section id="product-box" class="container">
        <section class="product-detail">
            <section id="product-name">
                <h1><?= $product['name'] ?></h1>
            </section>
            <section id="product-attributes">
                <section id="product-gallery">
                    <section id="main-image">
                        <img src="<?= $product['image'] ?>"> 
                    </section>

                </section>  
                <section id="product-attribute-detail">
                    <section id="product-price"><span><?= number_format($product['price'], 0, ",", ".") ?> Đ</span></section>
                    <hr>
                    <?php if ($product['quantity'] > 0) { ?>
                        <div class="product-quantity"><label>Tồn kho: </label><strong><?= $product['quantity'] ?></strong></div>
                        <form id="add-to-cart-form" action="cart.php?action=add" method="POST">
                            <label>Số lượng: </label>
                            <input type="text" value="1" name="quantity[<?= $product['id'] ?>]" size="2" style=" width: 30px; "><br>
                            <input type="submit" value="">
                        </form>
                    <?php } else { ?>
                        <span class="error">Hết hàng</span>
                    <?php } ?>
                    <?php if (!empty($product['images'])) { ?>
                        <section id="more-images">
                            <ul>
                                <?php foreach ($product['images'] as $num => $img) { ?>
                                    <li <?php if ($num % 3 == 0) { ?> class="first-line" <?php } ?>>
                                        <img src="<?= $img['path'] ?>"> 
                                    </li>
                                <?php } ?>
                                <div class="clear-both"></div>
                            </ul>
                        </section>
                    <?php } ?>
                </section>
                <section class="clear-both"></section>
            </section>
        </section>
    </section>
    <section id="product-heading" class="container">
        <ul>
            <li id="product-intro" class="active">Chi tiết sản phẩm</li>
            <li id="proudct-comment">Bình luận sản phẩm</li>
            <li class="clear-both" ></li>
        </ul>
    </section>
    <section id="product-content" class="container">
        <section id="product-display">
            <section id="produc-intro-content" class="display-box active">
                <?= $product['content'] ?>
            </section>
            <section id="product-comment-content"  class="display-box">
                Nội dung bình luận
            </section>
        </section>
    </section>
</section>
<?php include("footer.php"); ?>