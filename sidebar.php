<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NotePress
 */
?>

<aside id="aside">
	
	<div class="aside-title">
		<span>&#10136;</span>
		<h2>Notebooks</h2>
	</div>
	
	<div id="aside-note">
		<?php 
			$args = [
				'hide_empty' => 0,
				'order' => 'DESC'
			];
			$categories = get_categories($args);
			foreach ($categories as $c) {
				echo '<h3>' . $c -> name . '</h3>';
			}
		?>
	</div>
	
	<div class="aside-title">
		<span>&#10137;</span>
		<h2>Tags</h2>
	</div>
	
	<div id="aside-tag">
		<?php 
			$args = [
				'hide_empty' => 0,
				'order' => 'DESC'
			];
			$tags = get_tags($args);
			foreach ($tags as $t) {
				echo '<h3>' . $t -> name . '</h3>';
			}
		?>
	</div>
	
</aside>
