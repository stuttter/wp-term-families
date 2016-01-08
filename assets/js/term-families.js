jQuery( document ).ready( function( $ ) {
    'use strict';

    $( '.editinline' ).on( 'click', function() {
        var tag_id = $( this ).parents( 'tr' ).attr( 'id' ),
			family = $( 'td.family span', '#' + tag_id ).data( 'family' );

		if ( typeof( family ) !== 'undefined' ) {
			setTimeout( function() {
				$( 'select[name="term-family"]', '.inline-edit-row' ).val( family );
			}, 100 );
		}
    } );
} );
