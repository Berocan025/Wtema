<?php
/**
 * Debug Durum Kontrolü
 */

// WordPress yükle
require_once('wp-config.php');

echo "<h1>Debug Durum Kontrolü</h1>";

// Debug ayarları
echo "<h2>Debug Ayarları</h2>";
echo "<p>WP_DEBUG: " . (defined('WP_DEBUG') ? (WP_DEBUG ? 'Açık' : 'Kapalı') : 'Tanımlanmamış') . "</p>";
echo "<p>WP_DEBUG_DISPLAY: " . (defined('WP_DEBUG_DISPLAY') ? (WP_DEBUG_DISPLAY ? 'Açık' : 'Kapalı') : 'Tanımlanmamış') . "</p>";
echo "<p>display_errors: " . (ini_get('display_errors') ? 'Açık' : 'Kapalı') . "</p>";
echo "<p>display_startup_errors: " . (ini_get('display_startup_errors') ? 'Açık' : 'Kapalı') . "</p>";

// WooCommerce durumu
echo "<h2>WooCommerce Durumu</h2>";
echo "<p>WooCommerce Yüklü: " . (class_exists('WooCommerce') ? 'Evet' : 'Hayır') . "</p>";

if (class_exists('WooCommerce')) {
    echo "<p>WooCommerce Sürümü: " . WC_VERSION . "</p>";
    echo "<p>wc_get_products fonksiyonu: " . (function_exists('wc_get_products') ? 'Mevcut' : 'Mevcut değil') . "</p>";
}

// Tema durumu
echo "<h2>Tema Durumu</h2>";
$theme = wp_get_theme();
echo "<p>Tema: " . $theme->get('Name') . "</p>";
echo "<p>Sürüm: " . $theme->get('Version') . "</p>";

// PHP hata testi
echo "<h2>PHP Hata Testi</h2>";
echo "<p>Test mesajı - eğer bu görünüyorsa PHP çalışıyor</p>";

// Basit hata testi
$test_array = array();
echo "<p>Array test: " . $test_array[0] . "</p>";
?>