(function($){
    var ANIM_TIME = 300,

        header;

    function toggle_icon( el, iconName, isPressed ){
        var light = 'icon-' + iconName + '-light',
            dark = 'icon-' + iconName + '-dark';
        if( isPressed ){
            $(el).removeClass(dark).addClass(light);
        } else {
            $(el).removeClass(light).addClass(dark);
        }
    }

    function overlay_active( activate ){
        $('#overlay').toggleClass( 'active', activate );
    }

    function menu_active( activate ){
        var menu = $('.menu', header);
        if( arguments.length === 0 ){ return menu.hasClass('active'); }

        menu.toggleClass('active', activate);
        toggle_icon( '#show-menu', 'list', activate );
        overlay_active( activate );

        if( ! menu_active() ){
            menu.css( 'left', '' ).find( '.active' ).removeClass('active');
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
        }).trigger('resize');

        // close the menu if anything outside the header is clicked
        $('body').bind( 'click', function(e){
            if( $(e.target).closest('header').length === 0 ){
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