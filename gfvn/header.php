
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php wp_head(); ?><script src="https://player.vimeo.com/api/player.js"></script>
</head>


<body <?php body_class(); ?>>

<header class="header animate-fade-in-up shadow-lg">
    <div class="header-container container">
        <a href="<?php echo home_url(); ?>" class="header-logo">
            <?php 
            $custom_logo_id = get_theme_mod('custom_logo');
            if ($custom_logo_id) {
                $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
                echo '<img src="' . $logo_url . '" alt="' . get_bloginfo('name') . '">';
            } else {
                // Logo mặc định
                echo '<img src="#" alt="Logo">';
            }
            ?>
        </a>
        
        <nav class="header-nav">
            <?php 
            if (has_nav_menu('primary')) : 
                $args = array(
                    "theme_location" => 'primary',
                    "container" => false,
                    'menu_class' => 'header-menu',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'add_li_class' => 'header-menu-item'
                );
                wp_nav_menu($args);
            else : ?>
                <ul class="header-menu">
                    <li class="header-menu-item"><a href="#about" class="header-menu-link">Về chúng tôi</a></li>
                    <li class="header-menu-item"><a href="#membership" class="header-menu-link">Quyền Lợi Thành Viên</a></li>
                    <li class="header-menu-item"><a href="#schedule" class="header-menu-link">Hoạt Động Mới</a></li>
                    <li class="header-menu-item"><a href="#announcements" class="header-menu-link">Thông Báo</a></li>
                    <li class="header-menu-item"><a href="#contact" class="header-menu-link">Liên Hệ</a></li>
                </ul>
            <?php endif; ?>
        </nav>
        

        <div class="header-cta">
            <a href="<?php echo esc_url(get_theme_mod('readi_cta_link', 'https://zalo.me/')); ?>" target="_blank" class="header-button" style="transform: translateY(0px) scale(1); transition: 0.3s;">
                <i class="fas fa-message"></i> <?php echo esc_html(get_theme_mod('readi_cta_text', 'Tham Gia Ngay')); ?>
            </a>
        </div>

        
        <button class="header-mobile-toggle" aria-label="Toggle menu">
            <span class="header-mobile-icon"></span>
        </button>
    </div>
    
    <div class="header-mobile-menu">
        <?php 
        if (has_nav_menu('primary')) : 
            $mobile_args = array(
                "theme_location" => 'primary',
                "container" => false,
                'menu_class' => '',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
            );
            wp_nav_menu($mobile_args);
        else : ?>
            <ul>
                <li><a href="#about" class="header-mobile-link">Về</a></li>
                <li><a href="#membership" class="header-mobile-link">Quyền Lợi Thành Viên</a></li>
                <li><a href="#schedule" class="header-mobile-link">Hoạt Động Mới</a></li>
                <li><a href="#announcements" class="header-mobile-link">Thông Báo</a></li>
                <li><a href="#contact" class="header-mobile-link">Liên Hệ</a></li>
            </ul>
        <?php endif; ?>

        <div class="header-cta">
            <a href="<?php echo esc_url(get_theme_mod('readi_cta_link', 'https://zalo.me/')); ?>" target="_blank" class="header-button" style="transform: translateY(0px) scale(1); transition: 0.3s;">
                <?php echo esc_html(get_theme_mod('readi_cta_text', 'Tham Gia Ngay')); ?>
            </a>
        </div>

    </div>
</header>