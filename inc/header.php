<?php
    include_once 'lib/session.php';
    // kiểm tra xem đã đăng nhập vào chưa. Nếu bỏ câu lệnh thì có thể vào file index trực tiếp = đường dẫn
    Session::init();
?>
<?php
	include_once 'lib/database.php';
    include_once 'helpers/format.php';

	// spl_autoload_register(function ($className) {
    //     include_once 'classes/' . $className . '.class.php';
    // });

	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});

	$db = new Database();
	$fm = new Format();
	$ct = new cart();
	$us = new user();
	$cat = new category();
	$cs = new customer();
	$product = new product();
	$post = new post();
	$blog = new blog();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE HTML>

<head>
	<title>CD Store Website</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript" src="js/nav-hover.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function ($) {
			$('#dc_mega-menu-orange').dcMegaMenu({ rowItems: '4', speed: 'fast', effect: 'fade' });
		});
	</script>
</head>

<body>
	<div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			<div class="header_top_right">
				<div class="search_box">
					<form action="search.php" method="POST">
						<input type="text" placeholder="Tìm kiếm sản phẩm" name="tuKhoa">
						<input type="submit" name="search_product" value="Tìm kiếm">
					</form>
				</div>
				<div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Giỏ hàng</span>
							<span class="no_product">
								<?php
									$check_cart = $ct-> check_cart();
									if($check_cart){
										$sum = Session::get("sum");
										echo $fm->format_currency($sum)." "."đ";
									}else{
										echo 'Empty';
									}
									
								?>
							</span>
						</a>
					</div>
				</div>
				<?php
					if(isset($_GET['customer_id'])){
						$del_cart = $ct-> del_all_data();
						Session::destroy();
					}
				?>
				<div class="login">
					<?php
						$login_check = Session::get('customer_login');
						if($login_check == false){
							echo '<a href="login.php">Đăng nhập</a></div>';
						}else{
							echo '<a href="?customer_id='.Session::get('customer_id').'">Đăng xuất</a></div>';
						}
					?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="menu">
			<ul id="dc_mega-menu-orange" class="dc_mm-orange">
				<li><a href="index.php">Trang chủ</a></li>
				<li><a href="products.php">Sản phẩm</a> </li>
				<?php
					$checkCart = $ct->check_cart();
					if($checkCart==true){
						echo '<li><a href="cart.php">Giỏ hàng</a></li>';
					}else{
						echo '';
					}
				?>

				<?php
					$customer_id = Session::get('customer_id');
					$checkOrder = $ct-> check_order($customer_id);
					if($checkOrder==true){
						echo '<li><a href="orderdetails.php">Đơn hàng</a></li>';
					}else{
						echo '';
					}
				?>
				
				<?php
					$login_check = Session::get('customer_login');
					if($login_check == false){
						echo '';
					}else{
						echo '<li><a href="profile.php">Thông tin</a> </li>';
					}
				?>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						Tin tức<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">	
						<?php
							$postlist = $post->show_category_post();
							if($postlist){
								while($result_new = $postlist->fetch_assoc()){
						?>
						<li>
							<a href="categorypost.php?idpost=<?php echo $result_new['cate_post_id']?>"><?php echo $result_new['title']?></a>
						</li>
						<?php
								}
							} 
						?>
					</ul> 
				</li>
				<li><a href="contact.php">Liên hệ</a> </li>
				<div class="clear"></div>
			</ul>
		</div>