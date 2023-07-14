<!-- <?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
	if(isset($_GET['catId']) && $_GET['catId']!=NULL){
        $id = $_GET['catId'];
    }
    else {
        echo "<script>window.location ='404.php'</script>";
    }
    // if($_SERVER['REQUEST_METHOD'] === 'POST'){
	// 	// the request using the post method
	// 	$catName = $_POST['catName'];

	// 	$update_cat = $cat-> update_category($catName,$id);
	// }
?>
 <div class="main">
    <div class="content">
		<?php
				// $name_cat = $post->get_name_by_cat($id);
				if($name_cat){
					$result_name = $name_cat->fetch_assoc()
					
			?>
    	<div class="content_top">
    		<div class="heading">
    		<h3>Mới nhất từ <?php echo $result_name['catName']?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		<?php
					
				}
			?>	
	      <div class="section group">
			<?php
				$productbycat = $cat->get_product_by_cat($id);
				if($productbycat){
					while($result = $productbycat->fetch_assoc()){
					
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details-3.php"><img src="admin/uploads/<?php echo $result['image']?>" width="200px" alt="" /></a>
					 <h2><?php echo $result['productName']?></h2>
					 <!-- <p> Miêu tả</p> -->
					 <p><span class="price"><?php echo $result['price']." "."VND"?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId']?>" class="details">Chi tiết</a></span></div>
				</div>
			<?php
					}
				}
			?>	
			</div>

	
	
    </div>
 </div>

<?php
include 'inc/footer.php';
?> -->