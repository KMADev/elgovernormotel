<?php
/**
 * Created by PhpStorm.
 * Enable WordPress Sidebars
 */

if ( ! defined( 'ABSPATH' ) ) exit; //To protect from absolute linkage

function kdemo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'kdemo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'kdemo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'kdemo_widgets_init' );

// Add theme support for selective refresh for widgets.
add_theme_support( 'customize-selective-refresh-widgets' );