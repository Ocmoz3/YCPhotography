<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the .container div and all content after.
 */

?>

            <footer>
                <div class="div_site_credits">
                    <p class="site_credits"><span>mozdev</span> &copy;2024 Tous droits réservés</p>
                    <?php
                    if(has_nav_menu('footer_legals')):
                        wp_nav_menu([
                            'theme_location'  => 'footer_legals',
                            'menu_class'      => 'footer_legals_ul',
                            'container_class' => 'footer_legals_container',
                            'container'       => 'nav',
                        ]);
                    endif;
                    ?>
                </div>
            </footer>
        </main>
        <?php wp_footer() ?>
    </body>
</html>