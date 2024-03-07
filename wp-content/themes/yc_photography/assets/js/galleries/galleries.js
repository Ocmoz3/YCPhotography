// console.log('Hello galleries JS !');
/**
 * Handles JavaScript galleries template.
 */


// Must be at the beginning, else doesn't work for some
function rewriteUrl() {
    // Creates a new url obj that captures the current url.
    const url = new URL(location);
    // Explodes the url and creates an array and keeps the first five occurences.
    // Here, it's important to use this method to keep the first occurrences rather than remove the last. Indeed, with this method, we'll always keep the requested occurrences, whereas removing them is always possible as long as there are some left, so it reduces the url at each click...
    var pathName = url.href.split('/', 5);
    // console.log(pathName);
    // Rebuilds the url into a string.
    pathName = pathName.join('/');
    // console.log(pathName);
    // Rebuilds the base url.
    // Please note that the slash at the end is essential for the slider to function correctly when the modal opens on page load.
    closeUrl = pathName + '/';
    // The url is updated with the page's base url when the modal is closed.
    history.pushState({}, "", closeUrl);
}

/**
 * Handles slider images modal.
 */
// Attributes the base value of the slideIndex variable.
let slideIndex = 1;
// slideIndex = parseInt(slideIndex);
showSlides(slideIndex);

// Prev next buttons
// When click on next or previous icon, updates the value of slideIndex, the showSlides parameter.
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Image controls
// Updates the slideindex variable according to which image was clicked.
function currentSlide(n) {
    showSlides(slideIndex = n);
}

// Slider
function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName('mySlides');
    let hearts = document.getElementsByClassName('heart');
    let heartCounters = document.getElementsByClassName('heart_counter');
    let inputCounters = document.getElementsByClassName('input_storage');
    let shareButton = document.getElementsByClassName('share');
    let sharesIcons = document.getElementsByClassName('div_social_sharing');
    let sharesLink = document.getElementsByClassName('social_link_container');
    // slides
    if(n > slides.length) {
        slideIndex = 1
    }
    if(n < 1) {
        // slideIndex = parseInt(slideIndex);
        slideIndex = slides.length
    }
    heartIndex = slideIndex;
    // shareButtonIndex = slideIndex;
    shareIndex = slideIndex;
    // LinkIndex = slideIndex;
    // slides
    for (i = 0; i < slides.length; i++) {
        source = slides[i].src;
        slides[i].style.display = 'none';
    }
    for (i = 0; i < hearts.length; i++) {
        hearts[i].style.display = 'none';
        heartCounters[i].style.display = 'none';
    }
    for (i = 0; i < sharesIcons.length; i++) {
        sharesIcons[i].style.display = 'none';
    }
    for (i = 0; i < shareButton.length; i++) {
        shareButton[i].style.display = 'none';
    }

    // console.log(n);
    // console.log(slides);
    // console.log(slides[slideIndex-1]);
    // console.log(slideIndex);
    slides[slideIndex-1].style.display = 'block';

    // hearts
    // Displays only the current heart.
    hearts[slideIndex-1].style.display = 'inline-flex';
    // Displays the current heart counter only if its value is greater than 0.
    if(heartCounters[slideIndex-1].innerHTML !== '0') {
        heartCounters[slideIndex-1].style.display = 'inline-flex';
    }
    // share button
    // Displays only the current share button.
    shareButton[slideIndex-1].style.display = 'inline-flex';

    // sharesIcons
    // Displays only the current share icons.
    sharesIcons[slideIndex-1].style.display = 'block';
    // sharesLink
    // Displays only the current share link.
    counterID = heartCounters[slideIndex-1].getAttribute('id');
}

// jquery
( function ($) {

    // MAIN MODAL + LINK SHARE
    // When the page opens.
    $(document).ready(function() {
        // If the url includes a dot (as in an image file name...).
        if (window.location.href.indexOf(".") > -1) {
            // Modal is displayed.
            $('#modal01').css('display', 'block');
            // Recovers the correct value by exploding the url.
            var result = window.location.href.split('/');
            // Gets the nslider into the url.
            // Please note that the value must be transformed into a number for the showSlides function to work correctly.
            var result = result[result.length - 2];
            result = parseInt(result);
            // console.log(result);
            // Triggers the showSlide function with the value of the slideIndex which corresponds to the data retrieved from the url.
            showSlides(slideIndex = result);
            // Rewrites base url if click on previous or next button.
            $('.next').click(function(event) {
                event.preventDefault();
                rewriteUrl();
            });
            $('.prev').click(function(event) {
                event.preventDefault();
                rewriteUrl();
            });
        }
    });
    // LIKES
    $('.heart').click(function() {
        // Selects the counter span tag that follows THIS span.heart.
        counter = $(this).parent().next().children('span');
        // Gets value of THIS span.heart_counter and transforms it into an integer.
        counterGetNumber = parseInt(counter.html());
        // Sets 'liked' class to THIS heart span tag.
        // Gets the id of THIS span.heart_counter after and attributes it to a variable.
        counterID = counter.attr('id');
        $(this, '.heart').toggleClass('liked');
        // Whether THIS span.heart has class 'liked'
        if($(this, '.heart').hasClass('liked')) {
            // Integrates svg tag to THIS span.heart.
            $(this, '.heart').html('<svg width="18px" height="18px" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--twemoji" preserveAspectRatio="xMidYMid meet" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"><path fill="#DD2E44" d="M35.885 11.833c0-5.45-4.418-9.868-9.867-9.868c-3.308 0-6.227 1.633-8.018 4.129c-1.791-2.496-4.71-4.129-8.017-4.129c-5.45 0-9.868 4.417-9.868 9.868c0 .772.098 1.52.266 2.241C1.751 22.587 11.216 31.568 18 34.034c6.783-2.466 16.249-11.447 17.617-19.959c.17-.721.268-1.469.268-2.242z"/></g></svg>');
            // Adds one like.
            counter.html(counterGetNumber + 1);
            // Gets value of THIS span.heart_counter after and updates the concerned variable.
            counterGetNumber = counter.html();
            // Selects the input corresponding to THIS span.heart_counter.
            inputStorage = counter.next();
            // This assigns it the value of THIS span.heart_counter.
            inputStorage.val(counterGetNumber);
            // Retrieves the value of this input.
            inputStorageValue = inputStorage.val();
            // Assigns the value and displays it in the value attribute.
            inputStorage.attr('value', inputStorageValue);
            // Displays THIS span.heart_counter.
            counter.css('display', 'inline-flex');
        } else {
            // Removes one like.
            counter.html(counterGetNumber - 1);
            // Gets value of THIS span.heart_counter after and updates the concerned variable.
            counterGetNumber = counter.html();
            // Selects the input tag corresponding to THIS span.heart_counter.
            inputStorage = counter.next();
            // Attributes THIS span.heat_counter value to the input tag corresponding.
            inputStorage.val(counterGetNumber);
            // Stores the input value into a variable.
            inputStorageValue = inputStorage.val();
            // Attributes it to the input.
            inputStorage.attr('value', inputStorageValue);
            // Integrates svg tag to THIS span.heart.
            if(counterGetNumber == 0) {
                $(this, '.heart').html('<svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="-18.02 -18.02 636.86 636.86" xml:space="preserve" stroke="#000000" stroke-width="18.02472"> <g id="SVGRepo_bgCarrier" stroke-width="0"/> <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/> <g id="SVGRepo_iconCarrier"> <g> <g> <path d="M300.413,579.295l-3.838-2.256c-0.417-0.244-42.267-24.99-93.594-66.887C155.53,471.42,89.913,409.596,46.783,335.031 C15.751,281.351,0.011,227.687,0,175.529c-0.002-22.647,4.062-43.951,12.079-63.319c7.697-18.593,18.843-34.986,33.129-48.724 c28.135-27.056,66.771-41.957,108.79-41.957c25.468,0,48.491,4.055,68.428,12.051c19.008,7.624,35.286,18.838,48.382,33.333 c13.457,14.893,23.404,33.046,29.605,53.767c6.201-20.723,16.148-38.872,29.607-53.767c13.098-14.494,29.377-25.709,48.385-33.332 c19.939-7.997,42.965-12.051,68.434-12.051c42.016,0,80.648,14.901,108.783,41.957c14.287,13.738,25.434,30.132,33.131,48.725 c8.016,19.368,12.078,40.672,12.072,63.319c-0.01,52.166-15.752,105.83-46.795,159.502c-19.068,32.977-44.084,66.23-74.354,98.834 c-24.145,26.008-51.676,51.676-81.828,76.289c-51.328,41.896-93.182,66.641-93.598,66.887L300.413,579.295z M153.998,36.672 c-38.085,0-72.993,13.399-98.293,37.729c-26.54,25.522-40.566,60.49-40.561,101.125c0.01,49.464,15.066,100.579,44.75,151.925 c23.146,40.018,68.384,102.131,152.449,170.795c41.561,33.947,76.727,56.404,88.071,63.408 c11.345-7.002,46.513-29.461,88.074-63.408c46.4-37.898,110.512-98.295,152.436-170.795 c29.691-51.34,44.752-102.455,44.76-151.926c0.012-40.634-14.014-75.602-40.555-101.125 c-25.301-24.329-60.207-37.729-98.287-37.729c-45.842,0-81.363,13.59-105.584,40.393c-21.766,24.088-33.271,58.135-33.271,98.461 h-15.143c0-40.325-11.505-74.373-33.27-98.461C235.353,50.263,199.833,36.672,153.998,36.672z"/> </g> </g> </g> </svg>');
                counter.css('display', 'none');
                inputStorage.css('display', 'none');
            }
        }
    });

    // Selects all span.heart_counter.
    counter = $('.heart_counter');
    // Sets value to each span.heart_counter.
    counter.each(function() {
        // Gets likes number of THIS span.heart_counter recorded before.
        // The number of likes is retrieved upstream in PHP directly from the teplate using a function that fetches the value stored in the database.
        counterNumber = $(this).html();
        if(counterNumber == null) {
            counterNumber = 0;
        }
        // Gets id attribute of THIS span.heart_counter and sets it to a variable.
        counterId = '#' + $(this).attr('id');
        // Selects span.heart placed before THIS span.heart_counter.
        heart = $(this).parent().prev().children();
        // Attributes 'already_liked' class to THIS span.heart only if number of likes bigger than zero.
        if(counterNumber > 0) {
            heart.addClass(' already_liked');
        }
        // Check if span.heart has 'already_liked' class.
        if(heart.hasClass('already_liked')) {
            // Gets the right number of likes.
            $(counterId).html(counterNumber);
            // Displays THIS span.heart_counter.
            $(counterId).css('display', 'inline-flex');
            // Integrates svg tag to THIS span.heart.
            $(heart).html('<svg width="18px" height="18px" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--twemoji" preserveAspectRatio="xMidYMid meet" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"><path fill="#DD2E44" d="M35.885 11.833c0-5.45-4.418-9.868-9.867-9.868c-3.308 0-6.227 1.633-8.018 4.129c-1.791-2.496-4.71-4.129-8.017-4.129c-5.45 0-9.868 4.417-9.868 9.868c0 .772.098 1.52.266 2.241C1.751 22.587 11.216 31.568 18 34.034c6.783-2.466 16.249-11.447 17.617-19.959c.17-.721.268-1.469.268-2.242z"/></g></svg>');
        }
    });
    // Adds class 'is-current' to the nav item when on one of portfolio pages.
    // Do it in PHP language with is_page() ?
    $('a[href^="#portfolio"]').addClass('is-current');

}) (jQuery);

// MAIN MODAL
// Opens modal click.
function onClick(element) {
    jQuery('#modal01').css('display', 'block');
}

// Closes modal button.
function closeModal() {
    document.getElementById('modal01').style.display = 'none';
    // Rewrites url.
    rewriteUrl();
}

// SHARE MODAL
function displayModalShare(element) {
    // Displays the sharing modal.
    jQuery('#modal_social_sharing').css('display', 'flex');

    // Attributes a new url to this slide only if this one doesn't contain a dot.
    if(window.location.href.indexOf('.') == -1) {
        // Creates a new url obj that captures the current url.
        const url = new URL(location);
        // When the sharing modal opens, a new url is rebuilt with the sharing link and slide number managed and assigned in PHP directly in the template.
        // Please note that the slash at the end is essential for the slider to function correctly when the modal opens on page load.
        pushUrl = url + element.dataset.sharingurl + '/' + element.dataset.nslider + '/';
        // Assigns the value of this url to the input displayed in the sharing modal, which copies the link.
        jQuery('input[name="share_link"]').attr('value', pushUrl);
        // Updates the url dynamically with the values assigned in PHP. Important, as this is the url that will be used if a network user clicks on it. Redirection must be ok -> managed afterwards to assign the right value to currentSlide so that it displays the right image in relation to slideIndex.
        history.pushState({}, "", pushUrl);
    }

}
function displayCloseShare(element) {
    // Closes the sharing modal.
    jQuery('#modal_social_sharing').css('display', 'none');
    // Rewrites base url.
    rewriteUrl();
    // Retrieves the close button corresponding to the modal share corresponding to the displayed image.
    thisId = jQuery(element);
    // Retrieves the associated data-id.
    thisId = jQuery(thisId.data('getid'));
    // Selects the span that displays 'Link copied'.
    targetP = jQuery('#copied-' + (thisId)[0]);
    // Replaces the text 'Link copied' with nothing.
    targetP.html('');
}
// Opens full-screen image.
var elem = document.documentElement;
function openFullscreen() {
    // Fullscreen
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.webkitRequestFullscreen) { /* Safari */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) { /* IE11 */
        elem.msRequestFullscreen();
    }
    // Modal
    let elementContainer = document.querySelector('.img-modal-content');
    // let elementContainerDiv = document.querySelector('.img-modal-content').children;
    // console.log(elementContainerDiv);
    elementContainer.classList.add('fullscreen_modal');
    let elementsDivImage = document.querySelectorAll('.div_modal_img');
    let elementsImage = document.querySelectorAll('.mySlides');
    // console.log(elementsImage);
    for(elementDivImage of elementsDivImage) {
        elementDivImage.classList.add('fullscreen_div_img');
    }
    for(elementImage of elementsImage) {
        elementImage.classList.add('fullscreen_img');
    }
    // Min max icons
    let elementOpen = document.querySelector('.maximize_icon');
    elementOpen.style.display = 'none';
    let elementClose = document.querySelector('.minimize_icon');
    elementClose.style.display = 'flex';
}
// Closes full-screen image.
function closeFullscreen() {
    // Fullscreen
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.webkitExitFullscreen) { /* Safari */
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) { /* IE11 */
        document.msExitFullscreen();
    }
    // Modal
    let elementContainer = document.querySelector('.img-modal-content');
    elementContainer.classList.remove('fullscreen_modal');
    let elementsDivImage = document.querySelectorAll('.div_modal_img');
    let elementsImage = document.querySelectorAll('.mySlides');
    for(elementDivImage of elementsDivImage) {
        elementDivImage.classList.remove('fullscreen_div_img');
    }
    for(elementImage of elementsImage) {
        elementImage.classList.remove('fullscreen_img');
    }
    // Min max icons
    let elementOpen = document.querySelector('.maximize_icon');
    elementOpen.style.display = 'flex';
    let elementClose = document.querySelector('.minimize_icon');
    elementClose.style.display = 'none';
}

// SHARE
function copyToClipboard(element) {
    // Retrieves the share button clicked.
    thisElement = jQuery(element);
    // Selects the child of the previous element, which is the input in which the value is stored.
    textBox = jQuery(thisElement.prev().children('.share_link'));
    // Copies the value to the clipboard.
    navigator.clipboard.writeText(textBox.attr('value'));
    // Selects next span's children.
    thisElementSpan = thisElement.parent().next().children();
    // Displays 'Link copied' text in span.
    thisElementSpan.html('Lien copié !');
}