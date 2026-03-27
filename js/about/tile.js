$(function() {
    
    $('.beginner-scene')
        .hover(
            function(){
                $(this).children('.in-label').fadeIn('slow');
                $(this).children('.title').hide();
            },
            function () {
                $(this).children('.in-label').fadeOut('slow');
                $(this).children('.title').show();

        }
    );
});
