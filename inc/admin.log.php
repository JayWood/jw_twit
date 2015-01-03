<?php
	$token = get_option( 'jwtwit_key' );
	$secret = get_option( 'jwtwit_secret' );
	$add_new_disabled = empty( $token ) || empty( $secret ) ? true : false;
	$add_new_link = true === $add_new_disabled ? '#' : JwTwit::generate_add_account_link();
	$date_format = get_option( 'date_format' );
	$time_format = get_option( 'time_format' );

	$class = true == $add_new_disabled ? '' : 'hidden';
?>

<div class="wrap jwtwit">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2><?php _e( sprintf( '%s Log', 'JW Twit' ), 'jwtwit' ); ?></h2>
	<form method="post" action="options.php" class="jwtwit options_panel">

		
	</form>

	<pre>
		<?php
			if ( isset( $_REQUEST ) ){
				print_r( $_REQUEST );
			}
		?>
	</pre>
</div>