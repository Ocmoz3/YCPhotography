<?php
/**
 * Template de la metabox YC_Metabox
 * Render des champs type text
 */
?>

<div class="meta-box-item-title">
    <h4><?php echo esc_html($name); ?></h4>
</div>
<div class="meta-box-item-content">
    <input type="text" name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>" value="<?php if($value): echo esc_attr($value); endif; ?>">
</div>