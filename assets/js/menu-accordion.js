jQuery(document).ready(function($) {
    $('.ababil-menu-accordion').each(function() {
        var $accordion = $(this);
        var behavior = $accordion.data('behavior') || 'toggle';

        // Set initial display for active items
        $accordion.find('.ababil-menu-accordion-item.active > .ababil-menu-accordion-submenu').css('display', 'block');
    });

    $(document).on('click', '.ababil-menu-accordion-toggle', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var $toggle = $(this);
        var $header = $toggle.closest('.ababil-menu-accordion-header');
        var $item = $header.closest('.ababil-menu-accordion-item');
        var $submenu = $item.children('.ababil-menu-accordion-submenu');
        var $accordion = $item.closest('.ababil-menu-accordion');
        var behavior = $accordion.data('behavior') || 'toggle';

        if (behavior === 'accordion') {
            // Close siblings
            $item.siblings('.ababil-menu-accordion-item.active').each(function() {
                var $sib = $(this);
                $sib.removeClass('active');
                $sib.children('.ababil-menu-accordion-submenu').slideUp(300);
            });
        }

        $item.toggleClass('active');
        $submenu.slideToggle(300);
    });
});