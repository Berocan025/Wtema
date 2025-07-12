<?php
/**
 * Digital License Pro - Ana Sayfa Template
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

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">
                    <span class="highlight">Orijinal Lisanslar</span>
                    <br>Anında Teslimat
                </h1>
                <p class="hero-description">
                    Windows, Office, Adobe ve daha birçok yazılım lisansını güvenle satın alın. 
                    Anında dijital teslimat ile dakikalar içinde lisansınızı alın.
                </p>
                <div class="hero-features">
                    <div class="feature-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>%100 Orijinal</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-bolt"></i>
                        <span>Anında Teslimat</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-headset"></i>
                        <span>7/24 Destek</span>
                    </div>
                </div>
                <div class="hero-actions">
                    <a href="<?php echo get_permalink(get_option('woocommerce_shop_page_id')); ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-cart"></i>
                        Ürünleri İncele
                    </a>
                    <a href="#how-it-works" class="btn btn-secondary btn-lg">
                        <i class="fas fa-play"></i>
                        Nasıl Çalışır?
                    </a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-licenses.png" alt="Dijital Lisanslar">
                </div>
                <div class="trust-badges">
                    <div class="badge">
                        <i class="fas fa-lock"></i>
                        <span>SSL Güvenli</span>
                    </div>
                    <div class="badge">
                        <i class="fas fa-certificate"></i>
                        <span>Orijinal</span>
                    </div>
                    <div class="badge">
                        <i class="fas fa-clock"></i>
                        <span>Anında</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Products -->
<section class="popular-products">
    <div class="container">
        <div class="section-header">
            <h2>Popüler Ürünler</h2>
            <p>En çok tercih edilen yazılım lisansları</p>
        </div>
        
        <div class="product-carousel">
            <?php
            $popular_products = wc_get_featured_product_ids();
            if (empty($popular_products)) {
                $popular_products = wc_get_products(array(
                    'limit' => 8,
                    'status' => 'publish',
                    'orderby' => 'popularity'
                ));
            }
            
            foreach ($popular_products as $product) :
                if (is_numeric($product)) {
                    $product = wc_get_product($product);
                }
                if (!$product) continue;
            ?>
                <div class="product-card">
                    <div class="product-image">
                        <?php if ($product->get_image_id()) : ?>
                            <?php echo wp_get_attachment_image($product->get_image_id(), 'medium'); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png" alt="<?php echo esc_attr($product->get_name()); ?>">
                        <?php endif; ?>
                        
                        <?php if ($product->is_on_sale()) : ?>
                            <div class="sale-badge">
                                <span>İndirim</span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="product-actions">
                            <button class="quick-view-btn" data-product-id="<?php echo $product->get_id(); ?>">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="compare-checkbox" data-product-id="<?php echo $product->get_id(); ?>">
                                <i class="fas fa-balance-scale"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="product-content">
                        <h3 class="product-title">
                            <a href="<?php echo $product->get_permalink(); ?>">
                                <?php echo $product->get_name(); ?>
                            </a>
                        </h3>
                        
                        <div class="product-category">
                            <?php
                            $categories = wc_get_product_category_list($product->get_id());
                            if ($categories) {
                                echo $categories;
                            }
                            ?>
                        </div>
                        
                        <div class="product-rating">
                            <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                            <span class="rating-count">(<?php echo $product->get_review_count(); ?>)</span>
                        </div>
                        
                        <div class="product-price">
                            <?php echo $product->get_price_html(); ?>
                        </div>
                        
                        <div class="license-type-selector">
                            <select>
                                <option value="oem">OEM Lisans</option>
                                <option value="retail">Perakende Lisans</option>
                                <option value="volume">Volume Lisans</option>
                            </select>
                        </div>
                        
                        <div class="license-features">
                            <ul>
                                <li><i class="fas fa-check"></i> Anında İndirme</li>
                                <li><i class="fas fa-check"></i> Lisans Anahtarı</li>
                                <li><i class="fas fa-check"></i> Güvenli Ödeme</li>
                            </ul>
                        </div>
                        
                        <div class="product-actions-bottom">
                            <?php if ($product->is_in_stock()) : ?>
                                <a href="<?php echo $product->add_to_cart_url(); ?>" class="btn btn-primary add_to_cart_button" 
                                   data-product-id="<?php echo $product->get_id(); ?>"
                                   data-product-name="<?php echo esc_attr($product->get_name()); ?>"
                                   data-product-price="<?php echo $product->get_price(); ?>">
                                    <i class="fas fa-shopping-cart"></i>
                                    Sepete Ekle
                                </a>
                            <?php else : ?>
                                <button class="btn btn-secondary" disabled>
                                    <i class="fas fa-times"></i>
                                    Stokta Yok
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- How It Works -->
<section id="how-it-works" class="how-it-works">
    <div class="container">
        <div class="section-header">
            <h2>Nasıl Çalışır?</h2>
            <p>3 basit adımda lisansınızı alın</p>
        </div>
        
        <div class="steps-container">
            <div class="step">
                <div class="step-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3>1. Ürün Seçin</h3>
                <p>İhtiyacınız olan yazılım lisansını kategorilerden seçin veya arama yapın.</p>
            </div>
            
            <div class="step">
                <div class="step-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <h3>2. Güvenli Ödeme</h3>
                <p>SSL şifreleme ile güvenli ödeme yapın. Kredi kartı, PayPal veya banka transferi.</p>
            </div>
            
            <div class="step">
                <div class="step-icon">
                    <i class="fas fa-download"></i>
                </div>
                <h3>3. Anında Teslimat</h3>
                <p>Ödemeniz onaylandıktan sonra lisans anahtarınız anında e-posta ile gönderilir.</p>
            </div>
        </div>
    </div>
</section>

<!-- Trust Indicators -->
<section class="trust-indicators">
    <div class="container">
        <div class="trust-grid">
            <div class="trust-item">
                <div class="trust-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="trust-number trust-counter" data-count="15000">0</div>
                <div class="trust-label">Mutlu Müşteri</div>
            </div>
            
            <div class="trust-item">
                <div class="trust-icon">
                    <i class="fas fa-key"></i>
                </div>
                <div class="trust-number trust-counter" data-count="50000">0</div>
                <div class="trust-label">Satılan Lisans</div>
            </div>
            
            <div class="trust-item">
                <div class="trust-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="trust-number trust-counter" data-count="98">0</div>
                <div class="trust-label">% Müşteri Memnuniyeti</div>
            </div>
            
            <div class="trust-item">
                <div class="trust-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="trust-number trust-counter" data-count="24">0</div>
                <div class="trust-label">Saat Destek</div>
            </div>
        </div>
    </div>
</section>

<!-- Customer Reviews -->
<section class="customer-reviews">
    <div class="container">
        <div class="section-header">
            <h2>Müşteri Yorumları</h2>
            <p>Müşterilerimizin deneyimleri</p>
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
                    <p>"Windows 11 Pro lisansını aldım, gerçekten çok hızlı teslimat. Lisans anahtarı hemen geldi ve sorunsuz çalışıyor."</p>
                    <div class="review-author">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar1.jpg" alt="Müşteri">
                        <div>
                            <strong>Ahmet Yılmaz</strong>
                            <span>Windows 11 Pro</span>
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
                    <p>"Office 365 lisansı için tercih ettim. Fiyatlar uygun ve destek ekibi çok yardımcı oldu. Kesinlikle tavsiye ederim."</p>
                    <div class="review-author">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar2.jpg" alt="Müşteri">
                        <div>
                            <strong>Ayşe Demir</strong>
                            <span>Office 365</span>
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
                    <p>"Adobe Creative Suite lisanslarını toplu aldık. Kurumsal müşteri olarak çok memnun kaldık. Hızlı ve güvenilir."</p>
                    <div class="review-author">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar3.jpg" alt="Müşteri">
                        <div>
                            <strong>Mehmet Kaya</strong>
                            <span>Adobe Creative Suite</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="why-choose-us">
    <div class="container">
        <div class="section-header">
            <h2>Neden Bizi Seçmelisiniz?</h2>
            <p>Güvenilir ve profesyonel hizmet</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>%100 Orijinal Lisanslar</h3>
                <p>Tüm lisanslarımız Microsoft, Adobe ve diğer yazılım şirketlerinden orijinal olarak temin edilir.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Anında Dijital Teslimat</h3>
                <p>Ödemeniz onaylandıktan sonra lisans anahtarınız anında e-posta ile gönderilir.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3>7/24 Teknik Destek</h3>
                <p>Kurulum ve aktivasyon konularında uzman ekibimiz size her zaman yardımcı olur.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-undo"></i>
                </div>
                <h3>30 Gün Para İade Garantisi</h3>
                <p>Memnun kalmazsanız 30 gün içinde tam para iadesi garantisi veriyoruz.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h3>SSL Güvenli Ödeme</h3>
                <p>256-bit SSL şifreleme ile güvenli ödeme. Bilgileriniz korunur.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-gift"></i>
                </div>
                <h3>Toplu Alım İndirimleri</h3>
                <p>Çoklu lisans alımlarında özel indirimler ve kurumsal çözümler sunuyoruz.</p>
            </div>
        </div>
    </div>
</section>

<!-- Security Badges -->
<section class="security-badges">
    <div class="container">
        <div class="badges-grid">
            <div class="security-badge">
                <i class="fas fa-lock"></i>
                <span>SSL Güvenli</span>
            </div>
            
            <div class="security-badge">
                <i class="fas fa-certificate"></i>
                <span>Orijinal Lisans</span>
            </div>
            
            <div class="security-badge">
                <i class="fas fa-shield-alt"></i>
                <span>Güvenli Ödeme</span>
            </div>
            
            <div class="security-badge">
                <i class="fas fa-clock"></i>
                <span>Anında Teslimat</span>
            </div>
            
            <div class="security-badge">
                <i class="fas fa-headset"></i>
                <span>7/24 Destek</span>
            </div>
            
            <div class="security-badge">
                <i class="fas fa-undo"></i>
                <span>Para İade Garantisi</span>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <div class="section-header">
            <h2>Sık Sorulan Sorular</h2>
            <p>En çok merak edilen konular</p>
        </div>
        
        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Lisanslar gerçekten orijinal mi?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Evet, tüm lisanslarımız Microsoft, Adobe ve diğer yazılım şirketlerinden orijinal olarak temin edilir. Korsan yazılım satmıyoruz.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Lisans anahtarım ne zaman gelir?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Ödemeniz onaylandıktan sonra lisans anahtarınız anında e-posta adresinize gönderilir. Genellikle 1-5 dakika içinde ulaşır.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Kurulum desteği veriyor musunuz?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Evet, 7/24 teknik destek ekibimiz kurulum ve aktivasyon konularında size yardımcı olur. Canlı destek ve e-posta desteği sunuyoruz.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Para iade garantisi var mı?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Evet, 30 gün para iade garantisi veriyoruz. Memnun kalmazsanız tam para iadesi yapıyoruz.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Toplu alım yapabilir miyim?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Evet, kurumsal müşteriler için toplu alım seçenekleri ve özel indirimler sunuyoruz. İletişime geçin.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Hemen Başlayın</h2>
            <p>Güvenilir ve orijinal yazılım lisansları için hemen alışverişe başlayın.</p>
            <div class="cta-actions">
                <a href="<?php echo get_permalink(get_option('woocommerce_shop_page_id')); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-shopping-cart"></i>
                    Ürünleri İncele
                </a>
                <a href="<?php echo get_permalink(get_page_by_path('iletisim')); ?>" class="btn btn-secondary btn-lg">
                    <i class="fas fa-phone"></i>
                    İletişime Geç
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Modals -->
<div id="quick-view-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ürün Detayı</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- AJAX content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<div id="installation-guide-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kurulum Rehberi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <iframe src="" width="100%" height="500" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

<div id="support-chat-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Canlı Destek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="chat-messages" class="chat-messages">
                    <div class="chat-message agent-message">
                        <div class="message-content">
                            <p>Merhaba! Size nasıl yardımcı olabilirim?</p>
                            <span class="message-time"><?php echo date('H:i'); ?></span>
                        </div>
                    </div>
                </div>
                <form id="chat-form" class="chat-form">
                    <div class="input-group">
                        <input type="text" id="chat-message" class="form-control" placeholder="Mesajınızı yazın..." required>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>