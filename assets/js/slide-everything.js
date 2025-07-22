jQuery(document).ready(function($) {
    $('.ababil-slide-everything-container').each(function() {
        var $this = $(this);
        var selectorString = $this.data('parent-id'); // can be #id or #id1, #id2

        if (!selectorString) return;

        // Split by comma and trim each selector
        var selectors = selectorString.split(',').map(s => s.trim());

        selectors.forEach(function(selector) {
            var $target = $(selector);

            if ($target.length && $target.children().length && !$target.hasClass('swiper-initialized')) {
                // Wrap each direct child in swiper-slide
                $target.children().each(function() {
                    if (!$(this).hasClass('swiper-slide')) {
                        $(this).wrap('<div class="swiper-slide"></div>');
                    }
                });

                // Create swiper-wrapper if not present
                if (!$target.find('.swiper-wrapper').length) {
                    var $wrapper = $('<div class="swiper-wrapper"></div>');
                    $wrapper.append($target.children('.swiper-slide'));
                    $target.append($wrapper);
                }

                // Add navigation/pagination if available in widget container
                var $swiperPagination = $this.find('.swiper-pagination');
                var $swiperNext = $this.find('.swiper-button-next');
                var $swiperPrev = $this.find('.swiper-button-prev');
                $target.append($swiperPagination.clone(), $swiperNext.clone(), $swiperPrev.clone());

                // Initialize Swiper
                var config = {
                    slidesPerView: parseInt($this.data('spv')) || 3,
                    spaceBetween: parseInt($this.data('spacebetween')) || 20,
                    loop: !!$this.data('loop'),
                    autoplay: $this.data('autoplay') ? {
                        delay: parseInt($this.data('autoplay-delay')) || 3000,
                        reverseDirection: !!$this.data('autoplay-reverse')
                    } : false,
                    centeredSlides: !!$this.data('center-slides'),
                    pagination: $this.data('pagination') ? {
                        el: '.swiper-pagination',
                        clickable: true
                    } : false,
                    navigation: $this.data('arrows') ? {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    } : false,
                    mousewheel: !!$this.data('mousewheel'),
                    freeMode: !!$this.data('freemode'),
                    breakpoints: {
                        320: { slidesPerView: parseInt($this.data('spvp')) || 1 },
                        768: { slidesPerView: parseInt($this.data('spvt')) || 2 },
                        1024: { slidesPerView: parseInt($this.data('spv')) || 3 }
                    }
                };

                new Swiper($target[0], config);
                $target.addClass('swiper-initialized');
            }
        });
    });
});
