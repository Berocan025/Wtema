        </div><!-- #content -->
    </div><!-- #page -->
    
    <!-- Footer -->
    <footer id="colophon" class="site-footer">
        <!-- Footer Widgets -->
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <!-- Company Info -->
                    <div class="col">
                        <div class="footer-widget">
                            <h3 class="widget-title">Digital License Pro</h3>
                            <p>Profesyonel dijital lisans satış platformu. Windows, Office, Adobe ve daha birçok yazılım lisansını güvenle satın alın.</p>
                            
                            <div class="social-links">
                                <a href="#" class="social-link" aria-label="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="social-link" aria-label="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="social-link" aria-label="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="social-link" aria-label="YouTube">
                                    <i class="fab fa-youtube"></i>
                                </a>
                                <a href="#" class="social-link" aria-label="Telegram">
                                    <i class="fab fa-telegram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Links -->
                    <div class="col">
                        <div class="footer-widget">
                            <h3 class="widget-title">Hızlı Linkler</h3>
                            <ul class="footer-links">
                                <li><a href="<?php echo home_url('/'); ?>">Ana Sayfa</a></li>
                                <li><a href="<?php echo get_permalink(get_option('woocommerce_shop_page_id')); ?>">Ürünler</a></li>
                                <li><a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">Hesabım</a></li>
                                <li><a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>">Sepet</a></li>
                                <li><a href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>">Ödeme</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Product Categories -->
                    <div class="col">
                        <div class="footer-widget">
                            <h3 class="widget-title">Ürün Kategorileri</h3>
                            <ul class="footer-links">
                                <li><a href="<?php echo get_term_link('windows', 'product_cat'); ?>">Windows Lisansları</a></li>
                                <li><a href="<?php echo get_term_link('office', 'product_cat'); ?>">Office Lisansları</a></li>
                                <li><a href="<?php echo get_term_link('adobe', 'product_cat'); ?>">Adobe Lisansları</a></li>
                                <li><a href="<?php echo get_term_link('antivirus', 'product_cat'); ?>">Antivirüs Yazılımları</a></li>
                                <li><a href="<?php echo get_term_link('games', 'product_cat'); ?>">Oyun Lisansları</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Support -->
                    <div class="col">
                        <div class="footer-widget">
                            <h3 class="widget-title">Destek</h3>
                            <ul class="footer-links">
                                <li><a href="<?php echo get_permalink(get_page_by_path('iletisim')); ?>">İletişim</a></li>
                                <li><a href="<?php echo get_permalink(get_page_by_path('sss')); ?>">Sık Sorulan Sorular</a></li>
                                <li><a href="<?php echo get_permalink(get_page_by_path('nasil-calisir')); ?>">Nasıl Çalışır?</a></li>
                                <li><a href="<?php echo get_permalink(get_page_by_path('gizlilik-politikasi')); ?>">Gizlilik Politikası</a></li>
                                <li><a href="<?php echo get_permalink(get_page_by_path('kullanim-kosullari')); ?>">Kullanım Koşulları</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Contact Info -->
                    <div class="col">
                        <div class="footer-widget">
                            <h3 class="widget-title">İletişim Bilgileri</h3>
                            <div class="contact-info">
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <div>
                                        <strong>Telefon:</strong>
                                        <a href="tel:+905395115632">0539 511 56 32</a>
                                    </div>
                                </div>
                                
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <div>
                                        <strong>E-posta:</strong>
                                        <a href="mailto:info@digitallicensepro.com">info@digitallicensepro.com</a>
                                    </div>
                                </div>
                                
                                <div class="contact-item">
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <strong>Çalışma Saatleri:</strong>
                                        <span>7/24 Destek</span>
                                    </div>
                                </div>
                                
                                <div class="contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div>
                                        <strong>Adres:</strong>
                                        <span>Türkiye</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="d-flex justify-between align-center">
                    <div class="copyright">
                        <p>&copy; <?php echo date('Y'); ?> <strong>Digital License Pro</strong>. Tüm hakları saklıdır. | 
                        Geliştirici: <strong>BERAT K - 0539 511 56 32</strong></p>
                    </div>
                    
                    <div class="footer-bottom-links">
                        <a href="<?php echo get_permalink(get_page_by_path('gizlilik-politikasi')); ?>">Gizlilik</a>
                        <a href="<?php echo get_permalink(get_page_by_path('kullanim-kosullari')); ?>">Koşullar</a>
                        <a href="<?php echo get_permalink(get_page_by_path('cerez-politikasi')); ?>">Çerezler</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Back to Top Button -->
    <button id="back-to-top" class="back-to-top" aria-label="Yukarı çık">
        <i class="fas fa-chevron-up"></i>
    </button>
    
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="loading-overlay">
        <div class="loading-content">
            <div class="spinner"></div>
            <p>Yükleniyor...</p>
        </div>
    </div>
    
    <!-- Notification Toast -->
    <div id="notification-toast" class="notification-toast">
        <div class="toast-content">
            <i class="toast-icon"></i>
            <span class="toast-message"></span>
            <button class="toast-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    
    <!-- Theme Scripts -->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/theme.js"></script>
    
    <!-- Custom Scripts -->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/custom.js"></script>
    
    <?php wp_footer(); ?>
</body>
</html>