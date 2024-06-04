<?php

$url = 'https://raw.githubusercontent.com/sir-lucian/lucian_solutions/main/postcard-hny2024.json';
$json = file_get_contents($url);
$postcardList = json_decode($json);

echo '<div class="text-center d-block"><ol class="d-inline-block text-start">';
foreach ($postcardList as $entry) {
    echo '<li><p><i class="bi bi-person-fill mx-2 text-' . $entry->color . '"></i><strong>' . $entry->name . '</strong> <small class="fst-italic">' . $entry->method . '</small></p></li>';
}
echo '</ol></div>';
