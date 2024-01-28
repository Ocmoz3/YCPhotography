<?php
/**
 * Template de la metabox YC_Metabox
 * Render des champs type select
 */
// debug($options);
// debug(get_pages());
$pages = get_pages();
// foreach($pages as $page):
    // debug($pages);
// endforeach;
?>
<div class="meta-box-item-title">
    <h4><?php echo $name; ?></h4>
</div>
<div class="meta-box-item-content">
    <select name="<?php echo $id; ?>" id="<?php echo $id; ?>" onchange="myFunctionn(event)">
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
    <!-- <button id="addItem" onclick="testClick(event)">
        Ajouter un item
    </button> -->
</div>
<script>
    // jQuery(document).ready(function() {
    // Génère une erreur e is nor defined, peut-être réglé quand dans footer ?
    function myFunctionn(e) {
        // document.getElementById("myText").value = e.target.value
        // document.querySelector('.test').value = e.target.value
        // console.log(e);
        // thisVal = e.target;
        // Je sélectionne le select qui a changé
        thisVal = jQuery(e.target);
        // Je sélectionne l'élément d'après (<p>)
        thisValNext = thisVal.next();
        // Pour pouvoir sélectionner l'élément suivant (<input>) pour lui attribuer la valeur du select
        thisValNextNext = thisValNext.next().val(thisVal.val());
        // console.log(thisValNextNext);
        // console.log(thisVal.val());
        // document.querySelector('#go').value = e.target.value
        // thisValNextNext.val() = thisVal.val();
    }
// });
</script>