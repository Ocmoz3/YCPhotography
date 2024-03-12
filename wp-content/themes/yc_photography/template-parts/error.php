<?php
/**
 * The template for displaying 404 pages (not found) and error pages (page under construction...)
 */

get_header();
?>

<div class="div_error">
    <?php if(is_404()): ?>
        <h1>Page introuvable</h1>
    <?php else: ?>
        <h1>Page en cours de contruction...</h1>
    <?php endif; ?>
    <div class="div_around_error_content">
        <div class="div_error_content">
            <div class="logo">
                <?php 
                if(function_exists('the_custom_logo')):
                    if(has_custom_logo()):
                        the_custom_logo();
                    endif;
                endif; ?>
            </div>
            <div class="div_error_text">
                <div class="div_p_error">
                    <?php if(is_404()): ?>
                        <p class="p_error">Erreur 404</p>
                        <p class="p_not_exist">
                        Cette page n'existe pas...
                        </p>
                    <?php else: ?>
                        <p class="p_error">Cette page sera bientôt disponible&nbsp;!</p>
                        <p class="p_not_exist">
                        Revenez vite&nbsp;!
                        </p>
                    <?php endif; ?>
                </div>
                <div>
                    <a class="a_error_back" href="<?php echo esc_url(home_url('/')) ?>"><p class="p_error_back">Aller à la <span class="span_error_back">page d'accueil</span></p></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();