<?php

$url = 'https://raw.githubusercontent.com/lucidkarn/lucian_solutions/main/fanarts.json';
$json = file_get_contents($url);
$contributors = json_decode($json);

foreach ($contributors as $entry) {
    echo '<a href="#'.preg_replace('/\s+/', '_', strtolower($entry->artist)).'" class="artist-list btn btn-sm btn-light px-2 m-1">';
    echo '<strong style="color: #d4af37;">#</strong> '.$entry->artist;
    if (isset($entry->slug)) {
        echo ' <small lang="'.$entry->slug_lang.'">'.$entry->slug.'</small>';
    }
    echo '</a>';
}
