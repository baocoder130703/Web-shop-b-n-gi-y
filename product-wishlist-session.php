<?php
/**
 * Copyright C2009G
 *
 * Các hàm quản lý sản phẩm trong mục so sánh
 */
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/tool.image.php';

/*
 Dữ liệu trong mục so sánh sản phẩm được lưu trong mảng $_SESSION['product_wishlist'].
 Mỗi phần tử trong mảng này là một mã của sản phẩm đã được đưa vào so sánh
 */
global $product_wishlist_data;

$product_wishlist_data = array();
	

// Khởi tạo dữ liệu so sánh sản phẩm
if (!isset($_SESSION['product_wishlist']) || !is_array($_SESSION['product_wishlist'])) 
{
	$_SESSION['product_wishlist'] = array();
}

/*
	 Các thông tin của product được lấy từ db ở checkout/cart/add.php 
	 và ở đây nó được mã hóa thành một chuỗi kiểu base64.
	 Sang bên hàm getProducts() lại được giải mã để lấy các thông tin của sản phẩm. 
*/
function productwishlistAdd($product_id) 
{
    global $product_wishlist_data;
	$product_wishlist_data = array();

	
	// Nếu sản phẩm đã có trong mục so sánh rồi thì thôi !
	if(in_array($product_id, $_SESSION['product_wishlist']))
	    return;
	
	// Thực ra cũng không cần phải kiểm tra tính tồn tại
	// của sản phẩm theo id vì "/product-add.php" bị gọi theo kiểu
	// Ajax, chỉ sợ hàm này bị gọi theo kiểu GET method
// 	$product_info = productDetails($product_id);
// 	if (!is_array($product_info) || empty($product_info)) 
// 		return;
	
	$_SESSION['product_wishlist'][] = $product_id;
	    
	// Nếu có tới 4 sản phẩm trong mục so sánh thì 
	// bỏ đi sản phẩm đầu tiên (liệu có nên làm slide chạy ???)
	if (count( $_SESSION['product_wishlist'] ) >= 4) 
		array_shift($_SESSION['product_wishlist']);
	    
	
	

}

// Gỡ bỏ một sản phẩm khỏi so sánh.
function productwishlistRemove($product_id) 
{
	global $product_wishlist_data;
	$product_wishlist_data = array();
	
	if ( ($key = array_search($product_id, $_SESSION['product_wishlist'])) !== false ) {
	    unset($_SESSION['product_wishlist'][$key]);
	}
	
}

// Lấy ra tất cả các sản phẩm trong mục so sánh
function productwishlistGetProducts() 
{
	global $product_wishlist_data;
	
	if (!$product_wishlist_data) 
	{
	   foreach ($_SESSION['product_wishlist'] as $product_id) 
	   {
            $stock = true;
				
			$sql = " 
			     SELECT
                      p.product_id,
                      p.name,
                      p.model,
                      p.image,
                      p.price,
					  p.sale,
                      p.description,
                      p.manufacturer_id,
                      m.name AS manufacturer_name
                  FROM `product` AS p 
                  LEFT JOIN `manufacturer` AS m
                  ON p.manufacturer_id = m.manufacturer_id
			      WHERE p.product_id = '{$product_id}' AND p.status = '1'
		    ";
				
				
			$product_query = db_row($sql);
				
				
		    if (is_array($product_query) && !empty($product_query)) 
		    {
		         $product_wishlist_data[] = array(
						'product_id'      => $product_query['product_id'],
						'name'            => $product_query['name'],
						'model'           => $product_query['model'],
						'image'           => $product_query['image'],
					    'price'           => $product_query['price'],
						'sale'           =>  $product_query['sale'],
					    'description'     => $product_query['description'],
					    'manufacturer_id'    => $product_query['manufacturer_id'],
					    'manufacturer_name'    => $product_query['manufacturer_name'],
			     );
			} 
			else 
			{
			    productwishlistRemove($product_id);
		    }
		}
	}

	return $product_wishlist_data;
} // end getProducts()

/*
 Định dạng dữ liệu sản phẩm trước khi được hiển thị bên view html.
 khác so với hàm cartGetProducts() chỉ lấy dữ liệu thô.
 Mục đích là để đồng bộ mã nguồn (tránh dư thừa) ở các file 
 cart.php, checkout.php
 */
function productwishlistGetProductsWithFormat()
{
	$products = array();
	
	foreach (productwishlistGetProducts() as $product) 
	{
		// Ảnh đại diện sản phẩm
		if ($product['image']) 
		{
			$image = img_resize($product['image'], settings('config_image_cart_width'), settings('config_image_cart_height'));
		} else 
		{
			$image = '';
		}
		
		// Giá sản phẩm				
		$price = number_format($product['price'],0,'.',',').' ₫';
	
		// Tổng giá trị của số sản phẩm
		$total = number_format($product['total'], 2, '.', ',').' ₫';
					
					
		$products[] = array(
			'thumb'     => $image,
		    'product_id'  => $product['product_id'],
			'name'      => $product['name'],
			'model'     => $product['model'],
			'price'     => $price,
			'sale'     => $product['sale'],
		    'description' => utf8_substr(strip_tags(html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8')), 0, settings('config_product_description_length')) . '..',
			'href'      => '/product-info.php?product_id='.$product['product_id'],
		    'manufacturer_id'    => $product['manufacturer_id'],
		    'manufacturer_name'    => $product['manufacturer_name']
		);
	}
	
	return $products;
}
	
function productwishlistCountProducts() 
{
	return count(productwishlistGetProducts());
}
	
