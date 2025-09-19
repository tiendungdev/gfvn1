<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php get_header(); ?>
    
    <main id="main" class="site-main">

    <section id="page" class="section" style="margin-top:4%">

        <div class="container">
        <h1><?php the_title(); ?></h1>
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article class="page-content">
                    <?php the_content(); ?>
                </article>
                <?php
            endwhile;
        endif;
        ?>
        </div>
        </section>
    </main>

    <?php get_footer(); ?>
    
    <?php wp_footer(); ?>
</body>
</html>