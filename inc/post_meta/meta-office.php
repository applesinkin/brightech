<?php
/**
 * Add and save custom fields to "Office" post template
 *
 * @package brightech
 */


/*
 * Add Custom Fields
 */

function _action_bt_office_postmeta() {
	add_meta_box( 
		'brightech_page_contacts_meta',
		__('Office options', 'brightech'),
		'bt_office_postmeta_callback',
		'office',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', '_action_bt_office_postmeta');


/* 
 * Show Custom Fields HTML
 */

function bt_office_postmeta_callback( $post ) {
?>
	
	<fieldset>
		<!-- contact info: Address -->
		<p>
			<label for="bt_office_label">
				<b><?php _e('Label', 'brightech'); ?></b>
			</label>
		</p>
		<p>
			<input 
				type="text"
				name="bt_office_meta[bt_office_label]" 
				id="bt_office_label" style="width:50%"
				value="<?php echo get_post_meta($post->ID, 'bt_office_label', 1); ?>" />
		</p>

		<!-- contact info: Coords -->
		<br>
		<hr>
		<p>
			<label for="bt_office_lat">
				<b><?php _e('Coordinates', 'brightech'); ?></b>
			</label>
		</p>
		<table style="width:50%">
			<thead>
				<tr>
					<td style="width: 50%"><label for="bt_office_lat">Latitude</label></td>
					<td style="width: 50%"><label for="bt_office_lng">Longitude</label></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<input 
							type="text"
							name="bt_office_meta[bt_office_lat]" 
							id="bt_office_lat" style="width: 100%"
							value="<?php echo get_post_meta($post->ID, 'bt_office_lat', 1); ?>" />
					</td>
					<td>
						<input 
							type="text"
							name="bt_office_meta[bt_office_lng]" 
							id="bt_office_lng" style="width: 100%"
							value="<?php echo get_post_meta($post->ID, 'bt_office_lng', 1); ?>" />
					</td>
				</tr>
			</tbody>
		</table>

	</fieldset>

	<input type="hidden" name="bt_office_postmeta_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
<?php 
}


/*
 * Save Custom Fields
 */

function _action_brightech_page_contacts_meta_update( $post_id ) {

	if ( 
		empty( $_POST['bt_office_meta'] )
		|| ! wp_verify_nonce( $_POST['bt_office_postmeta_nonce'], __FILE__ )
		|| wp_is_post_autosave( $post_id )
		|| wp_is_post_revision( $post_id )
		|| ! current_user_can( 'edit_post', $post_id )
	) return;

	foreach( $_POST['bt_office_meta'] as $key => $value ) {

		switch ($key) {
			
			case 'bt_test':
				break;
			
			default:
				$value = sanitize_text_field($value);
				break;
		}

		if ( empty($value) ) {
			delete_post_meta( $post_id, $key );
			continue;
		}
		update_post_meta( $post_id, $key, $value );
	}

	return $post_id;
}
add_action( 'save_post', '_action_brightech_page_contacts_meta_update' );