<?php
/*
 * NotePress backend functions and definitions
 */

//load js and css dependencies for initial main page
function notepress_dependencies() {
	if ( !is_admin() ) {  
		wp_enqueue_style( 'notepressCss', get_stylesheet_uri() );
		wp_enqueue_script('jquery');
		if ( is_user_logged_in() ) {
			//fix layout height for logged in users
	    	wp_enqueue_style( 'userFixCss', get_template_directory_uri() . '/css/user-fix.css' );
	    }
	    wp_register_script( 'VueJs', get_template_directory_uri() . '/js/vue.js', [], '', true );  
	    wp_enqueue_script( 'VueJs' );  
	    wp_register_script( 'HelperJs', get_template_directory_uri() . '/js/helper.js', [ 'VueJs' ], '', true );  
	    wp_enqueue_script( 'HelperJs' );
	    wp_register_script( 
	    	'NotepressJs', 
	    	get_template_directory_uri() . '/js/notepress.js', 
	    	[ 'VueJs', 'HelperJs', 'jquery' ], 
	    	'', 
	    	true 
	    );  
	    wp_enqueue_script( 'NotepressJs' );
    }  
}
add_action( 'wp_enqueue_scripts', 'notepress_dependencies' );  

//Ajax client for list data
function listData() {
	if ($_POST[ 'np_action' ] === 'read') {
		$args = [
			'post_type' => 'post',
			'numberposts' => 20
		];
		echo json_encode( refineList( get_posts( $args ) ) );
	}
	exit();
}
add_action('wp_ajax_listData', 'listData');
add_action('wp_ajax_nopriv_listData', 'listData');

function refineList( $list ) {
	foreach( $list as $l ) {
		//get first image src if exist
		$l->post_image = preg_match( '/\<img.*\/\>/', $l->post_content, $image );
		if ( $l->post_image === 1 ) {
			preg_match( '/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i', $image[ 0 ], $l->post_image );
			$l->post_image = $l->post_image[ 1 ];
		}
		//remove all image tags in content
		$content = preg_replace('/\<img.*\/\>/', '', $l->post_content);
		//only return first 100 words
		$content = wp_trim_words( $content, 100 );
		$l->post_content = $content;
	}
	return $list;
}