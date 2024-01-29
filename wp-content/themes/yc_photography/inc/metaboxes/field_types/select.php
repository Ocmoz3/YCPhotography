<?php
/**
 * Template de la metabox YC_Metabox
 * Render des champs type select
 */

// Gets all pages
$pages = get_pages();
?>
<div class="meta-box-item-title">
    <h4><?php echo $name; ?></h4>
</div>
<div class="meta-box-item-content">
    <select name="<?php echo $id; ?>" id="<?php echo $id; ?>" onchange="myFunction(event)">
        <option <?php if(empty($value)): echo 'selected'; endif; ?>>Choisissez la page</option>
        <?php 
        foreach($pages as $page): 
            $url = $page->post_name . '.php';
            ?>
            <option value="<?php echo $page->post_name ?>" <?php if(!empty($value) && $value == $page->post_name): echo 'selected'; endif; ?>><?php echo $page->post_title ?></option>
            <?php 
        endforeach; 
        ?>
    </select>
    <p>Page actuellement sélectionnée</p>
    <input type="text" name="<?php echo $id; ?>" id="go" value="<?php echo $value; ?>" style="width: 85%;" data-changejs="changeJs" class="test">
</div>