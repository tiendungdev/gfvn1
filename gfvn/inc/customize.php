<?php


// Customizer - Thêm sections với hỗ trợ đa ngôn ngữ
function readi_customize_register($wp_customize) {
    // Lấy danh sách ngôn ngữ nếu Polylang active
    $languages = array();
    if (function_exists('pll_languages_list')) {
        $pll_languages = pll_languages_list(array('fields' => array()));
        foreach ($pll_languages as $lang) {
            $languages[$lang->slug] = $lang->name;
        }
    }
    
    // Nếu không có Polylang, chỉ dùng 1 ngôn ngữ mặc định
    if (empty($languages)) {
        $languages = array('' => 'Mặc định');
    }
    
    // Section Header Settings
    $wp_customize->add_section('readi_header_settings', array(
        'title'    => 'Cài Đặt Header',
        'priority' => 25,
    ));
    
    // Tạo controls cho từng ngôn ngữ
    foreach ($languages as $lang_code => $lang_name) {
        $suffix = empty($lang_code) ? '' : '_' . $lang_code;
        $label_suffix = empty($lang_code) ? '' : ' (' . $lang_name . ')';
        
        // Text button CTA
        $wp_customize->add_setting('readi_cta_text' . $suffix, array(
            'default'           => 'Tham Gia Ngay',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('readi_cta_text' . $suffix, array(
            'label'    => 'Text Button CTA' . $label_suffix,
            'section'  => 'readi_header_settings',
            'type'     => 'text',
        ));
        
        // Link button CTA
        $wp_customize->add_setting('readi_cta_link' . $suffix, array(
            'default'           => 'https://zalo.me/hocvienreadi',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control('readi_cta_link' . $suffix, array(
            'label'    => 'Link Button CTA' . $label_suffix,
            'section'  => 'readi_header_settings',
            'type'     => 'url',
        ));
    }
    
    // Section Contact Info
    $wp_customize->add_section('readi_contact_info', array(
        'title'    => 'Thông Tin Liên Hệ',
        'priority' => 30,
    ));
    
    // Số điện thoại (chung cho tất cả ngôn ngữ)
    $wp_customize->add_setting('readi_phone_number', array(
        'default'           => '0289999633',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('readi_phone_number', array(
        'label'    => 'Số Điện Thoại',
        'section'  => 'readi_contact_info',
        'type'     => 'text',
    ));
    
    // Link Zalo (chung cho tất cả ngôn ngữ)
    $wp_customize->add_setting('readi_zalo_link', array(
        'default'           => 'https://zalo.me/hocvienreadi',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('readi_zalo_link', array(
        'label'    => 'Link Zalo',
        'section'  => 'readi_contact_info',
        'type'     => 'url',
    ));
    
    // Link Messenger (chung cho tất cả ngôn ngữ)
    $wp_customize->add_setting('readi_messenger_link', array(
        'default'           => 'https://m.me/hocvienreadi',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('readi_messenger_link', array(
        'label'    => 'Link Messenger',
        'section'  => 'readi_contact_info',
        'type'     => 'url',
    ));
    
    // Section Footer Settings
    $wp_customize->add_section('readi_footer_settings', array(
        'title'    => 'Cài Đặt Footer',
        'priority' => 35,
    ));
    
    foreach ($languages as $lang_code => $lang_name) {
        $suffix = empty($lang_code) ? '' : '_' . $lang_code;
        $label_suffix = empty($lang_code) ? '' : ' (' . $lang_name . ')';
        
        // Tên công ty (copyright)
        $wp_customize->add_setting('readi_company_name' . $suffix, array(
            'default'           => 'Học viện Doanh nhân READI',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('readi_company_name' . $suffix, array(
            'label'    => 'Tên Công Ty (Copyright)' . $label_suffix,
            'section'  => 'readi_footer_settings',
            'type'     => 'text',
        ));
        
        // Link Điều khoản sử dụng
        $wp_customize->add_setting('readi_terms_link' . $suffix, array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control('readi_terms_link' . $suffix, array(
            'label'    => 'Link Điều khoản sử dụng' . $label_suffix,
            'section'  => 'readi_footer_settings',
            'type'     => 'url',
        ));
        
        // Text Điều khoản sử dụng
        $wp_customize->add_setting('readi_terms_text' . $suffix, array(
            'default'           => 'Điều khoản sử dụng',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('readi_terms_text' . $suffix, array(
            'label'    => 'Text Điều khoản sử dụng' . $label_suffix,
            'section'  => 'readi_footer_settings',
            'type'     => 'text',
        ));
        
        // Link Chính sách bảo mật
        $wp_customize->add_setting('readi_privacy_link' . $suffix, array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control('readi_privacy_link' . $suffix, array(
            'label'    => 'Link Chính sách bảo mật' . $label_suffix,
            'section'  => 'readi_footer_settings',
            'type'     => 'url',
        ));
        
        // Text Chính sách bảo mật
        $wp_customize->add_setting('readi_privacy_text' . $suffix, array(
            'default'           => 'Chính sách bảo mật',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('readi_privacy_text' . $suffix, array(
            'label'    => 'Text Chính sách bảo mật' . $label_suffix,
            'section'  => 'readi_footer_settings',
            'type'     => 'text',
        ));
    }
    
    // Section Social Media (chung cho tất cả ngôn ngữ)
    $wp_customize->add_section('readi_social_media', array(
        'title'    => 'Mạng Xã Hội',
        'priority' => 40,
    ));
    
    // Facebook
    $wp_customize->add_setting('readi_facebook_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('readi_facebook_link', array(
        'label'    => 'Link Facebook',
        'section'  => 'readi_social_media',
        'type'     => 'url',
    ));
    
    // YouTube
    $wp_customize->add_setting('readi_youtube_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('readi_youtube_link', array(
        'label'    => 'Link YouTube',
        'section'  => 'readi_social_media',
        'type'     => 'url',
    ));
    
    // LinkedIn
    $wp_customize->add_setting('readi_linkedin_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('readi_linkedin_link', array(
        'label'    => 'Link LinkedIn',
        'section'  => 'readi_social_media',
        'type'     => 'url',
    ));
    
    // TikTok
    $wp_customize->add_setting('readi_tiktok_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('readi_tiktok_link', array(
        'label'    => 'Link TikTok',
        'section'  => 'readi_social_media',
        'type'     => 'url',
    ));
    
    // Instagram
    $wp_customize->add_setting('readi_instagram_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('readi_instagram_link', array(
        'label'    => 'Link Instagram',
        'section'  => 'readi_social_media',
        'type'     => 'url',
    ));
    
    // Twitter/X
    $wp_customize->add_setting('readi_twitter_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('readi_twitter_link', array(
        'label'    => 'Link Twitter/X',
        'section'  => 'readi_social_media',
        'type'     => 'url',
    ));
}
add_action('customize_register', 'readi_customize_register');

// Shortcode hiển thị social media
function readi_social_media_shortcode($atts) {
    // Lấy các link social từ customizer (không cần đa ngôn ngữ)
    $facebook = get_theme_mod('readi_facebook_link', '');
    $youtube = get_theme_mod('readi_youtube_link', '');
    $linkedin = get_theme_mod('readi_linkedin_link', '');
    $tiktok = get_theme_mod('readi_tiktok_link', '');
    $instagram = get_theme_mod('readi_instagram_link', '');
    $twitter = get_theme_mod('readi_twitter_link', '');
    
    // Tạo mảng social media
    $socials = array(
        'facebook' => array(
            'url' => $facebook,
            'icon' => 'fab fa-facebook-f',
            'label' => 'Facebook'
        ),
        'youtube' => array(
            'url' => $youtube,
            'icon' => 'fab fa-youtube',
            'label' => 'YouTube'
        ),
        'linkedin' => array(
            'url' => $linkedin,
            'icon' => 'fab fa-linkedin-in',
            'label' => 'LinkedIn'
        ),
        'tiktok' => array(
            'url' => $tiktok,
            'icon' => 'fab fa-tiktok',
            'label' => 'TikTok'
        ),
        'instagram' => array(
            'url' => $instagram,
            'icon' => 'fab fa-instagram',
            'label' => 'Instagram'
        ),
        'twitter' => array(
            'url' => $twitter,
            'icon' => 'fab fa-x-twitter',
            'label' => 'Twitter/X'
        )
    );
    
    // Bắt đầu output
    ob_start();
    ?>
    <div class="footer-social">
        <?php foreach ($socials as $social) : ?>
            <?php if (!empty($social['url'])) : ?>
                <a href="<?php echo esc_url($social['url']); ?>" target="_blank" class="footer-social-link" aria-label="<?php echo esc_attr($social['label']); ?>">
                    <i class="<?php echo esc_attr($social['icon']); ?>"></i>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('gfvn_social', 'readi_social_media_shortcode');