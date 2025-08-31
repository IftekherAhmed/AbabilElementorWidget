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
            transitionSpeed: parseInt($slider.data('transition-speed')) || 1000,
            lazyLoad: $slider.data('lazy-load') === 'yes',
            touchSwipe: $slider.data('touch-swipe') === 'yes'
        };
        var currentIndex = 0;
        var autoplayInterval = null;
        var isAnimating = false;
        var transitions = [
            'slideup', 'slidedown', 'slideright', 'slideleft', 'slidehorizontal', 'slidevertical',
            'boxslide', 'slotslide-horizontal', 'slotslide-vertical', 'boxfade', 'slotfade-horizontal', 'slotfade-vertical',
            'fadefromright', 'fadefromleft', 'fadefromtop', 'fadefrombottom',
            'fadetoleftfadefromright', 'fadetorightfadefromleft', 'fadetotopfadefrombottom', 'fadetobottomfadefromtop',
            'parallaxtoright', 'parallaxtoleft', 'parallaxtotop', 'parallaxtobottom',
            'scaledownfromright', 'scaledownfromleft', 'scaledownfromtop', 'scaledownfrombottom',
            'zoomout', 'zoomin', 'slotzoom-horizontal', 'slotzoom-vertical', 'fade',
            'random-static', 'random'
        ];

        function applyTransition($slide, transitionType) {
            $slide.removeClass(transitions.map(t => 'transition-' + t).join(' '));
            if (transitionType === 'random-static' || transitionType === 'random') {
                var randomTransition = transitions[Math.floor(Math.random() * (transitionType === 'random-static' ? 6 : transitions.length))];
                $slide.addClass('transition-' + randomTransition);
                return randomTransition;
            }
            $slide.addClass('transition-' + transitionType);
            return transitionType;
        }

        function createBoxOrSlot($slide, type, rows, cols) {
            var $container = $('<div>').addClass(type === 'box' ? 'ababil-slide-box-container' : 'ababil-slide-slot-container');
            var $bg = $slide.find('.ababil-slide-background');
            var bgImage = $bg.css('background-image');
            $container.css({
                'grid-template-rows': `repeat(${rows}, 1fr)`,
                'grid-template-columns': `repeat(${cols}, 1fr)`
            });
            for (var i = 0; i < rows * cols; i++) {
                var $box = $('<div>').addClass(type === 'box' ? 'ababil-slide-box' : 'ababil-slide-slot')
                    .css('background-image', bgImage)
                    .css('background-position', `${(i % cols) * (100 / cols)}% ${Math.floor(i / cols) * (100 / rows)}%`);
                $container.append($box);
            }
            $slide.append($container);
            return $container;
        }

        function animateBoxOrSlot($container, type, transitionType, isActive) {
            var $items = $container.find('.' + (type === 'box' ? 'ababil-slide-box' : 'ababil-slide-slot'));
            var delay = settings.transitionSpeed / $items.length;
            $items.each(function(index) {
                var $item = $(this);
                setTimeout(function() {
                    $item.toggleClass('active', isActive);
                }, index * delay);
            });
        }

        function lazyLoadImage($slide) {
            if (settings.lazyLoad) {
                var $bg = $slide.find('.ababil-slide-background');
                var src = $bg.data('src');
                if (src && !$bg.hasClass('loaded')) {
                    $bg.css('background-image', `url(${src})`).addClass('loaded');
                }
            }
        }

        function goToSlide(index, direction) {
            if (isAnimating || index === currentIndex) return;
            isAnimating = true;

            var $currentSlide = $slides.eq(currentIndex);
            var $nextSlide = $slides.eq(index);
            var transitionType = $nextSlide.data('transition') || 'fade';
            var appliedTransition = applyTransition($nextSlide, transitionType);

            if (direction && (appliedTransition === 'slidehorizontal' || appliedTransition === 'slidevertical')) {
                appliedTransition = appliedTransition === 'slidehorizontal' ? (direction === 'next' ? 'slideright' : 'slideleft') : (direction === 'next' ? 'slideup' : 'slidedown');
                $nextSlide.removeClass('transition-' + transitionType).addClass('transition-' + appliedTransition);
            }

            if (['boxslide', 'boxfade'].includes(appliedTransition)) {
                var $container = createBoxOrSlot($nextSlide, 'box', 4, 4);
                animateBoxOrSlot($container, 'box', appliedTransition, true);
            } else if (['slotslide-horizontal', 'slotfade-horizontal'].includes(appliedTransition)) {
                var $container = createBoxOrSlot($nextSlide, 'slot', 1, 6);
                animateBoxOrSlot($container, 'slot', appliedTransition, true);
            } else if (['slotslide-vertical', 'slotfade-vertical', 'slotzoom-horizontal', 'slotzoom-vertical'].includes(appliedTransition)) {
                var $container = createBoxOrSlot($nextSlide, 'slot', 6, 1);
                animateBoxOrSlot($container, 'slot', appliedTransition, true);
            }

            lazyLoadImage($nextSlide);

            $currentSlide.removeClass('active');
            $dots.eq(currentIndex).removeClass('active');
            $nextSlide.addClass('active');
            $dots.eq(index).addClass('active');

            $nextSlide.find('[data-animation]').each(function() {
                var $elem = $(this);
                var animation = $elem.data('animation');
                var duration = parseInt($elem.data('duration')) || 1000;
                var delay = parseInt($elem.data('delay')) || 0;

                if (animation !== 'none') {
                    if (['typewriter', 'wordSlideIn', 'letterFadeIn', 'wave', 'scramble'].includes(animation)) {
                        $elem.addClass('ababil-animated-text');
                        animateText($elem, animation, duration, delay);
                    } else if (['staggeredFadeIn', 'masonryLoad', 'cascadeSlideIn'].includes(animation)) {
                        $elem.addClass('ababil-animated-group');
                        animateGroup($elem, animation, duration, delay);
                    } else {
                        $elem.css({
                            'animation-name': animation,
                            'animation-duration': duration + 'ms',
                            'animation-delay': delay + 'ms',
                            'animation-fill-mode': 'both'
                        });
                    }
                }
            });

            currentIndex = index;

            setTimeout(function() {
                isAnimating = false;
                $nextSlide.find('[data-animation]').css({
                    'animation-name': '',
                    'animation-duration': '',
                    'animation-delay': '',
                    'animation-fill-mode': ''
                });
                $nextSlide.find('.ababil-slide-box-container, .ababil-slide-slot-container').remove();
            }, settings.transitionSpeed);
        }

        function animateText($elem, animation, duration, delay) {
            var text = $elem.text().trim();
            $elem.empty();
            if (animation === 'typewriter' || animation === 'scramble') {
                var chars = text.split('');
                chars.forEach((char, i) => {
                    var $span = $('<span>').text(char === ' ' ? '\u00A0' : char).css('display', 'inline-block');
                    if (animation === 'scramble') {
                        $span.data('original', char).text(getRandomChar());
                    }
                    $elem.append($span);
                });
                $elem.find('span').each(function(i) {
                    var $span = $(this);
                    setTimeout(() => {
                        if (animation === 'scramble') {
                            scrambleText($span, $span.data('original'), duration / chars.length);
                        } else {
                            $span.css({
                                'animation-name': 'letterFadeIn',
                                'animation-duration': (duration / chars.length) + 'ms',
                                'animation-delay': (delay + i * 50) + 'ms',
                                'animation-fill-mode': 'both'
                            });
                        }
                    }, delay + i * 50);
                });
            } else if (animation === 'wordSlideIn') {
                var words = text.split(' ');
                words.forEach((word, i) => {
                    var $span = $('<span>').text(word + ' ').css('display', 'inline-block');
                    $elem.append($span);
                    setTimeout(() => {
                        $span.css({
                            'animation-name': 'wordSlideIn',
                            'animation-duration': duration + 'ms',
                            'animation-delay': (delay + i * 100) + 'ms',
                            'animation-fill-mode': 'both'
                        });
                    }, delay);
                });
            } else if (animation === 'letterFadeIn' || animation === 'wave') {
                var chars = text.split('');
                chars.forEach((char, i) => {
                    var $span = $('<span>').text(char === ' ' ? '\u00A0' : char).css('display', 'inline-block');
                    $elem.append($span);
                    setTimeout(() => {
                        $span.css({
                            'animation-name': animation,
                            'animation-duration': duration + 'ms',
                            'animation-delay': (delay + i * 50) + 'ms',
                            'animation-fill-mode': 'both'
                        });
                    }, delay);
                });
            }
        }

        function animateGroup($elem, animation, duration, delay) {
            var $children = $elem.children();
            $children.each(function(i) {
                var $child = $(this);
                setTimeout(() => {
                    $child.css({
                        'animation-name': animation,
                        'animation-duration': duration + 'ms',
                        'animation-delay': (delay + i * 100) + 'ms',
                        'animation-fill-mode': 'both'
                    });
                }, delay);
            });
        }

        function getRandomChar() {
            var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            return chars.charAt(Math.floor(Math.random() * chars.length));
        }

        function scrambleText($span, target, duration) {
            var interval = setInterval(() => {
                $span.text(getRandomChar());
            }, 50);
            setTimeout(() => {
                clearInterval(interval);
                $span.text(target);
                $span.css({
                    'animation-name': 'letterFadeIn',
                    'animation-duration': duration + 'ms',
                    'animation-fill-mode': 'both'
                });
            }, duration);
        }

        function nextSlide() {
            var nextIndex = currentIndex + 1;
            if (nextIndex >= $slides.length) {
                nextIndex = settings.loop ? 0 : currentIndex;
            }
            goToSlide(nextIndex, 'next');
        }

        function prevSlide() {
            var prevIndex = currentIndex - 1;
            if (prevIndex < 0) {
                prevIndex = settings.loop ? $slides.length - 1 : currentIndex;
            }
            goToSlide(prevIndex, 'prev');
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
        lazyLoadImage($slides.eq(0));
        applyTransition($slides.eq(0), $slides.eq(0).data('transition') || 'fade');
        $slides.eq(0).addClass('active');
        $dots.eq(0).addClass('active');
        $slides.eq(0).find('[data-animation]').each(function() {
            var $elem = $(this);
            var animation = $elem.data('animation');
            var duration = parseInt($elem.data('duration')) || 1000;
            var delay = parseInt($elem.data('delay')) || 0;

            if (animation !== 'none') {
                if (['typewriter', 'wordSlideIn', 'letterFadeIn', 'wave', 'scramble'].includes(animation)) {
                    $elem.addClass('ababil-animated-text');
                    animateText($elem, animation, duration, delay);
                } else if (['staggeredFadeIn', 'masonryLoad', 'cascadeSlideIn'].includes(animation)) {
                    $elem.addClass('ababil-animated-group');
                    animateGroup($elem, animation, duration, delay);
                } else {
                    $elem.css({
                        'animation-name': animation,
                        'animation-duration': duration + 'ms',
                        'animation-delay': delay + 'ms',
                        'animation-fill-mode': 'both'
                    });
                }
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

        if (settings.touchSwipe) {
            var touchStartX, touchStartY;
            $slider.on('touchstart', function(e) {
                touchStartX = e.originalEvent.touches[0].clientX;
                touchStartY = e.originalEvent.touches[0].clientY;
            }).on('touchend', function(e) {
                var touchEndX = e.originalEvent.changedTouches[0].clientX;
                var touchEndY = e.originalEvent.changedTouches[0].clientY;
                var deltaX = touchEndX - touchStartX;
                var deltaY = touchEndY - touchStartY;
                if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > 50) {
                    if (deltaX > 0) prevSlide();
                    else nextSlide();
                }
            });
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
            $slider.off('mouseenter mouseleave touchstart touchend');
            $slider.removeClass('ababil-slider-initialized');
        });
    }

    $(document).ready(function() {
        $('.ababil-slider').each(function() {
            initSlider($(this));
        });
    });

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/ababil-slider.default', function($scope) {
            $scope.find('.ababil-slider').each(function() {
                $(this).trigger('destroy');
                initSlider($(this));
            });
        });
    });
})(jQuery);