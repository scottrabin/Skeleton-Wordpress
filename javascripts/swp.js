(function($){
    var ANIM_TIME = 300,
        header;

    function menu_reset(){
        $('.menu', header).css('left', '');
        $('ul.active', header).removeClass('active');
    }

    $(function(){
        // faster lookups
        header = $('header');

        // listen for resize events to apply the .mobile class if necessary
        $(window).on( 'resize', function(){
            $('body').toggleClass( 'mobile', $(this).width() < 768 );
        }).trigger('resize');

        // close the menu if anything outside the header is clicked
        $('body').bind( 'click', function(e){
            if( $(e.target).closest('header').length === 0 ){
                header.removeClass('active');
            }
        });

        // toggle the menu if the show menu button is clicked
        $('.show-menu').bind( 'click', function(e){
            if( header.hasClass('active') ){
                // deactivating, so reset
                menu_reset();
            }

            header.toggleClass('active');

            e.preventDefault();
            return false;
        });

        // when a menu link with children is clicked, show the sub-menu
        $('html').on( 'click', '.mobile .menu a', function(e){
            // find out if the menu item has a sub-menu
            if( $(this).closest('li').children('ul.children').length > 0 ){

                $(this)
                    .closest('li').children('ul.children').addClass('active').end()
                    .closest('.menu').animate({left: "-=100%"}, ANIM_TIME);

                e.preventDefault();
                return false;
            }
        });
    });

})(jQuery);