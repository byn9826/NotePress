<?php
    //get first 20 notes info to display in the list
	$args = [
		'post_type' => 'post', 
		'numberposts' => 20
	];
	$list = cleanListInfo( get_posts( $args ) );
?>
<script>
    //past data from php to js
    var list = <?= json_encode( $list ) ?>;
</script>
<?php wp_footer(); ?>