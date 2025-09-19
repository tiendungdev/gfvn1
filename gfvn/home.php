<?php
/**
 * Template Name: Home Page with ACF
 * 
 * Trang chủ sử dụng ACF Flexible Content
 */

get_header(); ?>

<main>
    <?php
    // Kiểm tra và lấy flexible content field
    if (have_rows('home_section')) :
        while (have_rows('home_section')) : the_row();
            $layout = get_row_layout();
            
            switch ($layout) :
                case 'hero_image':
                    get_template_part('template-parts/hero-section');
                    break;
                    
                case 'about_us':
                    get_template_part('template-parts/about-section');
                    break;
                    
                case 'quyen_loi':
                    get_template_part('template-parts/membership-section');
                    break;
                    
                case 'hoat_dong':
                    get_template_part('template-parts/schedule-section');
                    break;
                    
                case 'thong_bao':
                    get_template_part('template-parts/announcements-section');
                    break;
                    
                case 'contact':
                    get_template_part('template-parts/contact-section');
                    break;

                case 'gallery':
                    get_template_part('template-parts/gallery-section');
                    break;
                case 'cot':
                    get_template_part('template-parts/columns-section');
                    break;

            endswitch;
        endwhile;
    endif;
    ?>
</main>

<?php get_footer(); ?>