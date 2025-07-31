<?php
$usersFile = 'users.json';
$users = [];

if (file_exists($usersFile)) {
    $json = file_get_contents($usersFile);
    $users = json_decode($json, true);
    if (!is_array($users)) {
        $users = []; // sécurité
    }
}

$now = time();
$activeUsers = [];

foreach ($users as $username => $timestamp) {
    if ($now - $timestamp <= 15) { // actif depuis moins de 15 secondes
        $activeUsers[] = $username;
    }
}

header('Content-Type: application/json');
echo json_encode($activeUsers);
