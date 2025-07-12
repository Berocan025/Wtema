<?php
/**
 * Digital License Pro - Ana Tema Dosyası
 * 
 * @package DigitalLicensePro
 * @author BERAT K - 0539 511 56 32
 * @version 1.0.0
 */

// Doğrudan erişimi engelle
if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="row">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('col'); ?>>
                        <div class="card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="card-image">
                                    <?php the_post_thumbnail('large', array('class' => 'w-100')); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="card-body">
                                <header class="entry-header">
                                    <h2 class="entry-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    
                                    <div class="entry-meta">
                                        <span class="posted-on">
                                            <i class="fas fa-calendar"></i>
                                            <?php echo get_the_date(); ?>
                                        </span>
                                        
                                        <span class="byline">
                                            <i class="fas fa-user"></i>
                                            <?php the_author(); ?>
                                        </span>
                                        
                                        <?php if (has_category()) : ?>
                                            <span class="cat-links">
                                                <i class="fas fa-folder"></i>
                                                <?php the_category(', '); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </header>
                                
                                <div class="entry-content">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <footer class="entry-footer">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                        Devamını Oku
                                    </a>
                                </footer>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <?php
            // Sayfalama
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => '<i class="fas fa-chevron-left"></i> Önceki',
                'next_text' => 'Sonraki <i class="fas fa-chevron-right"></i>',
            ));
            ?>
            
        <?php else : ?>
            <div class="no-posts">
                <div class="card text-center">
                    <div class="card-body">
                        <h2>İçerik Bulunamadı</h2>
                        <p>Aradığınız içerik bulunamadı. Lütfen farklı bir arama yapmayı deneyin.</p>
                        <a href="<?php echo home_url(); ?>" class="btn btn-primary">
                            Ana Sayfaya Dön
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>