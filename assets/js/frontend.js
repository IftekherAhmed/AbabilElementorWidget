jQuery(document).ready(function($) {
    // Add any interactive functionality here
    $('.ababil-text-segment').hover(
        function() {
            $(this).css('transform', 'translateY(-2px)');
        },
        function() {
            $(this).css('transform', 'translateY(0)');
        }
    );
});