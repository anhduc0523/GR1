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
	// if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
	// 	// the request using the post method
	// 	$quantity = $_POST['quantity'];
	// 	$addtocart = $ct-> add_to_cart($quantity,$id);
	// }
?>
<div class="main">
    <div class="content">
    	<div class="section group">
            <div class="content_top">
				<div class="heading">
					<h3>Payment Method</h3>
				</div>
                
				<div class="clear"></div>
                <div class="wrapper_method">
                    <h3 class="payment">Choose your payment method</h3>
                    <a href="offlinepayment.php">Offline Payment</a>
                    <a href="onlinepayment.php">Online Payment</a><br><br><br>
                    <a style="background:grey" href="cart.php"> << Previous</a>
                </div>
			</div>
        
	    </div>
 	</div>
</div>
	
<?php
include 'inc/footer.php';
?>
