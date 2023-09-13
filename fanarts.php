<?php
$url = 'https://raw.githubusercontent.com/lucidkarn/lucian_solutions/main/fanarts.json';
$json = file_get_contents($url);
$contributors = json_decode($json);

foreach ($contributors as $entry) {/*
    if (array_key_exists('slug', $entry)){
        echo '<a href="#'.strtolower($entry->artist).'" class="btn btn-sm btn-light my-1">'.$entry->artist.' <small lang="'.$entry->slug_lang.'">'.$entry->slug.'</small></a>';
    }
    else {*/
        echo '<a href="#'.strtolower($entry->artist).'" class="btn btn-sm btn-light my-1">'.$entry->artist.'</a>';
    }
?>
