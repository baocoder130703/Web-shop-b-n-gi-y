

<div id="product-wishlist" class="container">
   <ul class="breadcrumb">
      <li><a href="/home.php"><i class="fa fa-home"></i></a></li>
      <li><a href="/product-wishlist.php">Danh Sách yêu thích</a></li>
   </ul>
   <div class="row">
      <div id="content" class="col-sm-12">
      <?php if(count($wishlistd_products)) {?>
         <h1>Danh Sách yêu thích</h1>
         <table class="table table-bordered">
            <thead>
               <tr>
                  <td colspan="<?php echo count($wishlistd_products)+1;?>"><strong>Thông Tin Sản Phẩm</strong></td>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Sản Phẩm</td>
                  <?php foreach($wishlistd_products as $product) {?>
                  <td><a href="<?php echo $product['href']?>"><strong><?php echo $product['name']?></strong></a></td>
                  <?php }?>
               </tr>
               <tr>
                  <td>Ảnh</td>
                  <?php foreach($wishlistd_products as $product) {?>
                  <td class="text-center"> <img src="<?php echo $product['thumb']?>" alt="<?php echo $product['name']?>" title="<?php echo $product['name']?>" class="img-thumbnail"> </td>
                  <?php }?>
               </tr>
               <tr>
                  <td>Giá</td>
                  <?php foreach($wishlistd_products as $product) {?>
                  <td class="text-center"><?php echo $product['price']?></td>
                  <?php }?>
               </tr>
               <tr>
                  <td>Model</td>
                  <?php foreach($wishlistd_products as $product) {?>
                  <td class="text-center"><?php echo $product['model']?></td>
                  <?php }?>
               </tr>
               <tr>
                  <td>Thương Hiệu</td>
                  <?php foreach($wishlistd_products as $product) {?>
                  <td class="text-center"><?php echo $product['manufacturer_name']?></td>
                  <?php }?>
               </tr>
               <!-- 
               <tr>
                  <td>Availability</td>
                  <td>Out Of Stock</td>
                  <td>2-3 Days</td>
               </tr>
               <tr>
                  <td>Rating</td>
                  <td class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <br>
                     Based on 0 reviews.
                  </td>
                  <td class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <br>
                     Based on 0 reviews.
                  </td>
               </tr>
                -->
               <tr>
                  <td>Mô Tả</td>
                  <?php foreach($wishlistd_products as $product) {?>
                  <td class="description"><?php echo $product['description']?></td>
                  <?php }?>
               </tr>
               <!-- 
               <tr>
                  <td>Weight</td>
                  <td>10.00kg</td>
                  <td>0.00kg</td>
               </tr>
               <tr>
                  <td>Dimensions (L x W x H)</td>
                  <td>0.00cm x 0.00cm x 0.00cm</td>
                  <td>0.00cm x 0.00cm x 0.00cm</td>
               </tr>
                -->
            </tbody>
            <tbody>
               <tr>
                  <td></td>
                  <?php foreach(productwishlistGetProductsWithFormat() as $product) {?>
                  <td><input value="Mua" class="btn btn-primary btn-block" onclick="cart.add(<?php echo $product['product_id']?>, '1');" type="button">
                     <a href="/product-wishlist.php?remove=<?php echo $product['product_id']?>" class="btn btn-danger btn-block">Bỏ</a>
                  </td>
                   <?php }?>
               </tr>
            </tbody>
         </table>
         <?php } else {?>
         	<b>Chưa có sản phẩn nào để so sánh !</b>
         <?php } ?>
      </div>
   </div>
</div>

