<?php
/**
 * Template part: Schedule Section
 */

$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$noi_dung = get_sub_field('noi_dung');
$noi_dung_2 = get_sub_field('noi_dung_2');
$quan_trong = get_sub_field('quan_trong');
?>

<section id="schedule" class="section section--white">
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
        
        <div class="schedule-container">
            <?php if ($noi_dung) : ?>
                <div class="schedule-intro">
                    <?php echo wp_kses_post($noi_dung); ?>
                </div>
            <?php endif; ?>
            
            <?php if (have_rows('buoi')) : ?>
                <div class="schedule-grid">
                    <?php while (have_rows('buoi')) : the_row(); 
                        $buoi_so = get_sub_field('buoi_so');
                        $thoi_gian = get_sub_field('thoi_gian');
                    ?>
                        <div class="schedule-item">
                            <?php if ($buoi_so) : ?>
                                <?php echo $buoi_so; ?>
                            <?php endif; ?>
                            
                            <?php if ($thoi_gian) : ?>
                                <p class="schedule-item-date">
                                    <i class="far fa-calendar-alt"></i> 
                                    <?php echo esc_html($thoi_gian); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($noi_dung_2) : ?>
                <div class="schedule-info">
                    <?php echo wp_kses_post($noi_dung_2); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($quan_trong) : ?>
                <div class="schedule-alert" role="alert">
                    <?php echo wp_kses_post($quan_trong); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>