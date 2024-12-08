<?php
/**
 * Created by PhpStorm.
 * User: Tanjil Hasan
 * Date: 9/10/2017
 * Time: 3:52 AM
 */
?>
<?php
    include 'adminHader.php';
    include '../classes/Category.php';
    include '../classes/Brand.php';
    //include '../classes/Product.php';
    include_once '../helpers/Formate.php'
?>
<?php
    $categoryObject = new Category();
    $brandObject    = new Brand();
    $productObject  = new Product();
    $formateObject  = new Formate();
?>
    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
        
                <?php
                if (isset($_GET['delPro']))
                {
                    $productObject->deleteProductById($_GET['delPro']);
                }
                    $allProduct = $productObject->allProducts();
                    if (isset($allProduct)): $i = 0;
                ?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Product List</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <p class="text-muted font-13 m-b-30">
                                Category Table
                            </p>
                            <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0.11%;text-align: center;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Serial Number</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 11.11%;text-align: center;" aria-label="Position: activate to sort column ascending">Product Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 11.11%;text-align: center;" aria-label="Office: activate to sort column ascending">Product Category</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 11.11%;text-align: center;" aria-label="Age: activate to sort column ascending">Product Brand</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 11.11%;text-align: center;" aria-label="Age: activate to sort column ascending">Product Description</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 21.11%;text-align: center;" aria-label="Age: activate to sort column ascending">Product Image</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 8.11%;text-align: center;" aria-label="Age: activate to sort column ascending">Product Price</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 8.11%;text-align: center;" aria-label="Age: activate to sort column ascending">Product Gender</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 8.11%;text-align: center;" aria-label="Age: activate to sort column ascending">Edit Product</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 8.11%;text-align: center;" aria-label="Age: activate to sort column ascending">Delete Product</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                               
                                                <?php while ($allPro = $allProduct->fetch_assoc()): $i++; ?>
                                                <?php $catId = $productObject->getCategoryIdById($allPro['catid']); ?>
                                                <?php $brandId = $productObject->getBrandIdById($allPro['brandid']); ?>
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1" style="text-align: center"><?php echo $i ?></td>
                                                        <td style="text-align: center"><?php echo $allPro['proname'] ?></td>
                                                        <?php  if (isset($catId)) : while ($catName = $catId->fetch_assoc()): ?>
                                                            <td style="text-align: center"><?php echo $catName['catname']; ?></td>
                                                        <?php endwhile; endif; ?>
                                                        <?php  if (isset($brandId)) : while ($brandName = $brandId->fetch_assoc()): ?>
                                                            <td style="text-align: center"><?php echo $brandName['brand']; ?></td>
                                                        <?php endwhile; endif; ?>
                                                        <td style="text-align: center"><?php echo $formateObject->textShorten($allPro['body'], 100); ?></td>
                                                        <td style="text-align: center">
                                                            <a href="#" class="thumbnail">
                                                                <img src="<?php echo $allPro['image'] ?>" alt="" class="img-responsive" />
                                                            </a>
                                                        </td>
                                                        <td style="text-align: center"> $ <?php echo $allPro['price'] ?></td>
                                                        <td style="text-align: center"><?php echo $allPro['gender'] ?></td>
                                                        <td style="text-align: center">
                                                            <a class="btn btn-round btn-success" href="productEdit.php?proid=<?php echo $allPro['proid'];?>">
                                                                <i class="fa fa-pencil"></i> Edit
                                                            </a>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <a class="btn btn-round btn-danger" onclick="return confirm('Are You Sure You Want to Delete ?');" href="?delPro=<?php echo $allPro['proid']; ?>">
                                                                <i class="fa fa-times"></i> Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                                <?php else: ?>
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1" style="text-align: center">Empty Product</td>
                                                        <td style="text-align: center">Empty Product</td>
                                                            <td style="text-align: center">Empty Product</td>
                                                            <td style="text-align: center">Empty Product</td>
                                                        <td style="text-align: center">Empty Product</td>
                                                        <td style="text-align: center">
                                                            <a href="#" class="thumbnail">
                                                                <img src="<?php echo $allPro['image'] ?>" alt="" class="img-responsive" />
                                                            </a>
                                                        </td>
                                                        <td style="text-align: center">Empty Product</td>
                                                        <td style="text-align: center">Empty Product</td>
                                                        <td style="text-align: center">
                                                            No Product to Edit
                                                        </td>
                                                        <td style="text-align: center">
                                                            No Product to Delete
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--End product List-->
            </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    
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
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

    </body>
</html>
<?php
    include 'adminFooter.php';
?>
