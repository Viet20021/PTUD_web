<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
<style>
	#header {
  	background-color: #F9D5CA;
}

#top-header {
  background-color:#91C8EB;
}

.container{
	font-size: 15px;
}

</style>
<!-- TOP HEADER -->
<div id="top-header">
		<header>	
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> 0358881703</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> vietqv2002@gmail.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> TP Hồ Chí Minh</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-dollar"></i> VNĐ</a></li>
						<?php 
							if(isset($_SESSION['ten_dangnhap'])){
								 $ten_dangnhap=$_SESSION['ten_dangnhap'];
								 echo '<li><a href="?act=my_account"><i class="fa fa-user-o"></i> Xin chào, '.$ten_dangnhap.'!</a></li>';
							}
								else echo '<li><a href="index.php?act=register"><i class="fa fa-user-o"></i> Tạo tài khoản</a></li>';
						?>

						<li><a href="admin/index.php"><i class="fa fa-lock" aria-hidden="true"></i> Tài khoản Admin</a></li>
					</ul>

				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="index.php" class="logo">
									<img src="./img/LOGO.jpg" alt="" width=100px>
								</a>
							</div>
						</div>

						
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6" >
							<div class="header-search">
								<form method="get" >
									<select class="input-select" onchange="location = this.value;" style="border-radius:50px 0 0px 50px">
										<option value="0">Danh Mục Sản Phẩm</option>
										<?php
										$sql='select id, ten_tl from theloai';
										$list=executeResult($sql);
										foreach($list as $item){
											echo '<option value="?act=category&id='.$item['id'].'">'.$item['ten_tl'].'</option>';
										}
										?>
									</select>
									<input class="input" name="search" placeholder="Tên sản phẩm......" required oninvalid="this.setCustomValidity('Vui lòng nhập thông tin')" oninput="setCustomValidity('')"/>
									<button class="search-btn" style="border-radius:0px 50px 50px 0px;">Tìm</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								

								<!-- Cart -->
								<?php
									$qty=0;
									if(isset($_SESSION['cart'])){
										$cart=$_SESSION['cart'];
										foreach($cart as $value){
											$qty += $value['qty'];
										}
									}
								?>
								<div class="">
									<a href="?act=cart">
										<i class="fa fa-shopping-cart" style="color: black;"></i>
										<span style=" font-size: 15px; color: black;">Giỏ Hàng</span>
										<div class="qty" id="qtyPro"><?=$qty?></div>
									</a>
								</div>
								
								<!-- /Cart -->

								<!-- Cài đặt -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i style="color: black;"><img src="img/users-cog-solid.svg" alt="XYZ" style=" width:30px;" /></i>
										<span style=" font-size: 15px; color: black;">Tài Khoản</span>
										
									</a>
									<div class="cart-dropdown">
										<?php
											if(isset($_SESSION['ten_dangnhap'])){
												echo '<div class="cart">
														<div class="product-widget">
														<a href="index.php?act=my_account">Quản Lý Tài Khoản</a>
														</div>
														<div class="product-widget">
														<a href="index.php?act=my_bill">Quản Lý Đơn Hàng</a>											
														</div>
														<div class="product-widget">
				 										<a href="change_password.php"> Đổi mật khẩu </a></div>
														</div>'
													;
											}
										?>
										
										<div class="cart-btns">
											<a href="index.php?act=login">Đăng Nhập</a>
											<?php
												if(isset($_SESSION['ten_dangnhap'])){
													echo '<a href="frontend/logout.php">Đăng Xuất <i class="fa fa-arrow-circle-right"></i></a>';
												}else echo '<a href="index.php?act=register">Đăng Ký</a>';
											?>
											
										</div>
									</div>
								</div>
								<!-- /Cài đặt -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<?php
							if($act=='' && !(isset($_GET['id']))) {
								echo '<li class="active"><a href="index.php">Trang Chủ</a></li>';
							}else echo '<li><a href="index.php">Trang Chủ</a></li>';
							if($act=='hot'){
								echo '<li class="active"><a href="index.php?act=category">Tùy Chọn</a></li>';
							}else echo '<li><a href="?act=category">Tùy Chọn</a></li>';
						?>				
						
						
						<?php
							if(isset($_GET['id'])) $id=$_GET['id'];
							if($act=='product'){
								$sql='select id_the_loai from sanpham where id='.$id;
								$id=executeSingleResult($sql)['id_the_loai'];
								
							}
							$sql='select id, ten_tl from theloai';
							$list=executeResult($sql);
										foreach($list as $item){
											if($item['id']==$id){
												echo '<li class="active"><a href="?act=category&id='.$item['id'].'">'.$item['ten_tl'].'</a></li>';
											}else echo '<li><a href="?act=category&id='.$item['id'].'">'.$item['ten_tl'].'</a></li>';
											
										}
						?>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->