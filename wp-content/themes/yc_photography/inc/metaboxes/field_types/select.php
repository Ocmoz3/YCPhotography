<?php
/**
 * Template de la metabox YC_Metabox
 * Render des champs type select
 */

//  To use select field type, an array must de defined
$array = [
    'value 1' => 'value 1',
    'value 2' => 'value 2',
    'value 3' => 'value 3'
];
?>
<div class="meta-box-item-title">
    <h4><?php echo $name; ?></h4>
</div>
<div class="meta-box-item-content">
    <select name="<?php echo $id; ?>" id="<?php echo $id; ?>" onchange="myFunction(event)">
        <!-- <option <?php if(empty($value)): echo 'selected'; endif; ?>>Choisissez la page</option> -->
        <?php 
        foreach($array as $array_item): 
            ?>
            <!-- <option value="<?php //echo $page->post_name ?>" <?php //if(!empty($value) && $value == $page->post_name): echo 'selected'; endif; ?>><?php //echo $page->post_title ?></option> -->
            <option value="<?php echo $array_item ?>"><?php echo $array_item ?></option>
            <?php 
        endforeach; 
        ?>
    </select>
    <input type="hidden" name="<?php echo $id; ?>" value="<?php echo $array_item; ?>" style="width: 85%;" data-changejs="changeJs">
</div>