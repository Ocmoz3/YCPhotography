<?php
// Gets the current page URL.
// $url = urlencode(get_permalink());
// Gets the current rawurl.
$raw_url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
// Sanitizing.
$url = htmlspecialchars( $raw_url, ENT_QUOTES, 'UTF-8' );
// ⚠️ This code has security implications because the client and the server can set HTTP_HOST and REQUEST_URI to arbitrary values. It is absolutely necessary to sanitize both values and do proper input validation (CWE-20). They must not be used in any security context.
// $url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// $url = 'https://google.com'; // for test, works !
// debug($url);
// Gets the current page title.
// $title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
// $title = 'http://localhost/yc_photography/chroniques/chroniques3.jpg/4/';
$title = explode('/', $url);
$title = $title[5];
// debug($title);
// the_permalink(get_post_thumbnail_id($serv));
// $site_name = 'test';
$site_name = get_option('blogname');
// bloginfo('name');

// LINKS
// https://www.rankya.com/wordpress/how-to-add-social-media-share-links-to-wordpress-without-a-plugin/ 20/11/2021
// $siteurlfromsettingsgeneral =  get_bloginfo( 'url' );
// $domainparts = parse_url($siteurlfromsettingsgeneral);
// $domain = isset($domainparts['host']) ? $domainparts['host'] : '';
// if (preg_match('/(?P[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
//     $siteurlfromsettingsgeneral = strstr( $regs['domain'], '.', true );
// }
// // get_the_title but add space %20
// $rankya_title = str_replace( ' ', '%20', get_the_title());

// $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$rankya_url;
// $whatsappURL = 'whatsapp://send?text='.$rankya_title . ' ' . $rankya_url;
// $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$rankya_url.'&title='.$rankya_title;
// // 
// $twitterURL = 'https://twitter.com/intent/tweet?text='.$rankya_title.'&url='.$rankya_url.'&via='.$siteurlfromsettingsgeneral.'';

// https://www.myprograming.com/how-to-add-social-media-share-links-in-the-wordpress-custom-theme-without-plugin/ 30/03/2023
// $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . $url;
// $whatsapp_url = 'whatsapp://send?text=' . $title . ' ' . $url;
// $linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title;
// // 
// $instagram_url = 'https://www.instagram.com/myprograming?url=' . $url;
// $pinterest_url = 'https://www.pinterest.com/pin/create/button/?url=' . $url . '&media=' . $thumbnail[0] . '&description=' . $title;

// https://blog.sagipl.com/how-to-create-social-sharing-links-without-any-tool/ 24/04/2023
// Facebook:
// $facebook = 'https://www.facebook.com/share.php?u=[URL]&title=[TITLE]';
// // Linkedin:
// $linkedIn = 'https://www.linkedin.com/shareArticle?mini=true&url=[URL]&title=[TITLE]&source=[SOURCE/DOMAIN]';
// // Google Plus:
// $googlePlus = 'https://plus.google.com/share?url=[URL]';
// // Twitter:
// $twitter= 'https://twitter.com/home/?status=[TITLE][URL]';
// // Pinterest:
// $pinterest = 'https://pinterest.com/pin/create/bookmarklet/?media=[MEDIA]&url=[URL]&is_video=false&description=[TITLE]';
// // Reddit:
// $reddit = 'https://www.reddit.com/submit?url=[URL]&title=[TITLE]';
// // Stumbleupon:
// // https://www.stumbleupon.com/submit?url=[URL]&title=[TITLE]
// // BufferApp:
// // https://bufferapp.com/add?text=[TITLE]&url=[URL]
// // Email:
// $email = 'email:?subject=[TITLE]&body=Checkout the update on [URL]';
// // Tumblr:
// $tumblr = 'https://www.tumblr.com/share?v=3&u=[URL]&t=[TITLE]';

// WIX
// facebook
// https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fyanncielat.wixsite.com%2Fphotographie%2Fpresence%3Fpgid%3Diqggm38l-2c99fc5a-fb68-4e59-9e0e-c43b8e98cf63&t=02%20-%20chroniques.jpg
// twitter
// https://twitter.com/intent/tweet?url=https%3A%2F%2Fyanncielat.wixsite.com%2Fphotographie%2Fpresence%3Fpgid%3Diqggm38l-2c99fc5a-fb68-4e59-9e0e-c43b8e98cf63&amp;text=02%20-%20chroniques.jpg&amp;hashtags=gallery%2Cphotos%2Cphotographer%2Cprofessional
// pinterest
// https://www.pinterest.fr/pin/create/button/?description=02%20-%20chroniques.jpg&media=https%3A%2F%2Fstatic.wixstatic.com%2Fmedia%2F710cc4_b3a6931bed9046178d69435efdbae5c2~mv2.jpg%2Fv1%2Ffit%2Fw_500%2Ch_500%2Cq_90%2F710cc4_b3a6931bed9046178d69435efdbae5c2~mv2.jpg&url=https%3A%2F%2Fyanncielat.wixsite.com%2Fphotographie%2Fpresence%3Fpgid%3Diqggm38l-2c99fc5a-fb68-4e59-9e0e-c43b8e98cf63

$networks = [
    'facebook' => [
        'name' => 'facebook',
        'label' => 'Facebook',
        'icon' => '<i class="fa-brands fa-facebook"></i>',
        'unicode' => 'f082',
        'sharing_url' => 'https://www.facebook.com/sharer/sharer.php?u=' . $url . '&t=' . $title
    ],
    'whatsapp' => [
        'name' => 'whatsapp',
        'label' => 'WhatsApp',
        'icon' => '<i class="fa-brands fa-whatsapp"></i>',
        'unicode' => 'f40c',
        'sharing_url' => 'whatsapp://send?text=' . $title . ' ' . $url
    ],
    'linkedin' => [
        'name' => 'linkedin',
        'label' => 'Linkedin',
        'icon' => '<i class="fa-brands fa-linkedin"></i>',
        'unicode' => 'f08c',
        'sharing_url' => 'https://www.linkedin.com/shareArticle?url=' . $url . '&title=' . $title
    ],
    'pinterest' => [
        'name' => 'pinterest',
        'label' => 'Pinterest',
        'icon' => '<i class="fa-brands fa-pinterest"></i>',
        'unicode' => 'f0d3',
        'sharing_url' => 'https://pinterest.com/pin/create/button/?url=' . $url . '&description=' . $title
    ],
    'twitter' => [
        'name' => 'twitter',
        'label' => 'Twitter',
        'icon' => '<i class="fa-brands fa-twitter"></i>',
        'unicode' => 'f081',
        'sharing_url' => 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title
    ],
    'email' => [
        'name' => 'email',
        'label' => 'Email',
        'icon' => '<i class="fa-solid fa-envelope"></i>',
        'unicode' => 'f0e0',
        'sharing_url' => 'mailto:type%20email%20address%20here?subject=I%20wanted%20to%20share%20this%20post%20with%20you%20from%20' . $site_name . '&body=' . $title .' - '. $url . '" title="Email to a friend/colleague" target="_blank'
    ],
    // 'instagram' => [
    //     'name' => 'instagram',
    //     'label' => 'Instagram',
    //     'icon' => '<i class="fa-brands fa-square-instagram"></i>',
    //     'unicode' => 'e055',
    //     'sharing_url' => 'https://www.instagram.com/myprograming?url=' . $url
    // ],
    // 'snapchat' => [
    //     'name' => 'snapchat',
    //     'label' => 'Snapchat',
    //     'icon' => '<i class="fa-brands fa-square-snapchat"></i>',
    //     'unicode' => 'f2ad',
    //     'sharing_url' => 'test'
    // ],
    // 'viadeo' => [
    //     'name' => 'viadeo',
    //     'label' => 'Viadeo',
    //     'icon' => '<i class="fa-brands fa-square-viadeo"></i>',
    //     'unicode' => 'f2aa',
    //     'sharing_url' => 'test'
    // ],
    // 'flickr' => [
    //     'name' => 'flickr',
    //     'label' => 'Flickr',
    //     'icon' => '<i class="fa-brands fa-flickr"></i>',
    //     'unicode' => 'f16e',
    //     'sharing_url' => 'test'
    // ],
    // 'medium' => [
    //     'name' => 'medium',
    //     'label' => 'Medium',
    //     'icon' => '<i class="fa-brands fa-medium"></i>',
    //     'unicode' => 'f23a',
    //     'sharing_url' => 'test'
    // ],
    // 'youtube' => [
    //     'name' => 'youtube',
    //     'label' => 'Youtube',
    //     'icon' => '<i class="fa-brands fa-square-youtube"></i>',
    //     'unicode' => 'f431',
    //     'sharing_url' => 'test'
    // ],
    // 'tiktok' => [
    //     'name' => 'tiktok',
    //     'label' => 'Tiktok',
    //     'icon' => '<i class="fa-brands fa-tiktok"></i>',
    //     'unicode' => 'e07b',
    //     'sharing_url' => 'test'
    // ],
    // 'dailymotion' => [
    //     'name' => 'dailymotion',
    //     'label' => 'Dailymotion',
    //     'icon' => '<i class="fa-brands fa-dailymotion"></i>',
    //     'unicode' => 'e052',
    //     'sharing_url' => 'test'
    // ],
    // 'periscope' => [
    //     'name' => 'periscope',
    //     'label' => 'Periscope',
    //     'icon' => '<i class="fa-brands fa-periscope"></i>',
    //     'unicode' => 'f3da',
    //     'sharing_url' => 'test'
    // ],
    // 'reddit' => [
    //     'name' => 'reddit',
    //     'label' => 'Reddit',
    //     'icon' => '<i class="fa-brands fa-square-reddit"></i>',
    //     'unicode' => 'f1a2',
    //     'sharing_url' => 'test'
    // ],
    // 'spotify' => [
    //     'name' => 'spotify',
    //     'label' => 'Spotify',
    //     'icon' => '<i class="fa-brands fa-spotify"></i>',
    //     'unicode' => 'f1bc',
    //     'sharing_url' => 'test'
    // ],
    // 'deezer' => [
    //     'name' => 'deezer',
    //     'label' => 'Deezer',
    //     'icon' => '<i class="fa-brands fa-deezer"></i>',
    //     'unicode' => 'e077',
    //     'sharing_url' => 'test'
    // ],
    // 'soundcloud' => [
    //     'name' => 'soundcloud',
    //     'label' => 'Soundcloud',
    //     'icon' => '<i class="fa-brands fa-soundcloud"></i>',
    //     'unicode' => 'f1be',
    //     'sharing_url' => 'test'
    // ],
];