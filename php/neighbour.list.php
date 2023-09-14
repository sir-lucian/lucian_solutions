<?php

define('iconButton', '<a href="');

define('iconFacebook', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-facebook"></i></a>');
define('iconX', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-twitter-x"></i></a>');
define('iconYouTube', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-youtube"></i></a>');
define('iconGitHub', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-github"></i></a>');
define('iconFediverse', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-mastodon"></i></a>');
define('iconInstagram', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-instagram"></i></a>');
define('iconTwitch', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-twitch"></i></a>');

define('iconLink', '" target="_blank" class="btn btn-outline-dark border-0 btn-sm m-1"><i class="bi bi-link-45deg"></i>');
define('iconLinkEnd', '</a>');

$url = 'https://raw.githubusercontent.com/lucidkarn/lucian_solutions/main/neighbours.json';
$json = file_get_contents($url);
$neighbours = json_decode($json);

foreach ($neighbours as $neighbour) {
    /* Container */
    echo '<div id="'.preg_replace('/\s+/', '_', strtolower($neighbour->name)).'" class="col-lg-4 col-md-6 text-center my-1 mx-auto h-100">';

    /* Picture */
    echo '<txp:image id="'.$neighbour->picture.'" thumbnail="1" class="img-fluid mx-auto d-block rounded-circle mt-3 shadow" style="height:200px; width: auto;" loading="lazy"/>';

    /* Name */
}
