<?php
function landing_page_theme_enqueue_assets()
{
    wp_enqueue_style('tailwind', 'https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css');
    wp_enqueue_style('flowbite-css', 'https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.4.7/flowbite.min.css');
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/main.css');

    wp_enqueue_script('jquery');
    wp_enqueue_script('flowbite-js', 'https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.4.7/flowbite.min.js', array('jquery'), null, true);
    wp_enqueue_script('custom-countdown', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0', true);

    // Localize script to make ajaxurl available
    wp_localize_script('custom-countdown', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'landing_page_theme_enqueue_assets');

function enqueue_confetti_script()
{
    if (is_page_template('page-thank-you.php')) {
        wp_enqueue_script('canvas-confetti', 'https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.min.js', array('jquery'), '1.4.0', true);
        wp_enqueue_script('custom-confetti', get_template_directory_uri() . '/assets/js/custom-confetti.js', array('jquery', 'canvas-confetti'), '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_confetti_script');

function real_estate_theme_setup()
{
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'real-estate-theme'),
    ));
    add_theme_support('widgets');
}
add_action('after_setup_theme', 'real_estate_theme_setup');

function get_custom_image_1()
{
    return get_template_directory_uri() . '/assets/images/it.webp';
}

function get_result_image()
{
    return get_template_directory_uri() . '/assets/images/image2vector.svg';
}

function get_users_image_1()
{
    return get_template_directory_uri() . '/assets/images/photo-1553642618-de0381320ff3.webp';
}

function get_book_svg()
{
    return get_template_directory_uri() . '/assets/images/image2vector.svg';
}

function get_ceo_image()
{
    return get_template_directory_uri() . '/assets/images/ceo5thelement.webp';
}

function get_custom_footer_name()
{
    return " All Rights Reserved";
}

function handle_form_submission() {
    error_log("Form submission handler started.");

    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $phone = sanitize_text_field($_POST['phone']);

        global $wpdb;
        $table = $wpdb->prefix . 'form_submissions';

        $wpdb->insert(
            $table,
            array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'submitted_at' => current_time('mysql')
            )
        );

        error_log("Form submitted successfully. Redirecting to Thank You page.");
        wp_send_json_success(array('redirect_url' => home_url('/thank-you')));
    } else {
        error_log("Form submission failed. Required fields missing.");
        wp_send_json_error('Required fields are missing.');
    }
}

add_action('wp_ajax_nopriv_submit_form', 'handle_form_submission');
add_action('wp_ajax_submit_form', 'handle_form_submission');

function create_form_submissions_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'form_submissions';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name tinytext NOT NULL,
        email text NOT NULL,
        phone text NOT NULL,
        submitted_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_switch_theme', 'create_form_submissions_table');

function add_confetti_to_thank_you_page()
{
    // Check if it's the "Thank You" page
    if (is_page_template('page-thank-you.php')) {
        echo do_shortcode('[confetti-fall-animation delay="1" time="25"]');
    }
}
add_action('wp_head', 'add_confetti_to_thank_you_page');

function custom_redirect_to_home() {
    // Get the current URL path
    $current_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    // Define the allowed paths
    $allowed_paths = array(
        'facebook-ads-guide',
        'thank-you', 
        '',
    );

    // Check if the current path is not in the allowed paths
    if (!in_array($current_path, $allowed_paths)) {
        // Redirect to the home page
        wp_redirect(home_url('/facebook-ads-guide'));
        exit;
    }
}
add_action('template_redirect', 'custom_redirect_to_home');

function custom_page_title($title) {
    if (is_page('facebook-ads-guide') && !is_user_logged_in()) {
        return 'Olayemi Olamiju';
    }
    return $title;
}
add_filter('wp_title', 'custom_page_title');

add_filter('pre_get_document_title', 'custom_page_title'); // For newer WordPress versions



function theme_setup() {
    add_theme_support('Boost Your Real Estate Marketing | Social Media 100 Targeting Audience Options for Powerful Real Estate Ads');
}
add_action('after_setup_theme', 'theme_setup');

function custom_thank_you_page_title($title, $sep) {
    if (is_page_template('page-thank-you.php')) {
        return 'Congratulatulation and a Big Thank You' ;
    }
    return $title;
}
add_filter('wp_title', 'custom_thank_you_page_title', 10, 2);





