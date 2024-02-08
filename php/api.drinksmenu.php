<?php

define('url', 'https://lucian.solutions/files/drinksmenu.json');

function getDrink($list, $category)
{
    switch ($category) {
        case 0: // Coffee
            $reply = $list->coffee[rand(0, count($list->coffee) - 1)];
            break;
        case 1: // Tea
            $reply = $list->tea[rand(0, count($list->tea) - 1)];
            break;
        case 2: // Juice
            $reply = $list->juice[rand(0, count($list->juice) - 1)];
            break;
        case 3: // Soda
            $reply = $list->soda[rand(0, count($list->soda) - 1)];
            break;
        case 4: // Alcohol
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

if (isset($_GET['partymode'])) {
    if ($_GET['partymode'] == 1) {
        $partyMode = 1;
    } else {
        $partyMode = 0;
    }
} else {
    $partyMode = 0;
}

if (isset($_GET['category'])) {
    switch ($_GET['category']) {
        case 'coffee':
            $category = 0;
            break;
        case 'tea':
            $category = 1;
            break;
        case 'juice':
            $category = 2;
            break;
        case 'soda':
            $category = 3;
            break;
        case 'alcohol':
            $category = 4;
            break;
        default:
            if ($partyMode == 1) {
                $category = rand(0, 4);
            } else {
                $category = rand(0, 3);
            }
    }
} else {
    if ($partyMode == 1) {
        $category = rand(0, 4);
    } else {
        $category = rand(0, 3);
    }
}

echo getDrink($drinksList, $category);
