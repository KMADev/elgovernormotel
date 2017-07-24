<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KMA_DEMO
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php
$phone = get_field('phone', 5);
$localphone = get_field('local_phone', 5);
?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'kdemo'); ?></a>

    <div id="top-top" class="hidden-lg-up align-items-center justify-content-center">
        <div class="fluid-container">
            <div class="book-now">
                <a class="book-now-cta text-center" href="tel:<? echo preg_replace('/[()-]/','', $localphone ); ?>">
                    Book Now: <? echo $localphone ?>
                </a>
            </div>
        </div>
    </div>
    <div id="top">
        <header id="masthead" class="site-header">
            <div class="container-fluid">
                <div class="row justify-content-center align-items-middle no-gutters">
                    <div class="col-12 col-md-3 my-auto text-center">
                        <a href="/" class="navbar-brand"><img src="<?php echo get_template_directory_uri() . '/img/logo.png'; ?>" alt="El Governor Logo" class="img img-fluid"></a>
                    </div>
                    <div class="main-menu hidden-lg-down col my-auto text-center" >
                        <div class="navbar" >
                            <?php wp_nav_menu(
                                array(
                                    'theme_location'  => 'menu-1',
                                    'container_class' => 'navbar-static',
                                    'container_id'    => 'navbarNavMain',
                                    'menu_class'      => 'navbar-nav justify-content-end',
                                    'fallback_cb'     => '',
                                    'menu_id'         => 'menu-1',
                                    'walker'          => new WP_Bootstrap_Navwalker(),
                                )
                            ); ?>
                        </div>

                    </div>
                    <div class="main-buttons col-12 col-md-8 col-lg-6 hidden-xl-up my-auto text-center" >
                        <a class="btn btn-white" href="/rooms/">Rooms</a>
                        <a class="btn btn-white" href="/rv-park/">RV Park</a>
                        <button class="navbar-toggler btn btn-white text-center col-12 col-md-3" type="button" data-toggle="collapse" data-target="#navbar-header">
                                <span class="icon-box">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </span> FULL MENU
                        </button>
                    </div>
                    <div class="phone-button-col hidden-md-down col-md-3 col-lg-2 col-xl-1 my-auto" >
                        <span class="phone-button btn btn-yellow">Book Now: <? echo $localphone ?></span>
                    </div>
                </div>
                <div class="main-menu hidden-xl-up" >
                    <div class="navbar-collapse navbar-toggleable-lg justify-content-end" id="navbar-header" >
                        <?php wp_nav_menu(
                            array(
                                'theme_location'  => 'menu-3',
                                'container_class' => 'navbar-static',
                                'container_id'    => 'navbarNavMobile',
                                'menu_class'      => 'navbar-nav justify-content-end',
                                'fallback_cb'     => '',
                                'menu_id'         => 'menu-3',
                                'walker'          => new WP_Bootstrap_Navwalker(),
                            )
                        ); ?>
                    </div>
                </div>
            </div>
            <?php if(is_front_page()){ ?>
            <div class="hidden-md-up">
                <div class="webcam-button-phone text-center">
                    <div class="row align-items-middle no-gutters">
                        <div class="col-7">
                            <p class="tagline">All of our rooms <strong>face the gulf!</strong></p>
                        </div>
                        <div class="col-5">
                            <a class="cam-text" href="http://mexicobeach.com/mexico-beach/beach-cam/" target="_blank">Live Beach Cam <svg data-name="arrowsvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.67 26.93"><defs><style>.cls-1{fill:#fff;fill-rule:evenodd;}</style></defs><path class="cls-1" d="M119.49,380.55l-7.9-13h-8.78l8.78,13-8.78,13.9h8.78Z" transform="translate(-102.82 -367.52)"/></svg></a>
                        </div>
                    </div>
                </div>
                <div class="weather-module">
		            <?php echo do_shortcode('[getweather days="3" format="mini" location="Mexico Beach, FL"]'); ?>
                </div>
                <div class="mobile-slider">
	                <?php echo do_shortcode('[getslider id="mobile-slider"]'); ?>
                </div>
            </div>
            <div class="hidden-sm-down">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <?php echo do_shortcode('[getslider id="home-slider"]'); ?>
                        </div>
                        <div class="col-lg-4 weather-module">
                            <?php echo do_shortcode('[getweather days="3" format="mini" location="Mexico Beach, FL"]'); ?>
                            <div class="webcam-button-desktop text-center">
                                <p class="tagline">All of our rooms<br><strong>face the gulf!</strong></p>
                                <a class="cam-text" href="http://mexicobeach.com/mexico-beach/beach-cam/" target="_blank">Live Beach Cam <svg data-name="arrowsvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.67 26.93"><defs><style>.cls-1{fill:#fff;fill-rule:evenodd;}</style></defs><path class="cls-1" d="M119.49,380.55l-7.9-13h-8.78l8.78,13-8.78,13.9h8.78Z" transform="translate(-102.82 -367.52)"/></svg></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="email-signup" >
                <div class="container">
                    <div class="row justify-content-center align-items-middle no-gutters">
                        <div class="col-md-6 col-lg-8 text-center">
	                        <?php

	                        function assemble_error_codes($error_lists_string, $error_codes_string) {
		                        $legend = array (
			                        '0'       => "Unknown error. Please resubmit the subscription form.",
			                        '1'       => "Sorry, but we're at our maximum number of subscribers. Try again later.",
			                        '2'       => "You must have missed a required field. Please try again.",
			                        '3'       => "Thanks, but you're already on our list.",
			                        '4'       => "This e-mail address has been processed in the past to be subscribed, however your subscription was never confirmed.",
			                        '5'       => "This e-mail address cannot be added to list.",
			                        '6'       => "Got it. Please check your email to confirm your subscription.",
			                        '7'       => "Got it. Thanks for subscribing!",
			                        '8'       => "E-mail address is invalid.",
			                        '9'       => "Subscription could not be processed since you did not select a list. Please select a list and try again.",
			                        '10'      => "This e-mail address has been processed. Please check your email to confirm your unsubscription.",
			                        '11'      => "This e-mail address has been unsubscribed from the list.",
			                        '12'      => "This e-mail address was not subscribed to the list.",
			                        '13'      => "Thank you for confirming your subscription.",
			                        '14'      => "Thank you for confirming your unsubscription.",
			                        '15'      => "Your changes have been saved.",
			                        '16'      => "Your subscription request for this list could not be processed as you must type your name.",
			                        '17'      => "This e-mail address is on the global exclusion list.",
			                        '18'      => "Please type the correct text that appears in the image.",
			                        '19'      => "Subscriber ID is invalid.",
			                        '20'      => "You are unable to be added to this list at this time.",
			                        '21'      => "Thanks, but you're already on our list!<br>Would you like to add another?",
			                        '22'      => "This e-mail address could not be unsubscribed.",
			                        '23'      => "This subscriber does not exist.",
			                        '24'      => "The link to modify your account has been sent. Please check your email.",
			                        '25'      => "The image text you typed did not register. Please go back, reload the page, and try again.",
		                        );

		                        $error_lists = explode(',', $error_lists_string);
		                        $error_codes = explode(',', $error_codes_string);

		                        $message = "";

		                        foreach ( $error_lists as $k => $listid ) {
			                        $code = ( isset($error_codes[$k]) ? (int)$error_codes[$k] : 0 );
			                        if ( isset($legend[$code]) ) {
				                        $message .= ' <h3>'.$legend[$code] . '</h3>';
			                        }
		                        }

		                        return $message;
	                        }

	                        if ( isset($_GET['lists']) && isset($_GET['codes']) ){
		                        echo assemble_error_codes($_GET['lists'], $_GET['codes']);
	                        }else{ ?>
                                <h3><strong>Be the first to know.</strong> Sign up for updates & specials</h3>
	                        <?php } ?>
                        </div>
                        <div class="col-md-6 col-lg-4 text-center">
                            <form class="form form-inline" method="post" action="http://kmailer.kerigan.com/box.php">
                                <div class="form-group mx-auto">
                                    <input type="text" class="email-signup-field form-control" name="email" placeholder="Enter your email" ><input type="submit" class="btn btn-yellow email-signup-button" value="Sign up" >
                                </div>
                                <input type="hidden" name="field[]" /><input type="hidden" name="nlbox[]" value="20" /><input type="hidden" name="funcml" value="add" /><input type="hidden" name="p" value="1012" /><input type="hidden" name="_charset" value="utf-8" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <? }else{ ?>
                <?php if(is_page(20)){ ?>
                    <div class="support-mast">
                        <div class="container">

                            <script type="text/javascript">
                                // When the window has finished loading create our google map below
                                //google.maps.event.addDomListener(window, 'load', initMap);

                                function initMap() {
                                    // Basic options for a simple Google Map
                                    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                                    var mapOptions = {
                                        // How zoomed in you want the map to start at (always required)
                                        zoom: 7,

                                        // The latitude and longitude to center the map (always required)
                                        center: new google.maps.LatLng(31.142969, -85.403456), // Mexico Beach
                                        disableDefaultUI: true,
                                        // How you would like to style the map.
                                        // This is where you would paste any style found on Snazzy Maps.
                                        styles: [
                                            {
                                                "featureType": "poi",
                                                "elementType": "labels",
                                                "stylers": [
                                                    {
                                                        "visibility": "off"
                                                    }
                                                ]
                                            },
                                            {
                                                "featureType": "poi.park",
                                                "elementType": "all",
                                                "stylers": [
                                                    {
                                                        "visibility": "off"
                                                    },
                                                    {
                                                        "color": "#e8e1a5"
                                                    }
                                                ]
                                            },
                                            {
                                                "featureType": "road",
                                                "elementType": "labels",
                                                "stylers": [
                                                    {
                                                        "visibility": "off"
                                                    }
                                                ]
                                            },
                                            {
                                                "featureType": "transit",
                                                "elementType": "labels.text",
                                                "stylers": [
                                                    {
                                                        "visibility": "off"
                                                    }
                                                ]
                                            },
                                            {
                                                "featureType": "water",
                                                "elementType": "all",
                                                "stylers": [
                                                    {
                                                        "color": "#94d5d6"
                                                    }
                                                ]
                                            }
                                        ]
                                    };

                                    // Get the HTML DOM element that will contain your map
                                    // We are using a div with id="map" seen below in the <body>
                                    var mapElement = document.getElementById('map');

                                    // Create the Google Map using our element and options defined above
                                    var map = new google.maps.Map(mapElement, mapOptions);

                                    // Let's also add a marker while we're at it
                                    var marker = new google.maps.Marker({
                                        position: new google.maps.LatLng(29.941566, -85.409354),
                                        map: map,
                                        title: 'El Governor Motel'
                                    });
                                }
                            </script>
                            <div id="map" class="header-image-container"></div>
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRXeRhZCIYcKhtc-rfHCejAJsEW9rYtt4&callback=initMap" async defer></script>
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="support-mast">
                        <div class="container">
                            <div class="header-image-container">
                            <?php $headerurl = get_post_meta($post->ID,'page_information_header_image',true); ?>
                            <img src="<?php echo $headerurl; ?>" alt="<?php echo $post->title; ?>" class="img-fluid" >
                            </div>
                        </div>
                    </div>
	            <?php }?>
            <?php }?>
        </header>
    </div>

    <div id="content" class="site-content">
        <div id="mid">
