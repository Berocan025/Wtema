<?php
/**
 * Digital License Pro - Admin Panel
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
 * Admin Panel Sınıfı
 */
class DigitalLicensePro_Admin {
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'init_settings'));
        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
        add_action('wp_ajax_save_theme_settings', array($this, 'save_theme_settings'));
        add_action('wp_ajax_reset_theme_settings', array($this, 'reset_theme_settings'));
    }
    
    /**
     * Admin menüsü ekle
     */
    public function add_admin_menu() {
        add_menu_page(
            'Digital License Pro',
            'DLP Tema',
            'manage_options',
            'digital-license-pro',
            array($this, 'admin_page'),
            'dashicons-admin-customizer',
            30
        );
        
        add_submenu_page(
            'digital-license-pro',
            'Genel Ayarlar',
            'Genel Ayarlar',
            'manage_options',
            'digital-license-pro',
            array($this, 'admin_page')
        );
        
        add_submenu_page(
            'digital-license-pro',
            'Görsel Ayarlar',
            'Görsel Ayarlar',
            'manage_options',
            'dlp-visual-settings',
            array($this, 'visual_settings_page')
        );
        
        add_submenu_page(
            'digital-license-pro',
            'Hero Bölümü',
            'Hero Bölümü',
            'manage_options',
            'dlp-hero-settings',
            array($this, 'hero_settings_page')
        );
        
        add_submenu_page(
            'digital-license-pro',
            'Ürün Ayarları',
            'Ürün Ayarları',
            'manage_options',
            'dlp-product-settings',
            array($this, 'product_settings_page')
        );
        
        add_submenu_page(
            'digital-license-pro',
            'Güvenlik Ayarları',
            'Güvenlik Ayarları',
            'manage_options',
            'dlp-security-settings',
            array($this, 'security_settings_page')
        );
        
        add_submenu_page(
            'digital-license-pro',
            'Performans',
            'Performans',
            'manage_options',
            'dlp-performance',
            array($this, 'performance_page')
        );
        
        add_submenu_page(
            'digital-license-pro',
            'Yardım & Destek',
            'Yardım & Destek',
            'manage_options',
            'dlp-help-support',
            array($this, 'help_support_page')
        );
    }
    
    /**
     * Admin scriptleri
     */
    public function admin_scripts($hook) {
        if (strpos($hook, 'digital-license-pro') !== false) {
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script('wp-color-picker');
            wp_enqueue_media();
            
            wp_enqueue_style('dlp-admin-style', get_template_directory_uri() . '/assets/css/admin.css', array(), '1.0.0');
            wp_enqueue_script('dlp-admin-script', get_template_directory_uri() . '/assets/js/admin.js', array('jquery', 'wp-color-picker'), '1.0.0', true);
            
            wp_localize_script('dlp-admin-script', 'dlp_admin', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('dlp_admin_nonce'),
                'strings' => array(
                    'saving' => 'Kaydediliyor...',
                    'saved' => 'Ayarlar kaydedildi!',
                    'error' => 'Bir hata oluştu!',
                    'confirm_reset' => 'Tüm ayarları sıfırlamak istediğinizden emin misiniz?'
                )
            ));
        }
    }
    
    /**
     * Ayarları başlat
     */
    public function init_settings() {
        register_setting('dlp_theme_options', 'dlp_theme_settings', array($this, 'sanitize_settings'));
        
        // Genel Ayarlar
        add_settings_section('dlp_general_section', 'Genel Ayarlar', array($this, 'general_section_callback'), 'dlp_theme_options');
        
        add_settings_field('site_logo', 'Site Logo', array($this, 'logo_field_callback'), 'dlp_theme_options', 'dlp_general_section');
        add_settings_field('site_favicon', 'Favicon', array($this, 'favicon_field_callback'), 'dlp_theme_options', 'dlp_general_section');
        add_settings_field('company_name', 'Şirket Adı', array($this, 'text_field_callback'), 'dlp_theme_options', 'dlp_general_section');
        add_settings_field('company_phone', 'Telefon', array($this, 'text_field_callback'), 'dlp_theme_options', 'dlp_general_section');
        add_settings_field('company_email', 'E-posta', array($this, 'email_field_callback'), 'dlp_theme_options', 'dlp_general_section');
        add_settings_field('company_address', 'Adres', array($this, 'textarea_field_callback'), 'dlp_theme_options', 'dlp_general_section');
        
        // Renk Ayarları
        add_settings_section('dlp_colors_section', 'Renk Ayarları', array($this, 'colors_section_callback'), 'dlp_theme_options');
        
        add_settings_field('primary_color', 'Ana Renk', array($this, 'color_field_callback'), 'dlp_theme_options', 'dlp_colors_section');
        add_settings_field('secondary_color', 'İkincil Renk', array($this, 'color_field_callback'), 'dlp_theme_options', 'dlp_colors_section');
        add_settings_field('accent_color', 'Vurgu Rengi', array($this, 'color_field_callback'), 'dlp_theme_options', 'dlp_colors_section');
        
        // Sosyal Medya
        add_settings_section('dlp_social_section', 'Sosyal Medya', array($this, 'social_section_callback'), 'dlp_theme_options');
        
        add_settings_field('facebook_url', 'Facebook URL', array($this, 'url_field_callback'), 'dlp_theme_options', 'dlp_social_section');
        add_settings_field('twitter_url', 'Twitter URL', array($this, 'url_field_callback'), 'dlp_theme_options', 'dlp_social_section');
        add_settings_field('instagram_url', 'Instagram URL', array($this, 'url_field_callback'), 'dlp_theme_options', 'dlp_social_section');
        add_settings_field('linkedin_url', 'LinkedIn URL', array($this, 'url_field_callback'), 'dlp_theme_options', 'dlp_social_section');
        add_settings_field('youtube_url', 'YouTube URL', array($this, 'url_field_callback'), 'dlp_theme_options', 'dlp_social_section');
    }
    
    /**
     * Ana admin sayfası
     */
    public function admin_page() {
        $settings = get_option('dlp_theme_settings', array());
        ?>
        <div class="wrap dlp-admin-wrap">
            <div class="dlp-admin-header">
                <div class="dlp-admin-header-content">
                    <h1>
                        <i class="dashicons dashicons-admin-customizer"></i>
                        Digital License Pro - Tema Ayarları
                    </h1>
                    <p>Profesyonel dijital lisans satış teması yönetim paneli</p>
                </div>
                <div class="dlp-admin-header-actions">
                    <button type="button" class="button button-primary" id="save-all-settings">
                        <i class="dashicons dashicons-saved"></i>
                        Tüm Ayarları Kaydet
                    </button>
                    <button type="button" class="button button-secondary" id="reset-settings">
                        <i class="dashicons dashicons-update"></i>
                        Sıfırla
                    </button>
                </div>
            </div>
            
            <div class="dlp-admin-content">
                <div class="dlp-admin-sidebar">
                    <div class="dlp-admin-nav">
                        <a href="#general" class="dlp-nav-item active" data-tab="general">
                            <i class="dashicons dashicons-admin-generic"></i>
                            Genel Ayarlar
                        </a>
                        <a href="#colors" class="dlp-nav-item" data-tab="colors">
                            <i class="dashicons dashicons-art"></i>
                            Renk Ayarları
                        </a>
                        <a href="#social" class="dlp-nav-item" data-tab="social">
                            <i class="dashicons dashicons-share"></i>
                            Sosyal Medya
                        </a>
                        <a href="#hero" class="dlp-nav-item" data-tab="hero">
                            <i class="dashicons dashicons-align-wide"></i>
                            Hero Bölümü
                        </a>
                        <a href="#products" class="dlp-nav-item" data-tab="products">
                            <i class="dashicons dashicons-cart"></i>
                            Ürün Ayarları
                        </a>
                        <a href="#security" class="dlp-nav-item" data-tab="security">
                            <i class="dashicons dashicons-shield"></i>
                            Güvenlik
                        </a>
                        <a href="#performance" class="dlp-nav-item" data-tab="performance">
                            <i class="dashicons dashicons-performance"></i>
                            Performans
                        </a>
                    </div>
                    
                    <div class="dlp-admin-info">
                        <h3>Hızlı İstatistikler</h3>
                        <div class="dlp-stats">
                            <div class="dlp-stat-item">
                                <span class="dlp-stat-number"><?php echo $this->get_product_count(); ?></span>
                                <span class="dlp-stat-label">Toplam Ürün</span>
                            </div>
                            <div class="dlp-stat-item">
                                <span class="dlp-stat-number"><?php echo $this->get_order_count(); ?></span>
                                <span class="dlp-stat-label">Toplam Sipariş</span>
                            </div>
                            <div class="dlp-stat-item">
                                <span class="dlp-stat-number"><?php echo $this->get_revenue(); ?></span>
                                <span class="dlp-stat-label">Toplam Gelir</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="dlp-admin-main">
                    <form id="dlp-theme-settings-form" method="post">
                        <?php wp_nonce_field('dlp_theme_settings', 'dlp_nonce'); ?>
                        
                        <!-- Genel Ayarlar -->
                        <div class="dlp-tab-content active" id="general-tab">
                            <div class="dlp-tab-header">
                                <h2>Genel Ayarlar</h2>
                                <p>Site genel ayarlarını buradan yönetebilirsiniz.</p>
                            </div>
                            
                            <div class="dlp-settings-grid">
                                <div class="dlp-setting-group">
                                    <h3>Site Bilgileri</h3>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="site_logo">Site Logo</label>
                                        <div class="dlp-media-upload">
                                            <input type="hidden" name="site_logo" id="site_logo" value="<?php echo esc_attr($settings['site_logo'] ?? ''); ?>">
                                            <div class="dlp-media-preview">
                                                <?php if (!empty($settings['site_logo'])) : ?>
                                                    <img src="<?php echo esc_url($settings['site_logo']); ?>" alt="Logo">
                                                <?php else : ?>
                                                    <div class="dlp-media-placeholder">
                                                        <i class="dashicons dashicons-format-image"></i>
                                                        <span>Logo seçin</span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <button type="button" class="button dlp-media-button">Logo Seç</button>
                                            <button type="button" class="button dlp-media-remove" style="display: <?php echo empty($settings['site_logo']) ? 'none' : 'inline-block'; ?>">Kaldır</button>
                                        </div>
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="company_name">Şirket Adı</label>
                                        <input type="text" name="company_name" id="company_name" value="<?php echo esc_attr($settings['company_name'] ?? ''); ?>" class="regular-text">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="company_phone">Telefon</label>
                                        <input type="tel" name="company_phone" id="company_phone" value="<?php echo esc_attr($settings['company_phone'] ?? ''); ?>" class="regular-text">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="company_email">E-posta</label>
                                        <input type="email" name="company_email" id="company_email" value="<?php echo esc_attr($settings['company_email'] ?? ''); ?>" class="regular-text">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="company_address">Adres</label>
                                        <textarea name="company_address" id="company_address" rows="3" class="large-text"><?php echo esc_textarea($settings['company_address'] ?? ''); ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="dlp-setting-group">
                                    <h3>İletişim Bilgileri</h3>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="support_phone">Destek Telefonu</label>
                                        <input type="tel" name="support_phone" id="support_phone" value="<?php echo esc_attr($settings['support_phone'] ?? ''); ?>" class="regular-text">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="support_email">Destek E-posta</label>
                                        <input type="email" name="support_email" id="support_email" value="<?php echo esc_attr($settings['support_email'] ?? ''); ?>" class="regular-text">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="working_hours">Çalışma Saatleri</label>
                                        <input type="text" name="working_hours" id="working_hours" value="<?php echo esc_attr($settings['working_hours'] ?? '7/24'); ?>" class="regular-text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Renk Ayarları -->
                        <div class="dlp-tab-content" id="colors-tab">
                            <div class="dlp-tab-header">
                                <h2>Renk Ayarları</h2>
                                <p>Tema renklerini özelleştirin.</p>
                            </div>
                            
                            <div class="dlp-settings-grid">
                                <div class="dlp-setting-group">
                                    <h3>Ana Renkler</h3>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="primary_color">Ana Renk</label>
                                        <input type="text" name="primary_color" id="primary_color" value="<?php echo esc_attr($settings['primary_color'] ?? '#2563eb'); ?>" class="dlp-color-picker">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="secondary_color">İkincil Renk</label>
                                        <input type="text" name="secondary_color" id="secondary_color" value="<?php echo esc_attr($settings['secondary_color'] ?? '#7c3aed'); ?>" class="dlp-color-picker">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="accent_color">Vurgu Rengi</label>
                                        <input type="text" name="accent_color" id="accent_color" value="<?php echo esc_attr($settings['accent_color'] ?? '#f59e0b'); ?>" class="dlp-color-picker">
                                    </div>
                                </div>
                                
                                <div class="dlp-setting-group">
                                    <h3>Durum Renkleri</h3>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="success_color">Başarı Rengi</label>
                                        <input type="text" name="success_color" id="success_color" value="<?php echo esc_attr($settings['success_color'] ?? '#10b981'); ?>" class="dlp-color-picker">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="warning_color">Uyarı Rengi</label>
                                        <input type="text" name="warning_color" id="warning_color" value="<?php echo esc_attr($settings['warning_color'] ?? '#f59e0b'); ?>" class="dlp-color-picker">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="danger_color">Hata Rengi</label>
                                        <input type="text" name="danger_color" id="danger_color" value="<?php echo esc_attr($settings['danger_color'] ?? '#ef4444'); ?>" class="dlp-color-picker">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sosyal Medya -->
                        <div class="dlp-tab-content" id="social-tab">
                            <div class="dlp-tab-header">
                                <h2>Sosyal Medya</h2>
                                <p>Sosyal medya hesaplarınızı ekleyin.</p>
                            </div>
                            
                            <div class="dlp-settings-grid">
                                <div class="dlp-setting-group">
                                    <h3>Sosyal Medya Hesapları</h3>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="facebook_url">Facebook URL</label>
                                        <input type="url" name="facebook_url" id="facebook_url" value="<?php echo esc_attr($settings['facebook_url'] ?? ''); ?>" class="regular-text" placeholder="https://facebook.com/yourpage">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="twitter_url">Twitter URL</label>
                                        <input type="url" name="twitter_url" id="twitter_url" value="<?php echo esc_attr($settings['twitter_url'] ?? ''); ?>" class="regular-text" placeholder="https://twitter.com/yourhandle">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="instagram_url">Instagram URL</label>
                                        <input type="url" name="instagram_url" id="instagram_url" value="<?php echo esc_attr($settings['instagram_url'] ?? ''); ?>" class="regular-text" placeholder="https://instagram.com/yourprofile">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="linkedin_url">LinkedIn URL</label>
                                        <input type="url" name="linkedin_url" id="linkedin_url" value="<?php echo esc_attr($settings['linkedin_url'] ?? ''); ?>" class="regular-text" placeholder="https://linkedin.com/company/yourcompany">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="youtube_url">YouTube URL</label>
                                        <input type="url" name="youtube_url" id="youtube_url" value="<?php echo esc_attr($settings['youtube_url'] ?? ''); ?>" class="regular-text" placeholder="https://youtube.com/yourchannel">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Hero Bölümü -->
                        <div class="dlp-tab-content" id="hero-tab">
                            <div class="dlp-tab-header">
                                <h2>Hero Bölümü</h2>
                                <p>Ana sayfa hero bölümünü özelleştirin.</p>
                            </div>
                            
                            <div class="dlp-settings-grid">
                                <div class="dlp-setting-group">
                                    <h3>Hero İçeriği</h3>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="hero_title">Hero Başlığı</label>
                                        <input type="text" name="hero_title" id="hero_title" value="<?php echo esc_attr($settings['hero_title'] ?? 'Orijinal Lisanslar, Anında Teslimat'); ?>" class="large-text">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="hero_subtitle">Hero Alt Başlığı</label>
                                        <input type="text" name="hero_subtitle" id="hero_subtitle" value="<?php echo esc_attr($settings['hero_subtitle'] ?? 'Windows, Office, Adobe ve daha birçok yazılım lisansını güvenle satın alın'); ?>" class="large-text">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="hero_description">Hero Açıklaması</label>
                                        <textarea name="hero_description" id="hero_description" rows="4" class="large-text"><?php echo esc_textarea($settings['hero_description'] ?? 'Anında dijital teslimat ile dakikalar içinde lisansınızı alın. %100 orijinal lisanslar, güvenli ödeme ve 7/24 destek.'); ?></textarea>
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="hero_button_text">Buton Metni</label>
                                        <input type="text" name="hero_button_text" id="hero_button_text" value="<?php echo esc_attr($settings['hero_button_text'] ?? 'Ürünleri İncele'); ?>" class="regular-text">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="hero_button_url">Buton URL</label>
                                        <input type="url" name="hero_button_url" id="hero_button_url" value="<?php echo esc_attr($settings['hero_button_url'] ?? get_permalink(get_option('woocommerce_shop_page_id'))); ?>" class="regular-text">
                                    </div>
                                </div>
                                
                                <div class="dlp-setting-group">
                                    <h3>Hero Görseli</h3>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="hero_image">Hero Görseli</label>
                                        <div class="dlp-media-upload">
                                            <input type="hidden" name="hero_image" id="hero_image" value="<?php echo esc_attr($settings['hero_image'] ?? ''); ?>">
                                            <div class="dlp-media-preview">
                                                <?php if (!empty($settings['hero_image'])) : ?>
                                                    <img src="<?php echo esc_url($settings['hero_image']); ?>" alt="Hero Image">
                                                <?php else : ?>
                                                    <div class="dlp-media-placeholder">
                                                        <i class="dashicons dashicons-format-image"></i>
                                                        <span>Görsel seçin</span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <button type="button" class="button dlp-media-button">Görsel Seç</button>
                                            <button type="button" class="button dlp-media-remove" style="display: <?php echo empty($settings['hero_image']) ? 'none' : 'inline-block'; ?>">Kaldır</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Ürün Ayarları -->
                        <div class="dlp-tab-content" id="products-tab">
                            <div class="dlp-tab-header">
                                <h2>Ürün Ayarları</h2>
                                <p>Ürün sayfası ve lisans ayarlarını yönetin.</p>
                            </div>
                            
                            <div class="dlp-settings-grid">
                                <div class="dlp-setting-group">
                                    <h3>Lisans Ayarları</h3>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="auto_delivery">Otomatik Teslimat</label>
                                        <select name="auto_delivery" id="auto_delivery">
                                            <option value="1" <?php selected($settings['auto_delivery'] ?? '1', '1'); ?>>Aktif</option>
                                            <option value="0" <?php selected($settings['auto_delivery'] ?? '1', '0'); ?>>Pasif</option>
                                        </select>
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="delivery_time">Teslimat Süresi (dakika)</label>
                                        <input type="number" name="delivery_time" id="delivery_time" value="<?php echo esc_attr($settings['delivery_time'] ?? '5'); ?>" min="1" max="60" class="small-text">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="license_validation">Lisans Doğrulama</label>
                                        <select name="license_validation" id="license_validation">
                                            <option value="1" <?php selected($settings['license_validation'] ?? '1', '1'); ?>>Aktif</option>
                                            <option value="0" <?php selected($settings['license_validation'] ?? '1', '0'); ?>>Pasif</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="dlp-setting-group">
                                    <h3>Ürün Görünümü</h3>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="products_per_page">Sayfa Başına Ürün</label>
                                        <input type="number" name="products_per_page" id="products_per_page" value="<?php echo esc_attr($settings['products_per_page'] ?? '12'); ?>" min="4" max="48" class="small-text">
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="show_related_products">Benzer Ürünleri Göster</label>
                                        <select name="show_related_products" id="show_related_products">
                                            <option value="1" <?php selected($settings['show_related_products'] ?? '1', '1'); ?>>Evet</option>
                                            <option value="0" <?php selected($settings['show_related_products'] ?? '1', '0'); ?>>Hayır</option>
                                        </select>
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="related_products_count">Benzer Ürün Sayısı</label>
                                        <input type="number" name="related_products_count" id="related_products_count" value="<?php echo esc_attr($settings['related_products_count'] ?? '4'); ?>" min="2" max="8" class="small-text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Güvenlik -->
                        <div class="dlp-tab-content" id="security-tab">
                            <div class="dlp-tab-header">
                                <h2>Güvenlik Ayarları</h2>
                                <p>Site güvenlik ayarlarını yönetin.</p>
                            </div>
                            
                            <div class="dlp-settings-grid">
                                <div class="dlp-setting-group">
                                    <h3>Güvenlik Önlemleri</h3>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="enable_ssl_notice">SSL Uyarısı</label>
                                        <select name="enable_ssl_notice" id="enable_ssl_notice">
                                            <option value="1" <?php selected($settings['enable_ssl_notice'] ?? '1', '1'); ?>>Aktif</option>
                                            <option value="0" <?php selected($settings['enable_ssl_notice'] ?? '1', '0'); ?>>Pasif</option>
                                        </select>
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="enable_anti_piracy">Korsanlıkla Mücadele</label>
                                        <select name="enable_anti_piracy" id="enable_anti_piracy">
                                            <option value="1" <?php selected($settings['enable_anti_piracy'] ?? '1', '1'); ?>>Aktif</option>
                                            <option value="0" <?php selected($settings['enable_anti_piracy'] ?? '1', '0'); ?>>Pasif</option>
                                        </select>
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="enable_license_verification">Lisans Doğrulama</label>
                                        <select name="enable_license_verification" id="enable_license_verification">
                                            <option value="1" <?php selected($settings['enable_license_verification'] ?? '1', '1'); ?>>Aktif</option>
                                            <option value="0" <?php selected($settings['enable_license_verification'] ?? '1', '0'); ?>>Pasif</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="dlp-setting-group">
                                    <h3>Güven Rozetleri</h3>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="show_security_badges">Güvenlik Rozetlerini Göster</label>
                                        <select name="show_security_badges" id="show_security_badges">
                                            <option value="1" <?php selected($settings['show_security_badges'] ?? '1', '1'); ?>>Evet</option>
                                            <option value="0" <?php selected($settings['show_security_badges'] ?? '1', '0'); ?>>Hayır</option>
                                        </select>
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="show_money_back">Para İade Garantisi</label>
                                        <select name="show_money_back" id="show_money_back">
                                            <option value="1" <?php selected($settings['show_money_back'] ?? '1', '1'); ?>>Evet</option>
                                            <option value="0" <?php selected($settings['show_money_back'] ?? '1', '0'); ?>>Hayır</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Performans -->
                        <div class="dlp-tab-content" id="performance-tab">
                            <div class="dlp-tab-header">
                                <h2>Performans</h2>
                                <p>Site performans ayarlarını yönetin.</p>
                            </div>
                            
                            <div class="dlp-settings-grid">
                                <div class="dlp-setting-group">
                                    <h3>Önbellek Ayarları</h3>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="enable_caching">Önbellek</label>
                                        <select name="enable_caching" id="enable_caching">
                                            <option value="1" <?php selected($settings['enable_caching'] ?? '1', '1'); ?>>Aktif</option>
                                            <option value="0" <?php selected($settings['enable_caching'] ?? '1', '0'); ?>>Pasif</option>
                                        </select>
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="cache_duration">Önbellek Süresi (saat)</label>
                                        <input type="number" name="cache_duration" id="cache_duration" value="<?php echo esc_attr($settings['cache_duration'] ?? '24'); ?>" min="1" max="168" class="small-text">
                                    </div>
                                </div>
                                
                                <div class="dlp-setting-group">
                                    <h3>Görsel Optimizasyonu</h3>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="enable_lazy_loading">Lazy Loading</label>
                                        <select name="enable_lazy_loading" id="enable_lazy_loading">
                                            <option value="1" <?php selected($settings['enable_lazy_loading'] ?? '1', '1'); ?>>Aktif</option>
                                            <option value="0" <?php selected($settings['enable_lazy_loading'] ?? '1', '0'); ?>>Pasif</option>
                                        </select>
                                    </div>
                                    
                                    <div class="dlp-setting-item">
                                        <label for="enable_webp">WebP Desteği</label>
                                        <select name="enable_webp" id="enable_webp">
                                            <option value="1" <?php selected($settings['enable_webp'] ?? '1', '1'); ?>>Aktif</option>
                                            <option value="0" <?php selected($settings['enable_webp'] ?? '1', '0'); ?>>Pasif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * Ayarları temizle
     */
    public function sanitize_settings($input) {
        $sanitized = array();
        
        // Genel ayarlar
        $sanitized['site_logo'] = esc_url_raw($input['site_logo'] ?? '');
        $sanitized['company_name'] = sanitize_text_field($input['company_name'] ?? '');
        $sanitized['company_phone'] = sanitize_text_field($input['company_phone'] ?? '');
        $sanitized['company_email'] = sanitize_email($input['company_email'] ?? '');
        $sanitized['company_address'] = sanitize_textarea_field($input['company_address'] ?? '');
        
        // Renk ayarları
        $sanitized['primary_color'] = sanitize_hex_color($input['primary_color'] ?? '#2563eb');
        $sanitized['secondary_color'] = sanitize_hex_color($input['secondary_color'] ?? '#7c3aed');
        $sanitized['accent_color'] = sanitize_hex_color($input['accent_color'] ?? '#f59e0b');
        
        // Sosyal medya
        $sanitized['facebook_url'] = esc_url_raw($input['facebook_url'] ?? '');
        $sanitized['twitter_url'] = esc_url_raw($input['twitter_url'] ?? '');
        $sanitized['instagram_url'] = esc_url_raw($input['instagram_url'] ?? '');
        $sanitized['linkedin_url'] = esc_url_raw($input['linkedin_url'] ?? '');
        $sanitized['youtube_url'] = esc_url_raw($input['youtube_url'] ?? '');
        
        return $sanitized;
    }
    
    /**
     * AJAX ayar kaydetme
     */
    public function save_theme_settings() {
        check_ajax_referer('dlp_admin_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_die('Yetkisiz erişim');
        }
        
        $settings = $this->sanitize_settings($_POST['settings']);
        update_option('dlp_theme_settings', $settings);
        
        wp_send_json_success('Ayarlar başarıyla kaydedildi');
    }
    
    /**
     * AJAX ayar sıfırlama
     */
    public function reset_theme_settings() {
        check_ajax_referer('dlp_admin_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_die('Yetkisiz erişim');
        }
        
        delete_option('dlp_theme_settings');
        
        wp_send_json_success('Ayarlar sıfırlandı');
    }
    
    /**
     * Ürün sayısını al
     */
    private function get_product_count() {
        if (class_exists('WooCommerce')) {
            $products = wc_get_products(array(
                'limit' => -1,
                'status' => 'publish',
                'return' => 'ids'
            ));
            return count($products);
        }
        return 0;
    }
    
    /**
     * Sipariş sayısını al
     */
    private function get_order_count() {
        if (class_exists('WooCommerce')) {
            $orders = wc_get_orders(array(
                'limit' => -1,
                'status' => array('completed', 'processing'),
                'return' => 'ids'
            ));
            return count($orders);
        }
        return 0;
    }
    
    /**
     * Toplam geliri al
     */
    private function get_revenue() {
        if (class_exists('WooCommerce')) {
            $orders = wc_get_orders(array(
                'limit' => -1,
                'status' => 'completed',
                'return' => 'objects'
            ));
            
            $total = 0;
            foreach ($orders as $order) {
                $total += $order->get_total();
            }
            
            return wc_price($total);
        }
        return wc_price(0);
    }
}

// Admin panelini başlat
new DigitalLicensePro_Admin();