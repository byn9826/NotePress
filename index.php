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
					echo '<h4>' . wp_trim_words( $l->post_content, 16, ' ...' ) . '</h4>';
				echo '</div>';
			}
			
		?> 
	</main>

	<aside id="one">
	</aside>

<?php

get_footer();




		/*
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			/*
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
		/*
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; 
		*/
		?>
