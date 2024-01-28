<?php
/**
 * Template de la metabox YC_Metabox
 * Render des champs type upload
 * Avec WP, pas besoin de créer un champ de type file et de gérer ensuite un traitement compliqué, WP a déjà un système d'upload de fichiers natif
 */
?>
<?php
// if($id == 'yc_portfolio_image'):
// if($id == 'custom_repeater_item'):
//     $value = 'custom_repeater_item'; 
//     // $value = 'custom_repeater_item['.$item_key.'][item2]';
// else:
//     $class = '';
// endif;
// debug($item2);

$custom_repeater_itemmm = get_post_meta( $post->ID, 'custom_repeater_item', true );
// debug($custom_repeater_itemmm);
$class_a = 'custom_repeater_item_a';
$class_img = 'custom_repeater_item';
?>
<!-- <div class="meta-box-item-title">
    <h4><?php echo $name; ?></h4>
</div> -->
<div class="meta-box-item-content">
    <!-- Ensuite, je peux afficher la valeur récupérée dans la metabox dans le champs de l'admin -->
    <!-- Je peux afficher l'image si je veux, je dois d'abord vérfier qu'une valeur est enregistrée -->
    <?php 
    // $nameInput = '';
    if($custom_repeater_item){
        if( 'array' == gettype($value) ){
            foreach( $custom_repeater_item as $item_key => $item_value ):;
                // endif;
                $value = 'custom_repeater_item['.$item_key.'][item2]';
                $class_a = 'custom_repeater_item_a';
                $class_img = 'custom_repeater_item';
                $nameInput = 'name=' . $value;
                ?>
                <!-- <a href="<?php echo $custom_repeater_item; ?>" class="thickbox <?php echo $class_a; ?> a_js" style="display: block;"> -->
                <?php
                $item2 = $item2  = isset( $item_value['item2'] ) ? $item_value['item2'] : '';
                // if(!empty($value)) { ?>
                    <a href="<?php echo $value; ?>" class="thickbox <?php echo $class_a; ?> selectJS" style="display: block;">
                        <!-- <img id="meta-box-image_<?php echo $id; ?>" src="<?php if(!empty($value)): echo $value; endif; ?>" alt="" style="vertical-align: middle;" class="img_js <?php echo $class_img; ?>"> -->
                        <img id="meta-box-image_<?php echo $id; ?>" src="<?php echo $item2; ?>" alt="" style="vertical-align: middle;" class="img_js <?php echo $class_img; ?>">
                    </a>
                <?php 
                
                ?>
                <!-- </a> -->
                <!-- <input type="text" <?php echo $nameInput; ?> id="<?php echo $id; ?>" value="<?php if(!empty($value)): echo $value; endif; ?>" style="width: 95%;" data-changejs="changeJs" class="input_js"> -->
                <input type="text" <?php echo $nameInput; ?> id="<?php echo $id; ?>" value="<?php echo $item2; ?>" style="width: 95%;" data-changejs="changeJs" class="input_js">
                <!-- On crée un bouton pour téléchrger les images -->
                <!-- On ajoute un attribut data-id pour savoir à quel champ correspond cet uploader là -->
                <!-- <a href="#" class="button js-uploader" data-id="<?php echo $id; ?>" data-multiple="true">Uploader</a> -->
                <a href="#" class="button" onclick="getThisBtn(event, this)" data-id="<?php echo $id; ?>" data-multiple="true">Uploader</a>
            <?php
            // } 
            endforeach;
        } else {
            ?>
                <!-- <a href="<?php echo $custom_repeater_item; ?>" class="thickbox <?php if($class_a): echo $class_a; endif; ?> a_js" style="display: block;"> -->
                <?php
                $item2 = $item2  = isset( $item_value['item2'] ) ? $item_value['item2'] : '';
                // if(!empty($value)) { ?>
                    <a href="<?php echo $value; ?>" class="thickbox <?php echo $class_a; ?> selectJS" style="display: block;">
                        <!-- <img id="meta-box-image_<?php echo $id; ?>" src="<?php if(!empty($value)): echo $value; endif; ?>" alt="" style="vertical-align: middle;" class="img_js <?php echo $class_img; ?>"> -->
                        <img id="meta-box-image_<?php echo $id; ?>" src="" alt="" style="vertical-align: middle;" class="img_js <?php echo $class_img; ?>">
                    </a>
                <?php 
                
                ?>
                <input type="text" <?php echo $nameInput; ?> id="<?php echo $id; ?>" value="" style="width: 95%;" data-changejs="changeJs" class="input_js">
                <!-- On crée un bouton pour téléchrger les images -->
                <!-- On ajoute un attribut data-id pour savoir à quel champ correspond cet uploader là -->
                <!-- <a href="#" class="button js-uploader" data-id="<?php echo $id; ?>" data-multiple="true">Uploader</a> -->
                <a href="#" class="button" onclick="getThisBtn(event, this)" data-id="<?php echo $id; ?>" data-multiple="true">Uploader</a>
            <?php
        }
    } 
    // endif;
    ?>
</div>
<!-- Pb : Quand change valeur de n'importe quel chp uploader, met à jour d'office le premier avec la nouvelle donnée Mais pas le chp concerné !!! -->