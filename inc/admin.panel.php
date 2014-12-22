<?php
	$token = get_option( 'jwtwit_token' );
	$secret = get_option( 'jwtwit_secret' );
	$add_new_disabled = empty( $token ) || empty( $secret ) ? true : false;
	$add_new_link = true === $add_new_disabled ? '#' : JwTwit::generate_add_account_link();
?>

<div class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2><?php _e( 'JW Twit Options', 'jwtwit' ); ?></h2>
	<form method="post" action="options.php" class="jwtwit options_panel">

		<?php settings_fields( 'jw_twit' ); ?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="jwtwit_token"><?php _e( 'Access Token', 'jwtwit' ); ?></label></th>
				<td><input type="text" class="regular-text" name="jwtwit_token" id="jwtwit_token" value="<?php echo get_option( 'jwtwit_token' ); ?>"></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="jwtwit_secret"><?php _e( 'Secret', 'jwtwit' ); ?></label></th>
				<td><input type="password" class="regular-text" name="jwtwit_secret" id="jwtwit_secret" value="<?php echo get_option( 'jwtwit_secret' ); ?>"></td>
			</tr>
		</table>

		<p>
			<input type="submit" class="button button-primary" value="Submit" />
			<?php if( true === $add_new_disabled ): ?>
				<span class="notice"><?php _e( 'In order to add a new account, you will first need to input your token and secret.', 'jwtwit' ); ?></span>
			<?php else: ?>
				<a href="<?php echo $add_new_link; ?>" class="button button-secondary" <?php disabled( $add_new_disabled ); ?> >Test</a>
			<?php endif; ?>
		</p>

	</form>
</div>