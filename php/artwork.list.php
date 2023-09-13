<?php

$url = 'https://raw.githubusercontent.com/lucidkarn/lucian_solutions/main/fanarts.json';
$json = file_get_contents($url);
$contributors = json_decode($json);

foreach ($contributors as $entry) {
    /* Title */
    if (isset($entry->slug)) {
        echo '<h3 class="h5 my-1 gold-highlight" id="'.strtolower($entry->artist).'"><span itemprop="name">'.$entry->artist.'</span> <small class="lang-thai fs-6" lang="'.$entry->slug_lang.'">'.$entry->slug_lang.'">'.$entry->slug.'</small></h3>';
    } else {
        echo '<h3 class="h5 my-1 gold-highlight" id="'.strtolower($entry->artist).'" itemprop="name">'.$entry->artist.'</h3>';
    }

    /* Container */
    echo '<div class="container-fluid row row-cols-xl-4 row-cols-md-3 row-cols-sm-2 text-center mb-4 mx-auto bg-light pt-4 pb-5">';

    /* Artworks */
    foreach ($entry->art as $artpiece) {
        if ($artpiece->ext == 'gif') {
            echo '<div class="col-4-md col-2-sm align-middle position-relative pt-4"><a href="/images/'.$artpiece->id.'.'.$artpiece->ext.'" data-toggle="lightbox"><txp:image id="'.$artpiece->id.'" class="img-fluid shadow-sm h-100 lucian-showcase square-pix" loading="lazy" /></a></div>';
        } else {
            echo '<div class="col-4-md col-2-sm align-middle position-relative pt-4"><a href="/images/'.$artpiece->id.'.'.$artpiece->ext.'" data-toggle="lightbox"><txp:image id="'.$artpiece->id.'" thumbnail class="img-fluid shadow-sm h-100 lucian-showcase square-pix" loading="lazy" /></a></div>';
        }
    }

    /* End of Container */
    echo '</div><hr class="lucian-divider" />';
}
