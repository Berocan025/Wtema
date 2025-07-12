<?php
/**
 * Front Page Template
 * 
 * @package DigitalLicensePro
 * @author BERAT K - 0539 511 56 32
 * @version 1.0.0
 */

// WooCommerce kontrolü
if (!class_exists('WooCommerce')) {
    wp_die('Bu tema WooCommerce eklentisi gerektirir. Lütfen WooCommerce\'i yükleyin ve etkinleştirin.');
}

get_header(); ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-background">
        <div class="hero-overlay"></div>
        <div class="hero-particles"></div>
    </div>
    
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <i class="fas fa-shield-alt"></i>
                    <span>%100 Orijinal Lisanslar</span>
                </div>
                
                <h1 class="hero-title">
                    <span class="hero-title-line">Orijinal Lisanslar,</span>
                    <span class="hero-title-line highlight">Anında Teslimat</span>
                </h1>
                
                <p class="hero-subtitle">
                    Windows, Office, Adobe ve daha birçok yazılım lisansını güvenle satın alın. 
                    Anında dijital teslimat ile dakikalar içinde lisansınızı alın.
                </p>
                
                <div class="hero-features">
                    <div class="hero-feature">
                        <i class="fas fa-bolt"></i>
                        <span>Anında Teslimat</span>
                    </div>
                    <div class="hero-feature">
                        <i class="fas fa-shield-alt"></i>
                        <span>Güvenli Ödeme</span>
                    </div>
                    <div class="hero-feature">
                        <i class="fas fa-headset"></i>
                        <span>7/24 Destek</span>
                    </div>
                </div>
                
                <div class="hero-actions">
                    <a href="<?php echo get_permalink(get_option('woocommerce_shop_page_id')); ?>" class="btn btn-primary btn-xl hero-btn">
                        <i class="fas fa-shopping-cart"></i>
                        Ürünleri İncele
                    </a>
                    <a href="#how-it-works" class="btn btn-secondary btn-xl hero-btn">
                        <i class="fas fa-play"></i>
                        Nasıl Çalışır?
                    </a>
                </div>
                
                <div class="hero-stats">
                    <div class="hero-stat">
                        <span class="hero-stat-number">10K+</span>
                        <span class="hero-stat-label">Mutlu Müşteri</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">50K+</span>
                        <span class="hero-stat-label">Satılan Lisans</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">99%</span>
                        <span class="hero-stat-label">Müşteri Memnuniyeti</span>
                    </div>
                </div>
            </div>
            
            <div class="hero-visual">
                <div class="hero-image-container">
                    <div class="hero-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-software.png" alt="Software Licenses">
                    </div>
                    <div class="hero-floating-card floating-card-1">
                        <i class="fab fa-windows"></i>
                        <span>Windows 11 Pro</span>
                    </div>
                    <div class="hero-floating-card floating-card-2">
                        <i class="fab fa-microsoft"></i>
                        <span>Office 365</span>
                    </div>
                    <div class="hero-floating-card floating-card-3">
                        <i class="fab fa-adobe"></i>
                        <span>Adobe CC</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="hero-scroll-indicator">
        <div class="scroll-arrow"></div>
        <span>Aşağı Kaydır</span>
    </div>
</section>

<!-- Popular Products Section -->
<section class="popular-products-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Popüler Ürünler</h2>
            <p class="section-subtitle">En çok tercih edilen yazılım lisansları</p>
        </div>
        
        <div class="products-carousel">
            <?php
            // WooCommerce uyumlu ürün sorgusu
            $popular_products = array();
            
            // Önce öne çıkan ürünleri al
            $featured_products = wc_get_products(array(
                'limit' => 6,
                'status' => 'publish',
                'featured' => true,
                'return' => 'ids'
            ));
            
            if (!empty($featured_products)) {
                $popular_products = $featured_products;
            } else {
                // Öne çıkan ürün yoksa popüler ürünleri al
                $popular_products = wc_get_products(array(
                    'limit' => 6,
                    'status' => 'publish',
                    'orderby' => 'popularity',
                    'return' => 'ids'
                ));
            }
            
            // Hala ürün yoksa son eklenen ürünleri al
            if (empty($popular_products)) {
                $popular_products = wc_get_products(array(
                    'limit' => 6,
                    'status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'return' => 'ids'
                ));
            }
            
            if ($popular_products && is_array($popular_products) && !empty($popular_products)) :
                foreach ($popular_products as $product_id) :
                    $product = wc_get_product($product_id);
                    if ($product && $product->is_visible()) :
            ?>
                <div class="product-card">
                    <div class="product-image">
                        <?php echo $product->get_image('medium'); ?>
                        <div class="product-overlay">
                            <a href="<?php echo $product->get_permalink(); ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i>
                                İncele
                            </a>
                        </div>
                    </div>
                    
                    <div class="product-content">
                        <h3 class="product-title">
                            <a href="<?php echo $product->get_permalink(); ?>">
                                <?php echo $product->get_name(); ?>
                            </a>
                        </h3>
                        
                        <div class="product-price">
                            <?php echo $product->get_price_html(); ?>
                        </div>
                        
                        <div class="product-features">
                            <span class="product-feature">
                                <i class="fas fa-download"></i>
                                Anında İndirme
                            </span>
                            <span class="product-feature">
                                <i class="fas fa-key"></i>
                                Lisans Anahtarı
                            </span>
                        </div>
                        
                        <div class="product-actions">
                            <a href="<?php echo $product->add_to_cart_url(); ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-shopping-cart"></i>
                                Sepete Ekle
                            </a>
                        </div>
                    </div>
                </div>
            <?php
                    endif;
                endforeach;
            else :
            ?>
                <div class="no-products-message">
                    <div class="no-products-content">
                        <i class="fas fa-box-open"></i>
                        <h3>Henüz Ürün Eklenmemiş</h3>
                        <p>Mağazanızda henüz ürün bulunmuyor. Admin panelinden ürün ekleyebilirsiniz.</p>
                        <a href="<?php echo admin_url('post-new.php?post_type=product'); ?>" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Ürün Ekle
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="section-actions">
            <a href="<?php echo get_permalink(get_option('woocommerce_shop_page_id')); ?>" class="btn btn-secondary btn-lg">
                Tüm Ürünleri Gör
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" class="how-it-works-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Nasıl Çalışır?</h2>
            <p class="section-subtitle">3 basit adımda lisansınızı alın</p>
        </div>
        
        <div class="steps-container">
            <div class="step-item">
                <div class="step-number">1</div>
                <div class="step-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="step-title">Ürün Seçin</h3>
                <p class="step-description">
                    İhtiyacınız olan yazılım lisansını kategorilerden seçin veya arama yapın.
                </p>
            </div>
            
            <div class="step-item">
                <div class="step-number">2</div>
                <div class="step-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <h3 class="step-title">Güvenle Ödeyin</h3>
                <p class="step-description">
                    SSL korumalı ödeme sistemi ile güvenle ödeme yapın.
                </p>
            </div>
            
            <div class="step-item">
                <div class="step-number">3</div>
                <div class="step-icon">
                    <i class="fas fa-download"></i>
                </div>
                <h3 class="step-title">Anında Alın</h3>
                <p class="step-description">
                    Ödeme tamamlandıktan sonra lisans anahtarınızı anında alın.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Trust Indicators Section -->
<section class="trust-indicators-section">
    <div class="container">
        <div class="trust-grid">
            <div class="trust-item">
                <div class="trust-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="trust-title">SSL Güvenlik</h3>
                <p class="trust-description">
                    256-bit SSL şifreleme ile tüm verileriniz güvende.
                </p>
            </div>
            
            <div class="trust-item">
                <div class="trust-icon">
                    <i class="fas fa-undo"></i>
                </div>
                <h3 class="trust-title">Para İade Garantisi</h3>
                <p class="trust-description">
                    30 gün içinde memnun kalmazsanız paranızı iade ediyoruz.
                </p>
            </div>
            
            <div class="trust-item">
                <div class="trust-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="trust-title">7/24 Destek</h3>
                <p class="trust-description">
                    Canlı destek ile her zaman yanınızdayız.
                </p>
            </div>
            
            <div class="trust-item">
                <div class="trust-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <h3 class="trust-title">Orijinal Lisanslar</h3>
                <p class="trust-description">
                    Tüm lisanslar resmi distribütörlerden gelir.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Customer Reviews Section -->
<section class="customer-reviews-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Müşteri Yorumları</h2>
            <p class="section-subtitle">Müşterilerimizin deneyimleri</p>
        </div>
        
        <div class="reviews-carousel">
            <div class="review-item">
                <div class="review-content">
                    <div class="review-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="review-text">
                        "Çok hızlı ve güvenilir bir hizmet. Windows 11 Pro lisansını 5 dakika içinde aldım. Kesinlikle tavsiye ederim!"
                    </p>
                    <div class="review-author">
                        <div class="review-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="review-info">
                            <h4 class="review-name">Ahmet Yılmaz</h4>
                            <span class="review-date">2 gün önce</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="review-item">
                <div class="review-content">
                    <div class="review-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="review-text">
                        "Office 365 lisansı için mükemmel bir deneyim. Destek ekibi çok yardımcı oldu."
                    </p>
                    <div class="review-author">
                        <div class="review-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="review-info">
                            <h4 class="review-name">Ayşe Demir</h4>
                            <span class="review-date">1 hafta önce</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="review-item">
                <div class="review-content">
                    <div class="review-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="review-text">
                        "Adobe Creative Cloud lisansını çok uygun fiyata aldım. Anında teslimat harika!"
                    </p>
                    <div class="review-author">
                        <div class="review-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="review-info">
                            <h4 class="review-name">Mehmet Kaya</h4>
                            <span class="review-date">3 gün önce</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-choose-us-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Neden Bizi Seçmelisiniz?</h2>
            <p class="section-subtitle">Rakipsiz avantajlarımız</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3 class="feature-title">Anında Teslimat</h3>
                <p class="feature-description">
                    Ödeme tamamlandıktan sonra lisans anahtarınızı dakikalar içinde alın.
                </p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <h3 class="feature-title">En Uygun Fiyatlar</h3>
                <p class="feature-description">
                    Piyasadaki en uygun fiyatlarla kaliteli lisanslar sunuyoruz.
                </p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feature-title">Güvenli Ödeme</h3>
                <p class="feature-description">
                    SSL korumalı ödeme sistemi ile güvenle alışveriş yapın.
                </p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="feature-title">7/24 Destek</h3>
                <p class="feature-description">
                    Canlı destek ile her zaman yanınızdayız.
                </p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <h3 class="feature-title">Orijinal Lisanslar</h3>
                <p class="feature-description">
                    Tüm lisanslar resmi distribütörlerden gelir.
                </p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-undo"></i>
                </div>
                <h3 class="feature-title">Para İade Garantisi</h3>
                <p class="feature-description">
                    30 gün içinde memnun kalmazsanız paranızı iade ediyoruz.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Security Badges Section -->
<section class="security-badges-section">
    <div class="container">
        <div class="security-badges">
            <div class="security-badge">
                <i class="fas fa-lock"></i>
                <span>SSL Güvenlik</span>
            </div>
            <div class="security-badge">
                <i class="fas fa-shield-alt"></i>
                <span>Güvenli Ödeme</span>
            </div>
            <div class="security-badge">
                <i class="fas fa-certificate"></i>
                <span>Orijinal Lisans</span>
            </div>
            <div class="security-badge">
                <i class="fas fa-headset"></i>
                <span>7/24 Destek</span>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Sık Sorulan Sorular</h2>
            <p class="section-subtitle">Merak ettiğiniz soruların cevapları</p>
        </div>
        
        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Lisanslar gerçekten orijinal mi?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Evet, tüm lisanslarımız resmi distribütörlerden gelir ve %100 orijinaldir.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Ne kadar sürede teslimat yapılıyor?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Ödeme tamamlandıktan sonra lisans anahtarınızı 5-10 dakika içinde alırsınız.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Ödeme güvenli mi?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Evet, 256-bit SSL şifreleme ile tüm ödemeleriniz güvenle işlenir.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Para iade garantisi var mı?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Evet, 30 gün içinde memnun kalmazsanız paranızı iade ediyoruz.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Hemen Başlayın</h2>
            <p class="cta-description">
                İhtiyacınız olan yazılım lisansını hemen satın alın ve anında kullanmaya başlayın.
            </p>
            <div class="cta-actions">
                <a href="<?php echo get_permalink(get_option('woocommerce_shop_page_id')); ?>" class="btn btn-primary btn-xl">
                    <i class="fas fa-shopping-cart"></i>
                    Ürünleri İncele
                </a>
                <a href="tel:05395115632" class="btn btn-secondary btn-xl">
                    <i class="fas fa-phone"></i>
                    Bizi Arayın
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Modals -->
<div id="quick-view-modal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <div id="quick-view-content"></div>
    </div>
</div>

<div id="installation-guide-modal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Kurulum Rehberi</h2>
        <div class="installation-steps">
            <div class="step">
                <h3>1. Lisans Anahtarını Alın</h3>
                <p>Satın alma işlemi tamamlandıktan sonra e-posta adresinize lisans anahtarı gönderilecektir.</p>
            </div>
            <div class="step">
                <h3>2. Yazılımı İndirin</h3>
                <p>Resmi web sitesinden yazılımın son sürümünü indirin.</p>
            </div>
            <div class="step">
                <h3>3. Kurulumu Yapın</h3>
                <p>İndirilen dosyayı çalıştırın ve kurulum sihirbazını takip edin.</p>
            </div>
            <div class="step">
                <h3>4. Lisansı Aktive Edin</h3>
                <p>Yazılımı açın ve lisans anahtarınızı girin.</p>
            </div>
        </div>
    </div>
</div>

<div id="support-chat-modal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Canlı Destek</h2>
        <div class="support-chat">
            <div class="chat-messages" id="chat-messages">
                <div class="message bot">
                    <div class="message-content">
                        <p>Merhaba! Size nasıl yardımcı olabilirim?</p>
                    </div>
                    <span class="message-time">Şimdi</span>
                </div>
            </div>
            <div class="chat-input">
                <input type="text" id="chat-input" placeholder="Mesajınızı yazın...">
                <button type="button" id="send-message">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>