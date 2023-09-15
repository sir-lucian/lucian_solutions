<?php

$url = 'https://raw.githubusercontent.com/lucidkarn/lucian_solutions/main/fanarts.json';
$json = file_get_contents($url);
$contributors = json_decode($json);

foreach ($contributors as $entry) {
    echo '<div class="col-lg-2 col-md-3 col-sm-4 col-6 p-1"><a href="#'.preg_replace('/\s+/', '_', strtolower($entry->artist)).'" class="artist-list border-0 btn btn-sm btn-outline-dark w-100 h-100 px-2 text-start">';
    echo '<i class="bi bi-person-fill me-2" style="color: #d4af37;"></i>'.$entry->artist;
    if (isset($entry->slug)) {
        echo ' <small lang="'.$entry->slug_lang.'">'.$entry->slug.'</small>';
    }
    echo '</a></div>';
}
