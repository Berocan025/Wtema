/**
 * Digital License Pro - Theme JavaScript
 * 
 * @package DigitalLicensePro
 * @author BERAT K - 0539 511 56 32
 * @version 1.0.0
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        DigitalLicensePro.init();
    });

    // Window Load
    $(window).on('load', function() {
        DigitalLicensePro.onWindowLoad();
    });

    // Digital License Pro Object
    var DigitalLicensePro = {
        
        // Initialize
        init: function() {
            this.mobileMenu();
            this.themeToggle();
            this.backToTop();
            this.notifications();
            this.smoothScroll();
            this.formValidation();
            this.lazyLoading();
            this.searchEnhancement();
            this.cartEnhancement();
            this.accessibility();
            this.performance();
        },

        // Mobile Menu
        mobileMenu: function() {
            var $mobileToggle = $('#mobile-menu-toggle');
            var $mobileMenu = $('#mobile-menu');
            var $mobileClose = $('#mobile-menu-close');
            var $body = $('body');

            // Open mobile menu
            $mobileToggle.on('click', function(e) {
                e.preventDefault();
                $mobileMenu.addClass('active');
                $body.addClass('mobile-menu-open');
                
                // Focus management
                setTimeout(function() {
                    $mobileMenu.find('a:first').focus();
                }, 300);
            });

            // Close mobile menu
            $mobileClose.on('click', function(e) {
                e.preventDefault();
                $mobileMenu.removeClass('active');
                $body.removeClass('mobile-menu-open');
                $mobileToggle.focus();
            });

            // Close on escape key
            $(document).on('keydown', function(e) {
                if (e.keyCode === 27 && $mobileMenu.hasClass('active')) {
                    $mobileMenu.removeClass('active');
                    $body.removeClass('mobile-menu-open');
                    $mobileToggle.focus();
                }
            });

            // Close on outside click
            $(document).on('click', function(e) {
                if ($mobileMenu.hasClass('active') && !$(e.target).closest('#mobile-menu, #mobile-menu-toggle').length) {
                    $mobileMenu.removeClass('active');
                    $body.removeClass('mobile-menu-open');
                }
            });

            // Mobile menu animations
            $mobileMenu.find('a').on('click', function() {
                var $this = $(this);
                var $submenu = $this.next('.sub-menu');
                
                if ($submenu.length) {
                    e.preventDefault();
                    $submenu.slideToggle(300);
                    $this.toggleClass('submenu-open');
                }
            });
        },

        // Theme Toggle
        themeToggle: function() {
            var $themeToggle = $('#theme-toggle');
            var currentTheme = $('body').attr('data-theme') || 'light';

            // Set initial theme
            this.setTheme(currentTheme);

            // Theme toggle click
            $themeToggle.on('click', function(e) {
                e.preventDefault();
                var newTheme = currentTheme === 'light' ? 'dark' : 'light';
                DigitalLicensePro.setTheme(newTheme);
                currentTheme = newTheme;

                // Save to localStorage
                localStorage.setItem('dlp_theme', newTheme);

                // AJAX call to save theme preference
                $.ajax({
                    url: dlp_ajax.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'dlp_theme_toggle',
                        nonce: dlp_ajax.nonce,
                        theme: newTheme
                    },
                    success: function(response) {
                        if (response.success) {
                            DigitalLicensePro.showNotification('Tema değiştirildi', 'success');
                        }
                    }
                });
            });

            // Load theme from localStorage
            var savedTheme = localStorage.getItem('dlp_theme');
            if (savedTheme && savedTheme !== currentTheme) {
                this.setTheme(savedTheme);
                currentTheme = savedTheme;
            }
        },

        // Set Theme
        setTheme: function(theme) {
            $('body').attr('data-theme', theme);
            
            // Update theme toggle icon
            var $lightIcon = $('#theme-toggle .light-icon');
            var $darkIcon = $('#theme-toggle .dark-icon');
            
            if (theme === 'dark') {
                $lightIcon.hide();
                $darkIcon.show();
            } else {
                $lightIcon.show();
                $darkIcon.hide();
            }

            // Trigger custom event
            $(document).trigger('themeChanged', [theme]);
        },

        // Back to Top
        backToTop: function() {
            var $backToTop = $('#back-to-top');
            var scrollThreshold = 300;

            $(window).on('scroll', function() {
                if ($(window).scrollTop() > scrollThreshold) {
                    $backToTop.addClass('visible');
                } else {
                    $backToTop.removeClass('visible');
                }
            });

            $backToTop.on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
            });
        },

        // Notifications
        notifications: function() {
            var $toast = $('#notification-toast');
            var $toastContent = $toast.find('.toast-content');
            var $toastMessage = $toast.find('.toast-message');
            var $toastIcon = $toast.find('.toast-icon');
            var $toastClose = $toast.find('.toast-close');

            // Close toast
            $toastClose.on('click', function() {
                $toast.removeClass('show');
            });

            // Auto hide after 5 seconds
            $toast.on('show', function() {
                setTimeout(function() {
                    $toast.removeClass('show');
                }, 5000);
            });

            // Global notification function
            window.showNotification = function(message, type) {
                $toastMessage.text(message);
                $toast.removeClass('success error warning info').addClass(type);
                
                // Set icon based on type
                var iconClass = 'fas fa-info-circle';
                switch(type) {
                    case 'success':
                        iconClass = 'fas fa-check-circle';
                        break;
                    case 'error':
                        iconClass = 'fas fa-exclamation-circle';
                        break;
                    case 'warning':
                        iconClass = 'fas fa-exclamation-triangle';
                        break;
                }
                
                $toastIcon.attr('class', iconClass);
                $toast.addClass('show');
            };
        },

        // Smooth Scroll
        smoothScroll: function() {
            $('a[href^="#"]').on('click', function(e) {
                var target = $(this.getAttribute('href'));
                
                if (target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 800);
                }
            });
        },

        // Form Validation
        formValidation: function() {
            $('form').on('submit', function(e) {
                var $form = $(this);
                var isValid = true;

                // Required field validation
                $form.find('[required]').each(function() {
                    var $field = $(this);
                    var value = $field.val().trim();
                    
                    if (!value) {
                        isValid = false;
                        $field.addClass('error');
                        $field.focus();
                        return false;
                    } else {
                        $field.removeClass('error');
                    }
                });

                // Email validation
                $form.find('input[type="email"]').each(function() {
                    var $field = $(this);
                    var email = $field.val();
                    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    
                    if (email && !emailRegex.test(email)) {
                        isValid = false;
                        $field.addClass('error');
                        $field.focus();
                        return false;
                    } else {
                        $field.removeClass('error');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    this.showNotification('Lütfen tüm gerekli alanları doldurun', 'error');
                }
            });

            // Real-time validation
            $('input, textarea, select').on('blur', function() {
                var $field = $(this);
                var value = $field.val().trim();
                
                if ($field.is('[required]') && !value) {
                    $field.addClass('error');
                } else {
                    $field.removeClass('error');
                }
            });
        },

        // Lazy Loading
        lazyLoading: function() {
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
        },

        // Search Enhancement
        searchEnhancement: function() {
            var $searchField = $('.search-field');
            var $searchResults = $('<div class="search-results"></div>');
            var searchTimeout;

            $searchField.after($searchResults);

            $searchField.on('input', function() {
                var query = $(this).val().trim();
                
                clearTimeout(searchTimeout);
                
                if (query.length < 2) {
                    $searchResults.hide();
                    return;
                }

                searchTimeout = setTimeout(function() {
                    DigitalLicensePro.performSearch(query);
                }, 300);
            });

            // Hide results on outside click
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.search-container').length) {
                    $searchResults.hide();
                }
            });
        },

        // Perform Search
        performSearch: function(query) {
            var $searchResults = $('.search-results');
            
            $.ajax({
                url: dlp_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'dlp_search',
                    nonce: dlp_ajax.nonce,
                    query: query
                },
                success: function(response) {
                    if (response.success) {
                        $searchResults.html(response.data.html).show();
                    }
                }
            });
        },

        // Cart Enhancement
        cartEnhancement: function() {
            // Add to cart animation
            $('.add_to_cart_button, .single_add_to_cart_button').on('click', function() {
                var $button = $(this);
                var originalText = $button.text();
                
                $button.text('Sepete Ekleniyor...').prop('disabled', true);
                
                setTimeout(function() {
                    $button.text(originalText).prop('disabled', false);
                    DigitalLicensePro.showNotification('Ürün sepete eklendi', 'success');
                }, 1000);
            });

            // Cart count update
            $(document.body).on('added_to_cart', function(event, fragments, cart_hash, button) {
                if (fragments && fragments['.cart-count']) {
                    $('.cart-count').replaceWith(fragments['.cart-count']);
                }
            });
        },

        // Accessibility
        accessibility: function() {
            // Skip link functionality
            $('.skip-link').on('click', function(e) {
                var target = $(this.getAttribute('href'));
                if (target.length) {
                    e.preventDefault();
                    target.focus();
                }
            });

            // Keyboard navigation for dropdowns
            $('.user-account, .language-switcher').on('keydown', function(e) {
                var $dropdown = $(this).find('ul');
                
                if (e.keyCode === 13 || e.keyCode === 32) { // Enter or Space
                    e.preventDefault();
                    $dropdown.toggle();
                }
            });

            // Focus management
            $(document).on('keydown', function(e) {
                if (e.keyCode === 9) { // Tab
                    $('body').addClass('keyboard-navigation');
                }
            });

            $(document).on('mousedown', function() {
                $('body').removeClass('keyboard-navigation');
            });
        },

        // Performance
        performance: function() {
            // Debounce scroll events
            var scrollTimeout;
            $(window).on('scroll', function() {
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(function() {
                    // Perform scroll-based operations
                }, 100);
            });

            // Preload critical resources
            this.preloadResources();
        },

        // Preload Resources
        preloadResources: function() {
            var criticalImages = [
                dlp_ajax.theme_url + '/assets/images/logo.png',
                dlp_ajax.theme_url + '/assets/images/favicon.ico'
            ];

            criticalImages.forEach(function(src) {
                var link = document.createElement('link');
                link.rel = 'preload';
                link.as = 'image';
                link.href = src;
                document.head.appendChild(link);
            });
        },

        // Window Load Handler
        onWindowLoad: function() {
            // Hide loading overlay
            $('#loading-overlay').removeClass('active');
            
            // Initialize animations
            this.initAnimations();
            
            // Load saved preferences
            this.loadPreferences();
        },

        // Initialize Animations
        initAnimations: function() {
            // Fade in elements on scroll
            if ('IntersectionObserver' in window) {
                var animationObserver = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('fade-in');
                        }
                    });
                });

                document.querySelectorAll('.card, .widget, .product').forEach(function(el) {
                    animationObserver.observe(el);
                });
            }
        },

        // Load Preferences
        loadPreferences: function() {
            // Load theme preference
            var savedTheme = localStorage.getItem('dlp_theme');
            if (savedTheme) {
                this.setTheme(savedTheme);
            }

            // Load other preferences
            var preferences = JSON.parse(localStorage.getItem('dlp_preferences') || '{}');
            
            // Apply preferences
            if (preferences.fontSize) {
                $('html').css('font-size', preferences.fontSize);
            }
        },

        // Show Notification (Global function)
        showNotification: function(message, type) {
            if (window.showNotification) {
                window.showNotification(message, type);
            } else {
                console.log(message);
            }
        }
    };

    // Expose to global scope
    window.DigitalLicensePro = DigitalLicensePro;

})(jQuery);