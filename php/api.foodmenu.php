<?php

define('url', 'https://api.lucian.solutions/json/foodmenu.json');

function getFood($list, $category, $halal)
{
    switch ($category) {
        case 1: // Rice
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
        case 2: // Noodles
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
        case 3: // Soup
            $reply = $list->soup[rand(0, count($list->soup) - 1)];
            break;
        case 4: // Others
            $reply = $list->others[rand(0, count($list->others) - 1)];
            break;
        default:
            $reply = 'Error: Category is invalid';
    }

    $pattern = '/(หมู)|(แฮม)|(เล้ง)|(ลาบ)|(น้ำตก)/';

    if (preg_match($pattern, $reply) && $halal == 1) {
        $reply = getFood($list, $category, $halal);
    } else {
        return $reply;
    }
}

$ch = curl_init(url);
curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Content-Type: application/json',
]);
$res = curl_exec($ch);
$foodList = json_decode($res);
if (curl_errno($ch)) {
    echo 'Error: '.curl_errno($ch).' '.curl_error($ch).' '.CURL_SSLVERSION_TLSv1_2;
    exit;
}
curl_close($ch);

$halal = 0;
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
    if (!isset($args[2])) {
        $args[2] = '';
    }
}

if (isset($_GET['args1'])) {
    $args[1] = $_GET['args1'];
}

if (isset($_GET['args2'])) {
    $args[2] = $_GET['args2'];
}

switch ($args[1]) {
    case 'halal':
        $halal = 1;
        break;
    case 'rice':
        $category = 1;
        break;
    case 'noodles':
        $category = 2;
        break;
    case 'soup':
        $category = 3;
        break;
    case 'others':
        $category = 4;
        break;
}

switch ($args[2]) {
    case 'halal':
        $halal = 1;
        break;
    case 'rice':
        $category = 1;
        break;
    case 'noodles':
        $category = 2;
        break;
    case 'soup':
        $category = 3;
        break;
    case 'others':
        $category = 4;
        break;
}

if ($category == 0) {
    $category = rand(1, 4);
}
echo getFood($foodList, $category, $halal);
