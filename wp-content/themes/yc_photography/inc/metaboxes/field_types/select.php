<?php
/**
 * Template de la metabox YC_Metabox
 * Render des champs type select
 */

// To use select field type, an array must de defined
$array = [
    'value 1' => 'value 1',
    'value 2' => 'value 2',
    'value 3' => 'value 3'
];
?>
<div class="meta-box-item-title">
    <h4><?php echo esc_html($name); ?></h4>
</div>
<div class="meta-box-item-content">
    <select name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>" onchange="myFunction(event)">
        <?php 
        foreach($array as $array_item): 
            ?>
            <option value="<?php echo esc_attr($array_item); ?>"><?php echo esc_html($array_item); ?></option>
            <?php 
        endforeach; 
        ?>
    </select>
    <input type="hidden" name="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($array_item); ?>">
</div>