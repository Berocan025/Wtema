/**
 * Digital License Pro - Admin Panel JavaScript
 * 
 * @package DigitalLicensePro
 * @author BERAT K - 0539 511 56 32
 * @version 1.0.0
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        DLPAdmin.init();
    });

    // DLP Admin Object
    var DLPAdmin = {
        
        // Initialize
        init: function() {
            this.initTabs();
            this.initColorPickers();
            this.initMediaUpload();
            this.initFormHandling();
            this.initNotifications();
        },

        // Initialize Tabs
        initTabs: function() {
            $('.dlp-nav-item').on('click', function(e) {
                e.preventDefault();
                
                var targetTab = $(this).data('tab');
                
                // Update navigation
                $('.dlp-nav-item').removeClass('active');
                $(this).addClass('active');
                
                // Update content
                $('.dlp-tab-content').removeClass('active');
                $('#' + targetTab + '-tab').addClass('active');
                
                // Update URL hash
                window.location.hash = targetTab;
            });
            
            // Handle URL hash on page load
            if (window.location.hash) {
                var hash = window.location.hash.substring(1);
                $('.dlp-nav-item[data-tab="' + hash + '"]').click();
            }
        },

        // Initialize Color Pickers
        initColorPickers: function() {
            $('.dlp-color-picker').wpColorPicker({
                change: function(event, ui) {
                    // Trigger change event for form validation
                    $(this).trigger('change');
                }
            });
        },

        // Initialize Media Upload
        initMediaUpload: function() {
            $('.dlp-media-button').on('click', function(e) {
                e.preventDefault();
                
                var $button = $(this);
                var $upload = $button.closest('.dlp-media-upload');
                var $input = $upload.find('input[type="hidden"]');
                var $preview = $upload.find('.dlp-media-preview');
                var $remove = $upload.find('.dlp-media-remove');
                
                // Create media frame
                var frame = wp.media({
                    title: 'Medya Seç',
                    button: {
                        text: 'Seç'
                    },
                    multiple: false
                });
                
                // Handle selection
                frame.on('select', function() {
                    var attachment = frame.state().get('selection').first().toJSON();
                    
                    // Update input value
                    $input.val(attachment.url);
                    
                    // Update preview
                    $preview.html('<img src="' + attachment.url + '" alt="Selected Media">');
                    
                    // Show remove button
                    $remove.show();
                });
                
                // Open frame
                frame.open();
            });
            
            // Handle remove button
            $('.dlp-media-remove').on('click', function(e) {
                e.preventDefault();
                
                var $button = $(this);
                var $upload = $button.closest('.dlp-media-upload');
                var $input = $upload.find('input[type="hidden"]');
                var $preview = $upload.find('.dlp-media-preview');
                
                // Clear input
                $input.val('');
                
                // Reset preview
                $preview.html(`
                    <div class="dlp-media-placeholder">
                        <i class="dashicons dashicons-format-image"></i>
                        <span>Görsel seçin</span>
                    </div>
                `);
                
                // Hide remove button
                $button.hide();
            });
        },

        // Initialize Form Handling
        initFormHandling: function() {
            // Save all settings
            $('#save-all-settings').on('click', function(e) {
                e.preventDefault();
                DLPAdmin.saveSettings();
            });
            
            // Reset settings
            $('#reset-settings').on('click', function(e) {
                e.preventDefault();
                DLPAdmin.resetSettings();
            });
            
            // Auto-save on input change
            $('input, select, textarea').on('change', function() {
                // Debounce auto-save
                clearTimeout(DLPAdmin.autoSaveTimer);
                DLPAdmin.autoSaveTimer = setTimeout(function() {
                    DLPAdmin.autoSave();
                }, 2000);
            });
        },

        // Save Settings
        saveSettings: function() {
            var $button = $('#save-all-settings');
            var originalText = $button.html();
            
            // Show loading state
            $button.html('<i class="dashicons dashicons-update"></i> Kaydediliyor...').prop('disabled', true);
            
            // Collect form data
            var formData = new FormData($('#dlp-theme-settings-form')[0]);
            formData.append('action', 'save_theme_settings');
            formData.append('nonce', dlp_admin.nonce);
            
            // Convert FormData to object
            var settings = {};
            formData.forEach(function(value, key) {
                if (key !== 'action' && key !== 'nonce') {
                    settings[key] = value;
                }
            });
            
            // Send AJAX request
            $.ajax({
                url: dlp_admin.ajax_url,
                type: 'POST',
                data: {
                    action: 'save_theme_settings',
                    nonce: dlp_admin.nonce,
                    settings: settings
                },
                success: function(response) {
                    if (response.success) {
                        DLPAdmin.showNotification(dlp_admin.strings.saved, 'success');
                        
                        // Update CSS variables if colors changed
                        DLPAdmin.updateCSSVariables(settings);
                    } else {
                        DLPAdmin.showNotification(dlp_admin.strings.error, 'error');
                    }
                },
                error: function() {
                    DLPAdmin.showNotification(dlp_admin.strings.error, 'error');
                },
                complete: function() {
                    // Reset button
                    $button.html(originalText).prop('disabled', false);
                }
            });
        },

        // Reset Settings
        resetSettings: function() {
            if (confirm(dlp_admin.strings.confirm_reset)) {
                var $button = $('#reset-settings');
                var originalText = $button.html();
                
                // Show loading state
                $button.html('<i class="dashicons dashicons-update"></i> Sıfırlanıyor...').prop('disabled', true);
                
                // Send AJAX request
                $.ajax({
                    url: dlp_admin.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'reset_theme_settings',
                        nonce: dlp_admin.nonce
                    },
                    success: function(response) {
                        if (response.success) {
                            DLPAdmin.showNotification('Ayarlar sıfırlandı!', 'success');
                            
                            // Reload page to reset form
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            DLPAdmin.showNotification(dlp_admin.strings.error, 'error');
                        }
                    },
                    error: function() {
                        DLPAdmin.showNotification(dlp_admin.strings.error, 'error');
                    },
                    complete: function() {
                        // Reset button
                        $button.html(originalText).prop('disabled', false);
                    }
                });
            }
        },

        // Auto Save
        autoSave: function() {
            // Only auto-save if there are unsaved changes
            if (DLPAdmin.hasUnsavedChanges()) {
                DLPAdmin.saveSettings();
            }
        },

        // Check for unsaved changes
        hasUnsavedChanges: function() {
            // This is a simple implementation
            // You could enhance this to track actual changes
            return true;
        },

        // Update CSS Variables
        updateCSSVariables: function(settings) {
            var cssVars = {
                '--primary-color': settings.primary_color || '#2563eb',
                '--secondary-color': settings.secondary_color || '#7c3aed',
                '--accent-color': settings.accent_color || '#f59e0b',
                '--success-color': settings.success_color || '#10b981',
                '--warning-color': settings.warning_color || '#f59e0b',
                '--danger-color': settings.danger_color || '#ef4444'
            };
            
            // Update CSS variables in admin panel
            var root = document.documentElement;
            Object.keys(cssVars).forEach(function(key) {
                root.style.setProperty(key, cssVars[key]);
            });
        },

        // Initialize Notifications
        initNotifications: function() {
            // Create notification container if it doesn't exist
            if (!$('#dlp-notifications').length) {
                $('body').append('<div id="dlp-notifications"></div>');
            }
        },

        // Show Notification
        showNotification: function(message, type) {
            var $container = $('#dlp-notifications');
            var $notification = $('<div class="dlp-notification ' + type + '">' + message + '</div>');
            
            // Add to container
            $container.append($notification);
            
            // Show notification
            setTimeout(function() {
                $notification.addClass('show');
            }, 100);
            
            // Auto hide after 3 seconds
            setTimeout(function() {
                $notification.removeClass('show');
                setTimeout(function() {
                    $notification.remove();
                }, 300);
            }, 3000);
        },

        // Auto-save timer
        autoSaveTimer: null
    };

    // Expose to global scope
    window.DLPAdmin = DLPAdmin;

    // Additional utility functions
    $(document).on('click', '.dlp-setting-item input[type="checkbox"]', function() {
        // Handle checkbox changes
        var $checkbox = $(this);
        var $select = $checkbox.siblings('select');
        
        if ($checkbox.is(':checked')) {
            $select.val('1');
        } else {
            $select.val('0');
        }
    });

    // Handle select changes for boolean values
    $(document).on('change', '.dlp-setting-item select', function() {
        var $select = $(this);
        var $checkbox = $select.siblings('input[type="checkbox"]');
        
        if ($select.val() === '1') {
            $checkbox.prop('checked', true);
        } else {
            $checkbox.prop('checked', false);
        }
    });

    // Form validation
    $('#dlp-theme-settings-form').on('submit', function(e) {
        e.preventDefault();
        DLPAdmin.saveSettings();
    });

    // Keyboard shortcuts
    $(document).on('keydown', function(e) {
        // Ctrl/Cmd + S to save
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            DLPAdmin.saveSettings();
        }
        
        // Escape to close notifications
        if (e.key === 'Escape') {
            $('.dlp-notification').removeClass('show');
        }
    });

    // Tab keyboard navigation
    $(document).on('keydown', function(e) {
        if (e.key === 'Tab' && $('.dlp-nav-item:focus').length) {
            // Handle tab navigation
            var $currentTab = $('.dlp-nav-item.active');
            var $tabs = $('.dlp-nav-item');
            var currentIndex = $tabs.index($currentTab);
            
            if (e.shiftKey) {
                // Previous tab
                var prevIndex = currentIndex > 0 ? currentIndex - 1 : $tabs.length - 1;
                $tabs.eq(prevIndex).click().focus();
            } else {
                // Next tab
                var nextIndex = currentIndex < $tabs.length - 1 ? currentIndex + 1 : 0;
                $tabs.eq(nextIndex).click().focus();
            }
            
            e.preventDefault();
        }
    });

    // Responsive handling
    $(window).on('resize', function() {
        // Handle responsive layout changes
        if ($(window).width() <= 1200) {
            $('.dlp-admin-nav').addClass('mobile');
        } else {
            $('.dlp-admin-nav').removeClass('mobile');
        }
    });

    // Initialize responsive state
    $(window).trigger('resize');

    // Accessibility improvements
    $(document).on('focus', '.dlp-setting-item input, .dlp-setting-item select, .dlp-setting-item textarea', function() {
        $(this).closest('.dlp-setting-item').addClass('focused');
    });

    $(document).on('blur', '.dlp-setting-item input, .dlp-setting-item select, .dlp-setting-item textarea', function() {
        $(this).closest('.dlp-setting-item').removeClass('focused');
    });

    // Tooltip functionality
    $(document).on('mouseenter', '.dlp-setting-item label[title]', function() {
        var $label = $(this);
        var title = $label.attr('title');
        
        if (title) {
            $label.removeAttr('title');
            $label.append('<span class="dlp-tooltip">' + title + '</span>');
        }
    });

    $(document).on('mouseleave', '.dlp-setting-item label', function() {
        var $label = $(this);
        var $tooltip = $label.find('.dlp-tooltip');
        
        if ($tooltip.length) {
            $label.attr('title', $tooltip.text());
            $tooltip.remove();
        }
    });

    // Performance optimization
    var resizeTimer;
    $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // Handle resize after user stops resizing
            DLPAdmin.handleResize();
        }, 250);
    });

    // Add resize handler to DLPAdmin object
    DLPAdmin.handleResize = function() {
        // Handle any resize-specific logic here
        console.log('Window resized');
    };

    // Export settings functionality
    DLPAdmin.exportSettings = function() {
        var settings = {};
        $('#dlp-theme-settings-form').serializeArray().forEach(function(item) {
            settings[item.name] = item.value;
        });
        
        var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(settings, null, 2));
        var downloadAnchorNode = document.createElement('a');
        downloadAnchorNode.setAttribute("href", dataStr);
        downloadAnchorNode.setAttribute("download", "dlp-theme-settings.json");
        document.body.appendChild(downloadAnchorNode);
        downloadAnchorNode.click();
        downloadAnchorNode.remove();
    };

    // Import settings functionality
    DLPAdmin.importSettings = function(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            try {
                var settings = JSON.parse(e.target.result);
                DLPAdmin.populateForm(settings);
                DLPAdmin.showNotification('Ayarlar içe aktarıldı!', 'success');
            } catch (error) {
                DLPAdmin.showNotification('Dosya okunamadı!', 'error');
            }
        };
        reader.readAsText(file);
    };

    // Populate form with settings
    DLPAdmin.populateForm = function(settings) {
        Object.keys(settings).forEach(function(key) {
            var $field = $('[name="' + key + '"]');
            if ($field.length) {
                $field.val(settings[key]);
            }
        });
    };

})(jQuery);