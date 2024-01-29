<?php
/**
 * Template de la metabox YC_Metabox
 * Render des champs type select
 */

$pages = get_pages();

$custom_repeater_item = get_post_meta( $post->ID, 'custom_repeater_item', true );
?>
<div style="overflow-x: auto;">
    <table class="cxc-item-table">
        <tbody>
            <?php 
            if($custom_repeater_item) {
                if( 'array' == gettype($value) ) {
                    foreach( $custom_repeater_item as $item_key => $item_value ) {
                        $item1  = isset( $item_value['item1'] ) ? $item_value['item1'] : '';
                        $item2  = isset( $item_value['item2'] ) ? $item_value['item2'] : '';
                        ?>
                        <tr class="cxc-sub-row with">
                            <th class="meta-box-item-title">
                                <h3><?php echo 'Lien de navigation n°' . $item_key += 1; ?></h3>
                            </th>
                            <td>
                                <div class="meta-box-item-content">
                                    <a href="<?php echo $item1; ?>" class="thickbox custom_repeater_item_a selectJS">
                                        <img id="meta-box-image_<?php echo $id; ?>" src="<?php echo $item1; ?>" alt="" style="vertical-align: middle;" class="img_js custom_repeater_item">
                                    </a>
                                    <input type="hidden" name="<?php echo 'custom_repeater_item['.$item_key.'][item1]'; ?>" id="<?php echo $id; ?>" value="<?php echo $item1; ?>" data-changejs="changeJs" class="input_js">
                                    <a href="#" class="button btn_uploader" onclick="getThisBtn(event, this)" data-id="<?php echo $id; ?>" data-multiple="true">Sélectionner une image</a>
                                </div>
                                <hr>
                                <?php
                            ?>
                            </td>
                            <td>
                                <label>Choisir une page galerie :</label>
                                <select name="<?php echo 'custom_repeater_item['.$item_key.'][item2]'; ?>" id="<?php echo 'custom_repeater_item['.$item_key.'][item2]'; ?>" onchange="myFunction(event)">
                                    <option <?php if(empty($custom_repeater_item)): echo 'selected'; endif; ?> style="font-weight: bold;">Galeries...</option>
                                    <?php 
                                    foreach($pages as $page):
                                        ?>
                                        <option value="<?php echo $page->post_title ?>" <?php if(!empty($item2) && $item2 == $page->post_name): echo 'selected'; endif; ?>><?php echo $page->post_title ?></option>
                                        <?php 
                                    endforeach; 
                                    ?>
                                </select>
                                <input type="hidden" name="<?php echo 'custom_repeater_item['.$item_key.'][item2]'; ?>" id="test" value="<?php echo $item2; ?>" style="width: 85%;" data-changejs="changeJs">
                                <hr>
                            </td>
                            <td>
                                <button class="cxc-remove-item button" type="button"><?php esc_html_e( 'Supprimer ce lien de navigation', 'cxc-codexcoach' ); ?></button>
                            </td>
                        </tr>
                    <?php
                    }
                }
            } else {
                ?>
                <tr class="cxc-sub-row without">
                    <td>
                        <div class="meta-box-item-content">
                            <?php ?>
                            <a href="<?php echo 'custom_repeater_item[0][item1]' ?>" class="thickbox custom_repeater_item_a selectJS" style="display: block;">
                                <img id="meta-box-image_<?php echo $id; ?>" src="<?php echo 'custom_repeater_item[0][item1]' ?>" alt="" style="vertical-align: middle;" class="img_js custom_repeater_item">
                            </a>
                            <input type="hidden" name="<?php echo 'custom_repeater_item[0][item1]' ?>" id="<?php echo $id; ?>" value="" style="width: 95%;" data-changejs="changeJs" class="input_js">
                            <a href="#" class="button" onclick="getThisBtn(event, this)" data-id="<?php echo $id; ?>" data-multiple="true">Sélectionner une image</a>
                        </div>
                        <hr>
                    </td>
                        <?php
                        ?>
                    <td>
                        <label>Choisir une page galerie :</label>
                        <select name="<?php echo 'custom_repeater_item[0][item2]'; ?>" id="<?php echo 'custom_repeater_item[0][item2]'; ?>" onchange="myFunction(event)">
                        <?php 
                            ?>
                            <option selected style="font-weight: bold;">Galeries</option>
                            <?php 
                            foreach($pages as $page): 
                                ?>
                                <option value="<?php echo $page->post_title ?>"><?php echo $page->post_title ?></option>
                                <?php 
                            endforeach; 
                            ?>
                        </select>
                        <input type="hidden" name="<?php echo 'custom_repeater_item[0][item2]' ?>" id="test" value="" style="width: 85%;" data-changejs="changeJs">
                        <hr>
                    </td>
                    <td>
                        <button class="cxc-remove-item button" type="button"><?php esc_html_e( 'Supprimer ce lien de navigation', 'cxc-codexcoach' ); ?></button>
                    </td>
                </tr>
            <?php
            }
            ?>			
            <tr class="cxc-hide-tr">
                <td>
                    <div class="meta-box-item-content">
                        <?php
                        ?>
                        <a href="hide_custom_repeater_item[rand_no][item1]" class="thickbox custom_repeater_item_a selectJS">
                            <img id="meta-box-image_<?php echo $id; ?>" src="hide_custom_repeater_item[rand_no][item1]" alt="" style="vertical-align: middle;" class="img_js custom_repeater_item">
                        </a>
                        <input type="hidden" name="hide_custom_repeater_item[rand_no][item1]" id="<?php echo $id; ?>" value="hide_custom_repeater_item[rand_no][item1]" style="width: 95%;" data-changejs="changeJs" class="input_js">
                        <a href="#" class="button btn_uploader" onclick="getThisBtn(event, this)" data-id="<?php echo $id; ?>" data-multiple="true">Sélectionner une image</a>
                    </div>
                    <hr>
                </td>
                <td>
                    <label>Choisir une page galerie :</label>
                    <select name="hide_custom_repeater_item[rand_no][item2]" onchange="myFunction(event)">
                        <option <?php if(empty($custom_repeater_item)): echo 'selected'; endif; ?> style="font-weight: bold;">Galeries</option>
                        <?php 
                        foreach($pages as $page): 
                            ?>
                            <option value="<?php echo $page->post_title ?>" <?php if(!empty($custom_repeater_item) && $custom_repeater_item == $page->post_name): echo 'selected'; endif; ?>><?php echo $page->post_title ?></option>
                            <?php 
                        endforeach; 
                        ?>
                    </select>
                    <input type="hidden" name="<?php echo 'hide_custom_repeater_item[rand_no][item2]' ?>" id="test" value="" style="width: 85%;" data-changejs="changeJs" class="test">
                    <hr>
                </td>
                <td>
                    <button class="cxc-remove-item button" type="button"><?php esc_html_e( 'Supprimer ce lien de navigation', 'cxc-codexcoach' ); ?></button>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">
                    <button class="cxc-add-item button button-secondary" type="button"><?php esc_html_e( 'Add another', 'cxc-codexcoach' ); ?></button>
                </td>
            </tr>
        </tfoot>
    </table>
</div>