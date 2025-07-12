<?php
/**
 * Digital License Pro - Functions
 * 
 * @package DigitalLicensePro
 * @author BERAT K - 0539 511 56 32
 * @version 1.0.0
 */

// Doğrudan erişimi engelle
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Tema Kurulumu
 */
function digital_license_pro_setup() {
    // Tema desteği
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // WooCommerce desteği
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // Menü konumları
    register_nav_menus(array(
        'primary' => __('Ana Menü', 'digital-license-pro'),
        'mobile' => __('Mobil Menü', 'digital-license-pro'),
        'footer' => __('Footer Menü', 'digital-license-pro'),
    ));
    
    // İçerik genişliği
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'digital_license_pro_setup');

/**
 * Widget Alanları
 */
function digital_license_pro_widgets_init() {
    register_sidebar(array(
        'name'          => __('Ana Sidebar', 'digital-license-pro'),
        'id'            => 'sidebar-1',
        'description'   => __('Ana sayfa sidebar alanı', 'digital-license-pro'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget 1', 'digital-license-pro'),
        'id'            => 'footer-1',
        'description'   => __('Footer widget alanı 1', 'digital-license-pro'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget 2', 'digital-license-pro'),
        'id'            => 'footer-2',
        'description'   => __('Footer widget alanı 2', 'digital-license-pro'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget 3', 'digital-license-pro'),
        'id'            => 'footer-3',
        'description'   => __('Footer widget alanı 3', 'digital-license-pro'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget 4', 'digital-license-pro'),
        'id'            => 'footer-4',
        'description'   => __('Footer widget alanı 4', 'digital-license-pro'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'digital_license_pro_widgets_init');

/**
 * Stil ve Script Dosyaları
 */
function digital_license_pro_scripts() {
    // Ana stil dosyası
    wp_enqueue_style('digital-license-pro-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Özel CSS dosyası
    wp_enqueue_style('digital-license-pro-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.0');
    
    // Ana sayfa CSS dosyası
    if (is_front_page()) {
        wp_enqueue_style('digital-license-pro-front-page', get_template_directory_uri() . '/assets/css/front-page.css', array(), '1.0.0');
    }
    
    // Ana JavaScript dosyası
    wp_enqueue_script('digital-license-pro-script', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), '1.0.0', true);
    
    // Özel JavaScript dosyası
    wp_enqueue_script('digital-license-pro-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0.0', true);
    
    // AJAX için gerekli değişkenler
    wp_localize_script('digital-license-pro-script', 'dlp_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('dlp_nonce'),
        'home_url' => home_url(),
        'theme_url' => get_template_directory_uri(),
    ));
    
    // Yorumlar için script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'digital_license_pro_scripts');

/**
 * Fallback Menü
 */
function digital_license_pro_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . home_url('/') . '">Ana Sayfa</a></li>';
    echo '<li><a href="' . get_permalink(get_option('woocommerce_shop_page_id')) . '">Ürünler</a></li>';
    echo '<li><a href="' . get_permalink(get_option('woocommerce_myaccount_page_id')) . '">Hesabım</a></li>';
    echo '<li><a href="' . get_permalink(get_page_by_path('iletisim')) . '">İletişim</a></li>';
    echo '</ul>';
}

/**
 * WooCommerce Özelleştirmeleri
 */
if (class_exists('WooCommerce')) {
    
    // WooCommerce wrapper'ını kaldır
    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    
    // Özel wrapper ekle
    add_action('woocommerce_before_main_content', 'digital_license_pro_wrapper_start', 10);
    add_action('woocommerce_after_main_content', 'digital_license_pro_wrapper_end', 10);
    
    function digital_license_pro_wrapper_start() {
        echo '<main id="main" class="site-main">';
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col">';
    }
    
    function digital_license_pro_wrapper_end() {
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</main>';
    }
    
    // Sepet sayısını güncelle
    add_filter('woocommerce_add_to_cart_fragments', 'digital_license_pro_cart_count_fragments');
    
    function digital_license_pro_cart_count_fragments($fragments) {
        $fragments['.cart-count'] = '<span class="cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
        return $fragments;
    }
    
    // Ürün sayfası özelleştirmeleri
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 25);
    
    // Ürün listesi özelleştirmeleri
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 15);
    
    // Dijital ürün özellikleri
    add_action('woocommerce_single_product_summary', 'digital_license_pro_product_features', 20);
    
    function digital_license_pro_product_features() {
        global $product;
        
        if ($product->is_downloadable()) {
            echo '<div class="product-features">';
            echo '<h4>Ürün Özellikleri</h4>';
            echo '<ul>';
            echo '<li><i class="fas fa-download"></i> Anında İndirme</li>';
            echo '<li><i class="fas fa-key"></i> Lisans Anahtarı</li>';
            echo '<li><i class="fas fa-shield-alt"></i> Güvenli Ödeme</li>';
            echo '<li><i class="fas fa-headset"></i> 7/24 Destek</li>';
            echo '</ul>';
            echo '</div>';
        }
    }
}

/**
 * Tema Özelleştirici
 */
function digital_license_pro_customize_register($wp_customize) {
    
    // Header Bölümü
    $wp_customize->add_section('dlp_header', array(
        'title' => __('Header Ayarları', 'digital-license-pro'),
        'priority' => 30,
    ));
    
    // Logo
    $wp_customize->add_setting('dlp_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'dlp_logo', array(
        'label' => __('Logo', 'digital-license-pro'),
        'section' => 'dlp_header',
        'settings' => 'dlp_logo',
    )));
    
    // İletişim Bilgileri
    $wp_customize->add_setting('dlp_phone', array(
        'default' => '0539 511 56 32',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('dlp_phone', array(
        'label' => __('Telefon', 'digital-license-pro'),
        'section' => 'dlp_header',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('dlp_email', array(
        'default' => 'info@digitallicensepro.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('dlp_email', array(
        'label' => __('E-posta', 'digital-license-pro'),
        'section' => 'dlp_header',
        'type' => 'email',
    ));
    
    // Renk Ayarları
    $wp_customize->add_section('dlp_colors', array(
        'title' => __('Renk Ayarları', 'digital-license-pro'),
        'priority' => 40,
    ));
    
    $wp_customize->add_setting('dlp_primary_color', array(
        'default' => '#2563eb',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dlp_primary_color', array(
        'label' => __('Ana Renk', 'digital-license-pro'),
        'section' => 'dlp_colors',
    )));
    
    $wp_customize->add_setting('dlp_secondary_color', array(
        'default' => '#7c3aed',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dlp_secondary_color', array(
        'label' => __('İkincil Renk', 'digital-license-pro'),
        'section' => 'dlp_colors',
    )));
    
    // Sosyal Medya
    $wp_customize->add_section('dlp_social', array(
        'title' => __('Sosyal Medya', 'digital-license-pro'),
        'priority' => 50,
    ));
    
    $social_networks = array('facebook', 'twitter', 'instagram', 'youtube', 'telegram');
    
    foreach ($social_networks as $network) {
        $wp_customize->add_setting('dlp_' . $network . '_url', array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control('dlp_' . $network . '_url', array(
            'label' => ucfirst($network) . ' URL',
            'section' => 'dlp_social',
            'type' => 'url',
        ));
    }
}
add_action('customize_register', 'digital_license_pro_customize_register');

/**
 * Özel CSS Ekle
 */
function digital_license_pro_custom_css() {
    $primary_color = get_theme_mod('dlp_primary_color', '#2563eb');
    $secondary_color = get_theme_mod('dlp_secondary_color', '#7c3aed');
    
    $custom_css = "
        :root {
            --primary-color: {$primary_color};
            --secondary-color: {$secondary_color};
        }
    ";
    
    wp_add_inline_style('digital-license-pro-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'digital_license_pro_custom_css');

/**
 * AJAX İşlemleri
 */
add_action('wp_ajax_dlp_theme_toggle', 'digital_license_pro_theme_toggle');
add_action('wp_ajax_nopriv_dlp_theme_toggle', 'digital_license_pro_theme_toggle');

function digital_license_pro_theme_toggle() {
    check_ajax_referer('dlp_nonce', 'nonce');
    
    $current_theme = get_theme_mod('theme_mode', 'light');
    $new_theme = $current_theme === 'light' ? 'dark' : 'light';
    
    set_theme_mod('theme_mode', $new_theme);
    
    wp_send_json_success(array(
        'theme' => $new_theme,
        'message' => 'Tema değiştirildi'
    ));
}

/**
 * Güvenlik Önlemleri
 */
// XML-RPC'yi devre dışı bırak
add_filter('xmlrpc_enabled', '__return_false');

// WordPress sürüm bilgisini gizle
remove_action('wp_head', 'wp_generator');

// Emoji'leri devre dışı bırak
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

/**
 * Performans Optimizasyonları
 */
// Gereksiz meta tag'leri kaldır
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * Özel Post Tipleri
 */
function digital_license_pro_custom_post_types() {
    // Lisans Türleri
    register_post_type('license_type', array(
        'labels' => array(
            'name' => 'Lisans Türleri',
            'singular_name' => 'Lisans Türü',
            'add_new' => 'Yeni Ekle',
            'add_new_item' => 'Yeni Lisans Türü Ekle',
            'edit_item' => 'Lisans Türünü Düzenle',
            'new_item' => 'Yeni Lisans Türü',
            'view_item' => 'Lisans Türünü Görüntüle',
            'search_items' => 'Lisans Türü Ara',
            'not_found' => 'Lisans türü bulunamadı',
            'not_found_in_trash' => 'Çöp kutusunda lisans türü bulunamadı',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-admin-network',
        'rewrite' => array('slug' => 'lisans-turleri'),
    ));
}
add_action('init', 'digital_license_pro_custom_post_types');

/**
 * Özel Taksonomiler
 */
function digital_license_pro_custom_taxonomies() {
    // Lisans Kategorileri
    register_taxonomy('license_category', array('license_type'), array(
        'labels' => array(
            'name' => 'Lisans Kategorileri',
            'singular_name' => 'Lisans Kategorisi',
            'search_items' => 'Kategori Ara',
            'all_items' => 'Tüm Kategoriler',
            'parent_item' => 'Üst Kategori',
            'parent_item_colon' => 'Üst Kategori:',
            'edit_item' => 'Kategoriyi Düzenle',
            'update_item' => 'Kategoriyi Güncelle',
            'add_new_item' => 'Yeni Kategori Ekle',
            'new_item_name' => 'Yeni Kategori Adı',
            'menu_name' => 'Kategoriler',
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'lisans-kategori'),
    ));
}
add_action('init', 'digital_license_pro_custom_taxonomies');

/**
 * Admin Panel Özelleştirmeleri
 */
function digital_license_pro_admin_customizations() {
    // Admin bar'a geliştirici bilgisi ekle
    add_action('admin_bar_menu', 'digital_license_pro_admin_bar_info', 999);
    
    function digital_license_pro_admin_bar_info($wp_admin_bar) {
        $wp_admin_bar->add_node(array(
            'id' => 'developer-info',
            'title' => 'BERAT K - 0539 511 56 32',
            'href' => '#',
        ));
    }
}
add_action('init', 'digital_license_pro_admin_customizations');

/**
 * Güvenlik ve Optimizasyon
 */
// Dosya düzenleme devre dışı
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

// Otomatik güncellemeleri devre dışı bırak
add_filter('automatic_updater_disabled', '__return_true');

// WordPress sürüm kontrolünü devre dışı bırak
remove_action('wp_version_check', 'wp_version_check');
remove_action('admin_init', '_maybe_update_core');

/**
 * Hata Ayıklama
 */
if (WP_DEBUG) {
    // Hata loglarını özel dosyaya yaz
    ini_set('log_errors', 1);
    ini_set('error_log', WP_CONTENT_DIR . '/debug.log');
}

/**
 * Tema Aktivasyon Hook'u
 */
function digital_license_pro_activation() {
    // Varsayılan sayfaları oluştur
    $pages = array(
        'iletisim' => 'İletişim',
        'sss' => 'Sık Sorulan Sorular',
        'nasil-calisir' => 'Nasıl Çalışır?',
        'gizlilik-politikasi' => 'Gizlilik Politikası',
        'kullanim-kosullari' => 'Kullanım Koşulları',
        'cerez-politikasi' => 'Çerez Politikası',
    );
    
    foreach ($pages as $slug => $title) {
        if (!get_page_by_path($slug)) {
            wp_insert_post(array(
                'post_title' => $title,
                'post_name' => $slug,
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_content' => 'Bu sayfa içeriği yönetim panelinden düzenlenebilir.',
            ));
        }
    }
    
    // Varsayılan menüyü oluştur
    $menu_name = 'Ana Menü';
    $menu_exists = wp_get_nav_menu_object($menu_name);
    
    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);
        
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => 'Ana Sayfa',
            'menu-item-url' => home_url('/'),
            'menu-item-status' => 'publish',
        ));
        
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => 'Ürünler',
            'menu-item-url' => get_permalink(get_option('woocommerce_shop_page_id')),
            'menu-item-status' => 'publish',
        ));
        
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => 'İletişim',
            'menu-item-url' => get_permalink(get_page_by_path('iletisim')),
            'menu-item-status' => 'publish',
        ));
        
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}
add_action('after_switch_theme', 'digital_license_pro_activation');