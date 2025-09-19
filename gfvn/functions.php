<?php
// Ngăn truy cập trực tiếp
if (!defined('ABSPATH')) {
    exit;
}


// Thiết lập theme
function readi_theme_setup() {
    // Hỗ trợ title tag
    add_theme_support('title-tag');
    
    // Hỗ trợ post thumbnails
    add_theme_support('post-thumbnails');
    
    // Hỗ trợ custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));


    // Hỗ trợ HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Đăng ký menu
    register_nav_menus(array(
        'primary' => 'Menu chính',
    ));
}
add_action('after_setup_theme', 'readi_theme_setup');


// Đăng ký widget areas
function readi_widgets_init() {
    // Footer cột 1 - Mô tả và Social
    register_sidebar(array(
        'name'          => 'Footer - Mô tả & Social',
        'id'            => 'footer-1',
        'description'   => 'Widget area cho mô tả công ty và social media',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // Footer cột 2 - Liên kết nhanh
    register_sidebar(array(
        'name'          => 'Footer - Liên kết nhanh',
        'id'            => 'footer-2',
        'description'   => 'Widget area cho menu liên kết nhanh',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-heading">',
        'after_title'   => '</h3>',
    ));
    
    // Footer cột 3 - Thông tin liên hệ
    register_sidebar(array(
        'name'          => 'Footer - Thông tin liên hệ',
        'id'            => 'footer-3',
        'description'   => 'Widget area cho thông tin liên hệ',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-heading">',
        'after_title'   => '</h3>',
    ));
    
}
add_action('widgets_init', 'readi_widgets_init');


// Vô hiệu hóa Gutenberg (Block Editor)
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);


// Loại bỏ CSS của Gutenberg
function readi_remove_gutenberg_css() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
}
add_action('wp_enqueue_scripts', 'readi_remove_gutenberg_css', 100);


// Đảm bảo Classic Widgets
function readi_enable_classic_widgets() {
    remove_theme_support('widgets-block-editor');
}
add_action('after_setup_theme', 'readi_enable_classic_widgets');


// Hàm hiển thị menu
function readi_display_menu() {
    $menu_items = wp_get_nav_menu_items('primary');
    
    if ($menu_items) {
        foreach ($menu_items as $item) {
            echo '<li class="header-menu-item"><a href="' . $item->url . '" class="header-menu-link">' . $item->title . '</a></li>';
        }
    } else {
        // Menu mặc định nếu chưa thiết lập
        echo '<li class="header-menu-item"><a href="#about" class="header-menu-link">Về READI</a></li>';
        echo '<li class="header-menu-item"><a href="#membership" class="header-menu-link">Quyền Lợi Thành Viên</a></li>';
        echo '<li class="header-menu-item"><a href="#schedule" class="header-menu-link">Hoạt Động Mới</a></li>';
        echo '<li class="header-menu-item"><a href="#announcements" class="header-menu-link">Thông Báo</a></li>';
        echo '<li class="header-menu-item"><a href="#contact" class="header-menu-link">Liên Hệ</a></li>';
    }
}

// Hàm hiển thị mobile menu
function readi_display_mobile_menu() {
    $menu_items = wp_get_nav_menu_items('primary');
    
    if ($menu_items) {
        foreach ($menu_items as $item) {
            echo '<li><a href="' . $item->url . '" class="header-mobile-link">' . $item->title . '</a></li>';
        }
    } else {
        // Menu mặc định nếu chưa thiết lập
        echo '<li><a href="#about" class="header-mobile-link">Về READI</a></li>';
        echo '<li><a href="#membership" class="header-mobile-link">Quyền Lợi Thành Viên</a></li>';
        echo '<li><a href="#schedule" class="header-mobile-link">Hoạt Động Mới</a></li>';
        echo '<li><a href="#announcements" class="header-mobile-link">Thông Báo</a></li>';
        echo '<li><a href="#contact" class="header-mobile-link">Liên Hệ</a></li>';
    }
}



// Đảm bảo ACF được kích hoạt
if( !function_exists('get_field') ) {
    function acf_notice() {
        echo '<div class="notice notice-error"><p>Plugin Advanced Custom Fields cần được cài đặt và kích hoạt để theme hoạt động đúng cách.</p></div>';
    }
    add_action('admin_notices', 'acf_notice');
}

// Import ACF fields từ JSON (nếu cần)
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    // Thêm đường dẫn tới thư mục chứa ACF JSON
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}

// Helper function để kiểm tra layout có tồn tại không
function has_flexible_content($field_name = 'home_section', $layout_name = '') {
    if (have_rows($field_name)) {
        if (empty($layout_name)) {
            return true;
        }
        
        while (have_rows($field_name)) {
            the_row();
            if (get_row_layout() == $layout_name) {
                return true;
            }
        }
        // Reset rows để có thể sử dụng lại
        reset_rows();
    }
    return false;
}

// Helper function để lấy link ACF dạng array
function get_acf_link($link_array, $class = '', $attributes = '') {
    if (empty($link_array) || !is_array($link_array)) {
        return '';
    }
    
    $url = esc_url($link_array['url']);
    $title = esc_html($link_array['title']);
    $target = $link_array['target'] ? 'target="' . esc_attr($link_array['target']) . '"' : '';
    $class_attr = $class ? 'class="' . esc_attr($class) . '"' : '';
    
    return sprintf(
        '<a href="%s" %s %s %s>%s</a>',
        $url,
        $target,
        $class_attr,
        $attributes,
        $title
    );
}

// Helper function để format FontAwesome icon từ ACF
function format_fa_icon($icon_field) {
    if (empty($icon_field)) {
        return '';
    }
    
    // Nếu là string, return as is
    if (is_string($icon_field)) {
        return $icon_field;
    }
    
    // Nếu là array từ ACF FontAwesome field
    if (is_array($icon_field) && isset($icon_field['element'])) {
        return $icon_field['element'];
    }
    
    return '';
}

// Thêm hỗ trợ cho theme features nếu chưa có
if (!function_exists('readi_setup')) {
    function readi_setup() {
        // Thêm hỗ trợ post thumbnails
        add_theme_support('post-thumbnails');
        
        // Thêm hỗ trợ title tag
        add_theme_support('title-tag');
        
        // Thêm hỗ trợ HTML5
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));
    }
    add_action('after_setup_theme', 'readi_setup');
}

// Enqueue styles và scripts
function readi_scripts() {
    // CSS
    wp_enqueue_style('readi-style', get_stylesheet_uri());
    
    // FontAwesome (nếu chưa có)
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
    
    // Custom JS (nếu có)
    //wp_enqueue_script('readi-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'readi_scripts');

// Tùy chỉnh excerpt length
function readi_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'readi_excerpt_length');

// Custom excerpt more
function readi_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'readi_excerpt_more');



// Hàm helper lấy theme mod theo ngôn ngữ (tương thích Polylang)
function readi_get_theme_mod($option_name, $default = '') {
    // Kiểm tra nếu Polylang active
    if (function_exists('pll_current_language')) {
        $current_lang = pll_current_language();
        $option_name_lang = $option_name . '_' . $current_lang;
        return get_theme_mod($option_name_lang, get_theme_mod($option_name, $default));
    }
    return get_theme_mod($option_name, $default);
}


get_template_part('inc/clean');

// customize
get_template_part('inc/customize');




add_action('acf/init', 'add_section_id_to_gallery_layout');
function add_section_id_to_gallery_layout() {
    if (function_exists('acf_add_local_field')) {
        acf_add_local_field(array(
            'key' => 'field_gallery_section_id',
            'label' => 'Section ID',
            'name' => 'section_id',
            'type' => 'text',
            'instructions' => 'Nhập ID cho section này (ví dụ: gallery-1, hinh-anh-hoat-dong). Để trống sẽ tự động tạo ID.',
            'required' => 0,
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => 'Ví dụ: gallery-1, hinh-anh',
            'prepend' => '#',
            'append' => '',
            'maxlength' => '',
            'parent' => 'layout_68be0a95ca3c5', // Key của layout gallery trong JSON
        ));
    }
}

