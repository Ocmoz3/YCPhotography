/**
 * Uploader meta box JavaScript
 */

// (function($) {
    function getThisBtn(e, elem) {
        e.preventDefault()
        // Declares variable corresponding to the element clicked on.
        var $this = jQuery(elem);
        console.log($this);
        // Déclare variable qui récupère l'attribut data-multiple dans le champ
        var multiple = $this.data('multiple')
        // console.log(multiple);
        // Declares variable that will be a reference to the media uploader.
        var uploader = wp.media({
            // Initializes the media uploader with various parameters.
            title: 'Choisissez un fichier',
            button: {
                text: 'Sélectionnez un fichier'
            },
            // accepte les éléments multiples
            // ne fonctionne pas ???
            // multiple: multiple
            multiple: true
        })
        // Detects when an image is selected.
        uploader.on('select', function() {
            // Recovers the image and its state ('selected').
            var selection = uploader.state().get('selection')
            // je récupère ensuite la liste des urls en créant le tableau 'sélection'
            // map() me permet de parcourir chaque élément et de récupérer l'item
            var urls = selection.map(function(item) {
                // et je retourne l'url de l'item et je le transforme en objet
                // je récupère un tableau des urls
                return item.toJSON().url
            });
            // Selects this metabox input tag
            // inputDataIdPrev = jQuery($this).prev();
            inputPrev = jQuery($this).prev().val(urls);
            changedSrc = jQuery(inputPrev).val();
            // Selects this metabox image tag
            imgTagPrev = $this.prev();
            imgTagAround = imgTagPrev.prev();
            imgTag = imgTagAround.children();
            // Attributes new image source
            jQuery(imgTag).attr('src', changedSrc);
            jQuery(imgTagPrev).attr('value', changedSrc);
        })
        uploader.open()
    }
// })(jQuery)