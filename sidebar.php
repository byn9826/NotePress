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
	<div id="aside-note">
		<span>&#9886;</span>
		<h2>Notebooks</h2>
	</div>
	
	<?php 
    $args = ['hide_empty'=> 0];
  	$categories = get_categories($args);
		foreach ($categories as $c) {
			echo '<h3>' . $c -> name . '</h3>';
		}
?>
</aside>
