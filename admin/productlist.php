<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include 'C:/xampp/htdocs/web/shop/classes/category.php';?>
<?php include 'C:/xampp/htdocs/web/shop/classes/product.php';?>
<?php include_once 'C:/xampp/htdocs/web/shop/helpers/format.php';?>
<?php
	$pd = new product();
	$fm = new Format();
	if(isset($_GET['productId'])){
        $id = $_GET['productId'];
		$delete_product = $pd-> delete_product($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">
			<?php
				if(isset($delete_product)){
					echo $delete_product;
				}
			?>  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Category</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Image</th>
					<th>Description</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$pdlist = $pd-> show_product();
					if($pdlist){
						$i =0;
						while($result = $pdlist->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['catName'];?></td>
					<td width="350px"><?php echo $result['productName'];?></td>
					<td><?php echo $result['price'];?></td>
					<td><img src="uploads/<?php echo $result['image'];?>" width="80px"></td>
					<td width="200px"><?php echo $fm->textShorten($result['product_desc'], 50);?></td>
					<td><?php 
						if($result['type'] == 0){
							echo "Featured";
						}else{
							echo "Non-Featured";
						}
					?></td>
					<td><a href="productedit.php?productId=<?php echo $result['productId'];?>">Edit</a> || 
					<a href="?productId=<?php echo $result['productId'];?>">Delete</a></td>
				</tr>
				<?php
						}
					}
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
