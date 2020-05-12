<?php
    include('config.php');
    $res = getAllRecords($dbcon, 'footer');
    foreach($res as $datass){
        $contect_title = $datass['contect_info'];
        $contect_number = $datass['contect_number'];
        $contect_address = $datass['contect_address'];
        $contect_time = $datass['contect_time'];
    }
?>

<div id="footer" class=" ppb_wrapper">
        <ul class="sidebar_widget three">
            <li id="text-2" class="widget widget_text">
                <h2 class="widgettitle">Our Awards</h2>
                <div class="textwidget">
                    <p>London is a megalopolis of people, ideas and frenetic energy. The capital and largest city of the United Kingdom.
                        <br />
                        <img src="upload/awards.png" width="246" height="113" style="margin-top:30px;" alt="" /></p>
                </div>
            </li>
            <li id="text-4" class="widget widget_text">
                <h2 class="widgettitle"><?php echo $contect_title; ?></h2>
                <div class="textwidget">
                    <p><span class="ti-mobile" style="margin-right:10px;"></span><?php echo $contect_number; ?></p>
                    <p><span class="ti-location-pin" style="margin-right:10px;"></span><?php echo $contect_address; ?></p>
                    <p><span class="ti-alarm-clock" style="margin-right:10px;"></span><?php echo $contect_time; ?></p>
                    <div style="margin-top:20px;">
                        <div class="social_wrapper shortcode dark ">
                            <ul>
                                <li class="facebook"><a target="_blank" title="Facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="twitter"><a target="_blank" title="Twitter" href="https://twitter.com/#"><i class="fa fa-twitter"></i></a></li>
                                <li class="youtube"><a target="_blank" title="Youtube" href="#"><i class="fa fa-youtube"></i></a></li>
                                <li class="pinterest"><a target="_blank" title="Pinterest" href="https://pinterest.com/#"><i class="fa fa-pinterest"></i></a></li>
                                <li class="instagram"><a target="_blank" title="Instagram" href="https://instagram.com/theplanetd"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li id="grandtour_flickr-7" class="widget Grandtour_Flickr">
                <h2 class="widgettitle">Recent Trips</h2>
                <ul class="flickr">
                <?php
                $best_query = getLimitedRecords($dbcon, 'tours', 6);
                if($best_query == true){
                    foreach($best_query as $best_fetch){
                ?>
                    <li>
                        <a target="_blank" href="tour_value.php?id=<?php echo $best_fetch['id']; ?>"><img style="height:96.95px; witdh:96.95px" src="upload/<?php echo $best_fetch['tour_display_image']; ?>" alt="Buddha img" /></a>
                    </li>
                <?php
                    }
                }
                ?>
                </ul>
                <br class="clear" />
            </li>
        </ul>
    </div>

    <div class="footer_bar  ppb_wrapper ">

        <div class="footer_bar_wrapper ">
            <div class="menu-footer-menu-container">
                <ul id="footer_menu" class="footer_nav">
                    <li class="menu-item current-menu-item"><a href="index.php">Home</a></li>
                    <li class="menu-item"><a href="tour.php">Tours</a></li>
                    <li class="menu-item"><a href="blog.php">Blog</a></li>
                    <li class="menu-item"><a href="#">Purchase Template</a></li>
                </ul>
            </div>
            <div id="copyright">© Copyright GTour Template Demo</div>
            <br class="clear" />
            <a id="toTop" href="javascript:;"><i class="fa fa-angle-up"></i></a>
        </div>
    </div>