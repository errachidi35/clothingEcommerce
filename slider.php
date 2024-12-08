<?php
/**
 * Slider Page of Template
 * Created by PhpStorm.
 * User: Tanjil Hasan
 * Date: 9/8/2017
 * Time: 6:34 AM
 */
?>
<div class="banner-bottom">
    <div class="container">
        <div class="col-md-5 wthree_banner_bottom_left">
            <div class="video-img">
                
            </div>
            <!-- pop-up-box -->
            <script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
            <!--//pop-up-box -->
            
            
        </div>
        <div class="col-md-7 wthree_banner_bottom_right">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs" style="margin-left:50px">
                <ul id="myTab" class="nav nav-tabs" role="tablist" style="margin-left:110px">
                    <li role="presentation" class="active">
                        <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home">shirts</a>
                    </li>
                    <li role="presentation">
                        <a href="#audio" role="tab" id="audio-tab" data-toggle="tab" aria-controls="audio">T-shirts</a>
                    </li>
                    <li role="presentation">
                        <a href="#video" role="tab" id="video-tab" data-toggle="tab" aria-controls="video">Pants</a>
                    </li>
                    <li role="presentation">
                        <a href="#tv" role="tab" id="tv-tab" data-toggle="tab" aria-controls="tv">jackets</a>
                    </li>
                    <li role="presentation">
                        <a href="#kitchen" role="tab" id="kitchen-tab" data-toggle="tab" aria-controls="kitchen">shoes</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                        <div class="agile_ecommerce_tabs">
                            <?php $allPro = $productObject->show_shirts(); if ($allPro): ?>
                                <?php while ($mobile = $allPro->fetch_assoc()): ?>
                                <div class="col-md-4 agile_ecommerce_tab_left">
                                    <div class="hs-wrapper">
                                        <?php for ($i = 1; $i <= 8; ++$i): ?>
                                            <img src="admin/<?php echo $mobile['image'];?>" alt=" " class="img-responsive" />
                                        <?php endfor; ?>
                                    </div>
                                    <div style="margin-top: 10px; margin-bottom: 10px">
                                        <h5><a href="single.php?proid=<?php echo $mobile['proid'];?>" target="_blank" ><?php echo $mobile['proname'];?></a></h5>
                                        <h3> $ <?php echo $mobile['price'];?></h3>
                                    </div>
                                    <div class="" style="margin-top: 10px">
                                        <a href="single.php?proid=<?php echo $mobile['proid'];?>" target="_blank" class="btn btn-info">Details</a>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="audio" aria-labelledby="audio-tab">
                        <div class="agile_ecommerce_tabs">
                            <div class="agile_ecommerce_tabs">
                                <?php $allPro = $productObject->show_T_shirts(); if ($allPro): ?>
                                    <?php while ($mobile = $allPro->fetch_assoc()): ?>
                                        <div class="col-md-4 agile_ecommerce_tab_left">
                                            <div class="hs-wrapper">
                                                <?php for ($i = 1; $i <= 8; ++$i): ?>
                                                    <img src="admin/<?php echo $mobile['image'];?>" alt=" " class="img-responsive" />
                                                <?php endfor; ?>
                                            </div>
                                            <div style="margin-top: 10px; margin-bottom: 10px">
                                                <h5><a href="single.php?proid=<?php echo $mobile['proid'];?>" target="_blank" ><?php echo $mobile['proname'];?></a></h5>
                                                <h3> $ <?php echo $mobile['price'];?></h3>
                                            </div>
                                            <div class="" style="margin-top: 10px">
                                                <a href="single.php?proid=<?php echo $mobile['proid'];?>" target="_blank" class="btn btn-info">Details</a>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="video" aria-labelledby="video-tab">
                        <div class="agile_ecommerce_tabs">
                            <?php $allPro = $productObject-> show_Pants(); if ($allPro): ?>
                                <?php while ($mobile = $allPro->fetch_assoc()): ?>
                                    <div class="col-md-4 agile_ecommerce_tab_left">
                                        <div class="hs-wrapper">
                                            <?php for ($i = 1; $i <= 8; ++$i): ?>
                                                <img src="admin/<?php echo $mobile['image'];?>" alt=" " class="img-responsive" />
                                            <?php endfor; ?>
                                        </div>
                                        <div style="margin-top: 10px; margin-bottom: 10px">
                                            <h5><a href="single.php?proid=<?php echo $mobile['proid'];?>" target="_blank" ><?php echo $mobile['proname'];?></a></h5>
                                            <h3> $ <?php echo $mobile['price'];?></h3>
                                        </div>
                                        <div class="" style="margin-top: 10px">
                                            <a href="single.php?proid=<?php echo $mobile['proid'];?>" target="_blank" class="btn btn-info">Details</a>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tv" aria-labelledby="tv-tab">
                        <div class="agile_ecommerce_tabs">
                            <?php $allPro = $productObject->show_jackets(); if ($allPro): ?>
                                <?php while ($mobile = $allPro->fetch_assoc()): ?>
                                    <div class="col-md-4 agile_ecommerce_tab_left">
                                        <div class="hs-wrapper">
                                            <?php for ($i = 1; $i <= 8; ++$i): ?>
                                                <img src="admin/<?php echo $mobile['image'];?>" alt=" " class="img-responsive" />
                                            <?php endfor; ?>
                                        </div>
                                        <div style="margin-top: 10px; margin-bottom: 10px">
                                            <h5><a href="single.php?proid=<?php echo $mobile['proid'];?>" target="_blank" ><?php echo $mobile['proname'];?></a></h5>
                                            <h3> $ <?php echo $mobile['price'];?></h3>
                                        </div>
                                        <div class="" style="margin-top: 10px">
                                            <a href="single.php?proid=<?php echo $mobile['proid'];?>" target="_blank" class="btn btn-info">Details</a>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="kitchen" aria-labelledby="kitchen-tab">
                        <div class="agile_ecommerce_tabs">
                            <?php $allPro = $productObject->show_shoes(); if ($allPro): ?>
                                <?php while ($mobile = $allPro->fetch_assoc()): ?>
                                    <div class="col-md-4 agile_ecommerce_tab_left">
                                        <div class="hs-wrapper">
                                            <?php for ($i = 1; $i <= 8; ++$i): ?>
                                                <img src="admin/<?php echo $mobile['image'];?>" alt=" " class="img-responsive" />
                                            <?php endfor; ?>
                                        </div>
                                        <div style="margin-top: 10px; margin-bottom: 10px">
                                            <h5><a href="single.php?proid=<?php echo $mobile['proid'];?>" target="_blank" ><?php echo $mobile['proname'];?></a></h5>
                                            <h3> $ <?php echo $mobile['price'];?></h3>
                                        </div>
                                        <div class="" style="margin-top: 10px">
                                            <a href="single.php?proid=<?php echo $mobile['proid'];?>" target="_blank" class="btn btn-info">Details</a>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
