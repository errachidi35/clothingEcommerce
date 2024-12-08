<?php include 'header.php'?>

    <!-- //navigation -->
    <!--banner-->
    <div class="banner banner10">
        <div class="container">
        </div>
    </div>
    <!--//banner-->
    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container">
            <ul>
                <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
                <li>Add to Cart</li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <?php
        global $total;
        $total = 0;
        global $emptyCart;
    ?>
    <!-- Add to Cart -->
    <div class="single">
        <div class="container">
            <div class="row">
                <?php if ( isset($_GET['delCart']) && $_GET['delCart'] != null ): ?>
                    <?php $cartObject->delCartById($_GET['delCart']); ?>
                <?php endif; ?>

                <?php if ( ($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['updateCart']) ): ?>
                    <?php $cartObject->updateQuantity($_POST['cartid'], $_POST['quantity']); ?>
                <?php endif; ?>
                <?php $allCartProduct = $cartObject->allProductBySessionId(); if ($allCartProduct): $emptyCart = true; $i = 0; ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="cart-table">
                            <table class="table">
                                <thead class="table table-bordered">
                                    <tr>
                                        <th class="text-center" style="width: 8%;">#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center" style="width: 8%;">Price</th>
                                        <th class="text-center" style="width: 8%;">Quantity</th>
                                        <th class="text-center" style="width: 8%;">Totale Price</th>
                                        <th class="text-center" style="width: 8%;">Size</th>
                                        <th class="text-center" style="width: 24%;">Image</th>
                                        <th class="text-center" style="width: 22%;">Update</th>
                                        <th class="text-center" style="width: 8%;">Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php while ( $allCart = $allCartProduct->fetch_assoc() ): $i++; ?>
                                        <tr>
                                            <th scope="row" class="text-center"><?php echo $i; ?></th>
                                            <td class="text-center"><?php echo $allCart['proname']; ?></td>
                                            <td class="text-center">$<?php echo $allCart['price']; ?></td>
                                            <td class="text-center"><?php echo $allCart['quantity']; ?></td>
                                            <td class="text-center">$<?php echo $allCart['quantity']*$allCart['price']; $total += $allCart['quantity']*$allCart['price']; ?></td>
                                            <td class="text-center"><?php echo $allCart['size']; ?></td>
                                            <td class="text-center">
                                                <img src="admin/<?php echo $allCart['image']; ?>" title="<?php echo $allCart['proname']; ?>" alt="" class="img-rounded img-responsive" style="height: 65%;width: 70%;" />
                                            </td>
                                            <td class="text-center">
                                                <form class="navbar-form navbar-left" method="post" action="">
                                                    <input type="hidden" name="cartid" style="width: 30%;" class="form-control" value="<?php echo $allCart['cartid']; ?>" title="Product Quantity" />
                                                    <input type="number" name="quantity" style="width: 30%;" class="form-control" value="<?php echo $allCart['quantity']; ?>" title="Product Quantity" />
                                                    <button type="submit" class="btn btn-default w3ls-cart" name="updateCart" > <i class="fa fa-check"></i> Update </button>
                                                </form>
                                            </td>
                                            <?php  ?>
                                            <td class="text-center">
                                                <a href="?delCart=<?php echo $allCart['cartid']; ?>" onclick="return confirm('Are You Sure You Want to Delete ?');" class="btn btn-danger"> <i class="fa fa-pencil-square-o"></i> Delete </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <?php
                        echo "<div class='alert alert-warning alert-dismissable'>
                              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                              <strong> Your cart is Empty !</strong>
                          </div>";
                    ?>
                <?php endif; ?>
                <?php if (!$emptyCart): ?>
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 pull-right">
                        <?php
                            echo "<div class='alert alert-warning alert-dismissable'>
                                      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                      <strong> There is no item in your cart for now.</strong>
                                  </div>";
                        ?>
                    </div>
                <?php else: ?>
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 pull-right hover">
                        <div class="cart-info" style="background-color: #d9edf7; padding: 15%;box-shadow: 5px 4px 18px #888888;border-radius: 3%; font-weight: 700">
                            <p> Total Price :  $<?php echo $total; Session::set("total", $total); ?>  </p>
                            <p> Vat :  5% </p>
                            <p>Total With Vat :  $<?php echo ($total+(($total*5)/100)); ?> </p>
                        </div>
                        <div class="checkout-button" style="box-shadow: 5px 4px 18px #888888;">
                            <a class="btn btn-block btn-warning text-capitalize" href="payment.php">Validate</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <strong> My Orders </strong>
                <div class="x_content">
                        <?php  $orderProduct = $productObject->customerOrderProduct(Session::get("userId")); if ($orderProduct): $i = 0; ?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Products</th>
                                    <th class="text-center">Total Price</th>
                                    <th class="text-center">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($allPro = $orderProduct->fetch_assoc() ): $i++; ?>
                                    <tr>
                                        <td scope="row" class="text-center"><?php echo $i; ?></td>
                                        
                                        <td class="text-center"><?php echo $formateObject->formatDate($allPro['date']); ?></td>
                                        
                                        <td class="text-center">
                                            <ul>
                                                <?php 
                                                    $products = $productObject->allOrderProducts($allPro['id']); 
                                                    $totalPrice = 0;
                                                    while ( $product = $products->fetch_assoc() ):
                                                ?>
                                                <li>
                                                    <a class="" href="single.php?proid=<?php echo $product['proid']; ?>">
                                                        <?php 
                                                            $totalPrice += $product['quantity']*$product['price'];
                                                            echo $product['proname'].": "." [".$product['size']."]"." ( $".$product['price']." * ". $product['quantity']." )"; 
                                                        ?>
                                                    </a> 
                                                </li>
                                                <?php endwhile ?>
                                            </ul>
                                        </td>
                                        
                                        <td class="text-center">$<?php echo ($totalPrice) ?></td>
                                        
                                        
                                        <td class="text-center">
                                            <?php if ($allPro['status'] == 0): ?>
                                                <div class="btn btn-round btn-danger"> <i class="fa fa-delicious"></i> Pending</div>
                                            <?php elseif ($allPro['status'] == 1 ): ?>
                                                <div class="btn btn-round btn-warning"> <i class="fa fa-delicious"></i> InRoute</div>
                                                <?php else: ?>
                                                <div class="btn btn-round btn-success" > <i class="fa fa-check"></i> Received</div>
                                                <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class='alert alert-warning alert-dismissable'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                <strong> You are yet to make any orders.</strong>
                            </div>
                        <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- //Add to Cart -->


<?php
    include 'footer.php';
?>
