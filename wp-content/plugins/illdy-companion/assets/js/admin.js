// jscs:ignore validateLineBreaks
var illdyCompanionImporter = {

      /**
      * Show hidden content
      */
      showHiddenContent: function() {
          jQuery( '.epsilon-hidden-content-toggler' ).on( 'click', function( e ) {
            e.preventDefault();
            jQuery( jQuery( this ).attr( 'href' ) ).slideToggle();
          } );
      },

      /**
      * Import demo content
      */
      importDemoContent: function() {
          jQuery( '#add_default_sections' ).click( function( e ) {
            var container = jQuery( this ).parents( '.action-required-box' ),
                checkboxes = container.find( ':checkbox' ),
                args = {
                  action: [ 'Illdy_Companion_Import_Data', 'process_sample_content' ],
                  nonce: welcomeScreen.ajax_nonce,
                  args: []
               };

            e.preventDefault();

            jQuery( this ).addClass( 'updating-message' );

            jQuery.each( checkboxes, function( k, item ) {

              if ( jQuery( item ).prop( 'checked' ) ) {
                args.args.push( jQuery( item ).val() );
              }

            } );

            jQuery.ajax( {
                  type: 'POST',
                  data: { action: 'welcome_screen_ajax_callback', args: args },
                  dataType: 'json',
                  url: ajaxurl,
                  success: function() {
                    location.reload();
                  },
                  /**
                   * Throw errors
                   *
                   * @param jqXHR
                   * @param textStatus
                   * @param errorThrown
                   */
                  error: function( jqXHR, textStatus, errorThrown ) {
                    console.log( jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown );
                  }

                } );

          } );
      }

};

jQuery( document ).ready(function() {

      illdyCompanionImporter.showHiddenContent();
      illdyCompanionImporter.importDemoContent();

});
