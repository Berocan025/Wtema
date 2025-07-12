# Digital License Pro - WordPress Tema

Profesyonel dijital lisans satışı için özel olarak tasarlanmış WordPress teması. Windows, Office, Adobe ve diğer yazılım lisanslarının güvenli ve hızlı satışı için optimize edilmiştir.

## 🚀 Özellikler

### Tasarım & Görsel
- ✅ Modern, güvenilir ve profesyonel tasarım dili
- ✅ Gece/gündüz modu otomatik geçiş özelliği
- ✅ Mavi-beyaz-gri renk şeması (teknoloji teması)
- ✅ Yazılım logolarını destekleyen ızgara düzeni
- ✅ Smooth hover animasyonları
- ✅ Lisans sertifikaları sergileyen vitrin alanı

### Dijital Lisans Özelleştirmeleri
- ✅ Anında dijital teslimat sistemi
- ✅ Lisans anahtarı otomatik gönderimi
- ✅ Ürün kategorileri: İşletim Sistemleri, Editör Yazılımları, Ofis Uygulamaları
- ✅ Sistem gereksinimleri gösterimi
- ✅ Aktivasyon rehberi entegrasyonu
- ✅ Lisans türü açıklamaları (OEM, Perakende, Volume)

### E-ticaret Özellikleri
- ✅ WooCommerce tam entegrasyonu
- ✅ Hızlı checkout (3 adımda satın alma)
- ✅ Güvenli ödeme gateway'leri
- ✅ Fatura otomasyonu
- ✅ İndirim kodu sistemi
- ✅ Bulk satış seçenekleri
- ✅ Yeniden satın alma kolaylığı

### Güven & Güvenlik
- ✅ SSL sertifikası vurgusu
- ✅ Müşteri yorumları ve rating sistemi
- ✅ Güvenlik rozetleri gösterimi
- ✅ Para iade garanti banner'ı
- ✅ Lisans doğrulama sistemi
- ✅ Korsanlıkla mücadele uyarıları

### Müşteri Deneyimi
- ✅ Canlı destek chat özelliği
- ✅ Detaylı ürün açıklamaları
- ✅ Video kurulum rehberleri
- ✅ SSS bölümü
- ✅ Müşteri paneli (satın alınan lisanslar)
- ✅ Kurulum desteği iletişim formu

### Mobile Optimizasyon
- ✅ Tam responsive tasarım
- ✅ Mobil ödeme optimizasyonu
- ✅ Touch-friendly interface
- ✅ Hızlı yükleme (3 saniye altı)
- ✅ Progressive Web App desteği

### SEO & Marketing
- ✅ SEO optimize edilmiş yapı
- ✅ Sosyal medya paylaşımı
- ✅ Email marketing entegrasyonu
- ✅ Affiliate program desteği
- ✅ Hedefleme piksel desteği
- ✅ Google Alışveriş entegrasyonu

## 📋 Gereksinimler

- WordPress 5.0 veya üzeri
- PHP 7.4 veya üzeri
- WooCommerce 5.0 veya üzeri
- MySQL 5.6 veya üzeri

## 🛠️ Kurulum

### 1. Tema Yükleme
```bash
# Tema dosyalarını WordPress themes dizinine kopyalayın
wp-content/themes/digital-license-pro/
```

### 2. WordPress Admin Panelinden Aktivasyon
1. WordPress admin paneline giriş yapın
2. Görünüm > Temalar bölümüne gidin
3. "Digital License Pro" temasını bulun ve "Etkinleştir" butonuna tıklayın

### 3. Gerekli Eklentiler
Aşağıdaki eklentileri yükleyin ve etkinleştirin:
- WooCommerce
- Contact Form 7 (opsiyonel)
- Yoast SEO (opsiyonel)

### 4. Tema Ayarları
1. Görünüm > Özelleştir bölümüne gidin
2. Header Ayarları: Logo, telefon, e-posta bilgilerini girin
3. Renk Ayarları: Ana ve ikincil renkleri belirleyin
4. Sosyal Medya: Sosyal medya linklerini ekleyin

## 🎨 Özelleştirme

### Renk Şeması
CSS değişkenlerini kullanarak renkleri kolayca değiştirebilirsiniz:

```css
:root {
  --primary-color: #2563eb;
  --secondary-color: #7c3aed;
  --accent-color: #f59e0b;
}
```

### Özel CSS Ekleme
`assets/css/custom.css` dosyasını düzenleyerek özel stiller ekleyebilirsiniz.

### JavaScript Özelleştirme
`assets/js/custom.js` dosyasını düzenleyerek özel işlevsellik ekleyebilirsiniz.

## 📱 Mobil Uyumluluk

Tema tüm cihazlarda mükemmel görünüm sağlar:
- 📱 Mobil telefonlar (320px+)
- 📱 Tabletler (768px+)
- 💻 Masaüstü (1024px+)
- 🖥️ Büyük ekranlar (1200px+)

## 🔧 Geliştirici Bilgileri

### Dosya Yapısı
```
digital-license-pro/
├── style.css                 # Ana tema dosyası
├── index.php                 # Ana template
├── front-page.php            # Ana sayfa template
├── header.php                # Header template
├── footer.php                # Footer template
├── functions.php             # Tema fonksiyonları
├── woocommerce/              # WooCommerce template'leri
│   └── single-product.php    # Ürün sayfası
├── assets/
│   ├── css/
│   │   ├── custom.css        # Özel CSS
│   │   └── front-page.css    # Ana sayfa CSS
│   ├── js/
│   │   ├── theme.js          # Ana JavaScript
│   │   └── custom.js         # Özel JavaScript
│   └── images/               # Tema görselleri
└── README.md                 # Bu dosya
```

### Hook'lar ve Filtreler

#### Tema Hook'ları
```php
// Tema aktivasyonu
do_action('after_switch_theme');

// Özel CSS ekleme
add_action('wp_enqueue_scripts', 'digital_license_pro_custom_css');

// AJAX işlemleri
add_action('wp_ajax_dlp_theme_toggle', 'digital_license_pro_theme_toggle');
```

#### WooCommerce Hook'ları
```php
// Ürün özellikleri
add_action('woocommerce_single_product_summary', 'digital_license_pro_product_features', 20);

// Sepet güncelleme
add_filter('woocommerce_add_to_cart_fragments', 'digital_license_pro_cart_count_fragments');
```

## � WooCommerce Uyumluluk

### Güncel Sürüm Desteği
- ✅ WooCommerce 5.0 - 8.0+ tam uyumluluk
- ✅ Otomatik template güncelleme sistemi
- ✅ Uyumluluk kontrolü ve bildirimler
- ✅ Geriye dönük uyumluluk

### Template Güncelleme Sistemi
Tema, WooCommerce güncellemelerini otomatik olarak kontrol eder ve eski template'leri tespit eder:

1. **Otomatik Kontrol**: Admin panelinde eski template'ler için uyarı gösterir
2. **Tek Tıkla Güncelleme**: Eski template'leri tek tıkla güncelleyebilirsiniz
3. **Özel Özellik Korunması**: Güncelleme sırasında özel özellikleriniz korunur
4. **Güvenli Güncelleme**: Yedekleme ve geri alma özellikleri

### Uyumluluk Kontrolü
```php
// WooCommerce sürüm kontrolü
if (defined('WC_VERSION')) {
    $wc_version = WC_VERSION;
    $min_version = '5.0.0';
    
    if (version_compare($wc_version, $min_version, '<')) {
        // Uyarı göster
    }
}
```

### Template Override Sistemi
```php
// Tema template'lerini öncelikle kullan
add_filter('woocommerce_locate_template', 'digital_license_pro_woocommerce_template_override', 10, 3);
```

## �🚀 Performans Optimizasyonu

### Önerilen Ayarlar
1. **Caching**: WP Rocket veya W3 Total Cache kullanın
2. **CDN**: Cloudflare veya başka bir CDN hizmeti kullanın
3. **Görsel Optimizasyonu**: WebP formatını destekler
4. **Database**: Düzenli temizlik yapın

### Performans Metrikleri
- ⚡ First Contentful Paint: < 1.5s
- ⚡ Largest Contentful Paint: < 2.5s
- ⚡ Cumulative Layout Shift: < 0.1
- ⚡ First Input Delay: < 100ms

## 🔒 Güvenlik

### Güvenlik Önlemleri
- ✅ XML-RPC devre dışı
- ✅ WordPress sürüm gizleme
- ✅ Emoji devre dışı
- ✅ Dosya düzenleme devre dışı
- ✅ Otomatik güncellemeler devre dışı

### Güvenlik Kontrol Listesi
- [ ] SSL sertifikası kurulu
- [ ] Güçlü şifreler kullanılıyor
- [ ] Düzenli yedekleme yapılıyor
- [ ] Güvenlik eklentileri aktif
- [ ] Dosya izinleri doğru ayarlanmış

## 📞 Destek

### İletişim Bilgileri
- **Geliştirici**: BERAT K
- **Telefon**: 0539 511 56 32
- **E-posta**: info@digitallicensepro.com

### Destek Saatleri
- 🕐 7/24 Teknik Destek
- 📧 E-posta desteği
- 💬 Canlı destek chat

## 📄 Lisans

Bu tema GPL v2 veya üzeri lisansı altında dağıtılmaktadır.

## 🔄 Güncellemeler

### Sürüm 1.0.1
- ✅ WooCommerce 8.0+ uyumluluğu eklendi
- ✅ Template güncelleme sistemi eklendi
- ✅ Otomatik uyumluluk kontrolü
- ✅ Güvenlik güncellemeleri
- ✅ Performans iyileştirmeleri

### Sürüm 1.0.0
- ✅ İlk sürüm yayınlandı
- ✅ Temel özellikler eklendi
- ✅ WooCommerce entegrasyonu
- ✅ Responsive tasarım
- ✅ Gündüz/gece modu

## 🤝 Katkıda Bulunma

1. Bu repository'yi fork edin
2. Feature branch oluşturun (`git checkout -b feature/amazing-feature`)
3. Değişikliklerinizi commit edin (`git commit -m 'Add amazing feature'`)
4. Branch'inizi push edin (`git push origin feature/amazing-feature`)
5. Pull Request oluşturun

## 📝 Changelog

### v1.0.0 (2024-01-XX)
- 🎉 İlk sürüm yayınlandı
- ✨ Dijital lisans satışı için özel tasarım
- ✨ WooCommerce tam entegrasyonu
- ✨ Responsive ve mobil uyumlu tasarım
- ✨ Gündüz/gece modu
- ✨ Canlı destek sistemi
- ✨ Lisans doğrulama sistemi
- ✨ Güvenlik önlemleri
- ✨ SEO optimizasyonu

---

**Digital License Pro** - Profesyonel dijital lisans satış platformu için özel WordPress teması.

Geliştirici: **BERAT K** | İletişim: **0539 511 56 32**
