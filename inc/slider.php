
		<div class="header_bottom">
			<div class="header_bottom_left">
				<div class="section group">
					<?php
						$getLatestCD = $product-> getLatestCD();
						if($getLatestCD){
							while($result1 = $getLatestCD->fetch_assoc()){

					?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php"> <img src="admin/uploads/<?php echo $result1['image']?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2><?php echo $result1['productName']?><php></h2>
							<!-- <p><?php echo $fm->textShorten($result1['product_desc'], 50)?></p> -->
							<div class="button"><span><a href="details.php?proId=<?php echo $result1['productId']?>">Add to cart</a></span></div>
						</div>
					</div>
					<?php
							}
						}
					?>
					
					<?php
						$getLatestSale = $product-> getLatestSale();
						if($getLatestSale){
							while($result2 = $getLatestSale->fetch_assoc()){

					?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php"> <img src="admin/uploads/<?php echo $result2['image']?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2><?php echo $result2['productName']?><php></h2>
							<!-- <p><?php echo $fm->textShorten($result2['product_desc'], 50)?></p> -->
							<div class="button"><span><a href="details.php?proId=<?php echo $result2['productId']?>">Add to cart</a></span></div>
						</div>
					</div>
					<?php
							}
						}
					?>
				</div>
				<div class="section group">
					<?php
						$getLatestPreOrder = $product-> getLatestPreOrder();
						if($getLatestPreOrder){
							while($result3 = $getLatestPreOrder->fetch_assoc()){

					?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php"> <img src="admin/uploads/<?php echo $result3['image']?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2><?php echo $result3['productName']?><php></h2>
							<!-- <p><?php echo $fm->textShorten($result3['product_desc'], 50)?></p> -->
							<div class="button"><span><a href="details.php?proId=<?php echo $result3['productId']?>">Add to cart</a></span></div>
						</div>
					</div>
					<?php
							}
						}
					?>
					<?php
						$getLatestSingle = $product-> getLatestSingle();
						if($getLatestSingle){
							while($result4 = $getLatestSingle->fetch_assoc()){

					?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php"> <img src="admin/uploads/<?php echo $result4['image']?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2><?php echo $result4['productName']?><php></h2>
							<!-- <p><?php echo $fm->textShorten($result4['product_desc'], 50)?></p> -->
							<div class="button"><span><a href="details.php?proId=<?php echo $result4['productId'] ?>">Add to cart</a></span></div>
						</div>
					</div>
					<?php
							}
						}
					?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="header_bottom_right_images">
				<!-- FlexSlider -->

				<section class="slider">
					<div class="flexslider">
						<ul class="slides">
							<li><img src="images/1.jpg" alt="" /></li>
							<li><img src="images/2.jpg" alt="" /></li>
							<li><img src="images/3.jpg" alt="" /></li>
							<li><img src="images/4.jpg" alt="" /></li>
						</ul>
					</div>
				</section>
				<!-- FlexSlider -->
			</div>
			<div class="clear"></div>
		</div>