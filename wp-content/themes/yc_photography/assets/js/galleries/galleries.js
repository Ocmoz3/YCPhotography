console.log('Hello galleries JS !');
/**
 * Handles JavaScript for header navigation menu.
 */

// JS
// SLIDER
/**
 * Handles slider images modal.
 */
// Attributes the base value of the slideIndex variable.
let slideIndex = 1;
// Initiates the showslide function with the base value of the slideIndex variable.
// @param int slideIndex 
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
    // console.log(n);
    let i;
    let slides = document.getElementsByClassName('mySlides');
    let hearts = document.getElementsByClassName('heart');
    let heartCounters = document.getElementsByClassName('heart_counter');
    let shareButton = document.getElementsByClassName('share');
    let sharesIcons = document.getElementsByClassName('div_social_sharing');
    let sharesLink = document.getElementsByClassName('social_link_container');
    // slides
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    heartIndex = slideIndex;
    // shareButtonIndex = slideIndex;
    shareIndex = slideIndex;
    // LinkIndex = slideIndex;
    // slides
    for (i = 0; i < slides.length; i++) {
        // console.log(slides[i]);
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
    slides[slideIndex-1].style.display = 'block';
    // hearts
    // Displays only the current heart.
    hearts[slideIndex-1].style.display = 'inline-flex';
    heartCounters[slideIndex-1].style.display = 'inline-flex';
    // share button
    // Displays only the current share button.
    shareButton[slideIndex-1].style.display = 'block';

    // sharesIcons
    // Displays only the current share icons.
    sharesIcons[slideIndex-1].style.display = 'block';
    // sharesLink
    // Displays only the current share link.
    counterID = heartCounters[slideIndex-1].getAttribute('id');

    // Je récupère la valeur de l'input qui stocke le nombre de likes
    // Le nombre de likes est récupéré en amont en PHP directement dans le teplate grâce à une fonction qui va chercher la valeur enregistrée dans la base de données
    counterNumber = hearts[slideIndex-1].getAttribute('value');
    // Si le nombre de likes est positif, dans ce cas display la valeur
    if(counterNumber > 0 || counterNumber !== null) {
        heartCounters[slideIndex-1].style.display = 'inline-flex';
    }
}

// jquery
( function ($) {

    // À l'ouverture de la page !
    // MAIN MODAL + LINK SHARE
    $(document).ready(function() {
        // Si l'url comprend un point (comme dans un nom de fichier image...)
        if (window.location.href.indexOf(".") > -1) {
            // affiche la modale
            $('#modal01').css('display', 'block');
            // je récupère la bonne valeur en éclatant l'url
            // !!!!! doit être amélioré, difficile d'anticiper la clé...
            var result = window.location.href.split('/')[6];
            // déclenche la fonction showSlide MAIS avec la valeur du slideIndex qui correspond à la donnée récupérée dans l'url !!!
            showSlides(slideIndex = result);
        }
      });

    // LIKES
    $('.heart').click(function() {
        // Selects the counter span tag that follows THIS span.heart
        counter = $(this).next();
        // console.log(counter);
        // gets value of THIS span.heart_counter and transforms it into an integer
        counterGetNumber = parseInt(counter.html());
        // Sets 'liked' class to THIS heart span tag
        // gets id of THIS span.heart_counter after and attributes it to a variable
        counterID = counter.attr('id');
        $(this, '.heart').toggleClass('liked');
        // Whether THIS span.heart ahs class liked
        if($(this, '.heart').hasClass('liked')) {
            // integrates svg tag to THIS span.heart
            $(this, '.heart').html('<svg width="18px" height="18px" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--twemoji" preserveAspectRatio="xMidYMid meet" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"><path fill="#DD2E44" d="M35.885 11.833c0-5.45-4.418-9.868-9.867-9.868c-3.308 0-6.227 1.633-8.018 4.129c-1.791-2.496-4.71-4.129-8.017-4.129c-5.45 0-9.868 4.417-9.868 9.868c0 .772.098 1.52.266 2.241C1.751 22.587 11.216 31.568 18 34.034c6.783-2.466 16.249-11.447 17.617-19.959c.17-.721.268-1.469.268-2.242z"/></g></svg>');
            // adds one like
            counter.html(counterGetNumber + 1);
            // gets value of THIS span.heart_counter after and updates the concerned variable
            counterGetNumber = counter.html();
            // Je sélectionne l'input qui correspond à CE span.heart_counter
            inputStorage = counter.next();
            // Je lui attribue la valeur de THIS span.heart_counter
            inputStorage.val(counterGetNumber);
            // Je récupère la valeur de cet input
            inputStorageValue = inputStorage.val();
            // Je lui attribue la valeur et la display dans l'attribut value
            inputStorage.attr('value', inputStorageValue);

            // displays THIS span.heart_counter
            counter.css('display', 'inline-flex');
        } else {
            // removes one like
            counter.html(counterGetNumber - 1);
            // gets value of THIS span.heart_counter after and updates the concerned variable
            counterGetNumber = counter.html();

            inputStorage = counter.next();
            // console.log(inputStorage);
            inputStorage.val(counterGetNumber);
            // console.log(inputStorage);
            inputStorageValue = inputStorage.val();
            // inputStorageValue.html(inputStorageValue);
            inputStorage.attr('value', inputStorageValue);
            // integrates svg tag to THIS span.heart
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
        // Check !
        // console.log(`div${index}: ${this.id}`);
        // Gets likes number of THIS span.heart_counter recorded before.
        // Le nombre de likes est récupéré en amont en PHP directement dans le teplate grâce à une fonction qui va chercher la valeur enregistrée dans la base de données
        counterNumber = $(this).html();
        // Si résultat vide, résultat == null
        // Transforme résultat null en zéro
        if(counterNumber == null) {
            counterNumber = 0;
        }
        // Gets id attribute of THIS span.heart_counter and sets it to a variable.
        counterId = '#' + $(this).attr('id');
        // Selects span.heart placed before THIS span.heart_counter.
        heart = $(this).prev();
        // Attributes 'already_liked' class to THIS span.heart only if number of likes bigger than zero.
        if(counterNumber > 0) {
            heart.addClass(' already_liked');
        }
        // Check if span.heart has 'already_liked' class.
        if(heart.hasClass('already_liked')) {
            // gets the right number of likes
            $(counterID).html(counterNumber);
            // Displays THIS span.heart_counter.
            $(counterID).css('display', 'inline-flex');
            // Integrates svg tag to THIS span.heart.
            $(heart).html('<svg width="18px" height="18px" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--twemoji" preserveAspectRatio="xMidYMid meet" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"><path fill="#DD2E44" d="M35.885 11.833c0-5.45-4.418-9.868-9.867-9.868c-3.308 0-6.227 1.633-8.018 4.129c-1.791-2.496-4.71-4.129-8.017-4.129c-5.45 0-9.868 4.417-9.868 9.868c0 .772.098 1.52.266 2.241C1.751 22.587 11.216 31.568 18 34.034c6.783-2.466 16.249-11.447 17.617-19.959c.17-.721.268-1.469.268-2.242z"/></g></svg>');
        }
    });
    // jquery
    // Adds class 'is-current' to the nav item when on one of portfolio pages.
    // Do it in PHP language with is_page()
    $('a[href^="#portfolio"]').addClass('is-current');

}) (jQuery);

// JS
// MAIN MODAL
// Opens modal click.
function onClick(element) {
    jQuery('#modal01').css('display', 'block');
}
// Closes modal button.
function closeModal() {
    document.getElementById('modal01').style.display = 'none';
}
// SHARE MODAL
function displayModalShare(element) {
    // display la modale de partage
    jQuery('#modal_social_sharing').css('display', 'flex');
    // checks si je récupère bien la valeur de data-sharingurl intétgrée en PHP dans le template
    // console.log(element.dataset.sharingurl);
    // console.log(element.dataset.nslider);
    // je crée un nouvel obj url qui capte l'url courante
    const url = new URL(location);
    // quand j'ouvre la modale, je reconstruis une nouvelle url avec le lien de partage et le numéro de slide gérés et attribués en PHP directement dans le template
    pushUrl = url + element.dataset.sharingurl + '/' + element.dataset.nslider;
    // J'attribue comme valeur cette url à l'input qui est display dans la modale partage et qui permet de copier le lien
    jQuery('input[name="share_link"]').attr('value', pushUrl);
    // Je mets à jour l'url dynamiquement avec les valeurs attribuées en PHP, important car c'est cette url qui sera utilisée si un utlisateur d'un réseau clique dessus. Redirection doit être ok -> géré après en pour attribuer la bonne valeur de currentSlide pour qu'elle affiche la bonne image par rapport au slideIndex
    history.pushState({}, "", pushUrl);
}
function displayCloseShare() {
    // ferme la modale de partage
    jQuery('#modal_social_sharing').css('display', 'none');
    // je crée un nouvel obj url qui capte l'url courante
    const url = new URL(location);
    // console.log(url);
    // // je reconstruis l'url de base
    // closeUrl = url.origin + '/elfee/galerie/';

    closeUrl = url.origin + '/yc_photography/chroniques/';

    // // l'url est mis à jour avec l'url de base de la page quand on ferme la modale
    history.pushState({}, "", closeUrl);
}
// Opens full-screen image.
var elem = document.documentElement;
function openFullscreen() {
    // fullscreen
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.webkitRequestFullscreen) { /* Safari */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) { /* IE11 */
        elem.msRequestFullscreen();
    }
    // modal
    let elementContainer = document.querySelector('.img-modal-content');
    elementContainer.classList.add('fullpage_img');
    let elementsImage = document.querySelectorAll('.mySlides');
    for(elementImage of elementsImage) {
        elementImage.classList.add('fullpage_img');
    }
    // min max icons
    let elementOpen = document.querySelector('.maximize_icon');
    elementOpen.style.display = 'none';
    let elementClose = document.querySelector('.minimize_icon');
    elementClose.style.display = 'flex';
}
// Closes full-screen image.
function closeFullscreen() {
    // fullscreen
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.webkitExitFullscreen) { /* Safari */
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) { /* IE11 */
        document.msExitFullscreen();
    }
    // modal
    let elementContainer = document.querySelector('.img-modal-content');
    elementContainer.classList.remove('fullpage_img');
    let elementsImage = document.querySelectorAll('.mySlides');
    for(elementImage of elementsImage) {
        elementImage.classList.remove('fullpage_img');
    }
    // min max icons
    let elementOpen = document.querySelector('.maximize_icon');
    elementOpen.style.display = 'flex';
    let elementClose = document.querySelector('.minimize_icon');
    elementClose.style.display = 'none';
}

// SHARE
function copyToClipboard(element) {
    console.log(jQuery(element));
    thisElement = jQuery(element);
    // var textBox = document.getElementById("share_link");
    textBox = jQuery(thisElement.prev().children('#share_link'));
    console.log(jQuery(thisElement.prev().children('#share_link')));
    // console.log(textBox.value);
    console.log(textBox.attr('value'));
    navigator.clipboard.writeText(textBox.attr('value'));
    // let copied = document.getElementById('copied').innerHTML;
    // console.log(document.getElementById('copied'));
    // document.getElementById('copied').innerHTML = 'Lien copié !';
    thisElementP = thisElement.parent().next().children();
    // thisElementP = thisElement.parent().next();
    thisElementP.html('Lien copié !');
    // document.getElementById('share_link_button').addEventListener('click', function(e) {
    console.log('btn share click ok !');
}