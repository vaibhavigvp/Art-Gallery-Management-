<?php
	session_start();
	include("functions/functions.php");

?>
<html>
	<head>
		<title>My E-Commerce Page</title>
		<link rel="stylesheet" href="styles/style.css" media="all" />
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		

	</head>

	<body >
		<div >		
						<div >
				
				
				
				<div >
					<a href="cart.php">
						<div id="cartbox" >
							
						</div>
					</a>
					
				</div>	
				
				<div id="form" align="center">
					<form method="get" action="results.php" enctype="multipart/form-data">
						
					</form>
				</div>
				
				
			</div>
			<!--header ends here-->
			
			
			<!--navigation bar ends here-->
		</div>
		<!--top ends here-->

		
		<!--Main content starts here-->
		<div class="main_wrapper">
			
			<!--content wrapper starts here-->
			<div class="content_wrapper">
				
			
				
					 
					<div id="products_box">
					<br>
						<form action="" method="post" enctype="multipart/form-data">
							
							<table align="center" width="800" style="margin:auto;" id="outerbox">
								<tr align="center">
									<td colspan="5" id="tabletop"><h2>INVOICE</h2></td>
								</tr>
								
								<tr >
									<th>Products</th>
									<th>Quantity</th>
									<th>Price</th>
									
								</tr>
								
								<?php 
								$total = 0;
								global $con;
								
								$ip = getIp();
								
								$sel_price = "select * from cart where ip_add='$ip'";
					
								$run_price = mysqli_query($con, $sel_price);
								
								while($p_price=mysqli_fetch_array($run_price)){
									
									$pro_id = $p_price['p_id'];
									
									$pro_price = "select * from products where product_id='$pro_id'";
									
									$run_pro_price = mysqli_query($con,$pro_price);
									
									$_SESSION['qty'] = $p_price['qty'];
									
									
									while($pp_price = mysqli_fetch_array($run_pro_price)){
										$product_price = array($pp_price['product_price']);
										$product_title = $pp_price['product_title'];
										$product_image = $pp_price['product_image'];
										$single_price = $pp_price['product_price'];
										
										$values = array_sum($product_price); 
										
										$total += $values*$p_price['qty'];
										
										
								?>
								
								<tr align="center">
									<td><?php echo $product_title; ?><br>
										<img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60"/>
									</td>
									<td>
									<?php echo $p_price['qty'];?>
									</td>
								
									
									
									
									<td><?php echo "Rs ".$single_price;?></td>
									
								</tr>
								
								<?php } } ?>
								
								<tr align="right">
									<td colspan="2"><b>Total Price:</b></td>
									<td style="color:red;" id="total"><b><?php echo "Rs ".$total; ?></b></td>
								<tr>
								
								<tr align="center">
									
									<td><button onclick="window.print()">Print Bill</button></td>
									
								</tr>
							</table>
						</form>
						
					
						
						
				<?php

				
					$ip = getIp();
					
					if(isset($_POST['cust_bill'])){
						if(!empty($_POST['remove_item'])){
						foreach($_POST['remove_item'] as $remove_id){
							
							$delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
							
							$run_delete= mysqli_query($con,$delete_product);
							
							if($run_delete){
								
								echo "<script>window.open('cart.php','_self')</script>";
							}
							
						}
						}
						
						
						
						$total = 0;
								global $con;
								
								$ip = getIp();
								
								$sel_price = "select * from cart where ip_add='$ip'";
					
								$run_price = mysqli_query($con, $sel_price);
								
								while($p_price=mysqli_fetch_array($run_price)){
									
									$pro_id = $p_price['p_id'];
									
									$qty = $_POST["qty$pro_id"];
									
									$up_cart = "cust bill set qty='$qty' where p_id='$pro_id'";
									
									$run_up_cart = mysqli_query($con,$up_cart);
									
									
									$pro_price = "select * from products where product_id='$pro_id'";
									
									$run_pro_price = mysqli_query($con,$pro_price);
									
									
								while($pp_price = mysqli_fetch_array($run_pro_price)){
										
										$product_price = $pp_price['product_price'];
										
										$total += $product_price*$p_price['qty'];
									
								}
								
								}
						
						
						
						echo "<script>Document.getElementById('total').innerHTML=$total; </script>";
								
						echo "<script>window.open('cart.php','_self')</script>";
					}
					
					if(isset($_POST['continue'])){
						echo "<script>window.open('index.php','_self')</script>";
					}
					
					
				
				?>
				
					
					
					
					</div>

					
					

				
				
				
			</div>
			<!--content wrapper ends here-->
			
			
		</div>
		<!--Main content ends here-->
	</body>
</html>