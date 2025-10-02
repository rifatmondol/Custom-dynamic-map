<?php

function custom_map_shortcode()
{
    ob_start();
    $google_map_key = get_wooprex_option('google_map_key');
?>
    <div id="custom-map" style="width: 100%; height: 600px;"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_html($google_map_key); ?>"></script>
    <script>
        function initCustomMap() {
            var center = {
                lat: 45.57,
                lng: -73.75
            };

            var map = new google.maps.Map(document.getElementById('custom-map'), {
                zoom: 12,
                center: center,
                styles: [{
                        elementType: 'geometry',
                        stylers: [{
                            color: '#f5f5f5'
                        }]
                    },
                    {
                        elementType: 'labels.icon',
                        stylers: [{
                            visibility: 'off'
                        }]
                    },
                    {
                        elementType: 'labels.text.fill',
                        stylers: [{
                            color: '#616161'
                        }]
                    },
                    {
                        elementType: 'labels.text.stroke',
                        stylers: [{
                            color: '#f5f5f5'
                        }]
                    },
                    {
                        featureType: 'administrative.land_parcel',
                        elementType: 'labels.text.fill',
                        stylers: [{
                            color: '#bdbdbd'
                        }]
                    },
                    {
                        featureType: 'poi',
                        elementType: 'geometry',
                        stylers: [{
                            color: '#eeeeee'
                        }]
                    },
                    {
                        featureType: 'road',
                        elementType: 'geometry',
                        stylers: [{
                            color: '#ffffff'
                        }]
                    },
                    {
                        featureType: 'road',
                        elementType: 'labels.text.fill',
                        stylers: [{
                            color: '#757575'
                        }]
                    },
                    {
                        featureType: 'water',
                        elementType: 'geometry',
                        stylers: [{
                            color: '#c9c9c9'
                        }]
                    },
                    {
                        featureType: 'water',
                        elementType: 'labels.text.fill',
                        stylers: [{
                            color: '#9e9e9e'
                        }]
                    }
                ]
            });

           var customIcon = {
  url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 80 80">
  <!-- Ripple Circle Animation -->
  <circle cx="40" cy="40" r="0" stroke="#143141" stroke-width="2" fill="none">
    <animate attributeName="r" from="0" to="40" dur="2s" repeatCount="indefinite" />
    <animate attributeName="opacity" from="1" to="0" dur="2s" repeatCount="indefinite" />
  </circle>

  <!-- Central Filled Circle -->
  <circle cx="40" cy="40" r="12" fill="#143141" />
</svg>
`),
  scaledSize: new google.maps.Size(50, 50) // You can increase this if you want the icon bigger on the map
};

            <?php
            $args = array(
                'post_type'      => 'map_location',
                'posts_per_page' => -1,
            );

            $locations = new WP_Query($args);
            ?>
            var locations = [
                <?php
                if ($locations->have_posts()) :
                    while ($locations->have_posts()) : $locations->the_post();
                        $address = get_field('address'); // ACF field
                        $lat     = get_field('lat');
                        $lng     = get_field('long');
                        $link    = get_field('link'); // ACF URL field
                ?> {
                            title: "<?php echo esc_js(get_the_title()); ?>",
                            address: "<?php echo esc_js($address); ?>",
                            lat: <?php echo esc_js($lat); ?>,
                            lng: <?php echo esc_js($lng); ?>,
                            id: "<?php echo esc_js($link); ?>"
                        },
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            ];

            locations.forEach(function(loc) {
                var marker = new google.maps.Marker({
                    position: {
                        lat: loc.lat,
                        lng: loc.lng
                    },
                    map: map,
                    title: loc.title,
                    icon: customIcon
                });

                var infowindow = new google.maps.InfoWindow({
                    content: '<div class="scpin"><strong>' + loc.title + '</strong><br>' + loc.address + '</div>'
                });

                // Show popup on hover
                marker.addListener('mouseover', function() {
                    infowindow.open(map, marker);
                });

                marker.addListener('mouseout', function() {
                    infowindow.close();
                });

                // Scroll to section on click
                marker.addListener('click', function() {
                    var section = document.getElementById(loc.id);
                    if (section) {
                        section.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        }

        window.addEventListener('load', initCustomMap);
    </script>
<?php
    return ob_get_clean();
}
add_shortcode('custom_google_map', 'custom_map_shortcode');
