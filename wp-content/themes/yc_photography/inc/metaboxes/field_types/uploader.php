<?php
/**
 * Template de la metabox YC_Metabox
 * Render des champs type upload
 */
?>

<div class="meta-box-item-title">
    <h4><?php echo $name; ?></h4>
</div>
<div class="meta-box-item-content">
    <a href="<?php echo esc_url($value); ?>" class="thickbox selectJS" style="<?php if(!empty($value)): echo 'display: block;'; else: echo 'display: none;'; endif;?>">
        <img id="meta-box-image_<?php echo $id; ?>" src="<?php echo esc_url($value); ?>" alt="" style="vertical-align: middle;" class="img_js">
    </a>
    <input type="text" name="<?php echo esc_attr($id); ?>" id="<?php echo $id; ?>" value="<?php echo esc_attr($value); ?>" class="input_js">
    <a href="#" class="button btn_uploader" onclick="getThisBtn(event, this)" data-id="<?php echo $id; ?>" data-multiple="true"><?php echo esc_html('Sélectionner une image') ?></a>
</div>