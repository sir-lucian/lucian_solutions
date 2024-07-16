<?php

$url = 'https://raw.githubusercontent.com/sir-lucian/lucian_solutions/main/json/list.djmax.json';
$json = file_get_contents($url);
$data = json_decode($json);
$blank_cell = '<td class="border-0 fw-bold"></td>';
$checked_cell = ['<td class="', ' border-0"></td>'];
$new_badge = ' <span class="badge rounded-pill bg-danger">New</span>';

foreach ($data->charts as $chart) {
    echo '<tr><td class="border-0 fw-bold">'.$chart->name;
    echo (isset($chart->local_name) && !empty($chart->local_name)) ? ' <small lang="'.$chart->local_lang.'" class="text-muted fw-light">'.$chart->local_name.'</small>' : '';
    echo (isset($chart->remarks) && $chart->remarks == 'V Liberty') ? $new_badge : '';
    echo '</td><td class="border-0">'.$chart->pack.'</td>';
    echo (in_array(4, $chart->sc)) ? $checked_cell[0].'bg-success'.$checked_cell[1] : $blank_cell;
    echo (in_array(5, $chart->sc)) ? $checked_cell[0].'bg-primary'.$checked_cell[1] : $blank_cell;
    echo (in_array(6, $chart->sc)) ? $checked_cell[0].'bg-warning'.$checked_cell[1] : $blank_cell;
    echo (in_array(8, $chart->sc)) ? $checked_cell[0].'bg-danger'.$checked_cell[1] : $blank_cell;
    echo (isset($chart->remarks) && !empty($chart->remarks)) ? '<td class="border-0 text-muted fw-light fst-italic">'.$chart->remarks.'</td>' : $blank_cell;
    echo '</tr>';
}
