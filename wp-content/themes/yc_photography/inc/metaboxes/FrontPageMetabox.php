<?php
/**
 * The class of YC_FrontPage_Metabox
 * 
 * This class adds various meta boxes with various types of fields.
 * 
 * Type of fields :
 *    text
 *    textarea
 *    select
 *    uploader
 *    wysiwyg
 *    portfolio_type : a group of various fields with a repeater system
 */


class YC_FrontPage_Metabox {

    private $id;
    private $title;
    private $post_type;

    private $fields = [];

    // Enqueues JavaScript for Uploader file type
    public static function addJS() {
        add_action('admin_enqueue_scripts', function() {
            wp_register_script('uploaderjs', get_template_directory_uri() . '/assets/admin/js/metaboxes/uploader.js', ['jquery'], '', true);
            wp_enqueue_script('uploaderjs');
        });
    }

    /**
     * YC_FrontPage_Metabox constructor.
     * @param $id        Id
     * @param $title     Title
     * @param $post-type Post type
     */
    // Possibility of creating an array of the various post-types required. Here, only one (page) is required.
    public function __construct($id, $title, $post_type) 
    {
        // Hook to create the metabox.
        // Function : $this = metabox being created, 'create' = name of callback function.
        add_action('admin_init', array(&$this, 'create'));
        
        // Hook to save metabox value(s).
        // Warning, this hook is triggered for ALL posts (articles, pages, media...).
        // Must therefore be filtered in the callback function.
        add_action('save_post', array(&$this, 'save'));

        $this->id = $id;
        $this->title = $title;
        $this->post_type = $post_type;
    }

    /**
     * Creates the metabox.
     */
    public function create() 
    {
        if(function_exists('add_meta_box')):
            add_meta_box($this->id, $this->title, array(&$this, 'render'), $this->post_type);
        endif;
    }

    /**
     * Displays the meta box according to the type of field selected.
     * 
     * @param WP_Post $post The current post object
     */
    public function render($post) 
    {
        global $post;
        // fields = all metaboxes
        foreach($this->fields as $field):
            // In order to use the data from each $field ($id, $title, etc.), the data is extracted with extract(). Caution: use with great care. Here, we have control over the data passed and retrieved, so don't worry. Won't generate variables that could interfere with the rest of the script.
            extract($field);
            $value = get_post_meta($post->ID, $id, true);
            if($value == ''):
                $value = $default;
            endif;
            // __DIR__ = current folder
            require __DIR__ . '/field_types/' . $field['type'] . '.php';
        endforeach;
        // In addition to the conditions declared in the render, other security features: nonce field. It checks that the form has been submitted from the current page, avoids cross-site scripting vulnerabilities
        // Cross-site scripting (XSS) is a security vulnerability that allows an attacker to inject malicious client code into a website.
        echo '<input type="hidden" name="' . $this->id . '_nonce" value="' . wp_create_nonce($this->id) . '">';
    }

    /**
     * Creates additional fields
     * 
     * Creates an associative array of meta box fields.
     * .
     * @param int    $id      Id
     * @param string $label   Label
     * @param string $type    Field type
     * @param string $default Default value
     * @param array  $options Options array
     */
    public function add($id, $label, $type = 'text', $default = '', $options = []) 
    {
        $this->fields[] = [
            'id' => $id,
            'name' => $label,
            'type' => $type,
            'default' => $default,
            'options' => $options 
        ];
        // Returns $this permits to link fields as many times as wanted.
        return $this;
    }

    /**
     * Saves, updates or deletes the meta box and its values.
     * 
     * @param int $post_id Current post id
     */
    public function save($post_id) 
    {
        // die; // works
        // var_dump($_POST); // doesn't work
        // debug($_POST); // doesn't work
        // debug($post_id); // doesn't work

        // Please note that WP's native features automatically save things, especially with Ajax.
        // This must be avoid.
        if((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX)):
            return false;
        endif;

        // Checks user permission.
        if(!current_user_can('edit_post', $post_id)):
            return false;
        endif;

        // Checks the nonce.
        // Meta boxes are loaded on all posts of type page so must check if this nonce exists otherwise returns an error.
        // if(key_exists($_POST[$this->id . '_nonce'], $_POST)):
        // if($_POST[$this->id . '_nonce']):
            if(!wp_verify_nonce($_POST[$this->id . '_nonce'], $this->id)):
                return false;
            endif;
        // endif;

        foreach($this->fields as $field):
            $meta = $field['id'];
            // Special treatment for the repeater.
            if ( isset( $_POST['custom_repeater_item'] ) ){
                update_post_meta( $post_id, 'custom_repeater_item', $_POST['custom_repeater_item'] );
            } else {
                update_post_meta( $post_id, 'custom_repeater_item', '' );
            }
            // processing of all meta boxes
            if(isset($_POST[$meta])):
                $value = $_POST[$meta];
                if(get_post_meta($post_id, $meta)):
                    update_post_meta($post_id, $meta, $value);
                elseif($value === ''):
                    delete_post_meta($post_id, $meta);
                else:
                    add_post_meta($post_id, $meta, $value);
                endif;
            endif;
        endforeach;
    }
}

/**
 * Loads javascript for the 'uploader' field type.
 */
YC_FrontPage_Metabox::addJS();

/**
 * Initializing the meta box.
 */
// Adds home page Image metabox
$boxHomeImage = new YC_FrontPage_Metabox('frontpage_metabox_image', 'Image page d\'accueil', 'page');
$boxHomeImage->add('yc_frontpage_image', 'Choisissez l\'image de la page d\'accueil', 'uploader');
// Adds home page Presentation metabox
$boxHomePresentation = new YC_FrontPage_Metabox('frontpage_metabox_presentation', 'Présentation', 'page');
$boxHomePresentation->add('yc_presentation_title', 'Titre de la présentation', 'text')
->add('yc_presentation_text', 'Texte de la présentation', 'wysiwyg');
// Adds home page Portfolio metabox
$boxHomePortfolio = new YC_FrontPage_Metabox('frontpage_metabox_portfolio', 'Menu portfolio', 'page');
$boxHomePortfolio->add('yc_portfolio_title', 'Titre partie Portfolio', 'text')
->add('custom_repeater_item', 'Menu portfolio', 'portfolio_type');
// Adds home page Exhibitions metabox
$boxHomeExhibitions = new YC_FrontPage_Metabox('frontpage_metabox_exhibitions', 'Expositions', 'page');
$boxHomeExhibitions->add('yc_exhibitions_title', 'Titre partie Expositions', 'text')
->add('yc_exhibitions_list', 'Liste des expositions', 'wysiwyg');
// Adds home page Contact metabox
$boxHomeExhibitions = new YC_FrontPage_Metabox('frontpage_metabox_contact', 'Formulaire de contact', 'page');
$boxHomeExhibitions->add('yc_contact_title', 'Titre partie Contact', 'text')
->add('yc_contact_form', 'Shortcode', 'text');