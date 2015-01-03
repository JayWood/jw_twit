<?php
	$paged = get_query_var( 'paged' );
	$ppp = isset( $_GET['ppp'] ) ? intval( $_GET['ppp'] ) : 50;

	$tweet_posts_args = array(
		'post_type'      => 'jwtwit_tweets',
		'paged'          => ! empty( $paged ) ? $paged : '1',
		'post_status'    => 'any',
		'posts_per_page' => $ppp,
	);

	$tweet_posts = get_posts( $tweet_post_args );
?>
<div class="wrap jwtwit">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2><?php _e( sprintf( '%s Log', 'JW Twit' ), 'jwtwit' ); ?></h2>
	<form method="post" action="options.php" class="jwtwit options_panel">

	<?php

	?>
		
	</form>
	<?php JWTwit::display_debug(); ?>
</div>