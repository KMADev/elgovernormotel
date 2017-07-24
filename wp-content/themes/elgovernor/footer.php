<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KMA_DEMO
 */
$phone = get_field('phone', 5);
$localphone = get_field('local_phone', 5);
$address = get_field('address', 5);
?>
        </div><!-- #mid -->
	</div><!-- #content -->
    <div id="sticky-footer" class="unstuck">
        <div class="container">
        <div id="feat-blocks" >
            <div class="row no-gutters">
                <div class="col-lg-4 facebook">
                    <div class="feat-container text-center">
                        <h3>Join the conversation.</h3>
                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s); js.id = id;
                                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=131392937353724";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-page" data-href="https://www.facebook.com/El-Governor-Motel-179580765407597/" data-tabs="timeline" data-width="500" data-height="461" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"><blockquote cite="https://www.facebook.com/ElGovernorMotel" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ElGovernorMotel">El Governor Motel</a></blockquote></div>
                        <p class="hashtag">#ElGovernorMotel</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 tripadvisor">
                    <div class="feat-container text-center">
                        <h3>Read guest reviews.</h3>
                        <div id="TA_selfserveprop982" class="TA_selfserveprop">
                            <ul id="UAP2aAT061" class="TA_links IKP8ODb0t">
                                <li id="bbXPgIbRR" class="3vVXH3hbppMc">
                                    <a target="_blank" href="https://www.tripadvisor.com/"><img src="https://www.tripadvisor.com/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/></a>
                                </li>
                            </ul>
                        </div>
                        <script src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=982&amp;locationId=271119&amp;lang=en_US&amp;rating=true&amp;nreviews=3&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=true&amp;border=false&amp;display_version=2"></script>
                        <p class="hashtag">&nbsp;</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 instagram">
                    <div class="feat-container text-center">
                        <h3>View visitor photos.</h3>
                        <div id="instafeed" class="row no-gutters">
						    <?php echo wdi_feed(array('id'=>'1')); ?>
                        </div>
                        <p class="hashtag">#ElGovernorMotel</p>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div id="bot">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div id="botnav" class="row no-gutters">
                            <nav class="navbar navbar-toggleable-md">
			                    <?php wp_nav_menu(
				                    array(
					                    'theme_location'  => 'menu-2',
					                    'container_class' => '',
					                    'container_id'    => 'navbar-footer',
					                    'menu_class'      => 'nav',
					                    'fallback_cb'     => '',
					                    'menu_id'         => 'menu-2',
					                    'walker'          => new WP_Bootstrap_Navwalker(),
				                    )
			                    ); ?>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-4 hidden-sm-down text-center">
                        <img src="<?php echo get_template_directory_uri() . '/img/sunmark.png'; ?>" alt="El Governor Motel" class="img img-fluid">
                    </div>
                    <div class="footer-contact-info col-md-4">
                        <p>Local: <a href="tel:<?php echo $localphone; ?>" ><?php echo $localphone; ?></a><br>
                           Toll-free: <a href="tel:<?php echo $phone; ?>" ><?php echo $phone; ?></a></p>
                        <p><?php echo $address; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div id="bot-bot">
            <div class="container">
                <div class="row no-gutters justify-content-center justify-content-lg-start align-items-middle">
                    <div class="col-md-3 my-auto text-center text-md-left">
                        <div class="social">
                            <span class="facebook-word-logo" >
                                <a class="facebook-footer-button" href="https://www.facebook.com/El-Governor-Motel-179580765407597/" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 433.27 83.89"><defs><style>.cls-1{fill:#fff;}</style></defs><title>Asset 1</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path id="_Path_" data-name="&lt;Path&gt;" class="cls-1" d="M33.9,13.15c-5.1,0-6.58,2.27-6.58,7.25v8.28H40.93L39.57,42.06H27.32V82.65H11V42.06H0V28.68H11v-8C11,7.14,16.44,0,31.63,0a77.18,77.18,0,0,1,9.52.56V13.15"/><path class="cls-1" d="M42.06,54c0-15.08,7.14-26.42,22.11-26.42,8.16,0,13.15,4.2,15.53,9.41V28.68H95.35v54H79.7V74.49c-2.27,5.21-7.37,9.29-15.53,9.29-15,0-22.11-11.33-22.11-26.41m16.33.23c0,8.05,3,13.37,10.54,13.37C75.62,71,79,66.09,79,58.39V52.94c0-7.71-3.4-12.59-10.09-12.59-7.59,0-10.54,5.33-10.54,13.38Z"/><path id="_Path_2" data-name="&lt;Path&gt;" class="cls-1" d="M129.35,27.54c6.35,0,12.36,1.36,15.64,3.63l-3.63,11.56a25.68,25.68,0,0,0-10.88-2.49c-8.85,0-12.7,5.1-12.7,13.83v3.17c0,8.73,3.85,13.83,12.7,13.83a25.68,25.68,0,0,0,10.88-2.49L145,80.15c-3.28,2.27-9.3,3.63-15.64,3.63-19.16,0-27.89-10.32-27.89-26.87V54.41c0-16.55,8.73-26.87,27.89-26.87"/><path class="cls-1" d="M147.15,57.7V52.94c0-15.3,8.73-25.4,26.53-25.4,16.78,0,24.14,10.21,24.14,25.17v8.61H163.47C163.81,68.7,167.1,72,176.17,72a46.47,46.47,0,0,0,17.35-3.28l2.94,11.22c-4.3,2.27-13.15,4-21,4-20.63,0-28.34-10.31-28.34-26.19m16.33-7H183.2V49.31c0-5.9-2.38-10.54-9.52-10.54-7.37,0-10.2,4.65-10.2,11.9"/><path class="cls-1" d="M258.36,57.36c0,15.08-7.25,26.42-22.22,26.42-8.16,0-13.83-4.08-16.1-9.3v8.16H204.63V1.58L221,.11V36.16c2.38-4.76,7.59-8.61,15.19-8.61,15,0,22.22,11.33,22.22,26.41M242,53.62c0-7.6-3-13.26-10.77-13.26-6.69,0-10.32,4.76-10.32,12.47v5.67C221,66.2,224.58,71,231.27,71,239.09,71,242,65.3,242,57.7Z"/><path class="cls-1" d="M263.8,57V54.3c0-15.53,8.84-26.76,26.87-26.76s26.87,11.23,26.87,26.76V57c0,15.54-8.85,26.76-26.87,26.76S263.8,72.56,263.8,57m37.41-3.85c0-7.14-3-12.81-10.54-12.81S280.13,46,280.13,53.17v5c0,7.14,2.94,12.81,10.54,12.81s10.54-5.67,10.54-12.81Z"/><path class="cls-1" d="M323,57V54.3c0-15.53,8.84-26.76,26.87-26.76s26.87,11.23,26.87,26.76V57c0,15.54-8.85,26.76-26.87,26.76S323,72.56,323,57m37.41-3.85c0-7.14-3-12.81-10.54-12.81S339.3,46,339.3,53.17v5c0,7.14,2.94,12.81,10.54,12.81s10.54-5.67,10.54-12.81Z"/><polyline id="_Path_3" data-name="&lt;Path&gt;" class="cls-1" points="399.15 54.41 415.25 28.68 432.6 28.68 415.7 55.32 433.27 82.64 415.94 82.64 399.15 56.23 399.15 82.64 382.83 82.64 382.83 1.58 399.15 0.11"/></g></g></svg>
                                </a>
                            </span><?php $socialLinks = getSocialLinks('svg','square');
                            if(is_array($socialLinks)) {
                                foreach ( $socialLinks as $socialId => $socialLink ) {
                                    if($socialId != 'facebook') {
	                                    echo '<a class="' . $socialId . '" href="' . $socialLink[0] . '" target="_blank" >' . $socialLink[1] . '</a>';
                                    }
                                }
                            }
                            ?></div>
                    </div>
                    <div class="col-md-6 my-auto mx-auto justify-content-center text-center">
                        <p class="copyright">&copy;<?php echo date('Y'); ?> El Governor Motel. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-3 my-auto justify-content-center justify-content-sm-end text-center text-sm-right">
                        <p class="siteby"><svg version="1.1" id="kma" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 12.5 8.7" style="enable-background:new 0 0 12.5 8.7;" xml:space="preserve">
                                <defs><style>.kma{fill:#b4be35;}</style></defs>
                                <path class="kma" d="M6.4,0.1c0,0,0.1,0.3,0.2,0.9c1,3,3,5.6,5.7,7.2l-0.1,0.5c0,0-0.4-0.2-1-0.4C7.7,7,3.7,7,0.2,8.5L0.1,8.1
                            c2.8-1.5,4.8-4.2,5.7-7.2C6,0.4,6.1,0.1,6.1,0.1H6.4L6.4,0.1z"/>
                        </svg> <a href="https://keriganmarketing.com">Site by KMA</a>.</p>
                    </div>
                </div>
            </div><!-- .container -->
        </div>
    </div>
</div><!-- #page -->

<?php wp_footer(); ?>

<script>

function stickFooter(){

    var body = $('body'),
        bodyHeight = body.height(),
        windowHeight = $(window).height(),
        selector = $('#sticky-footer');


    if ( bodyHeight < windowHeight ) {

        body.addClass("full");
        selector.addClass("stuck");
        selector.removeClass("unstuck");
    }else{

        body.removeClass("full");
        selector.removeClass("stuck");
        selector.addClass("unstuck");
    }

    //console.log(windowHeight);
    //console.log(bodyHeight);

}

$(window).scroll(function() {
    if ($(this).scrollTop() > 10){
        $('#top').addClass("smaller");
    }else{
        $('#top').removeClass("smaller");
    }
    //stickFooter();
});

$(window).load(function() {
    stickFooter();
});

</script>

</body>
</html>
