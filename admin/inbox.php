<?php
include 'adminHader.php';
//include '../classes/Message.php';
//include '../classes/User.php';
//$messageobject = new Message();
$userObject = new User();
$productObject = new Product();
?>

<!--//Need to format Message-->

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Product Reviews</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Product Reviews</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Display Product Reviews in a Table -->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Product Name</th>
                                            <th>Reviews</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch products
                                        $products = $productObject->allProducts(); // Modify this based on your implementation

                                        // Loop through each product
                                        while ($product = $products->fetch_assoc()) :
                                            $productId = $product['proid'];
                                            $productName = $product['proname'];

                                            // Fetch reviews for the current product
                                            $reviews = $productObject->getProductReviews($productId);

                                            // Check if there are reviews
                                            if ($reviews!==false && $reviews->num_rows > 0) :
                                                ?>
                                                <tr>
                                                    <td><?php echo $productId; ?></td>
                                                    <td><?php echo $productName; ?></td>
                                                    <td>
                                                        <!-- Display Reviews in a List -->
                                                        
                                                        <!-- Button to trigger the modal -->
                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?php echo $productId; ?>">View Reviews</button>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                                <!-- End Display Product Reviews in a Table -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!-- footer content -->

<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="vendors/nprogress/nprogress.js"></script>
<!-- bootstrap-wysiwyg -->
<script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="vendors/google-code-prettify/src/prettify.js"></script>

<!-- Custom Theme Scripts -->
<script src="build/js/custom.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $productId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Reviews for <?php echo $productName; ?></h4>
            </div>
            <div class="modal-body">
                <!-- Display Reviews in the modal -->
                <ul>
                    <?php $reviews->data_seek(0); // Reset the result set pointer ?>
                    <?php while ($review = $reviews->fetch_assoc()) : ?>
                        <li>
                            <strong><?php echo $review['name']; ?>:</strong>
                            <?php echo $review['review']; ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<?php
    include 'adminFooter.php';
?>
