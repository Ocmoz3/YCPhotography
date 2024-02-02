console.log('Hello Ajax !');
( function ($) {
    // Je sélectionne tous les coeurs
    hearts = $('.heart');
    // Si je clique sur un de ces coeurs
    $(hearts).click(function() {
        // Je sélectionne le span qui correspond à CE coeur et qui affiche le compteur de likes
        var spanCounter = $(this).next();
        // Je sélectionne l'input qui correspond à CE coeur et qui stocke la valeur du compteur de likes
        var inputStorage = spanCounter.next();
        // Je récupère la valeur de cet input
        var inputStorageValue = spanCounter.next().val();
        // Je récupère la valeur de l'input qui suit et qui stocke l'id de l'image concernée
        var inputStorageAttId = inputStorage.next().val();

        // Je stocke les données dans la table wp_likes
        $.ajax({
            type: 'POST', // Adding Post method
            url: MyAjax.ajaxurl, // Including ajax file
            data: {'action': 'actionFunction', 'dname': inputStorageValue, 'att_id': inputStorageAttId}, // Sending data dname to post_word_count function.
            success: 
            function(data) { // Show returned data using the function.
                alert(data);
            }
        });
});


}) (jQuery);