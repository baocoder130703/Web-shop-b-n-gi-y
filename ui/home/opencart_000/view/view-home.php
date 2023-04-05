<?php  function currency_format($number, $suffix = 'đ') {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "{$suffix}";
        }
    }
?>
<div class="container">
    <div class="row">
        <div id="content" class="col-sm-12">
             <!-- 
             SLIDE SHOW BANNER TO VÀ DÀI Ở TRANG CHỦ (đang bị lỗi khi thu nhỏ)
             phải xóa đi nhiều mã html sinh ra ở bản lưu từ IE về thì slide mới chạy được. 
             -->
             <div id="slideshow0" class="flexslider">
             	<ul class="slides" style="width: 400%; transition-duration: 0.6s; transform: translate3d(-1132px, 0px, 0px);">
                <?php foreach (banner_imageActives() as $banner) { ?>
					<li style="width: 1132px; float: left; display: block;">
						<?php if ($banner['link']) { ?>
						<a href="<?php echo $banner['link']; ?>">
							<img src="<?php echo $banner['url_image_resized']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
						</a>
						<?php } else { ?>
						<img src="<?php echo $banner['url_image_resized']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
						<?php } ?>
						<?php echo $banner['description'].$banner['price_text'];?>
					</li>
				<?php } ?>
            	</ul>
            </div>
            <script type="text/javascript">
                $('#slideshow0').flexslider({
                    animation: 'slide',
                    animationLoop: true,
                    itemWidth: 1140
                });
            </script>
            
            <!-- START LOẠI SẢN PHẨM NỔI BẬT -->
            <h3>Danh Mục Nổi Bật</h3>
		    <div class="row"  style="border-bottom: #ddd solid 1px;">
		    	<?php foreach (categoryFeatureds( ['width'=>370,'height'=>240, 'limit'=>settings('categories_featured_limit')] ) as $category) { ?>
				<div class="col-sm-4">
					<a href="<?php echo $category['href']; ?>">
					<img src="<?php echo $category['url_image_resized']; ?>" alt="banner-3" title="banner-3" width="<?php echo $category['width']?>" height="<?php echo $category['height']?>" style="transition: all 0.5s ease;z-index: -100">
					<div class="s-desc" style="">
						<h1><?php echo $category['name']; ?></h1>
					</div>
					</a>
				</div>
				<?php } ?>
		    </div>
		    <!-- END LOẠI SẢN PHẨM GIỚI THIỆU -->
		    
		    <!-- START SẢN PHẨM NỔI BẬT -->
		    <h3>Sản Phẩm Nổi Bật</h3>
            <div class="row product-layout">
			    <?php foreach (productFeatureds(['width'=>200, 'height'=>200, 'limit'=>settings('products_featured_limit')]) as $product) { ?>                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="product-thumb transition">
                        <div class="image" style="position: relative;">
                            <?php if($product['sale']!=0){?>
                                    <div style=" position: absolute; top: 0px; right: 0px; background-color: red;z-index: 2; font-size: 17px;color:#ddd;border-radius: 3px;padding: 7px;">
                                        <?php echo 'Giảm' . $product['sale'].'%' ?>
                                    </div>
                            <?php }?>
                            <?php if($product['new']!=0){?>
                                    <div style=" position: absolute; top: 35px; right: 0px; background-color: tomato;z-index: 2; font-size: 17px;color:#ddd; border-radius: 3px ;padding: 7px;width:89px">
                                        <?php echo ' new '  ?>
                                    </div>
                            <?php }?>

                         
                            <a href="<?php echo $product['href']; ?>">
                            	<img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive">
                            </a>
                        </div>
                        <div class="caption">
                            <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                            <p><?php echo $product['desc_short']; ?></p>
                            <p class="price">
                                <?php if($product['sale']!=0){ ?>
                                    <?php $bien_price = $product['price'] - (int)($product['price']*($product['sale']/100));?>
                                    <span class="price-new"><del><?php echo $product['price_text']; ?></del></span>
                                    <span style="font-size: 17px; color: tomato; margin-left: 10px;" class="price-new" ><?php echo  currency_format($bien_price); ?></span> 
                                    <?php }?>
                                <?php if($product['sale']==0) {?>
                                    <span class="price-new"><?php echo $product['price_text']; ?></span>
                                <?php } ?> 
                            </p>
                            <p class="soluong">
                                <?php if($product['soluong']>0) {?>
                                    <span>còn hàng</span>
                                <?php }?>
                                <?php if($product['soluong']<=0) {?>
                                    <span>cháy hàng</span>
                                <?php }?>
                            </p>
                        </div>
                        <div class="button-group">
                            <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Thêm vào giỏ</span></button>
                            <button type="button" data-toggle="tooltip" title="" onclick="wishlist.add('<?php echo $product['product_id']?>');"data-original-title="them vao san pham"><i class="fa fa-heart"></i></button>
                            <button type="button" data-toggle="tooltip" title="" onclick="compare.add('<?php echo $product['product_id']?>');" data-original-title="So sánh sản phẩm"><i class="fa fa-exchange"></i></button>
                        </div>
                    </div>
                </div>
                <?php }  ?>
            </div>
			
			<h3>Nhãn Hàng Nổi Bật</h3>
             <!-- SLIDE SHOW ẢNH LOGO CÁC HÃNG SẢN XUẤT -->
             <div id="carousel0" class="flexslider carousel">
                    <ul class="slides" style="width: 2200%; transition-duration: 0.6s; transform: translate3d(-1540px, 0px, 0px);">
                        
                        <?php foreach (manufacturerFeatureds(['width'=>100, 'height'=>100, 'limit'=>settings('manufacturers_featured_limit')]) as $manufacturer) { ?>
                        <li style="width: 208px; float: left; display: block;">
						    <a href="<?php echo $manufacturer['href']; ?>">
						    	<img src="<?php echo $manufacturer['thumb']; ?>" alt="<?php echo $manufacturer['name']; ?>" class="img-responsive" draggable="false" />
						    </a>
						 </li>
						 <?php } ?>
                    </ul>
            </div>
            
            <script type="text/javascript">
                $(window).load(function() {
                    $('#carousel0').flexslider({
                        animation: 'slide',
                        itemWidth: 130,
                        itemMargin: 100,
                        minItems: 2,
                        maxItems: 5
                    });
                });
            </script>
            
            <!-- Google Map 
			<div style="height: 450px;position: relative; background-color: rgb(229, 227, 223); overflow: hidden;" id="google-map" class="col-sm-12">
			</div>
			-->
			<!-- Tham khảo cách nhúng bản đồ Google Map vào html
			https://support.google.com/maps/answer/144361?hl=vi&co=GENIE.Platform%3DDesktop
			 -->
			<?php //echo html_google_map();?>
        </div>
    </div>
</div>
