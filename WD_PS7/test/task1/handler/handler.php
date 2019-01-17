<?php
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
    header('location: ../public/index.html');
    die();
}

$regEx = [
    'ip' => '/^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]|[0-9])\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]|[0-9])$/',
    'url' => '/^(?:https?:\/\/)[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:\/?#[\]@!\$&\'\(\)\*\+,;=.]+$/i',
    'date' => '/^(?:0[0-9]|1[0-2])\/(?:[0-2][0-9]|3[0-1])\/[0-9]{4}$/',
    'email' => '/^[a-z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?(?:\.[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?)*$/i',
    'time' => '/^(?:[0-1][1-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/'
];

if (isset($_POST['data'])) {
    $validData = [];
    foreach ($_POST['data'] as $key => $val) {
        if (array_key_exists($val['name'], $regEx) && preg_match($regEx[$val['name']], $val['value'])) {
            $validData[$val['name']] = $val['value'];
        } else {
            $validData[$val['name']] = false;
        }
    }
}

echo json_encode($validData);