<?php

$url = 'https://raw.githubusercontent.com/lucidkarn/lucian_solutions/main/fanarts.json';
$json = file_get_contents($url);
$contributors = json_decode($json);

foreach ($contributors as $entry) {
    if (isset($entry->slug)) {
        echo '<a href="#'.preg_replace('/\s+/', '_', strtolower($entry->artist)).'" class="artist-list btn btn-sm btn-light px-2 m-1">'.$entry->artist.' <small lang="'.$entry->slug_lang.'">'.$entry->slug.'</small></a>';
    } else {
        echo '<a href="#'.preg_replace('/\s+/', '_', strtolower($entry->artist)).'" class="artist-list btn btn-sm btn-light px-2 m-1">'.$entry->artist.'</a>';
    }
}
