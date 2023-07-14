<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/post.php';?>

<?php
    if(isset($_GET['catId']) && $_GET['catId']!=NULL){
        $id = $_GET['catId'];
    }
    else {
        echo "<script>window.location ='postlist.php'</script>";
    }
    $post = new post();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
		// the request using the post method
		$catName = $_POST['catName'];
        $catDesc = $_POST['catDesc'];
        $catStatus = $_POST['catStatus'];

		$update_cat = $post-> update_category_post($catName,$catDesc,$catStatus,$id);
	}
?>
	
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục tin tức</h2>
                
               <div class="block copyblock"> 
                <?php
                    if(isset($update_cat)){
                        echo $update_cat;
                    }
                ?>
                <?php
                    $get_cat_name = $post-> getCatById($id);
                    if($get_cat_name){
                        while($result = $get_cat_name->fetch_assoc()){


                ?>
                 <form action="" method='post'>
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['title'];?>" name="catName" placeholder="Sửa tên danh mục sản phẩm..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="catDesc" value="<?php echo $result['description'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="catStatus" id="">
                                    <?php
                                        if($result['status']==0){

                                    ?>
                                    <option selected value="0">Hiển thị</option>
                                    <option value="1">Ẩn</option>
                                    <?php
                                        }else{
                                    ?>
                                    <option value="0">Hiển thị</option>
                                    <option selected value="1">Ẩn</option>
                                    <?php
                                        }
                                    ?>
                                </select>
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