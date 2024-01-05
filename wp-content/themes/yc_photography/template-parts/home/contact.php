<?php
/**
 * Displays the contact template part on front-page
 */
?>

<section id="contact" style="background-color: black; width: 100%; max-width: unset; position: relative;">
    <h1 style="color: white;">contact</h1>
    <form action="">
        <div class="contact_form contact_form_max_width">
            <div id="formTop" class="form_top">
                <div class="div_form_top">
                    <input type="text" placeholder="Nom">
                </div>
                <div class="div_form_top">
                    <input type="email" placeholder="Email">
                </div>
            </div>
            <div id="formBottom" class="form_bottom">
                <div class="div_form_bottom">
                    <input type="text" placeholder="Sujet">
                </div>
                <div class="div_form_bottom">
                    <textarea cols="40" rows="7" placeholder="Message"></textarea>
                    <div class="btn_mess">
                        <button type="submit" class="submit">
                            Envoyer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    // include('svg/insta-svg.php');
    ?>
</section>