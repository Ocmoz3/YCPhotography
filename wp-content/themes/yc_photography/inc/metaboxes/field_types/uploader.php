<?php
/**
 * Template de la metabox YC_Metabox
 * Render des champs type upload
 * Avec WP, pas besoin de créer un champ de type file et de gérer ensuite un traitement compliqué, WP a déjà un système d'upload de fichiers natif
 */
?>

<div class="meta-box-item-title">
    <h4><?php echo $name; ?></h4>
</div>
<div class="meta-box-item-content">
    <!-- Ensuite, je peux afficher la valeur récupérée dans la metabox dans le champs de l'admin -->
    <!-- Je peux afficher l'image si je veux, je dois d'abord vérfier qu'une valeur est enregistrée -->
    <?php 
        if(!empty($value)) { ?>
            <a href="<?php echo $value; ?>" class="thickbox selectJS" style="display: block;">
                <img id="meta-box-image_<?php echo $id; ?>" src="<?php echo $value; ?>" alt="" style="vertical-align: middle;" class="img_js">
            </a>
        <?php
        ?>
        <!-- </a> -->
        <input type="text" name="<?php echo $id; ?>" id="<?php echo $id; ?>" value="<?php echo $value; ?>" style="width: 95%;" data-changejs="changeJs" class="input_js">
        <!-- On crée un bouton pour téléchrger les images -->
        <!-- On ajoute un attribut data-id pour savoir à quel champ correspond cet uploader là -->
        <!-- <a href="#" class="button js-uploader" data-id="<?php echo $id; ?>" data-multiple="true">Uploader</a> -->
        <a href="#" class="button btn_uploader" onclick="getThisBtn(event, this)" data-id="<?php echo $id; ?>" data-multiple="true">Uploader</a>
    <?php
    } 
    ?>
</div>