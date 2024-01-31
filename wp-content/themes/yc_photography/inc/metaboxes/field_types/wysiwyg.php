<?php
/**
 * Template de la metabox YC_Metabox
 * Render des champs type wysiwyg
 */

$settings = [
    // 'wpautop' => false,
    'media_buttons' => false,
    // 'quicktags' => false
];

?>
<div class="meta-box-item-title">
    <h4><?php echo $name; ?></h4>
</div>
<div class="meta-box-item-content">
    <?php 
    wp_editor($value, $id, $settings);
    ?>
</div>
