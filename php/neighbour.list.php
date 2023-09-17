<?php

/* Badges */
define('badgeLS', '<span class="badge bg-warning text-dark">Lucian Solutions</span> ');
define('badgeStream', '<span class="badge bg-danger text-white">Streamer</span> ');
define('badgeOther', ['<span class="badge bg-dark text-white">', '</span> ']);

/* Links Button */
define('iconButton', '<a href="');

/* Socials */
define('iconFB', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-facebook fs-5"></i></a>');
define('iconX', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-twitter fs-5"></i></a>');
define('iconYT', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-youtube fs-5"></i></a>');
define('iconGH', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-github fs-5"></i></a>');
define('iconFedi', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-mastodon fs-5"></i></a>');
define('iconIG', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-instagram fs-5"></i></a>');
define('iconTTV', '" target="_blank" class="btn btn-outline-dark border-0 m-1"><i class="bi bi-twitch fs-5"></i></a>');

/* Other Links */
define('iconLink', ['" target="_blank" class="btn btn-outline-dark border-0 btn-sm m-1"><i class="bi bi-link-45deg me-2"></i>', '</a>']);

$url = 'https://raw.githubusercontent.com/lucidkarn/lucian_solutions/main/neighbours.json';
$json = file_get_contents($url);
$neighbours = json_decode($json);

foreach ($neighbours as $neighbour) {
    /* Container */
    echo '<div class="col-lg-4 col-md-6">';
    echo '<div id="'.preg_replace('/\s+/', '_', strtolower($neighbour->name)).'" class="mb-1 p-1 bg-light rounded-3 shadow-sm text-center position-relative" style="margin-top: 100px; height: calc(100% - 100px);">';

    /* Picture */
    echo '<txp:image id="'.$neighbour->picture.'" thumbnail class="img-fluid d-block rounded-circle shadow-sm position-absolute translate-middle start-50 bg-white" style="height:150px; width: auto;" loading="lazy"/>';

    /* Name */
    echo '<div style="padding-top: 100px;"><h4 class="mb-3">'.$neighbour->name.'</h4>';
    if (isset($neighbour->sub)) {
        echo '<p style="margin-top: -1rem; color: #a0a0a0;" itemprop="name" lang="'.$neighbour->lang.'">'.$neighbour->sub.'</p>';
    }

    /* Badge */
    if (isset($neighbour->badges)) {
        echo '<p>';
        $badgeField = '';
        foreach ($neighbour->badges as $badge) {
            if ($badge == 'Lucian Solutions') {
                $badgeField .= badgeLS;
            } elseif ($badge == 'Streamer') {
                $badgeField .= badgeStream;
            } else {
                $badgeField .= badgeOther[0].$badge.badgeOther[1];
            }
        }
        echo rtrim($badgeField).'</p>';
    }

    /* Socials */
    if (isset($neighbour->socials)) {
        echo '<div class="fs-5">';
        if (isset($neighbour->socials->facebook)) {
            echo iconButton.$neighbour->socials->facebook.iconFB;
        }
        if (isset($neighbour->socials->instagram)) {
            echo iconButton.$neighbour->socials->instagram.iconIG;
        }
        if (isset($neighbour->socials->x)) {
            echo iconButton.$neighbour->socials->x.iconX;
        }
        if (isset($neighbour->socials->fedi)) {
            echo iconButton.$neighbour->socials->fedi.iconFedi;
        }
        if (isset($neighbour->socials->youtube)) {
            echo iconButton.$neighbour->socials->youtube.iconYT;
        }
        if (isset($neighbour->socials->twitch)) {
            echo iconButton.$neighbour->socials->twitch.iconTTV;
        }
        if (isset($neighbour->socials->github)) {
            echo iconButton.$neighbour->socials->github.iconGH;
        }
        echo '</div>';
    }

    /* Links */
    if (isset($neighbour->links)) {
        echo '<div>';
        foreach ($neighbour->links as $link) {
            echo iconButton.$link->url.iconLink[0].$link->title.iconLink[1];
        }
        echo '</div>';
    }

    echo '</div></div></div>';
}
