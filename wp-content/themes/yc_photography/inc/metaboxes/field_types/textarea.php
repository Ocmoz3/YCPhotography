<?php
/**
 * Template de la metabox YC_Metabox
 * Render des champs type textarea
 */
?>
<div class="meta-box-item-title">
    <h4><?php echo $name; ?></h4>
</div>
<div class="meta-box-item-content">
    <!-- Ensuite, je peux afficher la valeur récupérée dans la metabox dans le champs de l'admin -->
    <textarea type="text" name="<?php echo $id; ?>" id="<?php echo $id; ?>" style="width: 100%;"><?php echo $value ?></textarea>
</div>