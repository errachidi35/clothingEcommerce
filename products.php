<?php include 'header.php'?>
	<!-- //navigation -->
	<!-- banner -->
	<div class="banner banner1">

	</div> 
	<!-- breadcrumbs -->
	<div class="breadcrumb_dress">
		<div class="container">
			<ul>
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
				<li>Products</li>
			</ul>
		</div>
	</div>
	<!-- //breadcrumbs --> 
	<!-- mobiles -->
	<div class="mobiles">
		<div class="container">
			<div class="w3ls_mobiles_grids">

				<div class="col-md-12 w3ls_mobiles_grid_right">
					<div class="col-md-6 w3ls_mobiles_grid_right_left">
						<div class="w3ls_mobiles_grid_right_grid1">
							<img src="images/z9.jpg" alt=" " class="img-responsive" />
							<div class="w3ls_mobiles_grid_right_grid1_pos1">
								<h3>Jackets<span>Up To</span> 15% Discount</h3>
							</div>
						</div>
					</div>
					<div class="col-md-6 w3ls_mobiles_grid_right_left">
						<div class="w3ls_mobiles_grid_right_grid1">
							<img src="images/z10.webp" alt=" " class="img-responsive" />
							<div class="w3ls_mobiles_grid_right_grid1_pos">
								<h3>Top 10 Latest<span>Pants </span>& Accessories</h3>
							</div>
						</div>
					</div>
					<div class="clearfix"> </div>

					<div class="w3ls_mobiles_grid_right_grid2">
						<div class="clearfix"> </div>
					</div>

					<div class="w3ls_mobiles_grid_right_grid3">
					<div class="filter">
						<form method="GET" class="form-inline">
							
							<div class="form-group">
								<input type="text" class="form-control" name="search" id="search" placeholder="search" 
									<?php if (isset($_GET['search'])): ?>
										value="<?php echo $_GET['search']?>"
									<?php endif ?>
								/>
							</div>
							
							<div style="float:right">
							<div class="form-group ml-3">
								<select class="form-control" name="brand" id="brand"
									<?php if (isset($_GET['brand'])): ?>
										value="<?php echo $_GET['brand']?>"
									<?php endif ?>
								>
									<option value="">All Brands</option>
									<?php
									// Fetch all unique brands from your database
									$brands = $brandObject->allBrand();
									if ($brands) {
										while ($brand = $brands->fetch_assoc()) {
											$selected = ($brandFilter == $brand['brand']) ? 'selected' : '';
											echo "<option value='{$brand['brand']}' $selected>{$brand['brand']}</option>";
										}
									}
									?>
								</select>
							</div>

							<div class="form-group ml-3">
								<label for="category"> </label>
								<select class="form-control " name="category" id="category"
									<?php if (isset($_GET['category'])): ?>
										value="<?php echo $_GET['category']?>"
									<?php endif ?>
								>
									<option value="">All Categories</option>
									<?php
									// Fetch all unique categories from your database
									$categories = $categoryObject->allCategory(); // Replace with your actual method to fetch categories
									if ($categories) {
										while ($category = $categories->fetch_assoc()) {
											$selected = ($categoryFilter == $category['catname']) ? 'selected' : '';
											echo "<option value='{$category['catname']}' $selected>{$category['catname']}</option>";
										}
									}
									?>
								</select>
							</div>

							<div class="form-group ml-3">
								<label for="gender"> </label>
								<select class="form-control " name="gender" id="gender">
									<option value="">All Genders</option>
									<option value="Male" <?php if (isset($_GET['gender']) && $_GET['gender']=="Male"): ?> selected <?php endif ?>>Male</option>
									<option value="Female" <?php if (isset($_GET['gender']) && $_GET['gender']=="female"): ?> selected <?php endif ?>>Female</option>
									<option value="All">All</option>
								</select>
							</div>
							

							&nbsp
							<button type="submit" class="btn btn-primary ml-3">Apply Filter</button>
							</div>
						</form>
					</div>


						<br><br>
                        <?php
							$brandFilter = isset($_GET['brand']) ? $_GET['brand'] : '';
							$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';
							$genderFilter = isset($_GET['gender']) ? $_GET['gender'] : '';
							$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';


							$mobile = $allCategoryObject->loadAllProduct($brandFilter, $categoryFilter, $genderFilter, $searchTerm);

							if ($mobile && $mobile->num_rows > 0):
								$j = 0;

								while ($allMobile = $mobile->fetch_assoc()):
									$j++;
							?>
									<div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles">
										<div class="agile_ecommerce_tab_left mobiles_grid">
											<div class="hs-wrapper">
												<?php for ($i = 1; $i <= 5; ++$i): ?>
													<img src="admin/<?php echo $allMobile['image']; ?>" alt=" " class="img-responsive" />
												<?php endfor; ?>
											</div>
											<div style="margin-bottom: 10px; margin-right:35px">
												<h5><a href="single.php?proid=<?php echo $allMobile['proid']; ?>" target="_blank"><?php echo $allMobile['proname']; ?></a></h5>
												<h3>$ <?php echo $allMobile['price']; ?></h3>
											</div>
											<div class="" style="margin-top: 10px; margin-bottom: 80px; margin-right:35px">
												<a href="single.php?proid=<?php echo $allMobile['proid']; ?>" class="btn btn-info">Details</a>
											</div>
											<?php if ($j <= 2): ?>
												<div class="mobiles_grid_pos">
													<h6>New</h6>
												</div>
											<?php endif; ?>
										</div>
									</div>
							<?php
								endwhile;
								else:
									echo "<p>No products found for the selected brand and category.</p>";
									// Add the following line to check if the query is correct
									
								endif;
							?>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>

	<!-- Initialize Select2 -->


	<!-- Related Products -->
	<!-- //Related Products -->
	<!-- newsletter -->
	<?php include 'footer.php'; ?>