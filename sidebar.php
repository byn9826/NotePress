<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NotePress
 */
?>
<section id="wrapper">
	<aside id="aside">
	
	<div class="aside-title">
		<span>&#10136;</span>
		<h2>Notebooks</h2>
	</div>
	
	<div id="aside-note">
		<?php 
			$args = [
				'hide_empty' => 0
			];
			$categories = get_categories($args);
			//var_dump($categories);
			foreach ($categories as $c) {
				echo '<h3 id="' . $c-> cat_ID . '">' . $c -> name . '</h3>';
			}
		?>
	</div>
	
	<div class="aside-title">
		<span>&#10136;</span>
		<h2>Tags</h2>
	</div>
	
	<div id="aside-tag">
		<?php 
			$args = [
				'hide_empty' => 0
			];
			$tags = get_tags($args);
			foreach ($tags as $t) {
				echo '<h3 id="' . $t-> term_id . '">' . $t -> name . '</h3>';
			}
		?>
	</div>
	
</aside>
