<?php

define('url', 'https://lucian.solutions/files/foodmenu.json');

function getDrink($list, $category)
{
    switch ($category) {
        case 0: // Rice
            $reply = 'ข้าว';
            switch (rand(0, 2)) {
                case 0: // Wok Station
                    switch (rand(0, 1)) {
                        case 0: // With Prefix
                            $reply .= $list->rice->wokstation->prefix[rand(0, count($list->rice->wokstation->prefix) - 1)];
                            $reply .= $list->rice->wokstation->meat[rand(0, count($list->rice->wokstation->meat) - 1)];
                            break;
                        case 1: // With Suffix
                        default:
                            $reply .= $list->rice->wokstation->meat[rand(0, count($list->rice->wokstation->meat) - 1)];
                            $reply .= $list->rice->wokstation->suffix[rand(0, count($list->rice->wokstation->suffix) - 1)];
                    }
                    $reply .= $list->rice->wokstation->toppings[rand(0, count($list->rice->wokstation->toppings) - 1)];
                    break;
                case 1: // Eggs
                    $reply .= $list->rice->eggs->method[rand(0, count($list->rice->eggs->method) - 1)];
                    $reply .= $list->rice->eggs->meat[rand(0, count($list->rice->eggs->meat) - 1)];
                    break;
                case 2: // Others
                default:
                    $reply .= $list->rice->others[rand(0, count($list->rice->others) - 1)];
                    break;
            }
            break;
        case 1: // Noodles
            $reply = 'ก๋วยเตี๋ยว';
            switch (rand(0, 1)) {
                case 0: // Type
                    $reply .= $list->noodles->type[rand(0, count($list->noodles->type) - 1)];
                    break;
                case 1: // Others
                default:
                    $reply = $list->noodles->others[rand(0, count($list->noodles->others) - 1)];
                    break;
            }
            break;
        case 2: // Soup
            $reply = $list->soup[rand(0, count($list->soup) - 1)];
            break;
        case 3: // Others
            $reply = $list->others[rand(0, count($list->others) - 1)];
            break;
        default:
            $reply = 'Error: Category is invalid';
    }

    $pattern = '/w3schools/i';

    if (preg_match($pattern, $reply) && $halal == 1) {
        $reply = getDrink($drinksList, $category, $halal);
    } else {
        return $reply;
    }
}

$ch = curl_init(url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Content-Type: application/json',
]);
$res = curl_exec($ch);
$foodList = json_decode($res);
if (curl_errno($ch)) {
    echo 'Error: '.curl_errno($ch).curl_error($ch);
    exit;
}
curl_close($ch);

$halal = 0;
$category = 0;

if (isset($_GET['halal'])) {
    if ($_GET['halal'] == 1) {
        $halal = 1;
    } else {
        $halal = 0;
    }
} else {
    $halal = 0;
}

if (isset($_GET['category'])) {
    switch ($_GET['category']) {
        case 'rice':
            $category = 0;
            break;
        case 'noodles':
            $category = 1;
            break;
        case 'soup':
            $category = 2;
            break;
        case 'others':
            $category = 3;
            break;
        default:
            $category = rand(0, 3);
    }
} else {
    $category = rand(0, 3);
}

echo getDrink($foodList, $category, $halal);
