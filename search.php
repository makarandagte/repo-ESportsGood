<?php include "inc/header.php" ?>
	<section>
		<div class="container">
			<div class="row">
		<?php include("inc/sidebar.php"); ?>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items">
						<h2 class="title text-center">Search Result</h2>
							<?php
							if(isset($_GET['search'])){
								$search = $_GET['search'];
							
						$select = "select * from product where p_name LIKE '%$search%'";
						$run = mysqli_query($con,$select);
						while($row=mysqli_fetch_array($run)){
							$id = $row['id'];
							$name = $row['p_name'];
							$image = $row['p_image'];
							$price = $row['p_price'];
							
							
						echo "
						<div class='col-sm-4'>
							<div class='product-image-wrapper'>
								<div class='single-products'>
									<div class='productinfo text-center'>
										<img src='admin/images/$image' alt='' >
										<h2><span>$</span>$price</h2>
										<p>$name</p>
										<a href='javascript:void(0)' class='btn btn-default add-to-cart' id='$id' onclick = 'cart($id)'><i class='fa fa-shopping-cart'></i>Add to cart</a>
									    <a href='$add_wish' class='btn btn-default add-to-cart wish' data-user='$s_email' onclick='wish($id)'><i class='glyphicon glyphicon-heart'></i> Wishlist</a>
									</div>
									
								</div>
								<div class='choose'>
									<ul class='nav nav-pills nav-justified'>
										
									</ul>
								</div>
							</div>
						</div>
						";
						}
						}else{
							echo "<script>
							 window.location.href = 'index.php';
							</script>";
						}
						?>
						
					</div>
				</div>
				</div>
				</div>
		</section>
<?php include "inc/footer.php"; ?>
	<script>
$(document).ready(function(){
$(window).scroll(function(){
    if($(window).scrollTop() == $(document).height() - $(window).height()){
	   var id = $('#last_id').attr('class');
	   
	   $.ajax({
		   url: 'fetch.php',
		   method : 'post',
		   data:{id:id},
		   beforeSend: function(){
			 $('#last_id').attr('type','submit');  
		   },
		   success : function(html){
			   $('#more').remove();
			   $('.features_items').append(html);
			   
		   }
	   })
	
	
	}
	
	});
	
	});
	
	function cart($pro_id){
		var p_id = $pro_id;
		
		$.ajax({
			url:"function.php",
			method:"post",
			data:{p_id:p_id},
			success: function($data){
			    if($data > 0){
					notif({
						msg:"Product Already Added !!!",
						type:"warning",
						width:330,
						height:40,
						timeout:1000,
						
					})
					
				}else{
					notif({
						msg:"Added to Cart",
						type:"success",
						width:330,
						height:40,
						timeout:1000,
						
					})
				}
				   	
			}
			
		})
		
	}
	
	function wish($p_id){
		var w_id = $p_id;
		var email = $(".wish").data("user");
		
		if(email != 0){
		$.ajax({
			url:"function.php",
			method:"post",
			data:{w_id:w_id,email:email},
			success: function($wish){
				    if($wish > 0){
					notif({
						msg:"Product Already Added to wishlist!!!",
						type:"warning",
						width:330,
						height:40,
						timeout:1000,
						
					})
					
				}else{
					notif({
						msg:"Added to wishlist",
						type:"success",
						width:330,
						height:40,
						timeout:1000,
						
					})
				}
			}
		})
		}
	}



</script>