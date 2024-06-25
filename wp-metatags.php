<?php
/*
Plugin Name: Geolocation Meta Tags
Description: Custom plugin to manage geolocation data and meta tags.
Version: 1.0
Author: Mohammad R. Tayyebi <github@tyyi.net>, Microsoft Copilot
*/

// Add an admin menu page
function geolocation_menu_page()
{
    add_menu_page(
        'Geolocation Settings',
        'Geolocation',
        'manage_options',
        'geolocation-settings',
        'geolocation_settings_page'
    );
}
add_action('admin_menu', 'geolocation_menu_page');

// Display the settings page
function geolocation_settings_page()
{
?>
    <div class="wrap">
        <h1>Geolocation Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('geolocation_options'); ?>
            <?php do_settings_sections('geolocation-settings'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Geo Position</th>
                    <td><input type="text" name="geo_position" placeholder="34.91936070, 47.48329250" value="<?php echo esc_attr(get_option('geo_position')); ?>"></td>
                </tr>
                <tr>
                    <th scope="row">Geo Location</th>
                    <td><input type="text" name="geo_location" placeholder="Hamedan, Iran" value="<?php echo esc_attr(get_option('geo_location')); ?>"></td>
                </tr>
                <tr>
                    <th scope="row">Geo Region</th>
                    <td><input type="text" name="geo_region" placeholder="IR-HMD" value="<?php echo esc_attr(get_option('geo_region')); ?>"></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}



// Register settings
function geolocation_register_settings()
{
    register_setting('geolocation_options', 'geo_position');
    register_setting('geolocation_options', 'geo_location');
    register_setting('geolocation_options', 'geo_region');
}
add_action('admin_init', 'geolocation_register_settings');

// Add meta tags to the head
function geolocation_render_meta_tags()
{
    $position = get_option('geo_position');
    $location = get_option('geo_location');
    $region = get_option('geo_region');

    if ($position) {
        echo '<meta name="geo.position" content="' . esc_attr($position) . '">';
    }
    if ($location) {
        echo '<meta name="geo.location" content="' . esc_attr($location) . '">';
    }
    if ($region) {
        echo '<meta name="geo.region" content="' . esc_attr($region) . '">';
    }
}
add_action('wp_head', 'geolocation_render_meta_tags');
