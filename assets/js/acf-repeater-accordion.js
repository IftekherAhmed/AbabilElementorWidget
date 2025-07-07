jQuery(document).ready(function($) {
    $('.ababil-acf-accordion').each(function() {
        var $accordion = $(this);
        var accordionID = $accordion.attr('id');
        var behavior = $accordion.data('behavior') || 'accordion';

        $accordion.on('click', '.ababil-acf-accordion-title', function() {
            var $title = $(this);
            var $item = $title.closest('.ababil-acf-accordion-item');
            var $content = $item.find('.ababil-acf-accordion-content');
            var $iconNormal = $item.find('.ababil-acf-accordion-icon-normal');
            var $iconActive = $item.find('.ababil-acf-accordion-icon-active');

            if (behavior === 'accordion') {
                $accordion.find('.ababil-acf-accordion-item').not($item).removeClass('active');
                $accordion.find('.ababil-acf-accordion-content').not($content).slideUp();
                $accordion.find('.ababil-acf-accordion-title').not($title).removeClass('active');
                $accordion.find('.ababil-acf-accordion-icon-normal').not($iconNormal).css('display', 'inline-flex');
                $accordion.find('.ababil-acf-accordion-icon-active').not($iconActive).css('display', 'none');
            }

            $item.toggleClass('active');
            $content.slideToggle();
            $title.toggleClass('active');

            if ($item.hasClass('active')) {
                $iconNormal.css('display', 'none');
                $iconActive.css('display', 'inline-flex');
            } else {
                $iconNormal.css('display', 'inline-flex');
                $iconActive.css('display', 'none');
            }
        });
    });
});
