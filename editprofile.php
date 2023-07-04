<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
    $login_check = Session::get('customer_login');
	if($login_check == false){
		header('Location:login.php');
	}
?>
<?php
	// if(isset($_GET['proId']) && $_GET['proId']!=NULL){
    //     $id = $_GET['proId'];
    // }else {
    //     echo "<script>window.location ='404.php'</script>";
    // }
    $id = Session::get('customer_id');
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])){
		// the request using the post method
        
		$updateCustomer = $cs-> update_customer($_POST,$id);
	}
?>
<div class="main">
    <div class="content">
    	<div class="section group">
            <div class="content_top">
					<div class="heading">
						<h3>Update Profile Customer</h3>
					</div>
					<div class="clear"></div>
				</div>
            <form action="" method="POST">
            <table class="tblone" width="500px">
                <tr>
                        <?php
                            if(isset($updateCustomer)){
                                echo '<td colspan="3">'.$updateCustomer.'</td>';
                            }
                        ?>
                </tr>
                <?php
                    $id = Session::get('customer_id');
                    $get_customer = $cs->show_customer($id);
                    if($get_customer){
                        while($result = $get_customer->fetch_assoc()){

                        
                ?>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td><input type="text" name="name" value="<?php echo $result['name']?>"></td>
                </tr>
                <!-- <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><input type="text" name="name" value="<?php echo $result['city']?>"></td>
                </tr> -->
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><input type="text" name="phone" value="<?php echo $result['phone']?>"></td>
                </tr>
                <!-- <tr>
                    <td>Country</td>
                    <td>:</td>
                    <td><?php echo $result['country']?></td>
                </tr> -->
                <tr>
                    <td>Zip-Code</td>
                    <td>:</td>
                    <td><input type="text" name="zipcode" value="<?php echo $result['zipcode']?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input type="text" name="email" value="<?php echo $result['email']?>"></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><input type="text" name="address" value="<?php echo $result['address']?>"></td>
                </tr>
                <tr>
                    <td colspan="3"><input type="submit" name="save" value="Save" class="grey"></td>
                </tr>
                <?php
                        }
                    }
                ?>
            </table>
            </form>
	    </div>
 	</div>
</div>
	
<?php
include 'inc/footer.php';
?>
