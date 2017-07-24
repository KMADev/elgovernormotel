<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package KMA_DEMO
 */

get_header();
if(!is_front_page()) {
	?>
    <div class="container">
        <div class="row">
        <div id="primary" class="content-area col-lg-8">
            <main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

            </main><!-- #main -->
        </div><!-- #primary -->
        <div class="secondary col-lg-4">
            <?php //Get Sidebat Info
            $weathersidebar = get_post_meta($post->ID, 'sidebar_include_weather', true );
            $beachcamsidebar = get_post_meta($post->ID, 'sidebar_include_beach_cam', true );
            $sidebartext = get_post_meta($post->ID, 'sidebar_custom_sidebar_text', true );
            ?>
            <?php if($weathersidebar){ ?>
            <div class="weather-module support">
		        <?php echo do_shortcode('[getweather days="3" format="mini" location="Mexico Beach, FL"]'); ?>
            </div>
            <?php } ?>
	        <?php if($beachcamsidebar){ ?>
            <div class="webcam-button-desktop text-center">
                <p class="tagline">All of our rooms<br><strong>face the gulf!</strong></p>
                <a class="cam-text" href="http://mexicobeach.com/mexico-beach/beach-cam/" target="_blank">Live Beach Cam <svg id="arrowsvg" data-name="arrowsvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.67 26.93"><defs><style>.cls-1{fill:#fff;fill-rule:evenodd;}</style></defs><path class="cls-1" d="M119.49,380.55l-7.9-13h-8.78l8.78,13-8.78,13.9h8.78Z" transform="translate(-102.82 -367.52)"/></svg></a>
            </div>
	        <?php } ?>
	        <?php if($sidebartext){ ?>
                <div class="sidebar-text support">
			        <?php echo apply_filters( 'the_content', $sidebartext); ?>
                </div>
	        <?php } ?>
        </div>
        </div>
    </div>
	<?php
}
//get_sidebar();
get_footer();
