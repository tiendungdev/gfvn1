<?php
/**
 * Template part: Contact Section
 */

$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$noi_dung = get_sub_field('noi_dung');
$map = get_sub_field('map');
?>

<section id="contact" class="section section--white">
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
        
        <div class="contact-container">
            <?php if ($noi_dung) : ?>
                <div class="contact-info">
                    <?php echo wp_kses_post($noi_dung); ?>
                </div>
            <?php endif; ?>

            <?php if ($map) : ?>
                <div class="contact-container-map">
                    <div class="contact-map">
                        <?php echo $map; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>