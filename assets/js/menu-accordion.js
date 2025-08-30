jQuery(document).ready(function($) {
    function initializeAccordion($accordion) {
        var behavior = $accordion.data('behavior') || 'toggle';
        var defaultState = $accordion.data('default-state') || 'all_closed';

        // Initialize active states
        $accordion.find('.ababil-menu-accordion-item').each(function() {
            var $item = $(this);
            if ($item.hasClass('active')) {
                $item.find('> .ababil-menu-accordion-submenu').css('display', 'block');
                $item.find('> .ababil-menu-accordion-header .ababil-menu-accordion-icon-normal').hide();
                $item.find('> .ababil-menu-accordion-header .ababil-menu-accordion-icon-active').show();
            } else {
                $item.find('> .ababil-menu-accordion-submenu').css('display', 'none');
                $item.find('> .ababil-menu-accordion-header .ababil-menu-accordion-icon-normal').show();
                $item.find('> .ababil-menu-accordion-header .ababil-menu-accordion-icon-active').hide();
            }
        });
    }

    // Initialize all accordions
    $('.ababil-menu-accordion').each(function() {
        initializeAccordion($(this));
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
            $item.siblings('.ababil-menu-accordion-item.active').each(function() {
                var $sib = $(this);
                $sib.removeClass('active');
                $sib.find('> .ababil-menu-accordion-submenu').slideUp(300);
                $sib.find('> .ababil-menu-accordion-header .ababil-menu-accordion-icon-normal').show();
                $sib.find('> .ababil-menu-accordion-header .ababil-menu-accordion-icon-active').hide();
            });
        }

        $item.toggleClass('active');
        if ($item.hasClass('active')) {
            $submenu.slideDown(300);
            $toggle.find('.ababil-menu-accordion-icon-normal').hide();
            $toggle.find('.ababil-menu-accordion-icon-active').show();
        } else {
            $submenu.slideUp(300);
            $toggle.find('.ababil-menu-accordion-icon-normal').show();
            $toggle.find('.ababil-menu-accordion-icon-active').hide();
        }
    });

    // Handle Elementor preview updates
    if (typeof elementor !== 'undefined') {
        elementor.channels.editor.on('change', function(view) {
            var $accordion = view.$el.find('.ababil-menu-accordion');
            if ($accordion.length) {
                initializeAccordion($accordion);
            }
        });
    }
});