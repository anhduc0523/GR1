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
	// if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
	// 	// the request using the post method
	// 	$quantity = $_POST['quantity'];
	// 	$addtocart = $ct-> add_to_cart($quantity,$id);
	// }
?>
<style type="text/css">
    .box_left{
        width: 50%;
        border: 1px solid #666;
        float: left;
        padding: 4px;
    }
    .box_right{
        width: 47%;
        border: 1px solid #666;
        float: right;
        padding: 4px;
    }
    .submit_order{
        padding: 10px 70px;
        background: red;
        border: none;
        font-size: 25px;
        color: #fff;
        margin: 10px;
        cursor: pointer;
    }
</style>
<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
			<div class="heading">
				<h3>Offline Payment</h3>
			</div>
            <div class="clear"></div>
            <div class="box_left">
                <div class="cartpage">

					<?php
						if(isset($update_quantity_cart)){
							echo $update_quantity_cart;
						}
					?>
					<?php
						if(isset($delcart)){
							echo $delcart;
						}
					?>
						<table class="tblone">
							<tr>
								<th width="5">ID</th>
                                <th width="35%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="20%">Total Price</th>
							</tr>
							<?php
								$get_product_cart = $ct->get_product_cart();
								if($get_product_cart){
									$subtotal =0;
									$qty = 0;
                                    $i=0;
									while($result = $get_product_cart->fetch_assoc()){
										$i++;
							?>
							<tr>
								<td><?php echo $i?></td>
                                <td><?php echo $result['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result['image']?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['price']).' '.'VND'?></td>
								<td><?php echo $result['quantity']?></td>
								<td><?php
									$total = $result['price'] * $result['quantity'];
									echo $fm->format_currency($total)." "."VND";
								?></td>
								
							</tr>
							<?php
										$qty = $qty + $result['quantity'];
										$subtotal += $total;
									}
								}
							?>
						</table>
						<?php
							$check_cart = $ct-> check_cart();
							if($check_cart){

						?>
						<table style="float:right;text-align:left; margin:5px" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php 
									echo $fm->format_currency($subtotal)." "."VND";
									Session::set('sum',$subtotal); 
									Session::set('qty',$qty); 
								?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10% (<?php echo $fm->format_currency($vat = $subtotal * 0.1)." "."VND";?>)</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td><?php
									$vat = $subtotal * 0.1;
									$gtotal = $vat + $subtotal;
									echo $fm->format_currency($gtotal)." "."VND";
								?></td>
							</tr>
                             
					   </table>
					   <?php
							}else{
								echo 'Yout cart is Empty ! Please shopping now';
							}			
					   ?>
					</div>
            </div>
            <div class="box_right">
                <table class="tblone" width="500px">
                <?php
                    $id = Session::get('customer_id');
                    $get_customer = $cs->show_customer($id);
                    if($get_customer){
                        while($result = $get_customer->fetch_assoc()){

                        
                ?>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td><?php echo $result['name']?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><?php echo $result['city']?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?php echo $result['phone']?></td>
                </tr>
                <!-- <tr>
                    <td>Country</td>
                    <td>:</td>
                    <td><?php echo $result['country']?></td>
                </tr> -->
                <tr>
                    <td>Zip-Code</td>
                    <td>:</td>
                    <td><?php echo $result['zipcode']?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result['email']?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?php echo $result['address']?></td>
                </tr>
                <tr>
                    <td colspan="3"><a href="editprofile.php">Update profile</a></td>
                </tr>
                <?php
                        }
                    }
                ?>
            </table>
            </div>
            
 		</div>
        
 	</div>
    <center><a href="?orderid=order" class="submit_order">Order</a></center><br><br><br>
</div>
</form>
<?php
include 'inc/footer.php';
?>
