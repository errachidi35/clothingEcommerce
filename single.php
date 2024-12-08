<?php
/**
 * Header File of Template
 * Created by PhpStorm.
 * User: Tanjil Hasan
 * Date: 9/8/2017
 * Time: 6:11 AM
 */
?>
<?php
    if (!isset($_GET['proid']) || $_GET['proid'] == null) echo "<script>window.location = 'index.php'</script>";
    else $productId = $_GET['proid'];
?>
<?php include 'header.php'?>

	<!-- //navigation -->
	<!-- banner -->
	<div class="banner banner10">
		<div class="container">
			<h2>Product Description</h2>
		</div>
	</div>
	<!-- //banner -->   
	<!-- breadcrumbs -->
	<div class="breadcrumb_dress">
		<div class="container">
			<ul>
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
				<li>Product Description</li>
			</ul>
		</div>
	</div>
	<!-- //breadcrumbs -->  
	<!-- single -->
	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addCart']) && Session::get("userLogin"))
	{
		$cartObject->addToCart($_POST['size'], $_POST['quantity'], $productId);
	}
	?>
<?php $proInfo = $productObject->getProductById($productId); if ($proInfo): ?>
    <?php while ($info = $proInfo->fetch_assoc()): $cat = $info['catid']; ?>
		<div class="single">
			<div class="container">
				<div class="col-md-4 single-left">
					<div class="flexslider">
						<ul class="slides">
							<li data-thumb="admin/<?php echo $info['image'];?>">
								<div class="thumb-image"> <img src="admin/<?php echo $info['image'];?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
							</li>
						</ul>
					</div>
					<!-- flexslider -->
						<script defer src="js/jquery.flexslider.js"></script>
						<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
						<script>
						// Can also be used with $(document).ready()
						$(window).load(function() {
						$('.flexslider').flexslider({
							animation: "slide",
							controlNav: "thumbnails"
						});
						});
						</script>
					<!-- flexslider -->
					<!-- zooming-effect -->
						<script src="js/imagezoom.js"></script>
					<!-- //zooming-effect -->
				</div>
				<!--Start-->
				<div class="col-md-8 single-right">
					<h3><?php echo $info['proname']?></h3>
					<div class="rating1">
						<span class="star-rating">
						<?php
							$rating = $productObject->rating($productId);

							// Initialisation des variables pour calculer la moyenne
							$totalStars = 0;
							$numberOfReviews = 0;

							if ($rating && $rating->num_rows > 0) {
								while ($rev = $rating->fetch_assoc()) {
									// Ajouter le nombre d'étoiles à la somme totale
									$totalStars += $rev['rate'];
									$numberOfReviews++;
								}

								// Calculer la moyenne des étoiles
								$averageRating = $numberOfReviews > 0 ? round($totalStars / $numberOfReviews) : 0;

								// Afficher la représentation graphique de la moyenne
								for ($i = 1; $i <= $averageRating; $i++) {
										echo '<span class="fa fa-star"></span> &nbsp';
								}
							}
							?>

						</span>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="description">
								<h5><i>Description</i></h5>
								<p><?php echo $info['body'];?></p>
							</div>
							<div class="description">
								<h5><i>Category</i></h5>
								<p><?php 
									$cat1 = $productObject->getCategoryIdById($info['catid']);
									$catname = $cat1->fetch_assoc()['catname'];
									echo $catname 
								?></p>
							</div>
							<div class="description">
								<h5><i>Brand</i></h5>
								<p><?php 
									$b = $productObject->getBrandIdById($info['brandid']);
									$bname = $b->fetch_assoc()['brand'];
									echo $bname
								?></p>
							</div>
						</div>

						<div class="col-md-6">
							<div class="description">
								<h5><i>Price</i></h5>
								<p><i class="item_price">$<?php echo $info['price'];?></i></p>
							</div>

							
							<div >
								<form  method="post" action="">

							<div class="description">
								<h5><i>Size</i></h5>
								&nbsp;
								<div class="">
									<select class="select2_single form-control" tabindex="-1" name="size" title="size">
										<option value="S">size S</option>
										<option value="M">size M</option>
										<option value="L">size L</option>
									</select>
								</div>
							</div>

							<div class="description">
								<h5><i>Quantity</i></h5>
								&nbsp;
								<div class="">
									<input type="number" name="quantity" class="form-control" value="1">	
								</div>
							</div>
							<button type="submit" class="btn btn-default w3ls-cart" name="addCart" >Add To Cart</button>
							
							</form>
							</div>
						</div>
					</div>

					
							
						
				</div>
				
            <!--End-->
			<div class="clearfix"> </div>
		</div>
	</div>
    <?php endwhile; ?>
<?php endif; ?>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])  ): ?>
        <?php $allCategoryObject->inseertProductReviewByCustomerId(Session::get("userId"), $_POST['Name'], $_POST['Email'], $_POST['Review'], $_POST['rate'], $productId, $_POST['Telephone']);  ?>
    <?php endif;  ?>

<?php $proInfo = $productObject->getProductById($productId); if ($proInfo): ?>
    <?php while ($info = $proInfo->fetch_assoc()): ?>
	<div class="additional_info">
		<div class="container">
			<div class="sap_tabs">	
				<div id="horizontalTab1" style="display: block; width: 100%; margin: 0px;">
					<ul>
						<li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Product Information</span></li>                  
						<li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Reviews</span></li>
                    </ul>
					<div class="tab-1 resp-tab-content additional_info_grid" aria-labelledby="tab_item-0">
						<h3><?php echo $info['proname'];?></h3>
						<p><?php echo $info['body'];?></p>
					</div>	

					<div class="tab-2 resp-tab-content additional_info_grid" aria-labelledby="tab_item-1">
						<div class="additional_info_sub_grids">
							<div >
                                <?php $rating = $productObject->rating($productId); if ($rating) :?>
                                    <?php while ($rev = $rating->fetch_assoc()): ?>			
								<div class="additional_info_sub_grid_rightl">
									<a href="#"><?php echo $rev['name'];?></a>
									<h5><?php echo $rev['date'];?></h5>
									<p><?php echo $rev['review'];?></p>
								</div>
								<div class="additional_info_sub_grid_rightr">
									<div class="rating">
										<div class="rating-left">
                                            <?php for ($i = 1; $i <= $rev['rate']; ++$i): ?>
                                                <span class="fa fa-star-o"></span>
                                            <?php endfor; ?>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
								<div class="clearfix"> </div>
							</div>
							<br>
							<br>
                            <?php endwhile; ?>
                            <?php endif; ?>
							<div class="clearfix"> </div>
						</div>
						<div class="review_grids">
							<h5>Add A Review</h5>
                            <form action="#review" id="review" method="post">
                                <div class="form-group">
                                    <label for="usr">Name:</label>
                                    <input type="text" class="form-control" name="Name" id="usr" placeholder="Your Name" />
                                </div>
                                <div class="form-group" style="position: relative;right: 15px;">
                                    <label for="pwd" style="position: relative;left: 15px;">E-mail:</label>
                                    <input type="email" name="Email" class="form-control" id="pwd" placeholder="Your E-mail" />
                                </div>
                                <div class="form-group">
                                    <label for="rate">Rate:</label>
                                    <input type="number" name="rate" class="form-control" id="rate" placeholder="Rate 1-5 " />
                                </div>
                                <div class="form-group">
                                    <label for="ph">Phone:</label>
                                    <input type="text" name="Telephone" class="form-control" id="ph" placeholder="Your Phone" />
                                </div>
                                <div class="form-group">
                                    <label for="comment">Review:</label>
                                    <textarea class="form-control" name="Review" rows="5" id="comment" placeholder="Your Review"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit"  value="Submit" />
                                </div>
                            </form>
						</div>
					</div>
				</div>
			</div>
			<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
			<script type="text/javascript">
				$(document).ready(function () {
					$('#horizontalTab1').easyResponsiveTabs({
						type: 'default', //Types: default, vertical, accordion           
						width: 'auto', //auto or any width like 600px
						fit: true   // 100% fit in a container
					});
				});
			</script>
		</div>
	</div>
    <?php endwhile; ?>
<?php endif; ?>
	<!-- Related Products -->
<?php $proInfo = $productObject->getProductByCategory($cat); if ($proInfo): ?>
	<div class="w3l_related_products">
		<div class="container">
			<h3>Related Products</h3>
			<ul id="flexiselDemo2">
                <?php  while ($related = $proInfo->fetch_assoc()): ?>
				<li>
					<div class="w3l_related_products_grid">
						<div class="agile_ecommerce_tab_left mobiles_grid">
							<div class="hs-wrapper hs-wrapper3">
                                <?php for ($i = 1; $i <= 5; ++$i): ?>
								    <img src="admin/<?php echo $related['image'] ;?>" alt=" <?php echo $related['proname'];?> " class="img-responsive" />
                                <?php endfor; ?>
							</div>
							<h5><a href="single.php?proid=<?php echo $related['proid'];?>"><?php echo $related['proname'];?></a></h5>
							<div class="simpleCart_shelfItem"> 
								<p class="flexisel_ecommerce_cart"><i class="item_price">$ <?php echo $related['price'];?></i></p>
							</div>
                            <div>
                                <a href="single.php?proid=<?php echo $related['proid'];?>" class="btn btn-default w3ls-cart">Add to Cart</a>
                            </div>
						</div>
					</div>
				</li>
                <?php endwhile; ?>
			</ul>
			
				<script type="text/javascript">
					$(window).load(function() {
						$("#flexiselDemo2").flexisel({
							visibleItems:4,
							animationSpeed: 1000,
							autoPlay: true,
							autoPlaySpeed: 3000,
							pauseOnHover: true,
							enableResponsiveBreakpoints: true,
							responsiveBreakpoints: {
								portrait: {
									changePoint:480,
									visibleItems: 1
								},
								landscape: {
									changePoint:640,
									visibleItems:2
								},
								tablet: {
									changePoint:768,
									visibleItems: 3
								}
							}
						});
					});
				</script>

				<script type="text/javascript" src="js/jquery.flexisel.js"></script>
		</div>
	</div>
<?php endif; ?>
	<!-- //Related Products -->

	<!-- //single -->
	<!-- newsletter -->
	<?php include 'footer.php'?>
