<?php

/* Artist List */
echo '<div class="d-flex flex-wrap justify-content-start position-relative">';
$url = 'https://raw.githubusercontent.com/sir-lucian/lucian_solutions/main/json/list.fanart.json';
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
echo '</div>';

/* Artwork List */
echo '<div class="d-flex flex-wrap my-5">';
foreach ($contributors as $entry) {
    $artNumber = 1;
    foreach ($entry->art as $artpiece) {
        echo '<a href="/images/'.$artpiece->id.'.'.$artpiece->ext.'" data-toggle="lightbox"';
        if ($artNumber == 1) {
            echo ' id="'.preg_replace('/\s+/', '_', strtolower($entry->artist)).'"';
        }
        echo ' class="col-xl-2 col-lg-3 col-md-4 col-6 position-relative gallery-pic" data-caption="'.$entry->artist.'" data-gallery="fanarts"><txp:image id="'.$artpiece->id.'" ';
        if ($artpiece->ext != 'gif') {
            echo ' thumbnail ';
        }
        echo ' class="img-fluid h-100 lucian-showcase square-pix ratio ratio-1x1" style="object-fit: cover;" loading="lazy" />';
        echo '<div class="position-absolute top-50 start-50 translate-middle w-100 h-100 img-card-gradient"></div>';
        echo '<div class="bg-dark shadow-sm text-white px-2 py-1 position-absolute bottom-0 end-0 fw-bold rounded-3" style="font-size: 0.8em; translate: -0.5em -0.5em;">'.$entry->artist.'</div>';
        echo '</a>';
        ++$artNumber;
    }
}

echo '</div>';
