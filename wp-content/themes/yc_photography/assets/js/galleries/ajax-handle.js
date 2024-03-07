// console.log('Hello Ajax !');
( function ($) {
    // Selects all span.heart
    hearts = $('.heart');
    // If click on one of them.
    $(hearts).click(function() {
        // Selects the span corresponding to THIS heart and that displays the likes counter.
        var spanCounter = $(this).parent().next().children('span');
        // Selects the input tag corresponding to THIS heart and that stores the value of the likes counter.
        var inputStorage = spanCounter.next();
        // Retrieves the value of this input.
        var inputStorageValue = spanCounter.next().val();
        // Retrieves the value of the following input, which stores the id of the image concerned.
        var inputStorageAttId = inputStorage.next().val();

        // Stores data in the wp_likes table.
        $.ajax({
            type: 'POST', // Adding Post method.
            url: MyAjax.ajaxurl, // Including ajax file.
            data: {'action': 'actionFunction', 'dname': inputStorageValue, 'att_id': inputStorageAttId}, // Sending data dname to actionFunction function.
            success: 
            function(data) { // Show returned data using the function.
                // alert(data);
            }
        });
});
}) (jQuery);