<?php

/* Badges */
define('badgeLS', '<span class="badge bg-primary text-white">Lucian Solutions</span> ');
define('badgeStream', '<span class="badge bg-danger text-white">Streamer</span> ');
define('badgeOther', ['<span class="badge bg-dark text-white">', '</span> ']);

/* Links Button */
define('iconButton', '<a href="');

/* Socials */
define('iconFB', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-facebook"></i></a>');
define('iconX', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-twitter-x"></i></a>');
define('iconYT', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-youtube"></i></a>');
define('iconGH', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-github"></i></a>');
define('iconFedi', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-mastodon"></i></a>');
define('iconIG', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-instagram"></i></a>');
define('iconTTV', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-twitch"></i></a>');

/* Other Links */
define('iconLink', ['" target="_blank" class="btn btn-outline-dark border-0 btn-sm m-1"><i class="bi bi-link-45deg"></i>', '</a>']);

$url = 'https://raw.githubusercontent.com/lucidkarn/lucian_solutions/main/neighbours.json';
$json = file_get_contents($url);
$neighbours = json_decode($json);

foreach ($neighbours as $neighbour) {
    /* Container */
    echo '<div id="'.preg_replace('/\s+/', '_', strtolower($neighbour->name)).'" class="col-lg-4 col-md-6 text-center my-1 mx-auto h-100">';

    /* Picture */
    echo '<txp:image id="'.$neighbour->picture.'" thumbnail="1" class="img-fluid mx-auto d-block rounded-circle mt-3 shadow" style="height:200px; width: auto;" loading="lazy"/>';

    /* Name */
    echo '<h4 class="my-3">'.$neighbour->name.'</h4>';
    if (isset($neighbour->sub)) {
        echo '<p style="margin-top: -1rem; color: #a0a0a0;" itemprop="name" lang="'.$neighbour->lang.'">'.$neighbour->sub.'</p>';
    }

    /* Badge */

    /* Socials */
    if (isset($neighbour->socials)) {
        echo '<p>';
        if (isset($neighbour->socials->facebook)) {
            echo iconButton.$neighbour->socials->facebook.iconFB;
        }
        if (isset($neighbour->socials->x)) {
            echo iconButton.$neighbour->socials->x.iconX;
        }
    }
}
