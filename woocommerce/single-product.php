<?php
/**
 * Digital License Pro - WooCommerce Single Product Template
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

<main id="main" class="site-main">
    <div class="container">
        <div class="row">
            <div class="col">
                <?php while (have_posts()) : the_post(); ?>
                    <?php global $product; ?>
                    
                    <div class="product-single">
                        <!-- Breadcrumb -->
                        <nav class="breadcrumb-nav">
                            <?php woocommerce_breadcrumb(); ?>
                        </nav>
                        
                        <div class="product-content-wrapper">
                            <!-- Product Images -->
                            <div class="product-images">
                                <?php
                                /**
                                 * Hook: woocommerce_before_single_product_summary.
                                 *
                                 * @hooked woocommerce_show_product_sale_flash - 10
                                 * @hooked woocommerce_show_product_images - 20
                                 */
                                do_action('woocommerce_before_single_product_summary');
                                ?>
                            </div>
                            
                            <!-- Product Summary -->
                            <div class="product-summary">
                                <div class="product-header">
                                    <h1 class="product-title"><?php the_title(); ?></h1>
                                    
                                    <!-- Product Rating -->
                                    <div class="product-rating">
                                        <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                                        <span class="rating-count">(<?php echo $product->get_review_count(); ?> değerlendirme)</span>
                                    </div>
                                    
                                    <!-- Product Price -->
                                    <div class="product-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>
                                </div>
                                
                                <!-- License Type Selector -->
                                <?php if ($product->is_downloadable()) : ?>
                                    <div class="license-type-section">
                                        <h3>Lisans Türü Seçin</h3>
                                        <div class="license-types">
                                            <div class="license-type" data-type="oem" data-price="<?php echo $product->get_price(); ?>">
                                                <div class="license-type-header">
                                                    <input type="radio" name="license_type" value="oem" id="license_oem" checked>
                                                    <label for="license_oem">
                                                        <strong>OEM Lisans</strong>
                                                        <span class="price"><?php echo wc_price($product->get_price()); ?></span>
                                                    </label>
                                                </div>
                                                <div class="license-features">
                                                    <ul>
                                                        <li><i class="fas fa-check"></i> Tek bilgisayar kullanımı</li>
                                                        <li><i class="fas fa-check"></i> Ömür boyu lisans</li>
                                                        <li><i class="fas fa-check"></i> Microsoft desteği</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <div class="license-type" data-type="retail" data-price="<?php echo $product->get_price() * 1.5; ?>">
                                                <div class="license-type-header">
                                                    <input type="radio" name="license_type" value="retail" id="license_retail">
                                                    <label for="license_retail">
                                                        <strong>Perakende Lisans</strong>
                                                        <span class="price"><?php echo wc_price($product->get_price() * 1.5); ?></span>
                                                    </label>
                                                </div>
                                                <div class="license-features">
                                                    <ul>
                                                        <li><i class="fas fa-check"></i> Transfer edilebilir</li>
                                                        <li><i class="fas fa-check"></i> Ömür boyu lisans</li>
                                                        <li><i class="fas fa-check"></i> Tam destek</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <div class="license-type" data-type="volume" data-price="<?php echo $product->get_price() * 2; ?>">
                                                <div class="license-type-header">
                                                    <input type="radio" name="license_type" value="volume" id="license_volume">
                                                    <label for="license_volume">
                                                        <strong>Volume Lisans</strong>
                                                        <span class="price"><?php echo wc_price($product->get_price() * 2); ?></span>
                                                    </label>
                                                </div>
                                                <div class="license-features">
                                                    <ul>
                                                        <li><i class="fas fa-check"></i> Çoklu lisans</li>
                                                        <li><i class="fas fa-check"></i> Merkezi yönetim</li>
                                                        <li><i class="fas fa-check"></i> Kurumsal destek</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Product Description -->
                                <div class="product-description">
                                    <?php the_content(); ?>
                                </div>
                                
                                <!-- System Requirements -->
                                <?php if ($product->is_downloadable()) : ?>
                                    <div class="system-requirements">
                                        <h3>Sistem Gereksinimleri</h3>
                                        <button class="system-requirements-toggle">
                                            <i class="fas fa-info-circle"></i>
                                            Sistem Gereksinimlerini Göster
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="requirements-content" style="display: none;">
                                            <div class="requirements-grid">
                                                <div class="requirement-item">
                                                    <h4>İşletim Sistemi</h4>
                                                    <p>Windows 10/11 (64-bit)</p>
                                                </div>
                                                <div class="requirement-item">
                                                    <h4>İşlemci</h4>
                                                    <p>1 GHz veya daha hızlı</p>
                                                </div>
                                                <div class="requirement-item">
                                                    <h4>RAM</h4>
                                                    <p>2 GB (32-bit) / 4 GB (64-bit)</p>
                                                </div>
                                                <div class="requirement-item">
                                                    <h4>Disk Alanı</h4>
                                                    <p>En az 20 GB boş alan</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Add to Cart Form -->
                                <div class="add-to-cart-section">
                                    <?php if ($product->is_in_stock()) : ?>
                                        <form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
                                            <?php do_action('woocommerce_before_add_to_cart_button'); ?>
                                            
                                            <?php
                                            do_action('woocommerce_before_add_to_cart_quantity');
                                            
                                            woocommerce_quantity_input(array(
                                                'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                                                'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                                                'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                                            ));
                                            
                                            do_action('woocommerce_after_add_to_cart_quantity');
                                            ?>
                                            
                                            <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button btn btn-primary btn-lg">
                                                <i class="fas fa-shopping-cart"></i>
                                                Sepete Ekle
                                            </button>
                                            
                                            <?php do_action('woocommerce_after_add_to_cart_button'); ?>
                                        </form>
                                    <?php else : ?>
                                        <div class="out-of-stock">
                                            <i class="fas fa-times-circle"></i>
                                            <span>Bu ürün şu anda stokta değil</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Trust Indicators -->
                                <div class="trust-indicators">
                                    <div class="trust-item">
                                        <i class="fas fa-shield-alt"></i>
                                        <span>%100 Orijinal Lisans</span>
                                    </div>
                                    <div class="trust-item">
                                        <i class="fas fa-bolt"></i>
                                        <span>Anında Teslimat</span>
                                    </div>
                                    <div class="trust-item">
                                        <i class="fas fa-headset"></i>
                                        <span>7/24 Destek</span>
                                    </div>
                                    <div class="trust-item">
                                        <i class="fas fa-undo"></i>
                                        <span>30 Gün İade</span>
                                    </div>
                                </div>
                                
                                <!-- Installation Guide -->
                                <?php if ($product->is_downloadable()) : ?>
                                    <div class="installation-guide">
                                        <h3>Kurulum Rehberi</h3>
                                        <p>Lisans anahtarınızı aldıktan sonra kurulum için aşağıdaki rehberi takip edin.</p>
                                        <button class="installation-guide-btn btn btn-secondary" data-guide-url="<?php echo get_template_directory_uri(); ?>/assets/guides/installation-guide.html">
                                            <i class="fas fa-play"></i>
                                            Kurulum Rehberini İzle
                                        </button>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- License Validation -->
                                <div class="license-validation">
                                    <h3>Lisans Doğrulama</h3>
                                    <p>Mevcut bir lisans anahtarınızı doğrulamak için aşağıdaki formu kullanın.</p>
                                    <form class="license-validator">
                                        <div class="input-group">
                                            <input type="text" name="license_key" placeholder="Lisans anahtarınızı girin" required>
                                            <button type="submit" class="btn btn-secondary">
                                                <i class="fas fa-search"></i>
                                                Doğrula
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Product Tabs -->
                        <div class="product-tabs">
                            <?php
                            /**
                             * Hook: woocommerce_after_single_product_summary.
                             *
                             * @hooked woocommerce_output_product_data_tabs - 10
                             * @hooked woocommerce_upsell_display - 15
                             * @hooked woocommerce_output_related_products - 20
                             */
                            do_action('woocommerce_after_single_product_summary');
                            ?>
                        </div>
                        
                        <!-- Related Products -->
                        <div class="related-products">
                            <h3>Benzer Ürünler</h3>
                            <?php
                            $related_products = wc_get_related_products($product->get_id(), 4);
                            if ($related_products) :
                            ?>
                                <div class="products-grid">
                                    <?php foreach ($related_products as $related_product) :
                                        $related_product = wc_get_product($related_product);
                                        if (!$related_product) continue;
                                    ?>
                                        <div class="product-card">
                                            <div class="product-image">
                                                <a href="<?php echo $related_product->get_permalink(); ?>">
                                                    <?php echo $related_product->get_image('medium'); ?>
                                                </a>
                                            </div>
                                            <div class="product-content">
                                                <h4 class="product-title">
                                                    <a href="<?php echo $related_product->get_permalink(); ?>">
                                                        <?php echo $related_product->get_name(); ?>
                                                    </a>
                                                </h4>
                                                <div class="product-price">
                                                    <?php echo $related_product->get_price_html(); ?>
                                                </div>
                                                <a href="<?php echo $related_product->add_to_cart_url(); ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-shopping-cart"></i>
                                                    Sepete Ekle
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>