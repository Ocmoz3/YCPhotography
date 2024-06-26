// console.log('Hello nav JS !');
/**
 * Handles JavaScript for header navigation menu.
 */

/**
 * Displays dropdown menu on desktop devices on hover.
 * If click on title, go directly to the page.
 */ 
    // li dropdown
    let drops = document.querySelectorAll('li.dropdown');
    for(let dropdown of drops) {
        dropdown.addEventListener('mouseover', function(e) {
            // ul dropdown-content
            // Selects all if there are several drop-down menus.
            let ul_drops = dropdown.querySelectorAll('ul.dropdown-content');
            // let ul_drop = dropdown.querySelector('ul.dropdown-content');
            for(let ul_drop of ul_drops) {
                if (window.matchMedia('(max-width: 900px)').matches) {
                    dc.style.display = 'none';
                }
                else if(window.matchMedia("(pointer: coarse)").matches) {
                    ul_drop.style.display = 'none';
                } else {
                    ul_drop.style.display = 'block';
                }
            }
        });
    }
// }
/**
 * Closes dropdown menu.
 */
// ul dropdown-content
let ul_drops_close = document.querySelectorAll('ul.dropdown-content');
for(let ul_drop_close of ul_drops_close) {
    ul_drop_close.addEventListener('mouseleave', function(e) {
        this.style.display = 'none';
    });
}
// li dropdown
let lis_drop_close = document.querySelectorAll('li.dropdown');
for(let li_drop_close of lis_drop_close) {
    li_drop_close.addEventListener('mouseleave', function(e) {
        let uls_close = li_drop_close.querySelectorAll('ul.dropdown-content');
        for(let ul_close of uls_close) {
            ul_close.style.display = 'none';
        }
    });
}
/**
 * Handles "burger" menu for medium and small screens.
 */
// Menu burger
let link_burger = document.getElementById('div_link_burger');
let burger      = document.getElementById('burger');
let ul          = document.getElementById('ul_burger');
let div_link_burger  = document.getElementById('div_link_burger')
link_burger.addEventListener('click', function(e) {
    e.preventDefault();
    burger.classList.toggle('open');
    ul.classList.toggle('open');
    div_link_burger.classList.toggle('open');
});

// Menu anchor
/**
 * Manages main menu anchors.
 */
// jquery
(function($) {
    $(document).ready(function () {
        if($('a.a_nav[href*="#"]').length) {
            $('a.a_nav[href*="#"]').click(function() {
                // Adjusts anchor to header height (35px = header nav height).
                substractHeight = 35;
                // Menu burger 
                // Detects whether user is on a touch screen.
                if(window.matchMedia("(pointer: coarse)").matches) {
                    // Changes the height of the anchor point according to screen size.
                    if (window.matchMedia('(max-width: 900px)').matches) {
                        substractHeight = 0;
                    }
                    // console.log(substractHeight);
                }
                // Closes the burger menu if the user clicks on a navigation link.
                $('#ul_burger').removeClass('open');
                $('#burger').removeClass('open');
                // Adjusts anchor height.
                $('html,body').animate({ scrollTop: $($(this).attr('href')).offset().top - substractHeight }, 'slow', 'swing');
                return false;
            });
        }
        // js
        // Highlights nav tab when scroll on home page.
        function onePageNav(switchName) {
            const navSwitch = $(switchName);
            // console.log(navSwitch);
            // Height must be a little superior compared to html, body animate, else when click on a nav tab, the previous nav tab is colored.
            // const deductHeight = 72;
            const deductHeight = 80;
            let navArr = [];
            // Triggers function only if user is on home page.
            if($('body.home').length) {
                navSwitch.each(function(i) {
                    let navSwitchHref = $(this).attr('href');
                    // console.log(navSwitchHref);
                    let tgtOff = $(navSwitchHref).offset().top - deductHeight;
                    // console.log(tgtOff);
                    navArr.push([]);
                    navArr[i].switch = $(this);
                    navArr[i].tgtOff = tgtOff;
                    // console.log(tgtOff);
                });
            }
            $(window).scroll(function() {
                for( let i = 0; i < navArr.length; i++ ) {
                    let scroll = $(window).scrollTop();
                    // console.log(scroll);
                    let tgtKey = navArr[i];
                    let tgtSwitch = tgtKey.switch;
                    let tgtOff = tgtKey.tgtOff;
                    if ( scroll >= tgtOff ) {
                        navSwitch.removeClass('is-current');
                        tgtSwitch.addClass('is-current');
                    } else {
                        tgtSwitch.removeClass('is-current');
                    }
                }
            });
        }
        $(window).on('load resize', function() {
            // Triggers the dynamic nav menu item color.
            onePageNav('.js-curnav-switch');
            // Adds the "is-current" class to the right menu item when the page loads.
            // Otherwise, no element is colored, as this is triggered by scrolling.
            // Gets the url.
            url = $(location).attr('href');
            // Explodes the url.
            splitUrl = url.split('/');
            // Loop into each part of url.
            for( let i = 0; i < splitUrl.length; i++ ) {
                // If finds the part which starts with the anchor.
                if(splitUrl[i].match('^#')) {
                    // Adds the "is-current" class to the right menu item.
                    // The class is then removed as soon as scrolling is activated.
                    $('a[href^="' + splitUrl[i] + '"]').addClass('is-current');
                }
            }
        });
    });
}) (jQuery);