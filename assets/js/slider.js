jQuery(document).ready(function($) {
    function initSlider($slider) {
        var slides = $slider.find('.ababil-slide');
        var currentIndex = 0;
        var autoplay = $slider.data('autoplay') === 'yes';
        var autoplaySpeed = parseInt($slider.data('autoplay-speed')) || 5000;
        var isAnimating = false;
        var autoplayInterval = null;

        function animateElement($element) {
            var animation = $element.data('animation');
            var duration = parseInt($element.data('duration')) || 1000;
            var delay = parseInt($element.data('delay')) || 0;

            if (animation && animation !== 'none') {
                $element.css({
                    'opacity': 0,
                    'visibility': 'hidden',
                    'animation': 'none'
                }).delay(delay).queue(function(next) {
                    $element.css({
                        'opacity': 1,
                        'visibility': 'visible',
                        'animation': `${animation} ${duration}ms ease-in-out`
                    });
                    next();
                });
            } else {
                $element.css({
                    'opacity': 1,
                    'visibility': 'visible',
                    'animation': 'none'
                });
            }
        }

        function showSlide(index) {
            if (isAnimating || index === currentIndex || index < 0 || index >= slides.length) return;
            isAnimating = true;

            var $currentSlide = $(slides[currentIndex]);
            var $nextSlide = $(slides[index]);
            var transitionEffect = $nextSlide.data('transition');

            // Hide current slide
            $currentSlide.removeClass('active').css({
                'opacity': 0,
                'visibility': 'hidden',
                'transform': 'none',
                'z-index': 9
            }).find('[data-animation]').css({
                'opacity': 0,
                'visibility': 'hidden',
                'animation': 'none'
            });

            // Prepare next slide
            $nextSlide.addClass('active').css({
                'opacity': 0,
                'visibility': 'visible',
                'z-index': 10
            });

            // Apply transition effect
            switch (transitionEffect) {
                case 'fade':
                    $nextSlide.animate({ opacity: 1 }, 1000, function() {
                        isAnimating = false;
                    });
                    break;
                case 'slide':
                    $nextSlide.css('transform', 'translateX(100%)').animate({
                        opacity: 1,
                        transform: 'translateX(0)'
                    }, 1000, 'easeInOutQuad', function() {
                        isAnimating = false;
                    });
                    break;
                case 'cube':
                    $nextSlide.css({
                        'transform': 'rotateY(90deg)',
                        'opacity': 0
                    }).animate({
                        opacity: 1,
                        transform: 'rotateY(0deg)'
                    }, 1000, 'easeInOutQuad', function() {
                        isAnimating = false;
                    });
                    break;
                case 'coverflow':
                    $nextSlide.css({
                        'transform': 'scale(0.8) rotateY(45deg)',
                        'opacity': 0
                    }).animate({
                        opacity: 1,
                        transform: 'scale(1) rotateY(0deg)'
                    }, 1000, 'easeInOutQuad', function() {
                        isAnimating = false;
                    });
                    break;
                case 'flip':
                    $nextSlide.css({
                        'transform': 'rotateY(180deg)',
                        'opacity': 0
                    }).animate({
                        opacity: 1,
                        transform: 'rotateY(0deg)'
                    }, 1000, 'easeInOutQuad', function() {
                        isAnimating = false;
                    });
                    break;
                case 'zoom':
                    $nextSlide.css({
                        'transform': 'scale(0.5)',
                        'opacity': 0
                    }).animate({
                        opacity: 1,
                        transform: 'scale(1)'
                    }, 1000, 'easeInOutQuad', function() {
                        isAnimating = false;
                    });
                    break;
                default:
                    $nextSlide.css({
                        'opacity': 1,
                        'visibility': 'visible'
                    });
                    isAnimating = false;
                    break;
            }

            // Animate content elements
            $nextSlide.find('[data-animation]').each(function() {
                animateElement($(this));
            });

            currentIndex = index;
        }

        function nextSlide() {
            var nextIndex = (currentIndex + 1) % slides.length;
            showSlide(nextIndex);
        }

        // Initialize first slide
        slides.removeClass('active').css({
            'opacity': 0,
            'visibility': 'hidden',
            'z-index': 9
        });
        $(slides[0]).addClass('active').css({
            'opacity': 1,
            'visibility': 'visible',
            'z-index': 10
        });
        $(slides[0]).find('[data-animation]').each(function() {
            animateElement($(this));
        });

        // Autoplay
        if (autoplay) {
            autoplayInterval = setInterval(nextSlide, autoplaySpeed);
        }

        // Handle Elementor preview updates
        $slider.on('elementor/frontend/init', function() {
            slides.removeClass('active').css({
                'opacity': 0,
                'visibility': 'hidden',
                'z-index': 9
            });
            showSlide(0);
        });

        // Stop autoplay on user interaction
        $slider.on('mouseenter', function() {
            if (autoplayInterval) clearInterval(autoplayInterval);
        }).on('mouseleave', function() {
            if (autoplay) {
                autoplayInterval = setInterval(nextSlide, autoplaySpeed);
            }
        });
    }

    // Initialize sliders
    $('.ababil-slider').each(function() {
        initSlider($(this));
    });

    // Re-initialize on Elementor preview changes
    elementorFrontend.hooks.addAction('frontend/element_ready/ababil-slider.default', function($scope) {
        initSlider($scope.find('.ababil-slider'));
    });
});