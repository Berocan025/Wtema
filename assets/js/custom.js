/**
 * Digital License Pro - Custom JavaScript
 * 
 * @package DigitalLicensePro
 * @author BERAT K - 0539 511 56 32
 * @version 1.0.0
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        DigitalLicenseProCustom.init();
    });

    // Digital License Pro Custom Object
    var DigitalLicenseProCustom = {
        
        // Initialize
        init: function() {
            this.licenseFeatures();
            this.productShowcase();
            this.trustElements();
            this.customerExperience();
            this.performanceOptimization();
            this.securityFeatures();
            this.mobileOptimization();
            this.seoEnhancement();
            this.liveChat();
            this.affiliateSystem();
        },

        // License Features
        licenseFeatures: function() {
            // License type selector
            $('.license-type-selector').on('change', function() {
                var selectedType = $(this).val();
                var $product = $(this).closest('.product');
                
                // Update price based on license type
                DigitalLicenseProCustom.updateLicensePrice($product, selectedType);
                
                // Update features list
                DigitalLicenseProCustom.updateLicenseFeatures($product, selectedType);
            });

            // System requirements toggle
            $('.system-requirements-toggle').on('click', function(e) {
                e.preventDefault();
                var $requirements = $(this).next('.system-requirements');
                $requirements.slideToggle(300);
                $(this).toggleClass('active');
            });

            // License validation
            $('.license-validator').on('submit', function(e) {
                e.preventDefault();
                var licenseKey = $(this).find('input[name="license_key"]').val();
                DigitalLicenseProCustom.validateLicense(licenseKey);
            });
        },

        // Update License Price
        updateLicensePrice: function($product, licenseType) {
            var prices = {
                'oem': $product.data('price-oem'),
                'retail': $product.data('price-retail'),
                'volume': $product.data('price-volume')
            };
            
            if (prices[licenseType]) {
                $product.find('.price').text(prices[licenseType] + ' ₺');
            }
        },

        // Update License Features
        updateLicenseFeatures: function($product, licenseType) {
            var features = {
                'oem': ['Tek bilgisayar kullanımı', 'Ömür boyu lisans', 'Microsoft desteği'],
                'retail': ['Transfer edilebilir', 'Ömür boyu lisans', 'Tam destek'],
                'volume': ['Çoklu lisans', 'Merkezi yönetim', 'Kurumsal destek']
            };
            
            if (features[licenseType]) {
                var $featuresList = $product.find('.license-features');
                $featuresList.empty();
                
                features[licenseType].forEach(function(feature) {
                    $featuresList.append('<li><i class="fas fa-check"></i> ' + feature + '</li>');
                });
            }
        },

        // Validate License
        validateLicense: function(licenseKey) {
            $.ajax({
                url: dlp_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'dlp_validate_license',
                    nonce: dlp_ajax.nonce,
                    license_key: licenseKey
                },
                success: function(response) {
                    if (response.success) {
                        DigitalLicensePro.showNotification('Lisans geçerli!', 'success');
                    } else {
                        DigitalLicensePro.showNotification('Lisans geçersiz veya süresi dolmuş.', 'error');
                    }
                }
            });
        },

        // Product Showcase
        productShowcase: function() {
            // Product carousel
            $('.product-carousel').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 5000,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            // Product quick view
            $('.quick-view-btn').on('click', function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                DigitalLicenseProCustom.showQuickView(productId);
            });

            // Product comparison
            $('.compare-checkbox').on('change', function() {
                var checkedProducts = $('.compare-checkbox:checked');
                if (checkedProducts.length >= 2) {
                    $('#compare-products').show();
                } else {
                    $('#compare-products').hide();
                }
            });
        },

        // Show Quick View
        showQuickView: function(productId) {
            $.ajax({
                url: dlp_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'dlp_quick_view',
                    nonce: dlp_ajax.nonce,
                    product_id: productId
                },
                success: function(response) {
                    if (response.success) {
                        $('#quick-view-modal .modal-body').html(response.data.html);
                        $('#quick-view-modal').modal('show');
                    }
                }
            });
        },

        // Trust Elements
        trustElements: function() {
            // Security badges animation
            $('.security-badge').on('mouseenter', function() {
                $(this).addClass('pulse');
            }).on('mouseleave', function() {
                $(this).removeClass('pulse');
            });

            // Customer reviews carousel
            $('.reviews-carousel').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            // Trust indicators counter
            $('.trust-counter').each(function() {
                var $this = $(this);
                var countTo = $this.attr('data-count');
                
                $({ countNum: $this.text() }).animate({
                    countNum: countTo
                }, {
                    duration: 2000,
                    easing: 'linear',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(this.countNum);
                    }
                });
            });
        },

        // Customer Experience
        customerExperience: function() {
            // FAQ accordion
            $('.faq-item .faq-question').on('click', function() {
                var $answer = $(this).next('.faq-answer');
                var $item = $(this).parent();
                
                $('.faq-item').not($item).removeClass('active');
                $('.faq-answer').not($answer).slideUp(300);
                
                $item.toggleClass('active');
                $answer.slideToggle(300);
            });

            // Installation guide modal
            $('.installation-guide-btn').on('click', function(e) {
                e.preventDefault();
                var guideUrl = $(this).data('guide-url');
                $('#installation-guide-modal iframe').attr('src', guideUrl);
                $('#installation-guide-modal').modal('show');
            });

            // Customer support chat
            $('.support-chat-btn').on('click', function(e) {
                e.preventDefault();
                DigitalLicenseProCustom.initSupportChat();
            });

            // Bulk purchase calculator
            $('.bulk-quantity').on('change', function() {
                var quantity = parseInt($(this).val());
                var basePrice = parseFloat($(this).data('base-price'));
                var discount = 0;
                
                if (quantity >= 10) discount = 0.15;
                else if (quantity >= 5) discount = 0.10;
                else if (quantity >= 3) discount = 0.05;
                
                var totalPrice = (basePrice * quantity) * (1 - discount);
                var savings = (basePrice * quantity) - totalPrice;
                
                $('.bulk-total').text(totalPrice.toFixed(2) + ' ₺');
                $('.bulk-savings').text(savings.toFixed(2) + ' ₺');
            });
        },

        // Init Support Chat
        initSupportChat: function() {
            // Initialize live chat widget
            if (typeof LiveChatWidget !== 'undefined') {
                LiveChatWidget.init();
            } else {
                // Fallback chat system
                $('#support-chat-modal').modal('show');
            }
        },

        // Performance Optimization
        performanceOptimization: function() {
            // Lazy load images
            if ('IntersectionObserver' in window) {
                var imageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            var img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            imageObserver.unobserve(img);
                        }
                    });
                });

                document.querySelectorAll('img[data-src]').forEach(function(img) {
                    imageObserver.observe(img);
                });
            }

            // Preload critical resources
            var criticalResources = [
                dlp_ajax.theme_url + '/assets/images/logo.png',
                dlp_ajax.theme_url + '/assets/images/security-badges.png'
            ];

            criticalResources.forEach(function(src) {
                var link = document.createElement('link');
                link.rel = 'preload';
                link.as = 'image';
                link.href = src;
                document.head.appendChild(link);
            });

            // Cache management
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register(dlp_ajax.theme_url + '/sw.js')
                    .then(function(registration) {
                        console.log('ServiceWorker registration successful');
                    })
                    .catch(function(err) {
                        console.log('ServiceWorker registration failed');
                    });
            }
        },

        // Security Features
        securityFeatures: function() {
            // Anti-spam protection
            $('form').on('submit', function(e) {
                var $form = $(this);
                var honeypot = $form.find('.honeypot-field').val();
                
                if (honeypot) {
                    e.preventDefault();
                    return false; // Bot detected
                }
            });

            // Payment security
            $('.payment-method').on('change', function() {
                var method = $(this).val();
                DigitalLicenseProCustom.updateSecurityInfo(method);
            });

            // License verification
            $('.verify-license-btn').on('click', function(e) {
                e.preventDefault();
                var licenseKey = $(this).data('license-key');
                DigitalLicenseProCustom.verifyLicenseOnline(licenseKey);
            });
        },

        // Update Security Info
        updateSecurityInfo: function(paymentMethod) {
            var securityInfo = {
                'credit_card': 'SSL şifreleme ile güvenli ödeme',
                'paypal': 'PayPal güvenlik standartları',
                'bank_transfer': 'Banka güvenliği ile transfer'
            };
            
            $('.security-info').text(securityInfo[paymentMethod] || '');
        },

        // Verify License Online
        verifyLicenseOnline: function(licenseKey) {
            $.ajax({
                url: dlp_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'dlp_verify_license_online',
                    nonce: dlp_ajax.nonce,
                    license_key: licenseKey
                },
                success: function(response) {
                    if (response.success) {
                        DigitalLicensePro.showNotification('Lisans doğrulandı!', 'success');
                    } else {
                        DigitalLicensePro.showNotification('Lisans doğrulanamadı.', 'error');
                    }
                }
            });
        },

        // Mobile Optimization
        mobileOptimization: function() {
            // Touch gestures
            var touchStartX = 0;
            var touchEndX = 0;
            
            document.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            });
            
            document.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });
            
            function handleSwipe() {
                var swipeThreshold = 50;
                var diff = touchStartX - touchEndX;
                
                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        // Swipe left - next product
                        $('.product-carousel').slick('slickNext');
                    } else {
                        // Swipe right - previous product
                        $('.product-carousel').slick('slickPrev');
                    }
                }
            }

            // Mobile menu gestures
            var mobileMenuStartY = 0;
            var mobileMenuEndY = 0;
            
            $('#mobile-menu').on('touchstart', function(e) {
                mobileMenuStartY = e.originalEvent.touches[0].clientY;
            });
            
            $('#mobile-menu').on('touchend', function(e) {
                mobileMenuEndY = e.originalEvent.changedTouches[0].clientY;
                var diff = mobileMenuStartY - mobileMenuEndY;
                
                if (diff > 100) {
                    // Swipe up to close menu
                    $('#mobile-menu').removeClass('active');
                    $('body').removeClass('mobile-menu-open');
                }
            });
        },

        // SEO Enhancement
        seoEnhancement: function() {
            // Structured data
            var structuredData = {
                "@context": "https://schema.org",
                "@type": "SoftwareApplication",
                "name": "Digital License Pro",
                "description": "Profesyonel dijital lisans satış platformu",
                "applicationCategory": "BusinessApplication",
                "operatingSystem": "Web",
                "offers": {
                    "@type": "Offer",
                    "price": "0",
                    "priceCurrency": "TRY"
                }
            };
            
            $('head').append('<script type="application/ld+json">' + JSON.stringify(structuredData) + '</script>');

            // Social sharing
            $('.social-share-btn').on('click', function(e) {
                e.preventDefault();
                var platform = $(this).data('platform');
                var url = encodeURIComponent(window.location.href);
                var title = encodeURIComponent($('title').text());
                
                var shareUrls = {
                    'facebook': 'https://www.facebook.com/sharer/sharer.php?u=' + url,
                    'twitter': 'https://twitter.com/intent/tweet?url=' + url + '&text=' + title,
                    'linkedin': 'https://www.linkedin.com/sharing/share-offsite/?url=' + url
                };
                
                if (shareUrls[platform]) {
                    window.open(shareUrls[platform], '_blank', 'width=600,height=400');
                }
            });

            // Google Analytics events
            $('.add_to_cart_button').on('click', function() {
                var productName = $(this).data('product-name');
                var productPrice = $(this).data('product-price');
                
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'add_to_cart', {
                        'items': [{
                            'name': productName,
                            'price': productPrice,
                            'currency': 'TRY'
                        }]
                    });
                }
            });
        },

        // Live Chat
        liveChat: function() {
            // Initialize live chat
            var chatConfig = {
                position: 'bottom-right',
                theme: 'light',
                welcomeMessage: 'Merhaba! Size nasıl yardımcı olabilirim?',
                agentName: 'Digital License Pro Destek'
            };
            
            // Custom chat widget
            $('.live-chat-widget').on('click', function() {
                $('#chat-modal').modal('show');
            });
            
            // Chat form submission
            $('#chat-form').on('submit', function(e) {
                e.preventDefault();
                var message = $('#chat-message').val();
                
                if (message.trim()) {
                    DigitalLicenseProCustom.sendChatMessage(message);
                    $('#chat-message').val('');
                }
            });
        },

        // Send Chat Message
        sendChatMessage: function(message) {
            var $chatMessages = $('#chat-messages');
            var timestamp = new Date().toLocaleTimeString();
            
            // Add user message
            $chatMessages.append(`
                <div class="chat-message user-message">
                    <div class="message-content">
                        <p>${message}</p>
                        <span class="message-time">${timestamp}</span>
                    </div>
                </div>
            `);
            
            // Simulate agent response
            setTimeout(function() {
                var responses = [
                    'Mesajınız alındı. En kısa sürede size dönüş yapacağız.',
                    'Bu konuda size yardımcı olabilirim. Detayları paylaşabilir misiniz?',
                    'Anlıyorum. Bu durumda şu adımları takip edebilirsiniz...'
                ];
                
                var randomResponse = responses[Math.floor(Math.random() * responses.length)];
                
                $chatMessages.append(`
                    <div class="chat-message agent-message">
                        <div class="message-content">
                            <p>${randomResponse}</p>
                            <span class="message-time">${new Date().toLocaleTimeString()}</span>
                        </div>
                    </div>
                `);
                
                $chatMessages.scrollTop($chatMessages[0].scrollHeight);
            }, 1000);
            
            $chatMessages.scrollTop($chatMessages[0].scrollHeight);
        },

        // Affiliate System
        affiliateSystem: function() {
            // Affiliate link tracking
            $('.affiliate-link').on('click', function(e) {
                var affiliateId = $(this).data('affiliate-id');
                var productId = $(this).data('product-id');
                
                // Track affiliate click
                $.ajax({
                    url: dlp_ajax.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'dlp_track_affiliate_click',
                        nonce: dlp_ajax.nonce,
                        affiliate_id: affiliateId,
                        product_id: productId
                    }
                });
            });

            // Affiliate commission calculation
            $('.affiliate-commission').each(function() {
                var $this = $(this);
                var basePrice = parseFloat($this.data('base-price'));
                var commissionRate = parseFloat($this.data('commission-rate'));
                var commission = basePrice * (commissionRate / 100);
                
                $this.text(commission.toFixed(2) + ' ₺');
            });
        }
    };

    // Expose to global scope
    window.DigitalLicenseProCustom = DigitalLicenseProCustom;

})(jQuery);