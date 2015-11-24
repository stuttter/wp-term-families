jQuery( document ).ready( function() {
    'use strict';

    jQuery( '.editinline' ).on( 'click', function() {
        var tag_id = jQuery( this ).parents( 'tr' ).attr( 'id' ),
			family = jQuery( 'td.family span', '#' + tag_id ).attr( 'data-family' );

        jQuery( 'select[name="term-family"]', '.inline-edit-row' ).val( family );
    } );
} );
