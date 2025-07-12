<?php
/**
 * WooCommerce Test File
 * 
 * @package DigitalLicensePro
 * @author BERAT K - 0539 511 56 32
 * @version 1.0.0
 */

// WordPress yükle
require_once('wp-config.php');

// WooCommerce kontrolü
echo "<h1>WooCommerce Durum Kontrolü</h1>";

// WooCommerce yüklü mü?
if (class_exists('WooCommerce')) {
    echo "<p style='color: green;'>✅ WooCommerce yüklü ve aktif</p>";
    
    // WooCommerce sürümü
    if (defined('WC_VERSION')) {
        echo "<p>WooCommerce Sürümü: " . WC_VERSION . "</p>";
    }
    
    // wc_get_products fonksiyonu var mı?
    if (function_exists('wc_get_products')) {
        echo "<p style='color: green;'>✅ wc_get_products fonksiyonu mevcut</p>";
        
        // Ürün sayısını kontrol et
        $products = wc_get_products(array(
            'limit' => -1,
            'status' => 'publish',
            'return' => 'ids'
        ));
        
        echo "<p>Toplam Ürün Sayısı: " . count($products) . "</p>";
        
        if (!empty($products)) {
            echo "<p style='color: green;'>✅ Ürünler mevcut</p>";
            echo "<ul>";
            foreach (array_slice($products, 0, 5) as $product_id) {
                $product = wc_get_product($product_id);
                if ($product) {
                    echo "<li>" . $product->get_name() . " (ID: " . $product_id . ")</li>";
                }
            }
            echo "</ul>";
        } else {
            echo "<p style='color: orange;'>⚠️ Henüz ürün eklenmemiş</p>";
        }
        
    } else {
        echo "<p style='color: red;'>❌ wc_get_products fonksiyonu mevcut değil</p>";
    }
    
    // wc_get_featured_product_ids fonksiyonu var mı?
    if (function_exists('wc_get_featured_product_ids')) {
        echo "<p style='color: green;'>✅ wc_get_featured_product_ids fonksiyonu mevcut</p>";
    } else {
        echo "<p style='color: orange;'>⚠️ wc_get_featured_product_ids fonksiyonu mevcut değil (otomatik oluşturulacak)</p>";
    }
    
} else {
    echo "<p style='color: red;'>❌ WooCommerce yüklü değil</p>";
    echo "<p>Lütfen WooCommerce eklentisini yükleyin ve etkinleştirin.</p>";
}

// PHP sürümü
echo "<h2>Sistem Bilgileri</h2>";
echo "<p>PHP Sürümü: " . PHP_VERSION . "</p>";
echo "<p>WordPress Sürümü: " . get_bloginfo('version') . "</p>";

// Tema bilgileri
$theme = wp_get_theme();
echo "<p>Tema: " . $theme->get('Name') . " v" . $theme->get('Version') . "</p>";
?>