console.log('Hello Ajax');
jQuery('#btn').click(function(e) {
    
    e.preventDefault();
    // $.post(ajaxurl, {action: 'actionFunction'}, function (data) {
    //     alert(data);
        // $('#frontpage_metabox_portfolio').append(data);
    // });
    // die();
    jQuery.ajax({
    type: 'POST', // Adding Post method
    url: MyAjax.ajaxurl, // Including ajax file
    // data: {'action': 'actionFunction', 'dname': inputStorageValue, 'att_id': inputStorageAttId}, // Sending data dname to post_word_count function.
    // data: {'action': 'actionFunction', }, // Sending data dname to post_word_count function.
    
    data: {'action': 'actionFunction' },
    // }).done(function( msg ) {
    // alert( "Data Saved: " + msg );
    // });
    success: 
    function(data) { // Show returned data using the function.
        // $('#sections_meta_box').parent().append(data);
        jQuery('#frontpage_metabox_portfolio').append(data);
        alert(data);
    }
});
});
// jQuery('#inputSub').click(function(e) {
//     e.preventDefault();
// });
// jQuery('.button').click(function(e) {
//     // e.preventDefault();
//     console.log('ok btn');
//     // jQuery.ajax({
//     //     type: "POST",
//     //     url: MyAjax.ajaxurl,
//     //     data: { name: "John" }
//     // }).done(function( msg ) {
//     //     alert( "Data Saved: " + msg );
//     // });
// }); 