<?php
/**
 * WooCommerce Template Updater
 * 
 * @package DigitalLicensePro
 * @author BERAT K - 0539 511 56 32
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

class Digital_License_Pro_WooCommerce_Updater {
    
    private $wc_version;
    private $theme_templates = array();
    private $wc_templates = array();
    
    public function __construct() {
        $this->wc_version = defined('WC_VERSION') ? WC_VERSION : '0.0.0';
        $this->init();
    }
    
    public function init() {
        add_action('admin_init', array($this, 'check_template_updates'));
        add_action('admin_notices', array($this, 'admin_notices'));
        add_action('wp_ajax_dlp_update_wc_templates', array($this, 'ajax_update_templates'));
    }
    
    /**
     * Template güncellemelerini kontrol et
     */
    public function check_template_updates() {
        if (!class_exists('WooCommerce')) {
            return;
        }
        
        $this->scan_templates();
        $this->check_outdated_templates();
    }
    
    /**
     * Tema template'lerini tara
     */
    private function scan_templates() {
        $theme_template_dir = get_template_directory() . '/woocommerce/';
        
        if (is_dir($theme_template_dir)) {
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($theme_template_dir)
            );
            
            foreach ($files as $file) {
                if ($file->isFile() && $file->getExtension() === 'php') {
                    $relative_path = str_replace($theme_template_dir, '', $file->getPathname());
                    $this->theme_templates[$relative_path] = array(
                        'path' => $file->getPathname(),
                        'modified' => filemtime($file->getPathname()),
                        'size' => filesize($file->getPathname())
                    );
                }
            }
        }
    }
    
    /**
     * Eski template'leri kontrol et
     */
    private function check_outdated_templates() {
        $outdated_templates = array();
        
        foreach ($this->theme_templates as $template => $info) {
            if ($this->is_template_outdated($template)) {
                $outdated_templates[] = $template;
            }
        }
        
        if (!empty($outdated_templates)) {
            update_option('dlp_outdated_wc_templates', $outdated_templates);
        } else {
            delete_option('dlp_outdated_wc_templates');
        }
    }
    
    /**
     * Template'in eski olup olmadığını kontrol et
     */
    private function is_template_outdated($template) {
        $wc_template_path = WC()->plugin_path() . '/templates/' . $template;
        
        if (!file_exists($wc_template_path)) {
            return false;
        }
        
        $wc_modified = filemtime($wc_template_path);
        $theme_modified = $this->theme_templates[$template]['modified'];
        
        // WooCommerce template'i daha yeni ise eski kabul et
        return $wc_modified > $theme_modified;
    }
    
    /**
     * Admin bildirimleri
     */
    public function admin_notices() {
        $outdated_templates = get_option('dlp_outdated_wc_templates', array());
        
        if (!empty($outdated_templates)) {
            echo '<div class="notice notice-warning is-dismissible">';
            echo '<p><strong>Digital License Pro:</strong> Bazı WooCommerce şablon dosyalarınız güncel değil. ';
            echo '<a href="#" class="dlp-update-templates-btn">Şablonları Güncelle</a></p>';
            echo '<div class="dlp-outdated-templates" style="display: none;">';
            echo '<ul>';
            foreach ($outdated_templates as $template) {
                echo '<li>' . esc_html($template) . '</li>';
            }
            echo '</ul>';
            echo '</div>';
            echo '</div>';
            
            // JavaScript ekle
            add_action('admin_footer', array($this, 'admin_scripts'));
        }
    }
    
    /**
     * Admin JavaScript
     */
    public function admin_scripts() {
        ?>
        <script>
        jQuery(document).ready(function($) {
            $('.dlp-update-templates-btn').on('click', function(e) {
                e.preventDefault();
                
                if (confirm('WooCommerce şablonlarını güncellemek istediğinizden emin misiniz? Bu işlem mevcut özelleştirmelerinizi etkileyebilir.')) {
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'dlp_update_wc_templates',
                            nonce: '<?php echo wp_create_nonce('dlp_update_templates'); ?>'
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Şablonlar başarıyla güncellendi!');
                                location.reload();
                            } else {
                                alert('Güncelleme sırasında bir hata oluştu: ' + response.data);
                            }
                        },
                        error: function() {
                            alert('Güncelleme sırasında bir hata oluştu.');
                        }
                    });
                }
            });
            
            $('.dlp-update-templates-btn').on('click', function() {
                $('.dlp-outdated-templates').toggle();
            });
        });
        </script>
        <?php
    }
    
    /**
     * AJAX template güncelleme
     */
    public function ajax_update_templates() {
        check_ajax_referer('dlp_update_templates', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_die('Yetkiniz yok.');
        }
        
        $outdated_templates = get_option('dlp_outdated_wc_templates', array());
        $updated_count = 0;
        $errors = array();
        
        foreach ($outdated_templates as $template) {
            if ($this->update_template($template)) {
                $updated_count++;
            } else {
                $errors[] = $template;
            }
        }
        
        if (empty($errors)) {
            delete_option('dlp_outdated_wc_templates');
            wp_send_json_success(array(
                'message' => sprintf('%d şablon başarıyla güncellendi.', $updated_count)
            ));
        } else {
            wp_send_json_error(array(
                'message' => sprintf('%d şablon güncellendi, %d şablon güncellenemedi.', $updated_count, count($errors)),
                'errors' => $errors
            ));
        }
    }
    
    /**
     * Tekil template güncelleme
     */
    private function update_template($template) {
        $wc_template_path = WC()->plugin_path() . '/templates/' . $template;
        $theme_template_path = get_template_directory() . '/woocommerce/' . $template;
        
        if (!file_exists($wc_template_path)) {
            return false;
        }
        
        // Tema dizinini oluştur
        $theme_template_dir = dirname($theme_template_path);
        if (!is_dir($theme_template_dir)) {
            wp_mkdir_p($theme_template_dir);
        }
        
        // Dosyayı kopyala
        $result = copy($wc_template_path, $theme_template_path);
        
        if ($result) {
            // Dosya izinlerini ayarla
            chmod($theme_template_path, 0644);
            
            // Özel özellikleri geri ekle (eğer varsa)
            $this->restore_custom_features($template, $theme_template_path);
        }
        
        return $result;
    }
    
    /**
     * Özel özellikleri geri ekle
     */
    private function restore_custom_features($template, $template_path) {
        $custom_features_file = get_template_directory() . '/inc/custom-features/' . $template . '.php';
        
        if (file_exists($custom_features_file)) {
            $custom_features = file_get_contents($custom_features_file);
            $template_content = file_get_contents($template_path);
            
            // Özel özellikleri template'e ekle
            $updated_content = $this->merge_custom_features($template_content, $custom_features);
            
            file_put_contents($template_path, $updated_content);
        }
    }
    
    /**
     * Özel özellikleri birleştir
     */
    private function merge_custom_features($template_content, $custom_features) {
        // Basit birleştirme - daha gelişmiş bir sistem için geliştirilebilir
        $marker = '<?php do_action(\'woocommerce_after_single_product\'); ?>';
        
        if (strpos($template_content, $marker) !== false) {
            return str_replace($marker, $custom_features . "\n" . $marker, $template_content);
        }
        
        return $template_content . "\n" . $custom_features;
    }
    
    /**
     * Template durumunu kontrol et
     */
    public function get_template_status() {
        $outdated_templates = get_option('dlp_outdated_wc_templates', array());
        
        return array(
            'wc_version' => $this->wc_version,
            'theme_templates_count' => count($this->theme_templates),
            'outdated_templates_count' => count($outdated_templates),
            'outdated_templates' => $outdated_templates,
            'last_check' => get_option('dlp_last_template_check', 0)
        );
    }
}

// Sınıfı başlat
new Digital_License_Pro_WooCommerce_Updater();