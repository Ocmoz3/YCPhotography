<?php
// Get the current page URL
$url = esc_url(get_permalink());
// Get the current page title
$title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
// the_permalink(get_post_thumbnail_id($serv));
$networks = [
    'facebook' => [
        'name' => 'facebook',
        'label' => 'Facebook',
        'icon' => '<i class="fa-brands fa-square-facebook"></i>',
        'unicode' => 'f082',
        'sharing_url' => 'https://www.facebook.com/sharer/sharer.php?u=' . $url
    ],
    'instagram' => [
        'name' => 'instagram',
        'label' => 'Instagram',
        'icon' => '<i class="fa-brands fa-square-instagram"></i>',
        'unicode' => 'e055',
        'sharing_url' => 'test'
    ],
    'twitter' => [
        'name' => 'twitter',
        'label' => 'Twitter',
        'icon' => '<i class="fa-brands fa-square-twitter"></i>',
        'unicode' => 'f081',
        'sharing_url' => 'test'
    ],
    'snapchat' => [
        'name' => 'snapchat',
        'label' => 'Snapchat',
        'icon' => '<i class="fa-brands fa-square-snapchat"></i>',
        'unicode' => 'f2ad',
        'sharing_url' => 'test'
    ],
    'linkedin' => [
        'name' => 'linkedin',
        'label' => 'Linkedin',
        'icon' => '<i class="fa-brands fa-linkedin"></i>',
        'unicode' => 'f08c',
        'sharing_url' => 'test'
    ],
    'viadeo' => [
        'name' => 'viadeo',
        'label' => 'Viadeo',
        'icon' => '<i class="fa-brands fa-square-viadeo"></i>',
        'unicode' => 'f2aa',
        'sharing_url' => 'test'
    ],
    'pinterest' => [
        'name' => 'pinterest',
        'label' => 'Pinterest',
        'icon' => '<i class="fa-brands fa-square-pinterest"></i>',
        'unicode' => 'f0d3',
        'sharing_url' => 'test'
    ],
    'flickr' => [
        'name' => 'flickr',
        'label' => 'Flickr',
        'icon' => '<i class="fa-brands fa-flickr"></i>',
        'unicode' => 'f16e',
        'sharing_url' => 'test'
    ],
    'medium' => [
        'name' => 'medium',
        'label' => 'Medium',
        'icon' => '<i class="fa-brands fa-medium"></i>',
        'unicode' => 'f23a',
        'sharing_url' => 'test'
    ],
    'youtube' => [
        'name' => 'youtube',
        'label' => 'Youtube',
        'icon' => '<i class="fa-brands fa-square-youtube"></i>',
        'unicode' => 'f431',
        'sharing_url' => 'test'
    ],
    'tiktok' => [
        'name' => 'tiktok',
        'label' => 'Tiktok',
        'icon' => '<i class="fa-brands fa-tiktok"></i>',
        'unicode' => 'e07b',
        'sharing_url' => 'test'
    ],
    'dailymotion' => [
        'name' => 'dailymotion',
        'label' => 'Dailymotion',
        'icon' => '<i class="fa-brands fa-dailymotion"></i>',
        'unicode' => 'e052',
        'sharing_url' => 'test'
    ],
    'periscope' => [
        'name' => 'periscope',
        'label' => 'Periscope',
        'icon' => '<i class="fa-brands fa-periscope"></i>',
        'unicode' => 'f3da',
        'sharing_url' => 'test'
    ],
    'reddit' => [
        'name' => 'reddit',
        'label' => 'Reddit',
        'icon' => '<i class="fa-brands fa-square-reddit"></i>',
        'unicode' => 'f1a2',
        'sharing_url' => 'test'
    ],
    'spotify' => [
        'name' => 'spotify',
        'label' => 'Spotify',
        'icon' => '<i class="fa-brands fa-spotify"></i>',
        'unicode' => 'f1bc',
        'sharing_url' => 'test'
    ],
    'deezer' => [
        'name' => 'deezer',
        'label' => 'Deezer',
        'icon' => '<i class="fa-brands fa-deezer"></i>',
        'unicode' => 'e077',
        'sharing_url' => 'test'
    ],
    'soundcloud' => [
        'name' => 'soundcloud',
        'label' => 'Soundcloud',
        'icon' => '<i class="fa-brands fa-soundcloud"></i>',
        'unicode' => 'f1be',
        'sharing_url' => 'test'
    ],
];
?>
<?php
// foreach($networks as $name => $networkItem) {
?>
    <!-- <div class="div_social<?php //echo $name ?>" style="cursor: pointer;">
        <a href="<?php //echo $networkItem['url'] ?>" target="_blank" title="Partager sur <?php //echo $networkItem['label'] ?>" rel="noopener"><i class="fa-brands fa-<?php //echo $name ?>"></i></a>
    </div> -->
<?php
// }
?>