<?php
/**
 * Template de la metabox YC_Metabox
 * Render des champs type text
 */
?>

<div class="meta-box-item-title">
    <h4><?php echo $name; ?></h4>
</div>
<div class="meta-box-item-content">
    <!-- Ensuite, je peux afficher la valeur récupérée dans la metabox dans le champs de l'admin -->
    <input type="text" name="<?php echo $id; ?>" id="<?php echo $id; ?>" value="<?php if($value): echo $value; endif; ?>" class="metabox_title" style="width: 100%;">
</div>