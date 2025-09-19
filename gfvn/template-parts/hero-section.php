<?php
/**
 * Template part: Hero Section
 */

$title = get_sub_field('title');
$text = get_sub_field('text');
$button_1 = get_sub_field('button_1');
$button_2 = get_sub_field('button_2');
?>

<section id="hero" class="hero">
    <div class="hero-container container">
        <div class="hero-content">
            <?php if ($title) : ?>
                <h1 class="hero-title"><?php echo esc_html($title); ?></h1>
            <?php endif; ?>
            
            <?php if ($text) : ?>
                <div class="hero-subtitle"><?php echo wp_kses_post($text); ?></div>
            <?php endif; ?>
            
            <?php if ($button_1 || $button_2) : ?>
                <div class="hero-buttons">
                    <?php if ($button_1) : ?>
                        <a href="<?php echo esc_url($button_1['url']); ?>" 
                           <?php echo $button_1['target'] ? 'target="' . esc_attr($button_1['target']) . '"' : ''; ?>
                           class="hero-button hero-button--primary">
                            <i class="fas fa-user-plus"></i> <?php echo esc_html($button_1['title']); ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($button_2) : ?>
                        <a href="<?php echo esc_url($button_2['url']); ?>" 
                           <?php echo $button_2['target'] ? 'target="' . esc_attr($button_2['target']) . '"' : ''; ?>
                           class="hero-button hero-button--secondary">
                            <i class="fas fa-info-circle"></i> <?php echo esc_html($button_2['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>