<?php
/**
 * Template de la metabox YC_Metabox
 * Render des champs type textarea
 */
?>
<div class="meta-box-item-title">
    <h4><?php echo esc_html($name); ?></h4>
</div>
<div class="meta-box-item-content">
    <textarea type="text" name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>" style="width: 100%;"><?php echo esc_textarea($value); ?></textarea>
</div>