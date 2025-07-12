<?php
/**
 * Digital License Pro - Header Dosyası
 * 
 * @package DigitalLicensePro
 * @author BERAT K - 0539 511 56 32
 * @version 1.0.0
 */

// Doğrudan erişimi engelle
if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="author" content="BERAT K - 0539 511 56 32">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Theme Styles -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/custom.css">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-theme="<?php echo get_theme_mod('theme_mode', 'light'); ?>">
    <?php wp_body_open(); ?>
    
    <!-- Skip to content link for accessibility -->
    <a class="skip-link screen-reader-text" href="#main">İçeriğe geç</a>
    
    <!-- Header -->
    <header id="masthead" class="site-header">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="container">
                <div class="d-flex justify-between align-center">
                    <div class="top-bar-left">
                        <span class="contact-info">
                            <i class="fas fa-phone"></i>
                            <a href="tel:+905395115632">0539 511 56 32</a>
                        </span>
                        <span class="contact-info">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:info@digitallicensepro.com">info@digitallicensepro.com</a>
                        </span>
                    </div>
                    
                    <div class="top-bar-right">
                        <!-- Theme Toggle -->
                        <button id="theme-toggle" class="theme-toggle" aria-label="Tema değiştir">
                            <i class="fas fa-sun light-icon"></i>
                            <i class="fas fa-moon dark-icon"></i>
                        </button>
                        
                        <!-- Language Switcher -->
                        <div class="language-switcher">
                            <button class="language-btn">
                                <i class="fas fa-globe"></i>
                                <span>TR</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <ul class="language-dropdown">
                                <li><a href="#" data-lang="tr">Türkçe</a></li>
                                <li><a href="#" data-lang="en">English</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Header -->
        <div class="main-header">
            <div class="container">
                <div class="d-flex justify-between align-center">
                    <!-- Logo -->
                    <div class="site-branding">
                        <?php if (has_custom_logo()) : ?>
                            <div class="custom-logo">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php else : ?>
                            <h1 class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </h1>
                            <p class="site-description"><?php bloginfo('description'); ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Search Bar -->
                    <div class="search-container">
                        <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                            <div class="search-input-group">
                                <input type="search" class="search-field" placeholder="Ürün ara..." value="<?php echo get_search_query(); ?>" name="s">
                                <button type="submit" class="search-submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Header Actions -->
                    <div class="header-actions">
                        <!-- User Account -->
                        <?php if (is_user_logged_in()) : ?>
                            <div class="user-account">
                                <button class="account-btn">
                                    <i class="fas fa-user"></i>
                                    <span><?php echo wp_get_current_user()->display_name; ?></span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <ul class="account-dropdown">
                                    <li><a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">Hesabım</a></li>
                                    <li><a href="<?php echo wc_get_account_endpoint_url('orders'); ?>">Siparişlerim</a></li>
                                    <li><a href="<?php echo wc_get_account_endpoint_url('downloads'); ?>">İndirilenler</a></li>
                                    <li><a href="<?php echo wp_logout_url(); ?>">Çıkış Yap</a></li>
                                </ul>
                            </div>
                        <?php else : ?>
                            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="btn btn-secondary">
                                <i class="fas fa-sign-in-alt"></i>
                                Giriş Yap
                            </a>
                        <?php endif; ?>
                        
                        <!-- Cart -->
                        <?php if (class_exists('WooCommerce')) : ?>
                            <div class="cart-container">
                                <a href="<?php echo wc_get_cart_url(); ?>" class="cart-btn">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Mobile Menu Toggle -->
                        <button id="mobile-menu-toggle" class="mobile-menu-toggle" aria-label="Menüyü aç/kapat">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav id="site-navigation" class="main-navigation">
            <div class="container">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'digital_license_pro_fallback_menu',
                ));
                ?>
            </div>
        </nav>
    </header>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu">
        <div class="mobile-menu-header">
            <h3>Menü</h3>
            <button id="mobile-menu-close" class="mobile-menu-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="mobile-menu-content">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'mobile',
                'menu_id'        => 'mobile-menu-items',
                'menu_class'     => 'mobile-nav-menu',
                'container'      => false,
                'fallback_cb'    => 'digital_license_pro_fallback_menu',
            ));
            ?>
            
            <!-- Mobile Search -->
            <div class="mobile-search">
                <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                    <div class="search-input-group">
                        <input type="search" class="search-field" placeholder="Ürün ara..." value="<?php echo get_search_query(); ?>" name="s">
                        <button type="submit" class="search-submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Mobile Account -->
            <?php if (is_user_logged_in()) : ?>
                <div class="mobile-account">
                    <h4>Hesabım</h4>
                    <ul>
                        <li><a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">Hesabım</a></li>
                        <li><a href="<?php echo wc_get_account_endpoint_url('orders'); ?>">Siparişlerim</a></li>
                        <li><a href="<?php echo wc_get_account_endpoint_url('downloads'); ?>">İndirilenler</a></li>
                        <li><a href="<?php echo wp_logout_url(); ?>">Çıkış Yap</a></li>
                    </ul>
                </div>
            <?php else : ?>
                <div class="mobile-account">
                    <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="btn btn-primary w-100">
                        <i class="fas fa-sign-in-alt"></i>
                        Giriş Yap
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Page Content -->
    <div id="page" class="site">
        <div id="content" class="site-content">