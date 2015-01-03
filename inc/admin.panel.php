<?php
	$token = get_option( 'jwtwit_key' );
	$secret = get_option( 'jwtwit_secret' );
	$add_new_disabled = empty( $token ) || empty( $secret ) ? true : false;
	$add_new_link = true === $add_new_disabled ? '#' : JwTwit::generate_add_account_link();

	$class = true == $add_new_disabled ? '' : 'hidden';
?>

<div class="wrap jwtwit">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2><?php _e( 'JW Twit Options', 'jwtwit' ); ?></h2>
	<form method="post" action="options.php" class="jwtwit options_panel">

		<?php settings_fields( 'jw_twit' ); ?>

		<table class="form-table jwtwit-general">
			<tr valign="top" class='<?php echo $class; ?>'>
				<th scope="row"><label for="jwtwit_key"><?php _e( 'Access Token', 'jwtwit' ); ?></label></th>
				<td><input type="text" class="regular-text" name="jwtwit_key" id="jwtwit_key" value="<?php echo get_option( 'jwtwit_key' ); ?>"></td>
			</tr>
			<tr valign="top" class='<?php echo $class; ?>'>
				<th scope="row"><label for="jwtwit_secret"><?php _e( 'Secret', 'jwtwit' ); ?></label></th>
				<td><input type="password" class="regular-text" name="jwtwit_secret" id="jwtwit_secret" value="<?php echo get_option( 'jwtwit_secret' ); ?>"></td>
			</tr>
		</table>

		<p>
			<input type="submit" class="button button-primary" value="Submit" class='<?php echo $class; ?>' />
			<?php if ( true === $add_new_disabled ): ?>
				<span class="notice"><?php _e( 'In order to add a new account, you will first need to input your token and secret.', 'jwtwit' ); ?></span>
			<?php else : ?>
				<a href="<?php echo $add_new_link; ?>" class="button button-secondary" <?php disabled( $add_new_disabled ); ?> ><?php _e( 'Add an Account', 'jwtwit' ); ?></a>
				<a href="#" class="button button-secondary edit-twitter-data" <?php disabled( $add_new_disabled ); ?> ><?php _e( 'Edit App Data', 'jwtwit' ); ?></a>
			<?php endif; ?>

		</p>

		<table class="widefat formtable">
			<thead>
				<tr>
					<th>Testing</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Test</td>
				</tr>
			</tbody>
		</table>
	</form>

	<pre>
		<?php
			if ( isset( $_REQUEST ) ){
				print_r( $_REQUEST );
			}
		?>
	</pre>
</div>