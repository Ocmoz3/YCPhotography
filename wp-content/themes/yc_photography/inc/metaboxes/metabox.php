<?php

class YC_FrontPage_Metabox {

    // $id sera appelé à diféérentes endroits et ne sera pas le même à chaque création d'objet donc j'initialise le champ. Je crée donc une propriété privée qui sera l'id, comme ça je pourrai y accéder plus tard. (voir plus bas)
    private $id;
    private $title;
    private $post_type;

    // propriété privée pour povuoir enregistrer les champs supplémentaires créés
    private $fields = [];

    // On crée un fonction statique pour enqueue le js nécessaire au uploader
    public static function addJS() {
        add_action('admin_enqueue_scripts', function() {
            // wp_register_script('uploaderjs', get_template_directory_uri() . '/assets/js/uploader.js');
            wp_register_script('uploaderjs', get_template_directory_uri() . '/assets/js/metaboxes/uploader.js', ['jquery'], '', true);
            wp_enqueue_script('uploaderjs');
        });
    }

    /**
     * YC_FrontPage_Metabox constructor.
     * @param $id Id de la metabox
     * @param $title Titre de la metabox
     * @param $post-type Post type
     */

    // Forcément un constructor
    // Pour créer ma metabox, j'ai besoin d'un id, d'un tire et du post-type Pour le post-type, peut mettre un tableau si on veut appliquer ce code sur différents post-types. Ici, un seul post-type concerné, pas besoin
    public function __construct($id, $title, $post_type) 
    {
        // Dans cette fonction, je déclare les deux actions MAIS je veux qu'elles fassent appel à des méthodes de la class donc, en focntion callback, je passe un tableau avec en premier paramètre une référence à $this qui est ma classe courante et en deuxième, la fonction de que je souhaite apppeler pour créer la metabox

        // À l'initiation de la partie admin, j'appelle la function qui va créer la metabox
        add_action('admin_init', array(&$this, 'create'));
        // Et aussi la fonction qui va sauvegarder la valeur de la metabox
        // Attention, ce hook se déclenche pour TOUS les posts (articles, pages, médias...)
        // Il croit d'office que le champ yc_surface existe
        // Donc, doit absolument être filtré
        // Fait dans la fonction 
        // add_action('save_post', array(&$this, 'save'));
        add_action('save_post', array(&$this, 'save'));

        $this->id = $id;
        $this->title = $title;
        $this->post_type = $post_type;
    }

    public function create() 
    {
        if(function_exists('add_meta_box')) {
            // Création de la metabox
            // parmam 1 Id de la metabox
            // param 2 Titre de la metabox (qui s'affiche)
            // param 3 fonction callback qui renvoie le HTML à afficher
            // param 4 post-type où doit s'afficher la metabox
            // + priorité...
            add_meta_box($this->id, $this->title, array(&$this, 'render'), $this->post_type);
        }
    }

    
    public function render() 
    {
    
        // J'utilise global $post pour accéder à l'ID du post surlequel je me trouve
        // J'en ai besoin pour accéder à la valeur de la metabox de cette page sépcifiquement
        global $post;
        // Attention, puisque j'ai choisi de pouvoir rendre plusieurs champs, je dois faire une boucle de tous mes champs
        foreach($this->fields as $field) {
            // Je récupère le template qui correspond au type de champ souhaité
            // Afin de pouvoir utiliser les données de chaque $field ($id, $title, etc.), j'extraie les données avec extract. Attention, à utliser avec beaucoup de précautions. Ici, on a le contrôle sur les données passées et récupérées donc ne craint rien. Ne va pas générer de variables qui pourraient gêner le reste de mon script.
            extract($field);
            // Il nous manque tjs la value
            $value = get_post_meta($post->ID, $id, true);
            // Si la valeur est vide, je prends la valeur par défaut
            if($value == '') {
                $value = $default;
            }
            // __DIR__ = dossier courant
            require __DIR__ . '/' . $field['type'] . '.php';
        }

        // ???????
        // $value = get_post_meta( $post->ID, 'yc_surface', true);
        // debug($value);
        // $value = get_post_meta( $post->ID, 'yc_photo', true);
       
        
        // En plus des conditions déclarées dans la render, autre fonctionnalité de sécurité: permet de vérifier que le formulaire a boen été soumis depuis cette page là, permet d'éviter les failles 
        // Cross-site scripting (XSS) est une faille de sécurité qui permet à un attaquant d'injecter dans un site web un code client malveillant.
        
        // Quand j'ai récupéré le bon template, je gère le nonce
        // <input type="hidden" name="immobilier_nonce" value=" echo wp_create_nonce('immobilier') ">
        // echo '<input type="hidden" name="' . $this->id . '" value="' . wp_create_nonce($this->id) . '">';
        echo '<input type="hidden" name="' . $this->id . '_nonce" value="' . wp_create_nonce($this->id) . '">';
        
        // Quand on sort l'inspecteur, on peut voir qu'une clé a été gnérérée dans l'attribut value
    }

    // Pour créer des champs supplémentaires
    // param 1 nom du champ
    // param 2 label du champ
    // param 3 type du champ, par défaut 'text'
    // param 4 valeur par défaut du champ, vide par défaut
    // rq: cette fonction ne fait rien si ce n'est qu'elle doit sauvegarder dans notre class metabox le champ
    // Si on veut, on peut adapter à n'importe quel type de champ. Par exemple, si on voulait créer un select, on pourrait ajouter un dernier paramètres $options qui serait un tableau et qui permettrait de lister des options
    public function add($id, $label, $type = 'text', $default = '') 
    {
        // donc quand je veux rajouter un nouveau champ, je reprends le tableau vide créé en rpopriété privée au départ et je push mon champ dedans
        // sous forme de tableau associatif dans lequel je peux lui renseigner tous les paramètres nécessaires
        $this->fields[] = [
            'id' => $id,
            'name' => $label,
            // 'type' => $type,
            'type' => $type,
            'default' => $default
        ];
        // Ensuite, je mets un return de $this, comme àa si je le souhaite je peux enchaîner les choses, c'est-à-dire que je peux générer plusieurs champs d'affilée
        // Cette manière de faire permet de générer autant de types de champs que souhaité
        // Exemple : $box->add('surface', 'Surface:', 'text')->add('short', 'Description courte', 'textarea');
        return $this;
    }

    // param 1 l'id du post courant
    public function save($post_id) 
    {

        // die; // fonctionne
        // var_dump($_POST); // fonctionne pas
        // debug($_POST); // fonctionne pas
        // debug($post_id); // fonctionne pas

        // Je déclare les termes utilisés plusieurs fois dans des variables
        // $meta = 'yc_surface';
        // Si le champ yc_surface n'est pas défini
        // Ou en cas de save Ajax
        // -> on ne fait rien
        // Attention, fonctionnalités natives de WP qui sauvegarde automatiquement les choses
        // Exemple : quand on modifie un article, WP sauvegarde les choses en ajax
        // Pour sauvegarder QUE quand on met le post à jour, on doit mettre des conditions ici
        // Permet d'anticiper s'il y a des changements dans WP, permet d'éviter de faire complètement planter le site si jamais
        // if(!isset($_POST[$meta]) || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX)) {
        if((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX)) {
            // Dans ce cas là, ne fais rien
            return false;
        }

        // Vérifier permission de l'utilsateur
        if(!current_user_can('edit_post', $post_id)) {
            return false;
        }

        // Vérification du nonce
        // param 1 le nonce
        // parma 2 action
        // Si le champ non n'est pas valable, return false
        // if(!wp_verify_nonce($_POST('immobilier_none', 'immobilier'))) {
        if(!wp_verify_nonce($_POST[$this->id . '_nonce'], $this->id)) {
            return false;
        }

        // Avec le mécanise de class, je dois récupérer une seule valeur parmi plusieurs donc boucle
        foreach($this->fields as $field) {
            $meta = $field['id'];
            // debug($meta);
            // On doit vérifier si la meta existe
            if(isset($_POST[$meta])) {
                // die;
                $value = $_POST[$meta];
                // Si la valeur existe
                if(get_post_meta($post_id, $meta)) {
                // if(get_post_meta($post_id, $meta, true)) {
                    // Mets la à jour
                    // die;
                    update_post_meta($post_id, $meta, $value);
                } 
                // Sinon si elle existe mais qu'elle est vide
                elseif($value === '') {
                    // efface-la
                    delete_post_meta($post_id, $meta);
                }
                // Sinon, si elle n'existe pas, crée-la
                else {
                    add_post_meta($post_id, $meta, $value);
                }
            }
        }
    }
}

// Dès le début, j'appelle le JS pour l'uploader
YC_FrontPage_Metabox::addJS();
// Pour initialiser mon système, ma metabox, il me suffit de faire :
// $box = new YC_FrontPage_Metabox('immo', 'Informations immobilières', 'page');

// Ajoute la metabox seulement sur la page souhaitée (côté admin)
$query = get_posts([
    'post_type' => 'page'
]);
$everyPosts = $query;
// Retrieves current page id
$pageId = '';
if(isset($_GET['post'])):
    $pageId = $_GET['post'];
// else:
//     $pageId = '';
endif;
// debug($pageId);
$pageHomeId = 'no';
foreach($everyPosts as $onePost):
    if($onePost->post_name == 'home'):
        // Get the page ID
        $pageHomeId = $onePost->ID;
    endif;
    if($pageHomeId !== 'no' && $pageHomeId == $pageId):
        $boxHome = new YC_FrontPage_Metabox('frontpage_metabox', 'Image page d\'accueil', 'page');
        // Pour créer des champs supplémentaires
        $boxHome->add('yc_frontpage_image', 'Choisissez l\'image de la page d\'accueil', 'uploader');
    endif;
endforeach;
// }
// $box


//     ->add('yc_surface', 'Surface', 'text')
//     ->add('yc_short', 'Description courte', 'textarea')
//     ->add('yc_long', 'Description longue', 'wysiwyg', 'Salut')
//     ->add('yc_image', 'Image', 'uploader', 'image');
