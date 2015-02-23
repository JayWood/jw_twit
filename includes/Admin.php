<?php

class Jw_Twit_Admin {

	private $key = '';
	private $metabox_id = '';
	protected $title = '';
	protected $options_page = '';

	public function __construct( $key ){

		$this->key = $key . '-options';
		$this->metabox_id = $this->key . '-metabox';
		$this->title = __( 'Twitter Config', 'jwtwit' );

		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'cmb2_init', array( $this, 'cmb2_init' ) );
		add_action( 'cmb2_render_text_password', array( $this, 'cmb2_password_field' ), 10, 5 );
		add_filter( 'cmb2_sanitize_text_small', array( $this, 'validate_tweet_frequency' ), 10, 4 );
	}

	public function init(){
		register_setting( $this->key, $this->key );
	}

	public function admin_menu(){

		$this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );
	}

	public function admin_page_display() {
		?>
		<div class="wrap cmb2_options_page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>
	<?php
	}

	function cmb2_init() {
		$prefix = 'jw_';

		$cmb = new_cmb2_box( array(
			'id'      => $this->metabox_id,
			'hookup'  => false,
			'show_on' => array(
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		// Set our CMB2 fields
		$cmb->add_field( array(
			'name' => __( 'API Key', 'jwtwit' ),
			'id'   => $prefix . 'api_key',
			'type' => 'text',
		) );

		$cmb->add_field( array(
			'name' => __( 'API Secret', 'jwtwit' ),
			'id'   => $prefix . 'api_secret',
			'type' => 'text_password',
		) );

		$cmb->add_field( array(
			'name' => __( 'Users', 'jwtwit' ),
			'type' => 'checkbox',
			'desc' => __( 'Allow other users to add their twitter accounts to their profile.', 'jwtwit' ),
			'id'   => $prefix . 'allow_users',
		) );

		$cmb->add_field( array(
			'name'    => ' ',
			'type'    => 'select',
			'desc'    => __( 'Select the minimum user-level required to add their Twitter account to their profile.', 'jwtwit' ),
			'id'      => $prefix . 'user-level',
			'options' => array(
				'contributor' => __( 'Contributor', 'jwtwit' ),
				'author'      => __( 'Author', 'jwtwit' ),
				'editor'      => __( 'Editor', 'jwtwit' ),
			),
		) );

		$cmb->add_field( array(
			'name'    => __( 'Repeat Times', 'jwtwit' ),
			'id'      => $prefix . 'repeat',
			'desc'    => __( 'Number of times to repeat a tweet.', 'jwtwit' ),
			'type'    => 'select',
			'options' => array(
				'1' => __( 'Once', 'jwtwit' ),
				'2' => __( 'Twice', 'jwtwit' ),
				'3' => __( 'Three Times ( the charm )', 'jwtwit' ),
				'4' => __( 'Four Times', 'jwtwit' ),
				'5' => __( 'Five Times', 'jwtwit' ),
			),
		) );

		$cmb->add_field( array(
			'name'    => __( 'Repeat Frequency', 'jwtwit' ),
			'id'      => $prefix . 'frequency',
			'desc'    => __( 'The amount of time between tweets ( in minutes ), cannot be lower than 20.', 'jwtwit' ),
			'type'    => 'text_small',
			'default' => '20',
		) );
	}

	public function cmb2_password_field( $field, $escaped_value, $obj_id, $obj_type, $fto ){
		echo $fto->input( array( 'type' => 'password' ) );
	}

	public function validate_tweet_frequency( $null, $value, $obj_id, $args ){
		$default = isset( $args['default'] ) ? $args['default'] : 20;
		if ( ! is_numeric( $value ) || 20 > $value ){
			return $default;
		}
	}

	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'fields', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}
		throw new Exception( 'Invalid property: ' . $field );
	}
}

