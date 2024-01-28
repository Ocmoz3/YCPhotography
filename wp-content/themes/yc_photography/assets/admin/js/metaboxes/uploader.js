// (function($) {
    // Si click sur bouton upload image
    // Par défaut, WP charge les scripts dans le head donc le HTML n'est pas chargé quand le script se lancxe.
    // Deux solutions : soit on lui indique ici d'attendre que le HTML soit chargé, soit on lui indique de charger le fichier dnas le footer lors du enqueue
    // $(document).ready(function() {
    //     $('.js-uploader').click(function(e) {
        function getThisBtn(e, elem) {
            // Empêche le click par défaut, au cas où il y aurait un href particulier
            // Empêche rechargement de page
            e.preventDefault()
            // Déclare variable qui est l'élément qur lequel on a cliqué
            var $this = jQuery(elem);
            // var $this = jQuery(this);
            // var $this = this.e;
            console.log($this);
            // Déclare variable qui récupère l'attribut data-multiple dans le champ
            var multiple = $this.data('multiple')
            // console.log(multiple);
            // Déclare variable qui sera une référence à l'uploader de média
            var uploader = wp.media({
                // À ce moment-là, on initialise l'uploader de médias avec différents paramètres
                // titre
                title: 'Choisissez un fichier',
                // bouton
                button: {
                    // texte du bouton
                    text: 'Sélectionnez un fichier'
                },
                // accepte les éléments multiples
                // ne fonctionne pas ???
                // multiple: multiple
                multiple: true
            })
            // Doit détecter quand un élément, une image est sélectionnée
            // Quand je sélectionne
            uploader.on('select', function() {
                // je récupère l'élément que j'ai sélectionné
                // et je récupère l'état actuel, l'état 'sélection'
                var selection = uploader.state().get('selection')
                // je récupère ensuite la liste des urls en créant le tableau 'sélection'
                // map() me permet de parcourir chaque élément et de récupérer l'item
                var urls = selection.map(function(item) {
                    // et je retourne l'url de l'item et je le transforme en objet
                    // je récupère un tableau des urls
                    return item.toJSON().url
                })
                // Je mets la valeur dans le champ data-id
                // Pour ce faire, je récupère l'id et je lui attribue les urls séparés par une virgule
                // jQuery('#' + $this.data('id')).val(urls.join(','))
                console.log(jQuery($this).prev());
                inputDataIdPrev = jQuery($this).prev();
                inputDataId = jQuery($this).prev().val(urls);
                // je récupère la valeur de l'input
                // changedSrc = jQuery('#' + $this.data('id')).val();
                changedSrc = jQuery(inputDataId).val();
                console.log(changedSrc);
                // pour l'injecter dans l'attribut src de la balise img donc l'image se met à jour à chaque nouvelle sélection
                imgTagPrev = $this.prev();
                console.log(imgTagPrev);
                imgTagAround = imgTagPrev.prev();
                imgTag = imgTagAround.children();
                jQuery(imgTag).attr('src', changedSrc);
                jQuery(imgTagPrev).attr('value', changedSrc);
            })
            // Quand j'ai cette metabox, je peux l'ouvrir
            uploader.open()
        }
//         )
//     })
// })(jQuery)