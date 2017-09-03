//Image Hover
jQuery(document).ready(function(){
jQuery(function() {
    jQuery('ul.port-thumb > li').hoverdir();
});
});	

(function( jQuery, undefined ) {
	jQuery.HoverDir 				= function( options, element ) {
		this.jQueryel	= jQuery( element );
		this._init( options );
	};
	jQuery.HoverDir.defaults 	= {
		hoverDelay	: 0,
		reverse		: false
	};
	jQuery.HoverDir.prototype 	= {
		_init 				: function( options ) {
			this.options 		= jQuery.extend( true, {}, jQuery.HoverDir.defaults, options );
			this._loadEvents();
		},
		_loadEvents			: function() {
			var _self = this;
			this.jQueryel.on( 'mouseenter.hoverdir, mouseleave.hoverdir', function( event ) {
				var jQueryel			= jQuery(this),
					evType		= event.type,
					jQueryhoverElem	= jQueryel.find( 'article' ),
					direction	= _self._getDir( jQueryel, { x : event.pageX, y : event.pageY } ),
					hoverClasses= _self._getClasses( direction );
				jQueryhoverElem.removeClass();				
				if( evType === 'mouseenter' ) {
					jQueryhoverElem.hide().addClass( hoverClasses.from );
					clearTimeout( _self.tmhover );
					_self.tmhover	= setTimeout( function() {
						jQueryhoverElem.show( 0, function() {
							jQuery(this).addClass( 'da-animate' ).addClass( hoverClasses.to );
						} );
					}, _self.options.hoverDelay );
				}
				else {
					jQueryhoverElem.addClass( 'da-animate' );
					clearTimeout( _self.tmhover );
					jQueryhoverElem.addClass( hoverClasses.from );
				}
			} );
		},
		_getDir				: function( jQueryel, coordinates ) {
			var w = jQueryel.width(),
				h = jQueryel.height(),
				x = ( coordinates.x - jQueryel.offset().left - ( w/2 )) * ( w > h ? ( h/w ) : 1 ),
				y = ( coordinates.y - jQueryel.offset().top  - ( h/2 )) * ( h > w ? ( w/h ) : 1 ),
				direction = Math.round( ( ( ( Math.atan2(y, x) * (180 / Math.PI) ) + 180 ) / 90 ) + 3 )  % 4;			
			return direction;
		},
		_getClasses			: function( direction ) {
			var fromClass, toClass;
			switch( direction ) {
				case 0:
					( !this.options.reverse ) ? fromClass = 'da-slideFromTop' : fromClass = 'da-slideFromBottom';
					toClass		= 'da-slideTop';
					break;
				case 1:
					( !this.options.reverse ) ? fromClass = 'da-slideFromRight' : fromClass = 'da-slideFromLeft';
					toClass		= 'da-slideLeft';
					break;
				case 2:
					( !this.options.reverse ) ? fromClass = 'da-slideFromBottom' : fromClass = 'da-slideFromTop';
					toClass		= 'da-slideTop';
					break;
				case 3:
					( !this.options.reverse ) ? fromClass = 'da-slideFromLeft' : fromClass = 'da-slideFromRight';
					toClass		= 'da-slideLeft';
					break;
			};
			return { from : fromClass, to: toClass };
		}
	};
	var logError 			= function( message ) {
		if ( this.console ) {
			console.error( message );
		}
	};
	jQuery.fn.hoverdir			= function( options ) {
		if ( typeof options === 'string' ) {
			var args = Array.prototype.slice.call( arguments, 1 );
			this.each(function() {
				var instance = jQuery.data( this, 'hoverdir' );
				if ( !instance ) {
					logError( "cannot call methods on hoverdir prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				if ( !jQuery.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for hoverdir instance" );
					return;
				}
				instance[ options ].apply( instance, args );
			});
		} 
		else {
			this.each(function() {
			
				var instance = jQuery.data( this, 'hoverdir' );
				if ( !instance ) {
					jQuery.data( this, 'hoverdir', new jQuery.HoverDir( options, this ) );
				}
			});
		}
		return this;
	};
})( jQuery );


// Initiate Quicksand
(function ( $ ) {
	$(document).ready(function(){
		
		var items = $('#container-inner .element'),
			itemsByTags = {};
		
		// Looping though all the li items:
		items.each(function(i, element){
			var elem = $(this);

			if(typeof elem.data('tags') != 'undefined') {
				tags = elem.data('tags').split(',');
			}

			// Adding a data-id attribute. Required by the Quicksand plugin:
			elem.attr('data-id',i);
			
			$.each(tags,function(key,value){
				
				// Removing extra whitespace:
				value = $.trim( value );

				if( !(value in itemsByTags) ){
					// Create an empty array to hold this item:
					itemsByTags[value] = [];
				}

				// Each item is added to one array per tag:
				itemsByTags[value].push(elem);
			});
		});

		// Creating the "Everything" option in the menu:
		createList('All',items);

		// Looping though the arrays in itemsByTags:
		$.each(itemsByTags,function(k,v){
			createList(k,v);
		});
		
		$('#filter a').live('click',function(e){
			var link = $(this);
			
			link.addClass('selected').siblings().removeClass('selected');
			
				jQuery(this).closest('#filter').find('li a').not(this).removeClass('selected');

			// Using the Quicksand plugin to animate the li items.
			// It uses data('list') defined by our createList function:
			$('#container-inner').quicksand( link.data('list').find('.element'), {
				duration: 800,
				useScaling: true,
			});

			e.preventDefault();
		});

		$('#filter a:first').click();
		
		function createList(text,items){

			// This is a helper function that takes the
			// text of a menu button and array of li items
			
			// Creating an empty unordered list:
			var ul = $('<ul>',{'class':'hidden'});
			
			$.each(items,function(){
				// Creating a copy of each li item
				// and adding it to the list:
				
				$(this).clone().appendTo(ul);
			});

			ul.appendTo('#container');

			// Creating a menu item. The unordered list is added
			// as a data parameter (available via .data('list'):
			
			var a = $('<a>',{
				html: text,
				data: {list:ul}
			}).appendTo('#filter');
		}
			// Wrap all filter items in li tags
			$( "#filter a" ).wrap( "<li></li>");

		// Looping though all the li items:
		var remove_tags = $('#filter a');
		remove_tags.each(function(i, element){
			if( $(this).text().match('thinkup_remove_tag') ) {
				$(this).remove();
			}  
		});
	});
}( jQuery ));