<?php
/**
 * Copyright C2009G
 *
 * Trang so sánh sản phẩm
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.category.php';

include_once 'lib/tool.image.php';
include_once 'product-wishlist-session.php';


//echo 'hello boy';
if (isset($_REQUEST['remove'])) {
    productwishlistRemove($_REQUEST['remove']);
}

$wishlistd_products = productwishlistGetProductsWithFormat();

// Nội dung riêng của trang...
$web_title = 'danh sách yêu thích';
$web_content = "view/view-product-wishlist.php";

// ...được đặt vào bố cục chung của toàn site.
include_once $web_layout;	
					
