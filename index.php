<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NotePress
 */

get_header(); 
get_sidebar(); ?>

	<main id="main">
		<?php
    	$args = [
				'category' => 1,
				'post_type' => 'post'
			];
    	$lists = get_posts( $args );
			//var_dump($lists);
			foreach ($lists as $l) {
				echo '<div class="main-list" >';
					echo '<h3>' . $l -> post_title . '</h3>';
					echo '<h5 class="main-list-date">' . substr($l -> post_date, 0, 10) . '</h5>';
					echo '<h4>' . wp_trim_words( $l-> post_content, 16, ' ...' ) . '</h4>';
				echo '</div>';
			}
			
		?> 
	</main>

	<aside id="one">
		<?php
		$args = [ 
			'category' => 1,
			'numberposts' => 1,
			'post_type' => 'post'
		];
		$recent = wp_get_recent_posts($args);
		
		$categories = wp_get_post_categories($recent[0]['ID']);
		$tags = wp_get_post_tags($recent[0]['ID']);
		//var_dump($recent);
		echo '<h1>' . $recent[0]['post_title'] . '</h1>';
		
		foreach ($categories as $c) {
			$note = get_category($c);
    	echo '<h5 class="one-book">' . $note -> name . '</h5>';
		}
		
		foreach ($tags as $t) {
    	echo '<h5 class="one-tag">' . $t -> name . '</h5>';
		}
		
		echo '<h5 id="one-time">' . substr($recent[0][post_date], 0, 10) . '</h5>';
		echo '<article id="one-content">' . $recent[0][post_content] . '</article>';
			
		?>
		
	</aside>

<?php

get_footer();