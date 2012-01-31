(function($){
    var ANIM_TIME = 300,

        header;

    function toggle_icon( el, iconName, isPressed ){
        $(el).toggleClass( 'active', isPressed );
    }

    function overlay_active( activate ){
        $('#overlay').toggleClass( 'active', activate );
    }

    function menu_active( activate ){
        var menu = $('#main-menu', header);
        if( arguments.length === 0 ){ return menu.hasClass('active'); }

        menu.toggleClass('active', activate);
        toggle_icon( '#show-menu', 'list', activate );
        overlay_active( activate );

        if( ! menu_active() ){
            menu.children('.menu').css( 'margin-left', '' ).find( '.active' ).removeClass('active');
        }
    }

    function search_active( activate ){
        var search = $('#searchform');
        if( arguments.length === 0 ){ return search.hasClass('active'); }

        search.toggleClass( 'active', activate );
        toggle_icon( '#show-search', 'zoom', activate );
        overlay_active( activate );

        if( search_active() ){
            $('input[name="s"]', search).focus();
        }
    }

    $(function(){
        // faster lookups
        header = $('header');

        // listen for resize events to apply the .mobile class if necessary
        $(window).on( 'resize', function(){
            $('body').toggleClass( 'mobile', $(this).width() < 480 );
            search_active( false );
            menu_active( false );
        }).trigger('resize');

        // close the menu if anything outside the header is clicked
        $('html').on( 'click', 'body.mobile', function(e){
            if( $(e.target).closest('header').length === 0 ||
                $(e.target).closest('#main-menu').length === 1 // should be halted before reaching this
              ){
                search_active( false );
                menu_active( false );
            }
        });

        // toggle the menu if the show menu button is clicked
        $('#show-menu').on( 'click', function(e){
            search_active( false );
            menu_active( ! menu_active() );

            e.preventDefault();
            return false;
        });

        $('#show-search').on( 'click', function(e){
            menu_active( false );
            search_active( ! search_active() );

            e.preventDefault();
            return false;
        });

        $('html').on( 'click', '.mobile #main-menu li', function(e){
            var sub_menu = $(this).children('ul');
            console.log( this );
            console.log( $(e.target) );
            console.log( sub_menu );

            var sub_menu = $(e.target).is('a') ? null : $(this).children('ul');

            if( sub_menu.length > 0 ){

                sub_menu.addClass('active');
                $('#main-menu').children('.menu').animate({marginLeft: '-=100%'}, ANIM_TIME);

                e.preventDefault();
                return false;
            }
        });
        
    });

})(jQuery);