<?php
add_action( 'admin_init', 'cxc_single_repeter_meta_boxess' );
function cxc_single_repeter_meta_boxess() {
	add_meta_box( 'cxc-single-repeater-data', 'Single Repeater', 'cxc_single_repeatable_meta_box_callbackk', 'page', 'normal', 'default' );
}
// $pages = get_pages();
function cxc_single_repeatable_meta_box_callbackk( $post ) {
	$custom_repeater_itemm = get_post_meta( $post->ID, 'custom_repeater_itemm', true );
	// $custom_repeater_itemm = delete_post_meta($post->ID, 'custom_repeater_itemm');
	// $custom_repeater_itemm = '';
	wp_nonce_field( 'repeterBox', 'formType' );
	$pages = get_pages();
	?>
	<table class="cxc-item-table">
		<tbody>
			<?php 
            debug($custom_repeater_itemm);
			if( $custom_repeater_itemm ){
				foreach( $custom_repeater_itemm as $item_key => $item_value ){
					$item1  = isset( $item_value['item1'] ) ? $item_value['item1'] : '';
					$item2  = isset( $item_value['item2'] ) ? $item_value['item2'] : '';
					$item3  = isset( $item_value['item3'] ) ? $item_value['item3'] : '';
					// $item3  = '';
					?>
					<tr class="cxc-sub-row">				
						<td>
							<input type="text" name="<?php echo esc_attr( 'custom_repeater_itemm['.$item_key.'][item1]' ); ?>" value="<?php echo esc_attr( $item1 ); ?>" placeholder="Item 1">
						</td>
						<td>
							<input type="text" name="<?php echo esc_attr( 'custom_repeater_itemm['.$item_key.'][item2]' ); ?>" value="<?php echo esc_attr( $item2 ); ?>" placeholder="Item 2"/>

							<select name="<?php echo 'custom_repeater_itemm['.$item_key.'][item3]'; ?>" id="<?php echo 'custom_repeater_itemm['.$item_key.'][item3]'; ?>" onchange="myFunctionn(event)" style="border: 10px solid green;">
								<?php 
								// debug($custom_repeater_itemm);
								?>
								<option <?php if(empty($custom_repeater_itemm)): echo 'selected'; endif; ?>>Choisissez la page</option>
								<?php 
								foreach($pages as $page):
									?>
									<option value="<?php echo $page->post_name ?>" <?php if(!empty($item3) && $item3 == $page->post_name): echo 'selected'; endif; ?>><?php echo $page->post_title ?></option>
									
									<?php 
								endforeach; 
								?>
							</select>
                    
							<!-- <div style="border: 2px solid green;"> -->
								<p>Page actuellement sélectionnée</p>
								<?php //echo $id.'['.$item_key.'][item2]'; ?>
								<input type="text" name="<?php echo 'custom_repeater_itemm['.$item_key.'][item3]'; ?>" id="test" value="<?php echo $item3; ?>" style="width: 85%;" data-changejs="changeJs" class="test">
								<!--  -->
							<!-- </div>	 -->
						</td>
						<td>
							<button class="cxc-remove-item button" type="button"><?php esc_html_e( 'Remove', 'cxc-codexcoach' ); ?></button>
						</td>
					</tr>
					<?php
				}
			} else {
				?>
				<tr class="cxc-sub-row">				
					<td>
						<input type="text" name="custom_repeater_itemm[0][item1]" placeholder="Item 1">
					</td>
					<td>
						<input type="text" name="custom_repeater_itemm[0][item2]" placeholder="Item 2"/>
						<select name="<?php echo 'custom_repeater_itemm[0][item3]'; ?>" id="<?php echo 'custom_repeater_itemm[0][item3]'; ?>" onchange="myFunctionn(event)" style="border: 2px solid yellow;">
						<?php 
							// debug($custom_repeater_itemm);
							?>
							<option selected>Choisissez la page</option>
							<?php 
							foreach($pages as $page): 
								// $url = $page->post_name . '.php';
								?>
								<option value="<?php echo $page->post_name ?>"><?php echo $page->post_title ?></option>
								
								<!-- <option value="<?php //echo $page->post_name ?>"><?php //echo $page->post_title ?></option> -->
								<?php 
							endforeach; 
							?>
						</select>
                    
						<!-- <div style="border: 2px solid green;"> -->
							<p>Page actuellement sélectionnée</p>
							<?php //echo $id.'['.$item_key.'][item2]'; ?>
							<input type="text" name="<?php echo 'custom_repeater_itemm[0][item3]' ?>" id="test" value="<?php if(isset($item3)): echo $item3; endif;?>" style="width: 85%;" data-changejs="changeJs" class="test">
							<!--  -->
						<!-- </div>	 -->
					</td>
					<td>
						<button class="cxc-remove-item button" type="button"><?php esc_html_e( 'Remove', 'cxc-codexcoach' ); ?></button>
					</td>
				</tr>
				<?php
			}
			?>			
			<tr class="cxc-hide-tr">				
				<td>
					<input name="hide_custom_repeater_itemm[rand_no][item1]" type="text" placeholder="Item 1"/>	
				</td>
				<td>
					<input type="text" name="hide_custom_repeater_itemm[rand_no][item2]" placeholder="Item 2"/>
					<?php 
						// debug($pages);
						?>
					<select name="hide_custom_repeater_itemm[rand_no][item3]" onchange="myFunctionn(event)" style="border: 2px solid red;">
						<option <?php if(empty($custom_repeater_itemm)): echo 'selected'; endif; ?>>Choisissez la page</option>
						<?php 
						foreach($pages as $page): 
							// $url = $page->post_name . '.php';
							?>
							<option value="<?php echo $page->post_name ?>" <?php if(!empty($custom_repeater_itemm) && $custom_repeater_itemm == $page->post_name): echo 'selected'; endif; ?>><?php echo $page->post_title ?></option>
							
							<!-- <option value="<?php echo $page->post_name ?>"><?php echo $page->post_title ?></option> -->
							<?php 
						endforeach; 
						?>
					</select>
			
					<!-- <div style="border: 2px solid green;"> -->
						<p>Page actuellement sélectionnée</p>
						<?php //echo $id.'['.$item_key.'][item2]'; ?>
						<input type="text" name="<?php echo 'hide_custom_repeater_itemm[rand_no][item3]' ?>" id="test" value="" style="width: 85%;" data-changejs="changeJs" class="test">
						<!--  -->
					<!-- </div> -->
				</td>
				<td>
					<button class="cxc-remove-item button" type="button"><?php esc_html_e( 'Remove', 'cxc-codexcoach' ); ?></button>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4">
					<button class="cxc-add-itemm button button-secondary" type="button"><?php esc_html_e( 'Add another', 'cxc-codexcoach' ); ?></button>
				</td>
			</tr>
		</tfoot>
	</table>	
	<script>
    function myFunctionn(e) {
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
}
?>
<?php
add_action( 'save_post', 'cxc_single_repeatable_meta_box_save' );
function cxc_single_repeatable_meta_box_save( $post_id ) {

	if ( !isset( $_POST['formType'] ) && !wp_verify_nonce( $_POST['formType'], 'repeterBox' ) ){
		return;
	}

	if ( ! defined( 'DOING_AUTOSAVE' ) ) {
		define( 'DOING_AUTOSAVE', true );
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return false;
	}

	if ( isset( $_POST['custom_repeater_itemm'] ) ){
		update_post_meta( $post_id, 'custom_repeater_itemm', $_POST['custom_repeater_itemm'] );
	} else {
		update_post_meta( $post_id, 'custom_repeater_itemm', '' );
	}	
}
?>
<?php
add_action( 'admin_footer', 'cxc_single_repeatable_meta_box_footerrr' );
function cxc_single_repeatable_meta_box_footerrr(){
	?>
	<script type="text/javascript">	
	
		// document.querySelector('.test').value = e.target.value	
		jQuery(document).ready(function($){
			jQuery(document).on('click', '.cxc-remove-item', function() {
				jQuery(this).parents('tr.cxc-sub-row').remove();
				// jQuery('tr.cxc-sub-row').remove();
			}); 				
			jQuery(document).on('click', '.cxc-add-itemm', function() {
				console.log('ok click');
				var p_this = jQuery(this);    
				var row_no = parseFloat( jQuery('.cxc-item-table tr.cxc-sub-row').length );
				console.log();
				var row_html = jQuery('.cxc-item-table .cxc-hide-tr').html().replace(/rand_no/g, row_no).replace(/hide_custom_repeater_itemm/g, 'custom_repeater_itemm');
				jQuery('.cxc-item-table tbody').append('<tr class="cxc-sub-row">' + row_html + '</tr>');    
			});
		});
	</script>
	<?php
}
?>
<?php
add_action( 'admin_head', 'cxc_single_repeatable_meta_box_headerr' );
function cxc_single_repeatable_meta_box_headerr(){
	?>
	<style type="text/css">
		.cxc-item-table, .cxc-item-table .cxc-sub-row input[type="text"]{ width: 100%; }
		.cxc-hide-tr{ display: none; }
	</style>
	<?php
}
?>