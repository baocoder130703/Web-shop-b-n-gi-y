<?php 

include_once '../configs.php';

// Thư viện hàm
include_once '../lib/tool.image.php';
include_once '../lib/table/table.product.php';

$web_title = "Bảng Số Liệu";
$web_content = "../ui/admin/view/view-chart.php";
$active_page_admin = ACTIVE_PAGE_ADMIN_CHART;

check_file_layout($web_layout_admin, $web_content);

// được đặt vào bố cục chung của toàn site:
include_once $_SERVER["DOCUMENT_ROOT"]."/".$web_layout_admin;

// ?>

