<?php
/**
 * Copyright C2009G
 *
 * Trang thêm mới sản phẩm.
 * Không gộp chung add và edit giống như nhiều framework từng làm !!!
 * Chia ra để trị, quản lý cho dễ.
 */
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.product.php';

include_once '../lib/table/table.order.php';

include_once 'product-validate.php';
include_once './phpexel.php';
$array = [
    ['Id', 'order_id', 'product_id','name','model','quantity','price','total']
];

$employees = get_all_order_details(); 

foreach($employees as $dong)
{
    $array = array_merge($array,array(array($dong['order_id'],$dong['product_id'],$dong['name'],$dong['model'],$dong['quantity'],$dong['price'],$dong['total'])));
}

$xlsx = Shuchkin\SimpleXLSXGen::fromArray($array);
$xlsx->downloadAs('LIST_ORDER_DETAILS.xlsx');