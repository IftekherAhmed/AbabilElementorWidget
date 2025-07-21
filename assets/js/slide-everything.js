jQuery(document).ready(function($) {
    $('.ababil-slide-everything-container').each(function() {
        var $this = $(this);
        var postListSelector = $this.data('post-list-selector');
        var $postList = $(postListSelector);

        if ($postList.length && $postList.find('.post').length && !$this.hasClass('swiper-initialized')) {
            // Wrap each .post in a swiper-slide
            $postList.find('.post').each(function() {
                $(this).wrap('<div class="swiper-slide"></div>');
            });

            // Move the .post_list content into the swiper-wrapper
            var $swiperWrapper = $this.find('.swiper-wrapper');
            $swiperWrapper.append($postList.children('.swiper-slide'));

            // Initialize Swiper
            var config = {
                slidesPerView: parseInt($this.data('spv')) || 3,
                spaceBetween: parseInt($this.data('spacebetween')) || 20,
                loop: !!$this.data('loop'),
                autoplay: $this.data('autoplay') ? { delay: parseInt($this.data('autoplay-delay')) || 3000, reverseDirection: !!$this.data('autoplay-reverse') } : false,
                centeredSlides: !!$this.data('center-slides'),
                pagination: $this.data('pagination') ? { el: '.swiper-pagination', clickable: true } : false,
                navigation: $this.data('arrows') ? { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' } : false,
                mousewheel: !!$this.data('mousewheel'),
                freeMode: !!$this.data('freemode'),
                breakpoints: {
                    320: { slidesPerView: parseInt($this.data('spvp')) || 1 },
                    768: { slidesPerView: parseInt($this.data('spvt')) || 2 },
                    1024: { slidesPerView: parseInt($this.data('spv')) || 3 }
                }
            };

            new Swiper($this[0], config);
        }
    });
});