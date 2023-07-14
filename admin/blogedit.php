<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/post.php';?>
<?php include '../classes/blog.php';?>
<?php
    $blog = new blog();
    if(isset($_GET['id']) && $_GET['id']!=NULL){
        $id = $_GET['id'];
    }else {
        echo "<script>window.location ='bloglist.php'</script>";
    }
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
		// the request using the post method

		$update_blog = $blog-> update_blog($_POST, $_FILES, $id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa tin tức</h2>
        <div class="block">
        <?php
            if(isset($update_blog)){
                echo $update_blog;
            }
        ?>
        <?php
            $get_blog_by_id =  $blog-> getBlogById($id);
            if($get_blog_by_id){
                while($result_blog = $get_blog_by_id->fetch_assoc()){

        ?>               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $result_blog['title'];?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category Post</label>
                    </td>
                    <td>
                        <select id="select" name="category_post">
                            <option>Select Category</option>
                            <?php
                                $post = new post();
                                $postlist = $post->show_category_post();
                                if($postlist){
                                    while($result = $postlist->fetch_assoc()){

                            ?>
                            <option 
                            <?php
                                if($result['cate_post_id'] == $result_blog['category_post']){echo 'selected';}
                            ?>
                            value="<?php echo $result['cate_post_id'];?>"><?php echo $result['title'];?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				
				<tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="desc" class="tinymce"><?php echo $result_blog['description'];?></textarea>
                    </td>
                </tr>

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea name="content" class="tinymce"><?php echo $result_blog['content'];?></textarea>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $result_blog['image'];?>" width="80px"> <br>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Blog Status</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php
                                if($result_blog['status'] == 0){

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
                    <td></td>
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


