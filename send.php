<?php
if (!empty($_POST['user']) && !empty($_POST['msg'])) {
    $user = htmlspecialchars($_POST['user']);
    $msg = htmlspecialchars($_POST['msg']);
    $line = date("H:i") . " <b>$user</b>: $msg\n";
    file_put_contents("chat.txt", $line, FILE_APPEND);
}
