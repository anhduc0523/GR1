<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
	$login_check = Session::get('customer_login');
	if($login_check){
		header('Location:order.php');
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
		// the request using the post method

		$insert_customer = $cs-> insert_customer($_POST);
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){
		// the request using the post method

		$login_customer = $cs-> login_customer($_POST);
	}
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
			<?php
				if(isset($login_customer)){
					echo $login_customer;
				}
			?>
        	<form action="" method="POST">
                	<input type="text" name="email" class="field" placeholder="Enter email.........">
					<!-- onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}" -->
                    <input type="password" name="password" class="field" placeholder="Enter password.........">
					<!-- onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" -->
                 <p class="note">If you forgot your password just enter your email and click <a href="#">here</a></p>
                    <div class="search"><div><input type="submit" name="login" class="grey" value="Sign in"></div></div>
                    </div>
			</form>
		<?php

		?>
    	<div class="register_account">
    		<h3>Register New Account</h3>
			<?php
				if(isset($insert_customer)){
					echo $insert_customer;
				}
			?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Enter name" >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Zip-code">
							</div>
							<div>
								<input type="text" name="email" placeholder="E-mail">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address">
						</div>
		    		<div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>
							<option value="VN">VietNam</option>         

		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Phone">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="grey" value="Create Account"></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
include 'inc/footer.php';
?>