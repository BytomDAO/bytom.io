// jscs:ignore validateLineBreaks
var illdyCompanion = {};
illdyCompanion.textEditor = {
  init: function( selector ) {
    var context = jQuery( selector ),
        editorId = jQuery( context.find( 'textarea' ) ).attr( 'id' );

    if ( tinymce.get( editorId ) ) {
		wp.editor.remove( editorId );
	}

    wp.editor.initialize( editorId, {
      tinymce: {
        wpautop: true,
        setup: function( editor ) {
          editor.on( 'change', function() {
            editor.save();
            jQuery( editor.getElement() ).trigger( 'change' );
          } );
        }
      },
      quicktags: true
    } );
  }
};

jQuery( document ).ready( function( $ ) {
	$( '#widgets-right .illdy-editor-container' ).each(function() {
		illdyCompanion.textEditor.init( $( this ) );
	});

});

jQuery( document ).on( 'widget-updated widget-added', function( e, widget ) {
	var context = jQuery( widget ).find( '.illdy-editor-container' );
    illdyCompanion.textEditor.init( context );
});
