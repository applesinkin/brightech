<?php
/**
 * Show and set site options
 *
 * @package brightech
 */


/**
 * Create Options Page
 */

function _action_bt_register_options_page() {
	add_menu_page( 'Site options', 'Site options', 'manage_options', 'bt-site-options', 'bt_site_options_callback' ); 
}
add_action('admin_menu', '_action_bt_register_options_page');

function bt_site_options_callback() { 
?>
	<div class="wrap">
		<h2><?php echo get_admin_page_title(); ?></h2>
	</div>

	<form action="options.php" method="POST">
		<?php
			settings_fields( 'bt_option_group' );
			do_settings_sections( 'bt_contact_info' );
			submit_button();
		?>
	</form>
<?php
}


/**
 * Set Options
 */

add_action('admin_init', '_action_bt_site_settings');
function _action_bt_site_settings(){

	// register settings
	register_setting( 'bt_option_group', 'bt_contact_address', 'sanitize_textarea_callback' );
	register_setting( 'bt_option_group', 'bt_contact_phone', 'sanitize_link_callback' );
	register_setting( 'bt_option_group', 'bt_support_info', 'sanitize_textarea_callback' );
	register_setting( 'bt_option_group', 'bt_support_phone', 'sanitize_link_callback' );
	register_setting( 'bt_option_group', 'bt_contact_email', 'sanitize_link_callback' );
	register_setting( 'bt_option_group', 'bt_contact_message', 'sanitize_link_callback' );
	register_setting( 'bt_option_group', 'bt_contact_form', 'sanitize_link_callback' );

	// add sections
	add_settings_section( 'section_bt_contact_info', 'Contact Info', '', 'bt_contact_info' ); 
	add_settings_section( 'section_bt_support_info', 'Support Info', '', 'bt_contact_info' ); 
	add_settings_section( 'section_bt_contact_email', 'Email', '', 'bt_contact_info' ); 
	add_settings_section( 'section_bt_contact_message', 'Send Message To', '', 'bt_contact_info' ); 
	add_settings_section( 'section_bt_contact_form', 'Contact Form Link', '', 'bt_contact_info' ); 

	// add contact fields
	add_settings_field('bt_contact_address', 'Contact Address', 'show_bt_contact_address_html', 'bt_contact_info', 'section_bt_contact_info' );
	add_settings_field('bt_contact_phone_link', 'Contact Phone Link', 'show_bt_contact_phone_link_html', 'bt_contact_info', 'section_bt_contact_info' );
	add_settings_field('bt_contact_phone_text', 'Contact Phone Label', 'show_bt_contact_phone_text_html', 'bt_contact_info', 'section_bt_contact_info' );
	
	// add support fields
	add_settings_field('bt_support_address', 'Support Info', 'show_bt_support_info_html', 'bt_contact_info', 'section_bt_support_info' );
	add_settings_field('bt_support_phone_link', 'Contact Phone Link', 'show_bt_support_phone_link_html', 'bt_contact_info', 'section_bt_support_info' );
	add_settings_field('bt_support_phone_text', 'Contact Phone Label', 'show_bt_support_phone_text_html', 'bt_contact_info', 'section_bt_support_info' );
	
	// add contact email fields
	add_settings_field('bt_contact_email_title', 'Title', 'show_bt_contact_email_title_html', 'bt_contact_info', 'section_bt_contact_email' );
	add_settings_field('bt_contact_email_link', 'Email', 'show_bt_contact_email_link_html', 'bt_contact_info', 'section_bt_contact_email' );
	add_settings_field('bt_contact_email_text', 'Label', 'show_bt_contact_email_text_html', 'bt_contact_info', 'section_bt_contact_email' );

	// add contact message fields
	add_settings_field('bt_contact_message_title', 'Title', 'show_bt_contact_message_title_html', 'bt_contact_info', 'section_bt_contact_message' );
	add_settings_field('bt_contact_message_link', 'Link', 'show_bt_contact_message_link_html', 'bt_contact_info', 'section_bt_contact_message' );
	add_settings_field('bt_contact_message_text', 'Label', 'show_bt_contact_message_text_html', 'bt_contact_info', 'section_bt_contact_message' );

	// add contact message fields
	add_settings_field('bt_contact_form_title', 'Title', 'show_bt_contact_form_title_html', 'bt_contact_info', 'section_bt_contact_form' );
	add_settings_field('bt_contact_form_link', 'Link', 'show_bt_contact_form_link_html', 'bt_contact_info', 'section_bt_contact_form' );
	add_settings_field('bt_contact_form_text', 'Label', 'show_bt_contact_form_text_html', 'bt_contact_info', 'section_bt_contact_form' );
}


/**
 * Options HTML
 */

// contact address
function show_bt_contact_address_html() {
?>
	<textarea 
		type="text"
		class="regular-text code"
		name="bt_contact_address" 
		row="4"><?php echo esc_attr( get_option('bt_contact_address') ) ?></textarea>
<?php
}

// contact phone
function show_bt_contact_phone_link_html() {
	$value = get_option('bt_contact_phone');
	$value = $value ? $value['link'] : null;
?>
	<input 
		type="tel"
		class="regular-text"
		pattern="(\+?\d[- .]*){7,13}"
		name="bt_contact_phone[link]" 
		value="<?php echo esc_attr( $value ) ?>" />
<?php
}
function show_bt_contact_phone_text_html() {
	$value = get_option('bt_contact_phone');
	$value = $value ? $value['text'] : null;
?>
	<input 
		type="text"
		class="regular-text"
		name="bt_contact_phone[text]"
		value="<?php echo esc_attr( $value ) ?>" />
<?php
}

// support info
function show_bt_support_info_html() {
?>
	<textarea 
		type="text"
		class="regular-text code"
		name="bt_support_info" 
		row="4"><?php echo esc_attr( get_option('bt_support_info') ) ?></textarea>
<?php
}

// support phone
function show_bt_support_phone_link_html() {
	$value = get_option('bt_support_phone');
	$value = $value ? $value['link'] : null;
?>
	<input 
		type="tel"
		class="regular-text"
		pattern="(\+?\d[- .]*){7,13}"
		name="bt_support_phone[link]" 
		value="<?php echo esc_attr( $value ) ?>" />
<?php
}
function show_bt_support_phone_text_html() {
	$value = get_option('bt_support_phone');
	$value = $value ? $value['text'] : null;
?>
	<input 
		type="text"
		class="regular-text"
		name="bt_support_phone[text]"
		value="<?php echo esc_attr( $value ) ?>" />
<?php
}

// contact email
function show_bt_contact_email_title_html() {
	$value = get_option('bt_contact_email');
	$value = $value ? $value['title'] : null;
?>
	<input 
		type="text"
		class="regular-text"
		name="bt_contact_email[title]" 
		value="<?php echo esc_attr( $value ) ?>" />
<?php
}

function show_bt_contact_email_link_html() {
	$value = get_option('bt_contact_email');
	$value = $value ? $value['email'] : null;
?>
	<input 
		type="email"
		class="regular-text"
		name="bt_contact_email[email]" 
		value="<?php echo esc_attr( $value ) ?>" />
<?php
}

function show_bt_contact_email_text_html() {
	$value = get_option('bt_contact_email');
	$value = $value ? $value['text'] : null;
?>
	<input 
		type="text"
		class="regular-text"
		name="bt_contact_email[text]"
		value="<?php echo esc_attr( $value ) ?>" />
<?php
}

// contact message
function show_bt_contact_message_title_html() {
	$value = get_option('bt_contact_message');
	$value = $value ? $value['title'] : null;
?>
	<input 
		type="text"
		class="regular-text"
		name="bt_contact_message[title]" 
		value="<?php echo esc_attr( $value ) ?>" />
<?php
}

function show_bt_contact_message_link_html() {
	$value = get_option('bt_contact_message');
	$value = $value ? $value['link'] : null;
?>
	<input 
		type="text"
		class="regular-text"
		name="bt_contact_message[link]" 
		value="<?php echo esc_attr( $value ) ?>" />
<?php
}
function show_bt_contact_message_text_html() {
	$value = get_option('bt_contact_message');
	$value = $value ? $value['text'] : null;
?>
	<input 
		type="text"
		class="regular-text"
		name="bt_contact_message[text]"
		value="<?php echo esc_attr( $value ) ?>" />
<?php
}

// contact form
function show_bt_contact_form_title_html() {
	$value = get_option('bt_contact_form');
	$value = $value ? $value['title'] : null;
?>
	<input 
		type="text"
		class="regular-text"
		name="bt_contact_form[title]" 
		value="<?php echo esc_attr( $value ) ?>" />
<?php
}
function show_bt_contact_form_link_html() {
	$value = get_option('bt_contact_form');
	$value = $value ? $value['link'] : null;
?>
	<input 
		type="text"
		class="regular-text"
		name="bt_contact_form[link]" 
		value="<?php echo esc_attr( $value ) ?>" />
<?php
}
function show_bt_contact_form_text_html() {
	$value = get_option('bt_contact_form');
	$value = $value ? $value['text'] : null;
?>
	<input 
		type="text"
		class="regular-text"
		name="bt_contact_form[text]"
		value="<?php echo esc_attr( $value ) ?>" />
<?php
}


/**
 * Sanitize callbacks
 */

// Sanitize textarea fiels
function sanitize_textarea_callback( $option ) {
	return sanitize_textarea_field( $option );
}

// Sanitize text fiels
function sanitize_text_callback( $option ) {
	return sanitize_text_field( $option );
}

// Sanitize link fields
function sanitize_link_callback( $options ) {
	foreach( $options as $name => &$val ) {
		switch ($name) {
			case 'email':
				$val = sanitize_email( $val );
				break;
			
			case 'link':
				$val = strip_tags( $val );
				break;
			
			default:
				$val = sanitize_text_field( $val );
				break;
		}
	}
	return $options;
}