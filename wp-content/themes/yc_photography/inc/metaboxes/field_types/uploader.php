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
    <a href="<?php echo $value; ?>" class="thickbox selectJS">
        <img id="meta-box-image_<?php echo $id; ?>" src="<?php echo $value; ?>" alt="" style="vertical-align: middle;" class="img_js">
    </a>
    <input type="text" name="<?php echo $id; ?>" id="<?php echo $id; ?>" value="<?php echo $value; ?>" style="width: 95%;" data-changejs="changeJs" class="input_js">
    <a href="#" class="button btn_uploader" onclick="getThisBtn(event, this)" data-id="<?php echo $id; ?>" data-multiple="true">Uploader</a>
</div>