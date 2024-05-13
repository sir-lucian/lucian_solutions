<?php

$url = 'https://raw.githubusercontent.com/lucidkarn/lucian_solutions/main/json/list.djmax.json';
$json = file_get_contents($url);
$data = json_decode($json);
$blank_cell = '<td class="text-success text-center"></td>';
$checked_cell = '<td class="text-success text-center">&check;</td>';

foreach ($data->charts as $chart) {
    echo '<tr><td>'.$chart->name;
    echo (isset($chart->local_name) && !empty($chart->local_name)) ? ' <small lang="'.$chart->local_lang.'">'.$chart->local_name.'</small></td>' : '</td>';
    echo (in_array(4, $chart->sc)) ? $checked_cell : $blank_cell;
    echo (in_array(5, $chart->sc)) ? $checked_cell : $blank_cell;
    echo (in_array(6, $chart->sc)) ? $checked_cell : $blank_cell;
    echo (in_array(8, $chart->sc)) ? $checked_cell : $blank_cell;
    echo (isset($chart->remarks) && !empty($chart->remarks)) ? '<td>'.$chart->remarks.'</td>' : $blank_cell;
    echo '</tr>';
}
