<?php

define('url', 'https://lucian.solutions/files/drinksmenu.json');

function getDrink($list, $category)
{
    switch ($category) {
        case 1: // Coffee
            $reply = $list->coffee[rand(0, count($list->coffee) - 1)];
            break;
        case 2: // Tea
            $reply = $list->tea[rand(0, count($list->tea) - 1)];
            break;
        case 3: // Juice
            $reply = $list->juice[rand(0, count($list->juice) - 1)];
            break;
        case 4: // Soda
            $reply = $list->soda[rand(0, count($list->soda) - 1)];
            break;
        case 5: // Alcohol
            $reply = $list->alcohol[rand(0, count($list->alcohol) - 1)];
            break;
        default:
            $reply = 'Error: Category is invalid';
    }

    return $reply;
}

$ch = curl_init(url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Content-Type: application/json',
]);
$res = curl_exec($ch);
$drinksList = json_decode($res);
if (curl_errno($ch)) {
    echo 'Error: '.curl_errno($ch).curl_error($ch);
    exit;
}
curl_close($ch);

$partyMode = 0;
$category = 0;
$args = ['', '', ''];

if (isset($_GET['fullarg'])) {
    $fullarg = rawurldecode($_GET['fullarg']);
    $args = explode(' ', $fullarg);
    if (!isset($args[0])) {
        $args[0] = '';
    }
    if (!isset($args[1])) {
        $args[1] = '';
    }
}

if (isset($_GET['args1'])) {
    $args[1] = $_GET['args1'];
}

if (isset($_GET['args2'])) {
    $args[2] = $_GET['args2'];
}

switch ($args[1]) {
    case 'partymode':
        $partyMode = 1;
        break;
    case 'coffee':
        $category = 1;
        break;
    case 'tea':
        $category = 2;
        break;
    case 'juice':
        $category = 3;
        break;
    case 'soda':
        $category = 4;
        break;
    case 'alcohol':
        $category = 5;
        break;
}

switch ($args[2]) {
    case 'partymode':
        $partyMode = 1;
        break;
    case 'coffee':
        $category = 1;
        break;
    case 'tea':
        $category = 2;
        break;
    case 'juice':
        $category = 3;
        break;
    case 'soda':
        $category = 4;
        break;
    case 'alcohol':
        $category = 5;
        break;
}

if ($category == 0) {
    switch ($partyMode) {
        case 0:
            $category = rand(1, 4);
            break;
        case 1:
            $category = rand(1, 5);
            break;
    }
}

echo getDrink($drinksList, $category);
