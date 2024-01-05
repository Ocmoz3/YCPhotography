console.log('Hello JS !');
// NAV
/**
 * Handles JavaScript for header navigation menu.
 */

/**
 * Displays header dropdown menu only on touch devices, so on click.
 */ 
if(window.matchMedia("(pointer: coarse)").matches) {
    // touchscreen
    let dropd = document.querySelector('li.dropdown a');
    dropd.addEventListener('click', function(event) {
        event.preventDefault();
        let drop = document.querySelector('li.dropdown');
        drop.classList.add('color_nav_hover');
        let dc = document.querySelector('ul.dropdown-content');
        if (window.matchMedia('(min-width: 900px)').matches) {
            dc.style.display = 'block';
        }
    }, true);
} 
/**
 * Displays dropdown menu on desktop devices on hover.
 * If click on title, go directly to the page.
 */ 
else {
    // main li
    let lis = document.querySelectorAll('#block_header li.menu-item');
    for(let li of lis) {
        li.addEventListener('mouseover', function(e) {
            this.classList.add('color_nav_hover');
        });
    }
    // li dropdown
    let drops = document.querySelectorAll('li.dropdown');
    for(let dropdown of drops) {
        dropdown.addEventListener('mouseover', function(e) {
            // ul dropdown-content
            // Selects all if there are several drop-down menus
            let ul_drops = dropdown.querySelectorAll('ul.dropdown-content');
            // let ul_drop = dropdown.querySelector('ul.dropdown-content');
            for(let ul_drop of ul_drops) {
                ul_drop.style.display = 'block';
            }
        });
    }
}

// Menu burger
let link_burger = document.getElementById("link_burger");
let burger      = document.getElementById("burger");
let ul          = document.getElementById("ul_burger");
link_burger.addEventListener("click", function (e) {
    e.preventDefault();
    burger.classList.toggle("open");
    ul.classList.toggle("open");
});
// Menu dropdown quand connecté
// let link_dropdown = document.getElementById("link_menu_drop");
// let dropdown      = document.getElementById("button_dropdown");
// let ul_drop       = document.getElementById("ul_dropdown");

// if (link_dropdown != null) {
//     link_dropdown.addEventListener("click", function (e) {
//     e.preventDefault();
//     dropdown.classList.toggle("open_drop");
//     ul_drop.classList.toggle("open_drop");
//     });
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
// main li
let lis_close = document.querySelectorAll('li.menu-item');
for(let li_close of lis_close) {
    li_close.addEventListener('mouseleave', function(e) {
        this.classList.remove('color_nav_hover');
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

// Menu anchor
// jquery
(function($) {
    // $( window ).on( "load", function(){
    $(document).ready(function () {
        // permet d'ajuster l'ancre par rapport à la hauteur du header (-70px)
        // topMenuHeight = -70;
        if($('a.a_nav[href*="#"]').length) {
            $('a.a_nav[href*="#"]').click(function() {
                substractHeight = 70;
                // Menu burger 
                // detects whether user is on a touch screen
                if(window.matchMedia("(pointer: coarse)").matches) {
                    // Changes the height of the anchor point according to screen size.
                    if (window.matchMedia('(min-width: 900px)').matches) {
                        substractHeight = 70;
                    }
                    else {
                        substractHeight = 0;
                    }
                }
                // Closes the burger menu if the user clicks on a navigation link.
                $('#ul_burger').removeClass('open');
                $('#burger').removeClass('open');
                // Adjusts anchor height.
                $('html,body').animate({ scrollTop: $($(this).attr('href')).offset().top - substractHeight }, 'slow','swing');
                return false;
            });
        }
        // js
        // Highlight nav tab when scroll on home page
        function onePageNav(switchName) {
            const navSwitch = $(switchName);
            console.log(navSwitch);
            // Height must be a little superior compared to html, body animate, else when click on a nav tab, the previous nav tab is colored.
            const deductHeight = 72;
            let navArr = [];
            // Triggers function only if user is on home page
            // Else, js errors
            if($('body.home').length) {
                navSwitch.each(function(i) {
                    let navSwitchHref = $(this).attr('href');
                    let tgtOff = $(navSwitchHref).offset().top - deductHeight;
                    navArr.push([]);
                    navArr[i].switch = $(this);
                    navArr[i].tgtOff = tgtOff;
                    console.log(tgtOff);
                });
            }
            $(window).scroll(function() {
                for( let i = 0; i < navArr.length; i++ ) {
                    let scroll = $(window).scrollTop();
                    console.log(scroll);
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
            // Triggers the dynamic nav menu item color 
            onePageNav('.js-curnav-switch');
            // Adds the "is-current" class to the right menu item when the page loads.
            // Otherwise, no element is colored, as this is triggered by scrolling.
            // Gets the url
            url = $(location).attr('href');
            // Explodes the url
            splitUrl = url.split('/');
            // Loop into each part of url
            for( let i = 0; i < splitUrl.length; i++ ) {
                // If finds the part which starts with the anchor
                if(splitUrl[i].match('^#')) {
                    // Adds the "is-current" class to the right menu item
                    // The class is then removed as soon as scrolling is activated.
                    $('a[href^="' + splitUrl[i] + '"]').addClass('is-current');
                }
            }
        });
    });
}) (jQuery);