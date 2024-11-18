<?php

//*********Instead of @import Use enqueue ad recommended by WordPress Codex **********/

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
 
    $parent_style = 'parent-style'; // This is 'twentytwenty-style' for the Twenty Twenty theme.
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
 function mychildtheme_widget_init() {
	
	register_sidebar( array(
		'name'=> 'My new Widget Area',
		'id' => 'my_new_widget_area',
		'before_widget' => '<aside>',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	
	));
}

add_action( 'widgets_init','mychildtheme_widget_init');
// Custom function to display word count in blog posts
function add_word_count_to_content( $content ) {
    if ( is_singular( 'post' ) && in_the_loop() && is_main_query() ) {
        $word_count = str_word_count( strip_tags( $content ) );
        $content .= '<p><strong>Word Count:</strong> ' . $word_count . ' words</p>';
    }
    return $content;
}
add_filter( 'the_content', 'add_word_count_to_content' );