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
    // include '../classes/Product.php';
    include_once '../helpers/Formate.php'
?>
<?php
    $categoryObject = new Category();
    $brandObject    = new Brand();
    $productObject  = new Product();
    $formateObject  = new Formate();
    if (!isset($_GET['proid']) || $_GET['proid'] == null) echo "<script>window.location = 'index.php'</script>";
    else $productId = $_GET['proid'];
?>
    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Elements</h3>
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
            <?php
                if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['productEdit']))
                {
                    $productObject->updateProductById($productId, $_POST, $_FILES);
                }

                if (isset($_GET['delPro']))
                {
                    $productObject->deleteProductById($_GET['delPro']);
                }
            ?>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Product <small> Edit Product </small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />

                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="POST" enctype="multipart/form-data">
                            <?php $proInfo = $productObject->getProductById($productId); if ($proInfo): ?>
                            <?php $info = $proInfo->fetch_assoc(); ?>
                            
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="proname">Product Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="proname" required="required" value="<?php echo $info['proname'];?>" name="product" class="form-control col-md-7 col-xs-12">
                                        
                                    </div>
                                </div>

                                <!--Category-->
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Category</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="select2_single form-control" tabindex="-1" name="category" title="Category"">
                                            <option value="<?php echo $info['catid'];?>">
                                                <?php 
                                                    $cat = $productObject->getCategoryIdById($info['catid']);
                                                    $catname = $cat->fetch_assoc()['catname'];
                                                    echo $catname 
                                                ?>
                                            </option>
                                            <?php
                                                $category = $categoryObject->allCategory();
                                                if (isset($category)):
                                                    while ($cat = $category->fetch_assoc()):
                                                        if($cat['id']!==$info['catid']):
                                            ?>
                                                <option value="<?php echo $cat['id'];?>" ><?php echo $cat['catname'];?></option>
                                            <?php endif; endwhile; endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <!--Brand-->
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Brand</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="select2_single form-control" tabindex="-1" name="brand" title="Brand">
                                        <?php 
                                            $b = $productObject->getBrandIdById($info['brandid']);
                                            $bname = $b->fetch_assoc()['brand'];
                                         ?>    
                                        <option value="<?php echo $info['brandid']  ?>">
                                                <?php 
                                                    echo $bname 
                                                ?>
                                            </option>
                                            <?php
                                                $brand = $brandObject->allBrand();
                                                if (isset($brand)):
                                                    while ($bra = $brand->fetch_assoc()):
                                                        if($bra['id']!==$info['brandid']):
                                            ?>
                                                <option value="<?php echo $bra['id'];?>"><?php echo $bra['brand'];?></option>
                                            <?php endif; endwhile; endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Description</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea type="text" id="body" required="required" value="<?php echo $info['body'];?>" name="prodis" class="form-control col-md-7 col-xs-12"><?php echo $info['body'];?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Product Price <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="price" required="required" value="<?php echo $info['price'];?>" name="price" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Picture</label>
                                    <div class="btn-group col-md-6 col-sm-6 col-xs-12">
                                        <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                                        <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12">
                                        <?php
                                        if (!empty($info['image'])) {
                                            echo '<img src="' . $info['image'] . '" alt="Current Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">';
                                        }
                                        ?>
                                    </div>
                                </div>


                                <!--Type-->
                                <!-- <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Type <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="first-name" required="required" name="type" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Gender</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="select2_single form-control" tabindex="-1" name="gender" title="Gender">
                                            <option value="<?php 
                                            echo $info['gender'] ?>"><?php 
                                            echo $info['gender'] ?></option>
                                            <?php if($info['gender']=='Male') ?>
                                            <option value="Female">Female</option>
                                            <option value="All">All</option>
                                            <?php endif; ?>
                                        </select>
                                        
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="proname">Product Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="proname" required="required" value="<?php echo $info['proname'];?>" name="product" class="form-control col-md-7 col-xs-12">
                                        
                                    </div>
                                </div> -->


                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="quant_S">Quantite Size S<span class="required" >*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="qs"  name="qs" class="form-control col-md-7 col-xs-12" value="<?php echo $info['quant_S']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="quant_M">Quantite Size M <span >*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="qm" name="qm" class="form-control col-md-7 col-xs-12" value="<?php echo $info['quant_M']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="quant_L">Quantite Size L <span >*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="ql"  name="ql" class="form-control col-md-7 col-xs-12" value="<?php echo $info['quant_L'];?>">
                                        </div>
                                    </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-app" name="productEdit"><i class="fa fa-save"></i> Save</button>
                                        <button class="btn btn-app" type="reset"><i class="fa fa-repeat"></i> Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                

                <!--End product List-->
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