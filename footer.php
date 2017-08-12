<?php
    //get first 20 notes info to display in the list
	$args = [
		'post_type' => 'post', 
		'numberposts' => 20
	];
	$list = get_posts( $args );
?>
<script type="text/javascript">
    //past data from php to js
    var listData = <?= json_encode( $list ) ?>;
</script>
<?php wp_footer(); ?>