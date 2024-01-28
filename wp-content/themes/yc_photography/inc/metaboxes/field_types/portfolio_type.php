<?php
/**
 * Template de la metabox YC_Metabox
 * Render des champs type select
 */

$pages = get_pages();

$custom_repeater_item = get_post_meta( $post->ID, 'custom_repeater_item', true );
$class_a = 'custom_repeater_item_a';
$class_img = 'custom_repeater_item';
?>
<style>
    .custom_repeater_item_a {
        width: 95% !important;
        height: 150px !important;
        display: block;
    }
    .custom_repeater_item {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .cxc-item-table, .cxc-item-table .cxc-sub-row input[type="text"] { 
        width: 100%; 
    }
    .cxc-hide-tr { 
        display: none; 
    }
</style>
<table class="cxc-item-table">
    <tbody>
        <?php 
        // wp_nonce_field( 'repeterBox', 'formType' );
        if($custom_repeater_item){
            // debug($custom_repeater_item);
            if( 'array' == gettype($value) ) {
                foreach( $custom_repeater_item as $item_key => $item_value ){
                    // debug($item_value);
                    $item1  = isset( $item_value['item1'] ) ? $item_value['item1'] : '';
                    $item2  = isset( $item_value['item2'] ) ? $item_value['item2'] : '';
                    ?>
                    <tr class="cxc-sub-row with" style="border: 5px solid green; background: lightgreen;">
                        <td>
                            <div class="meta-box-item-content">
                                <?php
                                // $value = 'custom_repeater_item['.$item_key.'][item1]';
                                $class_a = 'custom_repeater_item_a';
                                $class_img = 'custom_repeater_item';
                                // $nameInput = 'name=' . $value;
                                ?>
                                <a href="<?php echo $item1; ?>" class="thickbox <?php echo $class_a; ?> selectJS">
                                    <img id="meta-box-image_<?php echo $id; ?>" src="<?php echo $item1; ?>" alt="" style="vertical-align: middle;" class="img_js <?php echo $class_img; ?>">
                                </a>
                                <input type="text" name="<?php echo 'custom_repeater_item['.$item_key.'][item1]'; ?>" id="<?php echo $id; ?>" value="<?php echo $item1; ?>" style="width: 95%;" data-changejs="changeJs" class="input_js">
                                <a href="#" class="button" onclick="getThisBtn(event, this)" data-id="<?php echo $id; ?>" data-multiple="true">Uploader</a>
                            </div>
                            <?php
                        ?>
                        </td>
                        <td>
                            <select name="<?php echo 'custom_repeater_item['.$item_key.'][item2]'; ?>" id="<?php echo 'custom_repeater_item['.$item_key.'][item2]'; ?>" onchange="myFunction(event)" style="border: 10px solid green;">
                                <option <?php if(empty($custom_repeater_item)): echo 'selected'; endif; ?>>Choisissez la page</option>
                                <?php 
                                foreach($pages as $page):
                                    ?>
                                    <option value="<?php echo $page->post_name ?>" <?php if(!empty($item2) && $item2 == $page->post_name): echo 'selected'; endif; ?>><?php echo $page->post_title ?></option>
                                    <?php 
                                endforeach; 
                                ?>
                            </select>
                            <p>Page actuellement sélectionnée</p>
                            <input type="text" name="<?php echo 'custom_repeater_item['.$item_key.'][item2]'; ?>" id="test" value="<?php echo $item2; ?>" style="width: 85%;" data-changejs="changeJs" class="test">
                        </td>
                        <td>
                            <button class="cxc-remove-item button" type="button"><?php esc_html_e( 'Remove', 'cxc-codexcoach' ); ?></button>
                        </td>
                    </tr>
                <?php
                }
            }
        } else {
            ?>
            <tr class="cxc-sub-row without" style="border: 5px solid yellow; background: lightyellow;">
                <td>
                    <div class="meta-box-item-content">
                        <?php ?>
                        <a href="<?php echo 'custom_repeater_item[0][item1]' ?>" class="thickbox <?php echo $class_a; ?> selectJS" style="display: block;">
                            <img id="meta-box-image_<?php echo $id; ?>" src="<?php echo 'custom_repeater_item[0][item1]' ?>" alt="" style="vertical-align: middle;" class="img_js <?php echo $class_img; ?>">
                        </a>
                        <input type="text" name="<?php echo 'custom_repeater_item[0][item1]' ?>" id="<?php echo $id; ?>" value="" style="width: 95%;" data-changejs="changeJs" class="input_js">
                        <a href="#" class="button" onclick="getThisBtn(event, this)" data-id="<?php echo $id; ?>" data-multiple="true">Uploader</a>
                    </div>
                </td>
                    <?php
                    ?>
                <td>
                    <select name="<?php echo 'custom_repeater_item[0][item2]'; ?>" id="<?php echo 'custom_repeater_item[0][item2]'; ?>" onchange="myFunction(event)" style="border: 2px solid yellow;">
                    <?php 
                        ?>
                        <option selected>Choisissez la page</option>
                        <?php 
                        foreach($pages as $page): 
                            ?>
                            <option value="<?php echo $page->post_name ?>"><?php echo $page->post_title ?></option>
                            <?php 
                        endforeach; 
                        ?>
                    </select>
                    <p>Page actuellement sélectionnée</p>
                    <input type="text" name="<?php echo 'custom_repeater_item[0][item2]' ?>" id="test" value="<?php echo '' ?>" style="width: 85%;" data-changejs="changeJs" class="test">
                </td>
                <td>
                    <button class="cxc-remove-item button" type="button"><?php esc_html_e( 'Remove', 'cxc-codexcoach' ); ?></button>
                </td>
            </tr>
        <?php
        }
        ?>			
        <tr class="cxc-hide-tr" style="border: 5px solid red; background: indianred;">
            <td>
                <div class="meta-box-item-content">
                    <?php
                    ?>
                    <a href="hide_custom_repeater_item[rand_no][item1]" class="thickbox <?php echo $class_a; ?> selectJS">
                        <img id="meta-box-image_<?php echo $id; ?>" src="hide_custom_repeater_item[rand_no][item1]" alt="" style="vertical-align: middle;" class="img_js <?php echo $class_img; ?>">
                    </a>
                    <input type="text" name="hide_custom_repeater_item[rand_no][item1]" id="<?php echo $id; ?>" value="hide_custom_repeater_item[rand_no][item1]" style="width: 95%;" data-changejs="changeJs" class="input_js">
                    <a href="#" class="button" onclick="getThisBtn(event, this)" data-id="<?php echo $id; ?>" data-multiple="true">Uploader</a>
                </div>
            </td>
            <td>
                <select name="hide_custom_repeater_item[rand_no][item2]" onchange="myFunction(event)" style="border: 2px solid red;">
                    <option <?php if(empty($custom_repeater_item)): echo 'selected'; endif; ?>>Choisissez la page</option>
                    <?php 
                    foreach($pages as $page): 
                        ?>
                        <option value="<?php echo $page->post_name ?>" <?php if(!empty($custom_repeater_item) && $custom_repeater_item == $page->post_name): echo 'selected'; endif; ?>><?php echo $page->post_title ?></option>
                        <?php 
                    endforeach; 
                    ?>
                </select>
                <p>Page actuellement sélectionnée</p>
                <input type="text" name="<?php echo 'hide_custom_repeater_item[rand_no][item2]' ?>" id="test" value="" style="width: 85%;" data-changejs="changeJs" class="test">
                <!--  -->
            </td>
            <td>
                <button class="cxc-remove-item button" type="button"><?php esc_html_e( 'Remove', 'cxc-codexcoach' ); ?></button>
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
<script>
    function myFunction(e) {
        console.log('okk');
        // document.getElementById("myText").value = e.target.value
        // Je sélectionne le select qui a changé
        thisVal = jQuery(e.target);
        // Je sélectionne l'élément d'après (<p>)
        thisValNext = thisVal.next();
        console.log(thisValNext);
        // Pour pouvoir sélectionner l'élément suivant (<input>) pour lui attribuer la valeur du select
        thisValNextNext = thisValNext.next().val(thisVal.val());
        console.log(thisValNextNext);
        console.log(thisVal.val());
    }
</script>
<?php
add_action( 'admin_footer', 'cxc_single_repeatable_meta_box_footer' );
function cxc_single_repeatable_meta_box_footer(){
	?>
	<script type="text/javascript">	
	
		// document.querySelector('.test').value = e.target.value	
		jQuery(document).ready(function($){
			jQuery(document).on('click', '.cxc-remove-item', function() {
				jQuery(this).parents('tr.cxc-sub-row').remove();
				// jQuery('tr.cxc-sub-row').remove();
			}); 				
			jQuery(document).on('click', '.cxc-add-item', function() {
				var p_this = jQuery(this);    
				var row_no = parseFloat( jQuery('.cxc-item-table tr.cxc-sub-row').length );
				console.log(row_no);
				var row_html = jQuery('.cxc-item-table .cxc-hide-tr').html().replace(/rand_no/g, row_no).replace(/hide_custom_repeater_item/g, 'custom_repeater_item');
				jQuery('.cxc-item-table tbody').append('<tr class="cxc-sub-row">' + row_html + '</tr>');    
			});
		});
	</script>
	<?php
}