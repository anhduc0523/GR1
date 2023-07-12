<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
	if(isset($_GET['proId']) && $_GET['proId']!=NULL){
        $id = $_GET['proId'];
    }else {
        echo "<script>window.location ='404.php'</script>";
    }
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
		// the request using the post method
		$quantity = $_POST['quantity'];
		$addtocart = $ct-> add_to_cart($quantity,$id);
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wishlist'])){
		// the request using the post method
		$productId = $_POST['productId'];
		$insertWishlist = $pd-> insertWishlist($productId,$customer_id);
	}

	if(isset($_POST['binhluan_submit'])){
        $insert_binhluan = $cs->insert_binhluan();
    }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<?php
				$getproduct_details = $product->getproduct_details($id);
				if($getproduct_details){
					while($result_details = $getproduct_details->fetch_assoc()){

			?>
			<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result_details['image']?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_details['productName']?></h2>
					<!-- <p><?php echo $fm->textShorten($result_details['product_desc'], 100)?></p>					 -->
					<div class="price">
						<p>Giá: <span><?php echo $fm->format_currency($result_details['price'])." "."VND"?></span></p>
						<p>Thể loại: <span><?php echo $result_details['catName']?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Mua ngay"/>
						
					</form>
					<?php
						if(isset($addtocart)){
							echo '<span style= "color:red; font-size:18px;">Product has been already added</span>';
						}
					?>				
				</div>
				
			</div>
			<div class="product-desc">
			<h2>Miêu tả</h2>
			<p><?php echo $result_details['product_desc']?></p>	
	        
	    </div>
		<div class="binhluan">
			<div class="row">
				<div class="col-md-12">
					<h5>Bình luận</h5>
					<?php
						if(isset($insert_binhluan)){
							echo $insert_binhluan;
						}
					?>
					<form action="" method="POST">
						<p><input type="hidden" value="<?php echo $id ?>" name="productId_binhluan"></p>
						<p><input type="text"  placeholder="Điền tên" class="form-control" name="tenNguoiBinhLuan"></p><br>
						<p><textarea rows="5" style="resize:none" placeholder="Bình luận" class="form-control" name="binhluan"></textarea></p>
						<p><input type="submit" name="binhluan_submit" class="btn btn-success" value="Gửi bình luận"></p>
					</form>
				</div>
			</div>
			
		</div>
	</div>
	<?php
						}
				}
	?>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
					<?php
						$getall_category = $cat->show_category_fe();
						if($getall_category){
							while($result_cat = $getall_category->fetch_assoc()){

							
					?>
				      <li><a href="productbycat.php?catId=<?php echo $result_cat['catId']?>"><?php echo $result_cat['catName']?></a></li>
    				</ul>
					<?php
							}
						}
					?>
 				</div>
		
 	</div>

</div>
	
<?php
include 'inc/footer.php';
?>
