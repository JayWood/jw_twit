/* Main JS File */
window.jwtwit = ( function( window, document, $ ){

	var app = {};

	app.cache = function(){
		app.$gen_table = $( '.jwtwit-general' );
		app.$token     = app.$gen_table.find( '#jwtwit_key' );
		app.$secret    = app.$gen_table.find( '#jwtwit_secret' );
		app.$edit_btn  = app.$gen_table.find( '.edit-twitter-data' );
	};

	app.init = function(){
		app.cache();
		$( 'body' ).on( 'click', '.edit-twitter-data', app.show_jwtwit_fields );
	};

	app.show_jwtwit_fields = function( evt ){
		evt.preventDefault();
		app.$gen_table.find( 'tr' ).slideDown();
		$( this ).fadeOut( 200 );
	};

	$( document ).ready( app.init );

	return app;

})(window, document, jQuery);