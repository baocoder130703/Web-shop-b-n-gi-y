<?php  function currency_format($number, $suffix = 'đ') {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "{$suffix}";
        }
    }
?>
<div class="container">
  <ul class="breadcrumb">
    <li><a href="/home.php"><i class="fa fa-home"></i>Trang Chủ</a></li>
    <li><a href="/product-info.php?product_id=<?php echo $_GET['product_id']; ?>"><?php echo $product_info['name'];?></a></li>
  </ul>
  <div class="row">
    <div id="content" class="col-sm-12">
      <div class="row">
        <div class="col-sm-8">
          <?php if ($product_info['thumb'] || $product_info['product_images']) { ?>
          <ul class="thumbnails">
          <?php if($product_info['sale']!=0) { ?>
           <div style="position: absolute;top: 0px; right: 0px; z-index: 2;background-color: red ;color:#ddd ;padding: 7px; border-radius: 3px ;font-size: 17px;";>
               <?php echo 'Giảm '.$product_info['sale'].'%'?>
            </div>
          <?php } ?>
          <?php if($product_info['new']!=0){?>
              <div style=" position: absolute; top: 35px; right: 0px; background-color: tomato;z-index: 2; font-size: 17px;color:#ddd; border-radius: 3px ;padding: 7px;width:93px">
              <?php echo ' new '  ?>
              </div>
          <?php }?>
            <?php if ($product_info['thumb']) { ?>
            <li><a class="thumbnail" href="<?php echo $product_info['popup']; ?>" title="<?php echo $product_info['name'];?>"><img src="<?php echo $product_info['thumb']; ?>" title="<?php echo $product_info['name']; ?>" alt="<?php echo $product_info['name']; ?>" /></a></li>
            <?php } ?>
            <?php if ($product_info['product_images']) { ?>
            <?php foreach ($product_info['product_images'] as $image) { ?>
            <li class="image-additional">
            	<a class="thumbnail" rel="fancybox" href="<?php echo $image['popup']; ?>" title="<?php echo $product_info['name']; ?>"> <img src="<?php echo $image['thumb']; ?>" title="<?php echo $product_info['name']; ?>" alt="<?php echo $product_info['name']; ?>" /></a>
            </li>
            <?php } ?>
            <?php } ?>
          </ul>
          <?php } ?>
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-description" data-toggle="tab">Mô tả</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-description"><?php echo $product_info['description']; ?></div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="btn-group">
            <button type="button" data-toggle="tooltip" class="btn btn-default" title="Wishlist" onclick="wishlist.add('<?php echo $product_info['product_id']; ?>');"><i class="fa fa-heart"></i></button>
            <button type="button" data-toggle="tooltip" class="btn btn-default" title="So sánh sản phẩm" onclick="compare.add('<?php echo $product_info['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
          </div>
          <h1><?php echo $product_info['name']; ?></h1>
          <ul class="list-unstyled">
            <li>Nhà sản xuất: <a href="<?php echo $product_info['manufacturer_href']; ?>"><?php echo $product_info['manufacturer']; ?></a></li>
            <li>Model: <?php echo $product_info['model']; ?></li>
            <?php if($product_info['soluong'] > 0){ ?>
              <li>Tình trạng: <?php echo $product_info['availability']==0; ?></li>
            <?php }  ?>
            <?php if($product_info['soluong'] <= 0){ ?>
              <li>Tình trạng: hết hàng</li>
            <?php }  ?>
            <?php { ?>
              <li> còn : <?php echo $product_info['soluong']  ?> sản phẩm </li>
            <?php }?>
          </ul>
          <?php  echo ' + '.$product_info['sale']; ?>
          <ul class="list-unstyled">
            <li>
            <?php if($product_info['sale'] != 0) { ?>
                  <?php $bien_price = $product_info['price'] - (int)($product_info['price'] * ($product_info['sale']/100));?>
                  
                  <h2 class="price-new"> <del> <?php echo currency_format($product_info['price'] );?> </del></h2> 
                  <h2 style="  color: tomato;margin-right: 5px;" >  <?php echo  currency_format($bien_price);?> </h2> 
                <?php }?>
                <?php if($product_info['sale'] == 0) { ?>
                  <h2 class="price-new"> <?php echo currency_format($product_info['price'] );?></h2> 
                                   
                <?php }?>
              
            </li>
          </ul>
          <div id="product">
            <div class="form-group">
              <label class="control-label" for="input-quantity">Số lượng</label>

              <?php if($product_info['soluong']<=0){?>
                <input type="text" name="quantity" value="0" size="2" id="input-quantity" class="form-control" disabled/>
                <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>" />
                <br />
                <button onclick="" type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg btn-block">Thêm vào giỏ hàng</button>
              <?php }?>

              <?php if($product_info['soluong'] > 0){ ?>
                <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />
                <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>" />
                <br />
                <button onclick="" type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg btn-block">Thêm vào giỏ hàng</button>
              <?php } ?>
              
            
            </div>
            <?php if ($minimum > 1) { ?>
            <div class="alert alert-info"><i class="fa fa-info-circle"></i> Tối thiểu</div>
            <?php } ?>
          </div>
        </div>
      </div>
      
      <!--  trước đây là sản phẩm nổi bật, có thể xem lại code trong view-product-info.php -->      
      
      <?php if ($tags) { ?>
      <p><?php echo $text_tags; ?>
        <?php for ($i = 0; $i < count($tags); $i++) { ?>
        <?php if ($i < (count($tags) - 1)) { ?>
        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
        <?php } else { ?>
        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
        <?php } ?>
        <?php } ?>
      </p>
      <?php } ?>
      </div>
    </div>
</div>

<script type="text/javascript">

$('#button-cart').on('click', function() {
	$.ajax({
		url: '/cart-add.php',
		type: 'post',
		data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-cart').button('loading');
		},
		complete: function() {
			$('#button-cart').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));
						
						if (element.parent().hasClass('input-group')) {
							element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						} else {
							element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						}
					}
				}
				
				if (json['error']['recurring']) {
					$('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
				}
				
				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}
			
			if (json['success']) {
				$('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				
				$('#cart-total').html(json['total']);
				
				$('html, body').animate({ scrollTop: 0 }, 'slow');
				
				//$('#cart > ul').load('index.php?route=common/cart/info ul li');
				// tải lại nội dung html của giỏ hàng bằng (ajax load) lấy từ nguồn: /common/cart-info.php
				// chỉ lấy phần nội dung bên trong phần tử html có id="cart" 
				// sau đó đắp phần html đó vào bên trong phần tử id="cart" của trang hiện tại.
				$('#cart').load('/cart-ajax.php#cart > *');
			}
		}
	});
});
</script>

<script type="text/javascript">

$(function(){
	$('.date').datetimepicker({
		pickTime: false
	});

	$('.datetime').datetimepicker({
		pickDate: true,
		pickTime: true
	});

	$('.time').datetimepicker({
		pickDate: false
	});
});


</script> 

<script type="text/javascript">
//Slideshow ảnh sản phẩm
// đừng có cố đưa bxslider, elevatezoom vào đây
// vì mã html/css không tương thích tí nào.
// nếu thích thì tích hợp thêm một bản horizontal slide vào themes mẫu
// một bản vertical slide (khó) vào nữa.
// $(document).ready(function() { // không chạy !!!

// 	$('.thumbnails').magnificPopup({
// 		type:'image',
// 		delegate: 'li > a',
// 		gallery: {
// 			enabled:true
// 		}
// 	});
	
// });

	$('.thumbnails').magnificPopup({ // chạy ngon (: >
		type:'image',
		delegate: 'li > a',
		gallery: {
			enabled:true
		}
	});
	
</script>
