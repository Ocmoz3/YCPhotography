/**
 * Uploader meta box JavaScript
 */

function getThisBtn(e, elem) {
    e.preventDefault()
    // Declares variable corresponding to the element clicked on.
    var $this = jQuery(elem);
    // Déclare variable qui récupère l'attribut data-multiple dans le champ
    var multiple = $this.data('multiple');
    // Declares variable that will be a reference to the media uploader.
    var uploader = wp.media({
        // Initializes the media uploader with various parameters.
        title: 'Choisissez un fichier',
        button: {
            text: 'Sélectionnez un fichier'
        },
        // Accepts multiple elements.
        // Doesn't work ???
        // multiple: multiple
        multiple: true
    })
    // Detects when an image is selected.
    uploader.on('select', function() {
        // Recovers the image and its state ('selected').
        var selection = uploader.state().get('selection')
        // Retrieves the list of urls by creating the 'selection' table.
        // map() allows me to browse each element and retrieve the item.
        var urls = selection.map(function(item) {
            // Returns the element's url and transforms it into a object.
            // Retrieves an array of urls.
            return item.toJSON().url
        });
        // Selects this metabox input tag.
        inputPrev = jQuery($this).prev().val(urls);
        changedSrc = jQuery(inputPrev).val();
        // Selects this metabox image tag.
        imgTagPrev = $this.prev();
        imgTagAround = imgTagPrev.prev();
        imgTag = imgTagAround.children();
        // Attributes new image source.
        jQuery(imgTag).attr('src', changedSrc);
        jQuery(imgTagPrev).attr('value', changedSrc);
        // Displays <a>.
        imgTagAround.css('display', 'block');
    })
    uploader.open()
}