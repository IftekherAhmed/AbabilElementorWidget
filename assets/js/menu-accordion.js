jQuery(document).ready(function($) {
    function initializeAccordion($accordion) {
        var behavior = $accordion.data('behavior') || 'toggle';
        var defaultState = $accordion.data('default-state') || 'all_closed';
        var openSubmenuOnActive = $accordion.data('open-submenu-on-active') === 'yes';

        // Initialize active states
        $accordion.find('.ababil-menu-accordion-item').each(function() {
            var $item = $(this);
            var isActive = $item.hasClass('active') || 
                          (defaultState === 'all_open') ||
                          (defaultState === 'first_open' && $item.index() === 0 && !$item.parents('.ababil-menu-accordion-submenu').length) ||
                          (openSubmenuOnActive && $item.hasClass('current-menu-ancestor'));

            if (isActive) {
                $item.addClass('active');
                $item.find('> .ababil-menu-accordion-submenu').css('display', 'block');
                $item.find('> .ababil-menu-accordion-header .ababil-menu-accordion-icon-normal').hide();
                $item.find('> .ababil-menu-accordion-header .ababil-menu-accordion-icon-active').show();
            } else {
                $item.removeClass('active');
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

    // For Elementor editor live preview
    if ( window.elementor ) {
        elementor.hooks.addAction( 'panel/open_editor/widget/ababil-menu-accordion', function( panel, model, view ) {
            model.on( 'change', function() {
                view.render();
                initializeAccordion( view.$el.find('.ababil-menu-accordion') );
            } );
        } );
    }
});