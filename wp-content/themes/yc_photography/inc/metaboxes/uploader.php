<?php
/**
 * Template de la metabox YC_Metabox
 * Render des champs type upload
 * Avec WP, pas besoin de créer un champ de type file et de gérer ensuite un traitement compliqué, WP a déjà un système d'upload de fichiers natif
 */
?>
<div class="meta-box-item-title">
    <!-- Surface (en m²) -->
    <h4><?php echo $name; ?></h4>
</div>
<div class="meta-box-item-content">
    <!-- Ensuite, je peux afficher la valeur récupérée dans la metabox dans le champs de l'admin -->
    <!-- Je peux afficher l'image si je veux, je dois d'abord vérfier qu'une valeur est enregistrée -->
    <?php if(!empty($value)) { ?>
        <!-- <a href="<?php echo $value; ?>" class="thickbox" style="display: block;"> -->
        <a href="<?php echo $value; ?>" class="thickbox" style="display: block;">
        <!-- max-width: 200px; max-height: 200px;  -->
            <img id="meta-box-image" src="<?php echo $value; ?>" alt="" style="vertical-align: middle;">
        </a>
    <?php } ?>
    <input type="text" name="<?php echo $id; ?>" id="<?php echo $id; ?>" value="<?php echo $value; ?>" style="width: 85%;" data-changejs="changeJs">
    <!-- On crée un bouton pour téléchrger les images -->
    <!-- On ajoute un attribut data-id pour savoir à quel champ correspond cet uploader là -->
    <a href="#" class="button js-uploader" data-id="<?php echo $id; ?>" data-multiple="true">Uploader</a>
</div>
<style>
    .thickbox-loading
    /* #TB_ImageOff  */
    {
        max-height: 80%;
        height: fit-content !important;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1rem;
    }
    #TB_window img#TB_Image {
        /* object-fit: cover; */
        max-width: -webkit-fill-available;
        max-width: -moz-available;
        max-width: 100%;
        /* max-height: 100%; */
        height: auto;
    }
    #TB_closeWindowButton {
        top: 0;
    }
    a.thickbox {
        margin-bottom: 1rem;
    }
    a.thickbox img {
        width: -webkit-fill-available;
    }
    /* -webkit-fill-available
    -moz-available */
</style>