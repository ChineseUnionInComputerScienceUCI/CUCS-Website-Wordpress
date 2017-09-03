/*global redux_change, wp, redux*/

(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.thinkup_slider_v3 = redux.field_objects.thinkup_slider_v3 || {};

    $( document ).ready(
        function() {
            //redux.field_objects.thinkup_slider_v3.init();
        }
    );

    redux.field_objects.thinkup_slider_v3.init = function( selector ) {

        if ( !selector ) {
            selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-thinkup_slider_v3:visible' );
        }

        $( selector ).each(
            function() {
                var el = $( this );

                redux.field_objects.media.init(el);

                var parent = el;
                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }
                if ( parent.is( ":hidden" ) ) { // Skip hidden fields
                    return;
                }
                
                if ( parent.hasClass( 'redux-container-thinkup_slider_v3' ) ) {
                    parent.addClass( 'redux-field-init' );    
                }
                
                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }

                el.find( '.redux-thinkup_slider_v3-remove' ).live(
                    'click', function() {
                        redux_change( $( this ) );

                        $( this ).parent().siblings().find( 'input[type="text"]' ).val( '' );
                        $( this ).parent().siblings().find( 'textarea' ).val( '' );
                        $( this ).parent().siblings().find( 'input[type="hidden"]' ).val( '' );

                        var slideCount = $( this ).parents( '.redux-container-thinkup_slider_v3:first' ).find( '.redux-thinkup_slider_v3-accordion-group' ).length;

                        if ( slideCount > 1 ) {
                            $( this ).parents( '.redux-thinkup_slider_v3-accordion-group:first' ).slideUp(
                                'medium', function() {
                                    $( this ).remove();
                                }
                            );
                        } else {
                            var content_new_title = $( this ).parent( '.redux-thinkup_slider_v3-accordion' ).data( 'new-content-title' );

                            $( this ).parents( '.redux-thinkup_slider_v3-accordion-group:first' ).find( '.remove-image' ).click();
                            $( this ).parents( '.redux-container-thinkup_slider_v3:first' ).find( '.redux-thinkup_slider_v3-accordion-group:last' ).find( '.redux-thinkup_slider_v3-header' ).text( content_new_title );
                        }
                    }
                );

                //el.find( '.redux-thinkup_slider_v3-add' ).click(
                el.find( '.redux-thinkup_slider_v3-add' ).off('click').click(
                    function() {
                        var newSlide = $( this ).prev().find( '.redux-thinkup_slider_v3-accordion-group:last' ).clone( true );

                        var slideCount = $( newSlide ).find( '.slide-title' ).attr( "name" ).match( /[0-9]+(?!.*[0-9])/ );
                        var slideCount1 = slideCount * 1 + 1;

                        $( newSlide ).find( 'input[type="text"], input[type="hidden"], textarea' ).each(
                            function() {

                                $( this ).attr(
                                    "name", jQuery( this ).attr( "name" ).replace( /[0-9]+(?!.*[0-9])/, slideCount1 )
                                ).attr( "id", $( this ).attr( "id" ).replace( /[0-9]+(?!.*[0-9])/, slideCount1 ) );
                                $( this ).val( '' );
                                if ( $( this ).hasClass( 'slide-sort' ) ) {
                                    $( this ).val( slideCount1 );
                                }
                            }
                        );

                        var content_new_title = $( this ).prev().data( 'new-content-title' );

                        $( newSlide ).find( '.screenshot' ).removeAttr( 'style' );
                        $( newSlide ).find( '.screenshot' ).hide();
                        $( newSlide ).find( '.screenshot a' ).attr( 'href', '' );
                        $( newSlide ).find( '.remove-image' ).addClass( 'hide' );
                        $( newSlide ).find( '.redux-thinkup_slider_v3-image' ).attr( 'src', '' ).removeAttr( 'id' );
                        $( newSlide ).find( '.redux-option-image' ).attr( 'src', '' ).removeAttr( 'id' );
                        $( newSlide ).find( 'h3' ).text( '' ).append( '<span class="redux-thinkup_slider_v3-header">' + content_new_title + '</span><span class="ui-accordion-header-icon ui-icon ui-icon-plus"></span>' );
                        $( this ).prev().append( newSlide );
                    }
                );

                el.find( '.slide-title' ).keyup(
                    function( event ) {
                        var newTitle = event.target.value;
                        $( this ).parents().eq( 3 ).find( '.redux-thinkup_slider_v3-header' ).text( newTitle );
                    }
                );


                el.find( ".redux-thinkup_slider_v3-accordion" )
                    .accordion(
                    {
                        header: "> div > fieldset > h3",
                        collapsible: true,
                        active: false,
                        heightStyle: "content",
                        icons: {
                            "header": "ui-icon-plus",
                            "activeHeader": "ui-icon-minus"
                        }
                    }
                )
                    .sortable(
                    {
                        axis: "y",
                        handle: "h3",
                        connectWith: ".redux-thinkup_slider_v3-accordion",
                        start: function( e, ui ) {
                            ui.placeholder.height( ui.item.height() );
                            ui.placeholder.width( ui.item.width() );
                        },
                        placeholder: "ui-state-highlight",
                        stop: function( event, ui ) {
                            // IE doesn't register the blur when sorting
                            // so trigger focusout handlers to remove .ui-state-focus
                            ui.item.children( "h3" ).triggerHandler( "focusout" );
                            var inputs = $( 'input.slide-sort' );
                            inputs.each(
                                function( idx ) {
                                    $( this ).val( idx );
                                }
                            );
                        }
                    }
                );
            }
        );
    };
})( jQuery );