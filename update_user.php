<?php
if (!empty($_POST['username'])) {
    $username = $_POST['username'];
    $usersFile = 'users.json';
    $users = [];

    // Lire les données JSON en toute sécurité
    if (file_exists($usersFile)) {
        $json = file_get_contents($usersFile);
        $users = json_decode($json, true);
        if (!is_array($users)) {
            $users = []; // sécurité si le fichier est cassé
        }
    }

    $users[$username] = time(); // met à jour le timestamp de l'utilisateur

    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
}
