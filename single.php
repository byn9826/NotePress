<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package NotePress
 */

get_header(); ?>

	<main id="single">
		<?php
		while ( have_posts() ) : the_post();
			the_title( '<h1>', '</h1>' );
		?>
		<div id="single-info">
			<h3>By <?php the_author() ?></h3>
			<h3>,  <?php the_time('F jS, Y') ?> </h3>
		</div>
		<article id="single-article">
			<?php 
				remove_filter( 'the_content', 'wpautop' );
				the_content();
			?>
		</article>
		<?php
		endwhile;
		?>
	</main>
	
<?php

get_footer();


/*
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	*/