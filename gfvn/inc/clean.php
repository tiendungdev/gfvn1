<?php 


// remove <style>img:is([sizes=”auto” i], [sizes^=”auto,” i]) { contain-intrinsic-size: 3000px 1500px }</style>
add_filter('wp_img_tag_add_auto_sizes', '__return_false');


// remove css <style id='classic-theme-styles-inline-css' type='text/css'>
add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style( 'classic-theme-styles' );
}, 20 );



// Disable Safe SVG block.
add_action( 'wp_enqueue_scripts', function() {
	wp_deregister_style( 'safe-svg-svg-icon-style' );
}, 20 );



/* Remove auto add <p> contact form
*===============================================================*/
add_filter('wpcf7_autop_or_not', '__return_false');


/* Them text truoc Gia ban
*===============================================================*/
// add_filter( 'woocommerce_get_price_html', 'vts_text_before_price' );
// function vts_text_before_price($price){
//     $text_to_add_before_price  = '<span class="gia-ban">Giá bán: </span>'; 
// 	return $text_to_add_before_price . $price   ;
// }


/* Tat confirm admin email khi login
*===============================================================*/
add_filter( 'admin_email_check_interval', '__return_false' );


/* Tat tuy chon ngon ngu trong login page
*===============================================================*/
add_filter( 'login_display_language_dropdown', '__return_false' );

/* Add text so luong before + - button
*===============================================================*/
// add_action( 'woocommerce_before_add_to_cart_button', 'vts_sl_addtocart_button_func' );
// function vts_sl_addtocart_button_func() {
//     echo '<div class="vts-soluong">Số lượng: </div>';
// }


/* Input price auto convert  to number
*===============================================================*/
add_action( 'admin_print_scripts', function() {
    //vutruso
    echo <<<'EOT'
    <script type="text/javascript">
        jQuery(function($){
            // Input Only Number by vutruso.com
                $('.wc_input_price').on('input', onlyNum);
                $('.wc_input_price').on('input', onlyNum);
                function onlyNum(){
                    // $(this).val( $(this).val().replace(/[^0-9]/g,''));
                    $(this).val( $(this).val().replace(/\D/g,''));
                }
        });
    </script>
EOT;
}, PHP_INT_MAX );


/* Classic editor
*===============================================================*/
add_filter('use_block_editor_for_post', '__return_false', 10);


/* Classic widget
*===============================================================*/
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );


/* Xoa svg trong body https://bit.ly/3wEyMFQ
*===============================================================*/
remove_action ('wp_body_open', 'wp_global_styles_render_svg_filters');
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');


/* Disable _application_passwords
*===============================================================*/
add_filter( 'wp_is_application_passwords_available', '__return_false' );


/* Disable WordPress Image Compression
*===============================================================*/
add_filter('jpeg_quality', function($arg){return 100;});


/* Remove WordPress menu from admin bar
*===============================================================*/
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
function remove_wp_logo( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'wp-logo' );
}


/* Login Page
*===============================================================*/
function vts_login_logo_url() {return home_url();}
add_filter( 'login_headerurl', 'vts_login_logo_url' );


/* Cleaner WP header
*===============================================================*/
function vutruso_clean_header() {

    // Remove the REST API lines from the HTML Header
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

	// Remove comment feed <link rel="alternate" type="application/rss+xml" href="https://vnick.vn/comments/feed/" />
	remove_action( 'wp_head', 'feed_links', 2 );
	
    // Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );

    // Turn off oEmbed auto discovery.
    add_filter( 'embed_oembed_discover', '__return_false' );

    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );

    // Remove emoji js
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );

    // Remove EditURI/RSD + wlwmanifest + wp version
    remove_action ('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator'); 

}
add_action( 'init', 'vutruso_clean_header' );


/* Xoa ky tu dac biet khi tai anh len
*=====================================================================*/
function vutruso_sanitize_file_name( $filename ) {
 
    $sanitized_filename = remove_accents( $filename ); // Convert to ASCII
    // Standard replacements
    $invalid = array(
        ' '   => '-',
        '%20' => '-',
        '_'   => '-',
    );
    $sanitized_filename = str_replace( array_keys( $invalid ), array_values( $invalid ), $sanitized_filename );
    $sanitized_filename = preg_replace('/[^A-Za-z0-9-\. ]/', '', $sanitized_filename); // Remove all non-alphanumeric except .
    $sanitized_filename = preg_replace('/\.(?=.*\.)/', '', $sanitized_filename); // Remove all but last .
    $sanitized_filename = preg_replace('/-+/', '-', $sanitized_filename); // Replace any more than one - in a row
    $sanitized_filename = str_replace('-.', '.', $sanitized_filename); // Remove last - if at the end
    $sanitized_filename = strtolower( $sanitized_filename ); // Lowercase
    return $sanitized_filename;
}
add_filter( 'sanitize_file_name', 'vutruso_sanitize_file_name', 10, 1 );


/* Remove Widget Default
*===============================================================*/
function vutruso_remove_widgets(){
    //unregister_widget('WP_Widget_Pages');     
    unregister_widget('WP_Widget_Calendar');     
    unregister_widget('WP_Widget_Archives');     
    unregister_widget('WP_Widget_Links');    
    unregister_widget('WP_Widget_Meta');     
    unregister_widget('WP_Widget_Search');                  
    unregister_widget('WP_Widget_RSS');    
    //unregister_widget('WP_Nav_Menu_Widget'); 
    unregister_widget('WP_Widget_Media_Audio');
    unregister_widget('WP_Widget_Media_Video');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    //unregister_widget('WP_Widget_Categories');
}
add_action('widgets_init', 'vutruso_remove_widgets', 11);


/* Change <h3 id="reply-title" class="comment-reply-title">Trả lời
*===============================================================*/
add_filter( 'comment_form_defaults', 'custom_reply_title' );
function custom_reply_title( $defaults ){
  $defaults['title_reply_before'] = '<span id="reply-title" class="h4 comment-reply-title">';
  $defaults['title_reply_after'] = '</span>';
  return $defaults;
}


/* Remove Admin footer modification
*=====================================================================*/
function remove_footer_admin () {
    echo '<span id="footer-thankyou"></span>';
}
add_filter('admin_footer_text', 'remove_footer_admin');