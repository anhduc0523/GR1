<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/post.php';?>
<?php
    $post = new post();
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		// the request using the post method
		$catName = $_POST['catName'];
        $catDesc = $_POST['catDesc'];
        $catStatus = $_POST['catStatus'];

		$insert_cat = $post-> insert_category_post($catName,$catDesc,$catStatus);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm danh mục tin tức</h2>
                
               <div class="block copyblock"> 
                <?php
                    if(isset($insert_cat)){
                        echo $insert_cat;
                    }
                ?>
                 <form autocomplete="off" action="postadd.php" method='post'>
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Nhập tên danh mục tin tức..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="catDesc" placeholder="Nhập mô tả danh mục tin tức.." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="catStatus" id="">
                                    <option value="0">Hiển thị</option>
                                    <option value="1">Ẩn</option>
                                </select>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>