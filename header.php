<?php
// Hata gösterimini kapat
error_reporting(0);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Preload critical resources -->
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/inter-var.woff2" as="font" type="font/woff2" crossorigin>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon.png">
    
    <!-- Meta tags for SEO -->
    <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
    <meta name="keywords" content="dijital lisans, windows lisans, office lisans, adobe lisans, yazılım lisansı">
    <meta name="author" content="BERAT K - 0539 511 56 32">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url(); ?>">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/og-image.jpg">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php echo get_bloginfo('description'); ?>">
    <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/twitter-image.jpg">
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "<?php bloginfo('name'); ?>",
        "url": "<?php echo home_url(); ?>",
        "logo": "<?php echo get_template_directory_uri(); ?>/assets/images/logo.png",
        "description": "<?php echo get_bloginfo('description'); ?>",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "0539-511-56-32",
            "contactType": "customer service",
            "availableLanguage": "Turkish"
        },
        "sameAs": [
            "https://facebook.com/<?php echo get_theme_mod('dlp_facebook_url', ''); ?>",
            "https://twitter.com/<?php echo get_theme_mod('dlp_twitter_url', ''); ?>",
            "https://instagram.com/<?php echo get_theme_mod('dlp_instagram_url', ''); ?>"
        ]
    }
    </script>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip to content link for accessibility -->
<a class="skip-link screen-reader-text" href="#main-content">Ana içeriğe geç</a>

<!-- Header -->
<header class="site-header" id="site-header">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <div class="top-bar-left">
                    <div class="contact-info">
                        <a href="tel:05395115632" class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>0539 511 56 32</span>
                        </a>
                        <a href="mailto:info@digitallicensepro.com" class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@digitallicensepro.com</span>
                        </a>
                    </div>
                </div>
                
                <div class="top-bar-right">
                    <div class="top-bar-actions">
                        <!-- Theme Toggle -->
                        <button class="theme-toggle" id="theme-toggle" aria-label="Tema değiştir">
                            <i class="fas fa-sun light-icon"></i>
                            <i class="fas fa-moon dark-icon"></i>
                        </button>
                        
                        <!-- Language Selector -->
                        <div class="language-selector">
                            <button class="language-btn" aria-label="Dil seç">
                                <i class="fas fa-globe"></i>
                                <span>TR</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="language-dropdown">
                                <a href="#" class="language-option active">Türkçe</a>
                                <a href="#" class="language-option">English</a>
                            </div>
                        </div>
                        
                        <!-- Social Links -->
                        <div class="social-links">
                            <?php if (get_theme_mod('dlp_facebook_url')) : ?>
                                <a href="<?php echo esc_url(get_theme_mod('dlp_facebook_url')); ?>" target="_blank" rel="noopener" aria-label="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (get_theme_mod('dlp_twitter_url')) : ?>
                                <a href="<?php echo esc_url(get_theme_mod('dlp_twitter_url')); ?>" target="_blank" rel="noopener" aria-label="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (get_theme_mod('dlp_instagram_url')) : ?>
                                <a href="<?php echo esc_url(get_theme_mod('dlp_instagram_url')); ?>" target="_blank" rel="noopener" aria-label="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Header -->
    <div class="main-header">
        <div class="container">
            <div class="header-content">
                <!-- Logo -->
                <div class="site-logo">
                    <?php if (get_theme_mod('dlp_logo')) : ?>
                        <a href="<?php echo home_url(); ?>" class="logo-link">
                            <img src="<?php echo esc_url(get_theme_mod('dlp_logo')); ?>" alt="<?php bloginfo('name'); ?>" class="logo-image">
                        </a>
                    <?php else : ?>
                        <a href="<?php echo home_url(); ?>" class="logo-text">
                            <span class="logo-title"><?php bloginfo('name'); ?></span>
                            <span class="logo-subtitle">Dijital Lisans Pro</span>
                        </a>
                    <?php endif; ?>
                </div>
                
                <!-- Navigation -->
                <nav class="main-navigation" id="main-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'nav-menu',
                        'container' => false,
                        'fallback_cb' => 'digital_license_pro_fallback_menu',
                        'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                        'walker' => new Digital_License_Pro_Walker_Nav_Menu()
                    ));
                    ?>
                </nav>
                
                <!-- Header Actions -->
                <div class="header-actions">
                    <!-- Search -->
                    <div class="search-container">
                        <button class="search-toggle" id="search-toggle" aria-label="Arama">
                            <i class="fas fa-search"></i>
                        </button>
                        <div class="search-dropdown" id="search-dropdown">
                            <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                                <div class="search-input-group">
                                    <input type="search" class="search-input" placeholder="Ürün ara..." value="<?php echo get_search_query(); ?>" name="s">
                                    <button type="submit" class="search-submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- User Account -->
                    <div class="user-account">
                        <?php if (is_user_logged_in()) : ?>
                            <div class="user-menu">
                                <button class="user-menu-toggle" aria-label="Kullanıcı menüsü">
                                    <i class="fas fa-user"></i>
                                    <span class="user-name"><?php echo wp_get_current_user()->display_name; ?></span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="user-dropdown">
                                    <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="user-menu-item">
                                        <i class="fas fa-user"></i>
                                        <span>Hesabım</span>
                                    </a>
                                    <a href="<?php echo wc_get_account_endpoint_url('orders'); ?>" class="user-menu-item">
                                        <i class="fas fa-shopping-bag"></i>
                                        <span>Siparişlerim</span>
                                    </a>
                                    <a href="<?php echo wc_get_account_endpoint_url('downloads'); ?>" class="user-menu-item">
                                        <i class="fas fa-download"></i>
                                        <span>İndirilenler</span>
                                    </a>
                                    <div class="user-menu-divider"></div>
                                    <a href="<?php echo wp_logout_url(); ?>" class="user-menu-item">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Çıkış Yap</span>
                                    </a>
                                </div>
                            </div>
                        <?php else : ?>
                            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="btn btn-secondary btn-sm">
                                <i class="fas fa-user"></i>
                                <span>Giriş Yap</span>
                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Cart -->
                    <div class="cart-container">
                        <a href="<?php echo wc_get_cart_url(); ?>" class="cart-link" aria-label="Sepet">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count" id="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                        </a>
                        
                        <!-- Mini Cart -->
                        <div class="mini-cart" id="mini-cart">
                            <div class="mini-cart-header">
                                <h3>Sepetim</h3>
                                <button class="mini-cart-close" aria-label="Sepeti kapat">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            
                            <div class="mini-cart-content">
                                <?php if (WC()->cart->is_empty()) : ?>
                                    <div class="empty-cart">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>Sepetiniz boş</p>
                                    </div>
                                <?php else : ?>
                                    <div class="cart-items">
                                        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : ?>
                                            <?php
                                            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                                            
                                            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) :
                                            ?>
                                                <div class="cart-item">
                                                    <div class="cart-item-image">
                                                        <?php echo $_product->get_image('thumbnail'); ?>
                                                    </div>
                                                    <div class="cart-item-content">
                                                        <h4 class="cart-item-title"><?php echo $_product->get_name(); ?></h4>
                                                        <div class="cart-item-price">
                                                            <?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
                                                        </div>
                                                    </div>
                                                    <button class="cart-item-remove" data-cart-item-key="<?php echo $cart_item_key; ?>">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    
                                    <div class="cart-total">
                                        <span>Toplam:</span>
                                        <span class="total-amount"><?php echo WC()->cart->get_cart_total(); ?></span>
                                    </div>
                                    
                                    <div class="cart-actions">
                                        <a href="<?php echo wc_get_cart_url(); ?>" class="btn btn-secondary btn-sm">
                                            Sepeti Görüntüle
                                        </a>
                                        <a href="<?php echo wc_get_checkout_url(); ?>" class="btn btn-primary btn-sm">
                                            Ödeme Yap
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mobile Menu Toggle -->
                    <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Menüyü aç/kapat">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobile-menu">
        <div class="mobile-menu-header">
            <div class="mobile-menu-logo">
                <?php if (get_theme_mod('dlp_logo')) : ?>
                    <img src="<?php echo esc_url(get_theme_mod('dlp_logo')); ?>" alt="<?php bloginfo('name'); ?>">
                <?php else : ?>
                    <span><?php bloginfo('name'); ?></span>
                <?php endif; ?>
            </div>
            <button class="mobile-menu-close" id="mobile-menu-close" aria-label="Menüyü kapat">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="mobile-menu-content">
            <!-- Mobile Search -->
            <div class="mobile-search">
                <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                    <div class="search-input-group">
                        <input type="search" class="search-input" placeholder="Ürün ara..." value="<?php echo get_search_query(); ?>" name="s">
                        <button type="submit" class="search-submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Mobile Navigation -->
            <nav class="mobile-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'mobile-nav-menu',
                    'container' => false,
                    'fallback_cb' => 'digital_license_pro_fallback_menu',
                    'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                    'walker' => new Digital_License_Pro_Walker_Nav_Menu()
                ));
                ?>
            </nav>
            
            <!-- Mobile User Actions -->
            <div class="mobile-user-actions">
                <?php if (is_user_logged_in()) : ?>
                    <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="mobile-user-link">
                        <i class="fas fa-user"></i>
                        <span>Hesabım</span>
                    </a>
                    <a href="<?php echo wp_logout_url(); ?>" class="mobile-user-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Çıkış Yap</span>
                    </a>
                <?php else : ?>
                    <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="mobile-user-link">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Giriş Yap</span>
                    </a>
                <?php endif; ?>
            </div>
            
            <!-- Mobile Contact -->
            <div class="mobile-contact">
                <a href="tel:05395115632" class="mobile-contact-link">
                    <i class="fas fa-phone"></i>
                    <span>0539 511 56 32</span>
                </a>
                <a href="mailto:info@digitallicensepro.com" class="mobile-contact-link">
                    <i class="fas fa-envelope"></i>
                    <span>info@digitallicensepro.com</span>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<main id="main-content" class="site-main">