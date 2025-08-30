(function($) {
    function initSlider($slider) {
        if ($slider.hasClass('ababil-slider-initialized')) {
            return;
        }

        var $wrapper = $slider.find('.ababil-slider-wrapper');
        var $slides = $wrapper.find('.ababil-slide');
        var $pagination = $slider.find('.ababil-slider-pagination');
        var $dots = $pagination.find('.ababil-pagination-dot');
        var $navPrev = $slider.find('.ababil-nav-prev');
        var $navNext = $slider.find('.ababil-nav-next');
        var settings = {
            autoplay: $slider.data('autoplay') === 'yes',
            autoplaySpeed: parseInt($slider.data('autoplay-speed')) || 5000,
            loop: $slider.data('loop') === 'yes',
            pauseOnHover: $slider.data('pause-on-hover') === 'yes',
            transitionSpeed: parseInt($slider.data('transition-speed')) || 1000
        };
        var currentIndex = 0;
        var autoplayInterval = null;
        var isAnimating = false;

        function applyTransition($slide, transitionType) {
            $slide.removeClass('transition-slide transition-fade transition-zoom transition-flip');
            $slide.addClass('transition-' + transitionType);
        }

        function goToSlide(index) {
            if (isAnimating || index === currentIndex) return;
            isAnimating = true;

            var $currentSlide = $slides.eq(currentIndex);
            var $nextSlide = $slides.eq(index);
            var transitionType = $nextSlide.data('transition') || 'slide';

            // Remove active class and transition from current slide
            $currentSlide.removeClass('active');
            $dots.eq(currentIndex).removeClass('active');

            // Apply transition class to next slide
            applyTransition($nextSlide, transitionType);

            // Set next slide as active
            $nextSlide.addClass('active');
            $dots.eq(index).addClass('active');

            // Trigger content animations
            $nextSlide.find('[data-animation]').each(function() {
                var $elem = $(this);
                var animation = $elem.data('animation');
                var duration = parseInt($elem.data('duration')) || 1000;
                var delay = parseInt($elem.data('delay')) || 0;

                if (animation !== 'none') {
                    $elem.css({
                        'animation-name': animation,
                        'animation-duration': duration + 'ms',
                        'animation-delay': delay + 'ms',
                        'animation-fill-mode': 'both'
                    });
                }
            });

            // Update current index
            currentIndex = index;

            // Reset animation flag after transition
            setTimeout(function() {
                isAnimating = false;
                // Reset animation styles after transition
                $nextSlide.find('[data-animation]').css({
                    'animation-name': '',
                    'animation-duration': '',
                    'animation-delay': '',
                    'animation-fill-mode': ''
                });
            }, settings.transitionSpeed);
        }

        function nextSlide() {
            var nextIndex = currentIndex + 1;
            if (nextIndex >= $slides.length) {
                nextIndex = settings.loop ? 0 : currentIndex;
            }
            goToSlide(nextIndex);
        }

        function prevSlide() {
            var prevIndex = currentIndex - 1;
            if (prevIndex < 0) {
                prevIndex = settings.loop ? $slides.length - 1 : currentIndex;
            }
            goToSlide(prevIndex);
        }

        function startAutoplay() {
            if (settings.autoplay && !autoplayInterval) {
                autoplayInterval = setInterval(nextSlide, settings.autoplaySpeed);
            }
        }

        function stopAutoplay() {
            if (autoplayInterval) {
                clearInterval(autoplayInterval);
                autoplayInterval = null;
            }
        }

        // Initialize first slide
        applyTransition($slides.eq(0), $slides.eq(0).data('transition') || 'slide');
        $slides.eq(0).addClass('active');
        $dots.eq(0).addClass('active');
        $slides.eq(0).find('[data-animation]').each(function() {
            var $elem = $(this);
            var animation = $elem.data('animation');
            var duration = parseInt($elem.data('duration')) || 1000;
            var delay = parseInt($elem.data('delay')) || 0;

            if (animation !== 'none') {
                $elem.css({
                    'animation-name': animation,
                    'animation-duration': duration + 'ms',
                    'animation-delay': delay + 'ms',
                    'animation-fill-mode': 'both'
                });
            }
        });

        // Event handlers
        $navNext.on('click', nextSlide);
        $navPrev.on('click', prevSlide);

        $dots.on('click', function() {
            var index = $(this).data('index');
            goToSlide(index);
        });

        if (settings.pauseOnHover) {
            $slider.on('mouseenter', stopAutoplay).on('mouseleave', startAutoplay);
        }

        // Start autoplay
        startAutoplay();

        // Prevent multiple initializations
        $slider.addClass('ababil-slider-initialized');

        // Clean up on Elementor widget update
        $slider.on('destroy', function() {
            stopAutoplay();
            $navNext.off('click');
            $navPrev.off('click');
            $dots.off('click');
            $slider.off('mouseenter mouseleave');
            $slider.removeClass('ababil-slider-initialized');
        });
    }

    $(document).ready(function() {
        $('.ababil-slider').each(function() {
            initSlider($(this));
        });
    });

    // Reinitialize on Elementor frontend init
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/ababil-slider.default', function($scope) {
            $scope.find('.ababil-slider').each(function() {
                $(this).trigger('destroy');
                initSlider($(this));
            });
        });
    });
})(jQuery);