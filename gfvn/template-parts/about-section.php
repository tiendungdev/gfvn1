<?php
/**
 * Template part: About Section
 */

$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$cot_trai = get_sub_field('cot_trai');
$cot_phai = get_sub_field('cot_trai_copy'); // Note: ACF uses "cot_trai_copy" for right column
?>

<section id="about" class="section section--white">
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
        
        <div class="about-grid">
            <?php if ($cot_trai) : ?>
                <div>
                    <?php echo wp_kses_post($cot_trai); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($cot_phai) : ?>
                <div>
                    <?php echo wp_kses_post($cot_phai); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>