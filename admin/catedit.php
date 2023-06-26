<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<!-- <?php
    if(isset($_GET['catId']) && $_GET['catId']!=NULL){
        $id = $_GET['catId'];
    }
    $cat = new category();
?> -->

<?php
    if(isset($_GET['catId']) && $_GET['catId']!=NULL){
        $id = $_GET['catId'];
    }
    else {
        echo "<script>window.location ='catlist.php'</script>";
    }
    $cat = new category();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
		// the request using the post method
		$catName = $_POST['catName'];

		$update_cat = $cat-> update_category($catName,$id);
	}
?>
	
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục</h2>
                
               <div class="block copyblock"> 
                <?php
                    if(isset($update_cat)){
                        echo $update_cat;
                    }
                ?>
                <?php
                    $get_cat_name = $cat-> getCatById($id);
                    if($get_cat_name){
                        while($result = $get_cat_name->fetch_assoc()){


                ?>
                 <form action="" method='post'>
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['catName'];?>" name="catName" placeholder="Sửa tên danh mục sản phẩm..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>