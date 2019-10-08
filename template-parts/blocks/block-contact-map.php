<?php
/**
 * Template part for displaying "Contact Map" block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brightech
 */

?>

<?php 
	$offices = get_posts( array(
		'post_type' => 'office',
		'number' => -1
	) );
?>

<?php 
	if ( !$offices || !sizeof($offices) ) 
		return; 
?>
	

<section class="page-block page-block--contact-map">
	<div class="block-contact-map">
		<div class="site__width">
			<div class="cols">
				<div class="cols__col cols__col--md-1-2">
					<div class="block-contact-map__info">
						<h2>Our Offices</h2>
						<div class="js-tabs tabs">
							<ul class="tabs__filters">
								<?php foreach ($offices as $key => $office): ?>
									<?php $meta_label = get_post_meta($office->ID, 'bt_office_label'); ?>
									<li class="tabs__filters-item">
										<a class="js-tabs-btn tabs__filter<?php echo ($key == 0) ? ' active' : ''; ?>" 
										data-lat="<?php echo get_post_meta($office->ID, 'bt_office_lat')[0] ?: 0; ?>" 
										data-lng="<?php echo get_post_meta($office->ID, 'bt_office_lng')[0] ?: 0; ?>" 
										href="#"><?php echo $meta_label ? $meta_label[0] : get_the_title($office->ID); ?></a>
									</li>
								<?php endforeach ?>
							</ul>

							<?php foreach ($offices as $key => $office): ?>
								<div class="js-tabs-body tabs__body<?php echo ($key == 0) ? ' opened' : ''; ?>">
									<div class="entry-content">
										<?php echo wpautop($office->post_content); ?>
									</div>
								</div>
							<?php endforeach ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="block-contact-map__map">
				<div id="map" class="map"></div>
			</div>
		</div>
	</div>
</section>

<script>
	function initMap() {

		var lat = <?php echo get_post_meta($offices[0]->ID, 'bt_office_lat' )[0] ?: 0 ?>;
		var lng = <?php echo get_post_meta($offices[0]->ID, 'bt_office_lng' )[0] ?: 0 ?>;

		var coords = {
			lat: window.tabsMapLat ? window.tabsMapLat : lat, 
			lng: window.tabsMaplng ? window.tabsMapLng : lng
		};

		var args = { 
			zoom: 12,
			zoomControl: false,
			scaleControl: false,
			mapTypeControl: false,
			fullscreenControl: false,
			streetViewControl: false,
			center: coords,
			styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}] 
		};

		var map = new google.maps.Map( document.getElementById('map'), args);
		var marker = new google.maps.Marker({
			position: coords, 
			map: map,
			icon: "<?php echo get_template_directory_uri('url') ?>/img/map-marker.png"
		});

		window.tabsMap = map;
		window.tabsMapMarker = marker;
		window.tabsMapLat = coords.lat;
		window.tabsMapLng = coords.lng;
	};

	;(function() {
		var s = document.createElement("script");
		var head = document.querySelector("head");
		s.type = "text/javascript";
		s.async = true;
		s.defer = true;
		s.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCcywKcxXeMZiMwLDcLgyEnNglcLOyB_qw&callback=initMap";
		head.append(s);
	})();

</script>

<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcywKcxXeMZiMwLDcLgyEnNglcLOyB_qw&callback=initMap"></script> -->
