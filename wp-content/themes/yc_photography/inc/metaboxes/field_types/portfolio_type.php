<?php
/**
 * YC_FrontPage_Metabox template
 * 
 * Render du groupe de champs type portfolio
 */

$pages = get_pages();
$custom_repeater_item = get_post_meta( $post->ID, 'custom_repeater_item', true );
$i = 1;
?>
<div style="overflow-x: auto;">
<?php
?>
    <table class="cxc-item-table">
        <tbody>
            <?php 
            if($custom_repeater_item):
                if('array' == gettype($value)):
                    foreach($custom_repeater_item as $item_key => $item_value):
                        $item1  = isset( $item_value['item1'] ) ? $item_value['item1'] : '';
                        $item2  = isset( $item_value['item2'] ) ? $item_value['item2'] : '';
                        ?>
                        <tr class="cxc-sub-row with">
                            <th class="meta-box-item-title">
                                <h3><?php echo 'Lien de navigation n°' . $i++ ?></h3>
                            </th>
                            <td>
                                <div class="meta-box-item-content">
                                    <a href="<?php echo esc_url($item1); ?>" class="thickbox custom_repeater_item_a selectJS" style="<?php if(!empty($item1)): echo 'display: block;'; else: echo 'display: none;'; endif;?>">
                                        <img id="meta-box-image_<?php echo esc_attr($id); ?>" src="<?php echo esc_url($item1); ?>" alt="" style="vertical-align: middle;" class="img_js custom_repeater_item">
                                    </a>
                                    <input type="hidden" name="<?php echo esc_attr('custom_repeater_item['.$item_key.'][item1]'); ?>" id="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($item1); ?>" class="input_js">
                                    <a href="#" class="button btn_uploader" onclick="getThisBtn(event, this)" data-id="<?php echo esc_attr($id); ?>" data-multiple="true">Sélectionner une image</a>
                                </div>
                                <hr>
                                <?php
                            ?>
                            </td>
                            <td>
                                <label>Choisir une page galerie :</label>
                                <select name="<?php echo esc_attr('custom_repeater_item['.$item_key.'][item2]'); ?>" id="<?php echo esc_attr('custom_repeater_item['.$item_key.'][item2]'); ?>" onchange="myFunction(event)">
                                    <option <?php if(empty($custom_repeater_item)): echo 'selected'; endif; ?> style="font-weight: bold;">Galeries...</option>
                                    <?php 
                                    foreach($pages as $page):
                                        // Checks if the page content starts with a gallery shortcode.
                                        if(str_starts_with($page->post_content, '[gallery')):
                                        ?>
                                            <option value="<?php echo $page->post_title ?>" <?php if(!empty($item2) && $item2 == $page->post_title): echo 'selected'; endif; ?>><?php echo $page->post_title ?></option>
                                        <?php 
                                        endif;
                                    endforeach; 
                                    ?>
                                </select>
                                <input type="hidden" name="<?php echo esc_attr('custom_repeater_item['.$item_key.'][item2]'); ?>" value="<?php echo esc_attr($item2); ?>">
                                <hr>
                            </td>
                            <td>
                                <button class="cxc-remove-item button" type="button"><?php echo esc_html('Supprimer ce lien de navigation'); ?></button>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                endif;
            else:
                ?>
                <tr class="cxc-sub-row without">
                    <td>
                        <div class="meta-box-item-content">
                            <?php ?>
                            <a href="" class="thickbox custom_repeater_item_a selectJS" style="display: none;">
                                <img id="meta-box-image_<?php echo $id; ?>" src="" alt="" style="vertical-align: middle;" class="img_js custom_repeater_item">
                            </a>
                            <input type="hidden" name="custom_repeater_item[0][item1]" id="<?php echo $id; ?>" value="" class="input_js">
                            <a href="#" class="button btn_uploader" onclick="getThisBtn(event, this)" data-id="<?php echo $id; ?>" data-multiple="true">Sélectionner une image</a>
                        </div>
                        <hr>
                    </td>
                    <td>
                        <label>Choisir une page galerie :</label>
                        <select name="<?php echo 'custom_repeater_item[0][item2]'; ?>" id="<?php echo 'custom_repeater_item[0][item2]'; ?>" onchange="myFunction(event)">
                            <option selected style="font-weight: bold;">Galeries...</option>
                            <?php 
                            foreach($pages as $page):
                                ?>
                                    <option value="<?php echo $page->post_title ?>"><?php echo $page->post_title ?></option>
                                <?php 
                            endforeach; 
                            ?>
                        </select>
                        <input type="hidden" name="<?php echo 'custom_repeater_item[0][item2]' ?>" id="test" value="">
                        <hr>
                    </td>
                </tr>
            <?php
            endif;
            ?>			
            <tr class="cxc-hide-tr">
                <td>
                    <div class="meta-box-item-content">
                        <?php
                        ?>
                        <a href="" class="thickbox custom_repeater_item_a selectJS" style="display: none;">
                            <img id="meta-box-image_<?php echo $id; ?>" src="" alt="" style="vertical-align: middle;" class="img_js custom_repeater_item">
                        </a>
                        <input type="hidden" name="hide_custom_repeater_item[rand_no][item1]" id="<?php echo $id; ?>" value="" class="input_js">
                        <a href="#" class="button btn_uploader" onclick="getThisBtn(event, this)" data-id="<?php echo $id; ?>" data-multiple="true">Sélectionner une image</a>
                    </div>
                    <hr>
                </td>
                <td>
                    <label>Choisir une page galerie :</label>
                    <select name="hide_custom_repeater_item[rand_no][item2]" onchange="myFunction(event)">
                        <option <?php if(empty($custom_repeater_item)): echo 'selected'; endif; ?> style="font-weight: bold;">Galeries...</option>
                        <?php 
                        foreach($pages as $page): 
                            // Checks if the page content starts with a gallery shortcode.
                            if(str_starts_with($page->post_content, '[gallery')):
                            ?>
                                <option value="<?php echo $page->post_title ?>"><?php echo $page->post_title ?></option>
                            <?php 
                            endif;
                        endforeach; 
                        ?>
                    </select>
                    <input type="hidden" name="hide_custom_repeater_item[rand_no][item2]" value="">
                    <hr>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">
                    <button class="cxc-add-item button button-secondary" type="button"><?php echo esc_html('Ajouter un lien'); ?></button>
                </td>
            </tr>
        </tfoot>
    </table>
</div>