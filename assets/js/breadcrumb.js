jQuery(document).ready(function($) {
    $('.ababil-breadcrumb-item').on('mouseenter', function() {
        $(this).addClass('hovered');
    }).on('mouseleave', function() {
        $(this).removeClass('hovered');
    });
});