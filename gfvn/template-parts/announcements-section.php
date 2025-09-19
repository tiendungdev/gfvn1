<?php
/**
 * Template part: Announcements Section
 */

$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$box_noi_dung = get_sub_field('box_noi_dung');
$link = get_sub_field('link');
?>

<section id="announcements" class="section section--gray">
    <div class="container">
        <?php if ($title || $sub_title) : ?>
            <div class="section-header">
                <?php if ($title) : ?>
                    <h2 class="section-title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                
                <?php if ($sub_title) : ?>
                    <p class="section-subtitle"><?php echo esc_html($sub_title); ?></p>
                <?php endif; ?>
                
                <div class="section-divider"></div>
            </div>
        <?php endif; ?>
        
        <?php if ($box_noi_dung) : ?>
            <div class="announcements-container">
                <?php 
                $time = $box_noi_dung['time'];
                $content = $box_noi_dung['content'];
                $features = $box_noi_dung['features'];
                ?>
                
                <?php if ($time) : ?>
                    <p class="announcements-date"><?php echo esc_html($time); ?></p>
                <?php endif; ?>
                
                <?php if ($content) : ?>
                    <div class="announcements-content">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($features && have_rows('box_noi_dung') && have_rows('features', 'box_noi_dung')) : ?>
                    <div class="announcements-features">
                        <?php while (have_rows('features', 'box_noi_dung')) : the_row(); 
                            $icon = get_sub_field('icon');
                            $name = get_sub_field('name');
                        ?>
                            <span class="announcements-feature">
                                <?php if ($icon) : ?>
                                    <?php echo $icon; ?>
                                <?php endif; ?>
                                <?php if ($name) : ?>
                                    <?php echo esc_html($name); ?>
                                <?php endif; ?>
                            </span>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($link) : ?>
            <div class="text-center">
                <a href="<?php echo esc_url($link['url']); ?>" 
                   <?php echo $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>
                   class="announcements-button">
                    <?php echo esc_html($link['title']); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>