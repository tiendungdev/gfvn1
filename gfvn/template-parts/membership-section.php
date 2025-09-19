<?php
/**
 * Template part: Membership Section
 */

$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$noi_dung = get_sub_field('noi_dung');
$link = get_sub_field('link');
?>

<section id="membership" class="section section--gray">
    <div class="container-fluid">
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

        <?php if ($noi_dung) : ?>
            <div class="membership-content">
                <?php echo wp_kses_post($noi_dung); ?>
            </div>
        <?php endif; ?>

        <?php if ($link) : ?>
            <div class="text-center">
                <a href="<?php echo esc_url($link['url']); ?>" 
                   <?php echo $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>
                   class="membership-button">
                    <i class="fas fa-envelope-open-text"></i> <?php echo esc_html($link['title']); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>