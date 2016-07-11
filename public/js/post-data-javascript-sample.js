( function( $, postData ) {

  'use strict';

  $( document ).ready( function(){

    var template = "";
    if ( $.isEmptyObject( postData ) ) {

      // No data in the JS object. Either render 'not found' or fail silently
      template = "No data sent from the post";
    } else {

      // Render JS object data here
      template = "Data was sent from the post on JavaScript object 'postData'.";
    }

    // HTML must have `<div id="postdata"></div>` where the data will go
    // Alternately, assign any existing tag with the id `postdata`.

    $( '#postdata' ).html( template );
  });

} )( jQuery, postData || {} ); // If no post data, default is an empty object
