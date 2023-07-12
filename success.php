<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
	if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
        $customer_id = Session::get('customer_id');
		$insert_order = $ct -> insertOrder($customer_id);
		$del_cart = $ct-> del_all_data();
		header('Location:success.php');
    }
?>
<style type="text/css">
    h2.success_order{
        text-align: center;
        color: red;
    }
    p.success_note{
        text-align: center;
        padding: 8px;
        font-size: 17px;
    }
</style>
<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
            <h2 class="success_order">Success Order</h2>
            <?php
                $customer_id = Session::get('customer_id');
                $get_amount = $ct->get_amount_price($customer_id);
                if($get_amount){
                    $amount = 0;
                    while($result = $get_amount->fetch_assoc()){
                        $price = $result['price'];
                        $amount += $price;
                    }
                }
            ?>
            <p class="success_note">Total Price you have bought from My Shop : 
                <?php 
                    $vat = $amount*0.1; 
                    $total = $amount + $vat;
                    echo $fm->format_currency($total)." "."VND"; 
                ?></p>
            <p class="success_note">We will contact as soon as posible. Please see your order here <a href="orderdetails.php">Click Here</a></p>
 		</div>
 	</div>
</div>
</form>
<?php
include 'inc/footer.php';
?>
