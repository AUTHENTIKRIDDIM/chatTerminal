<?php
if (file_exists("chat.txt")) {
    echo nl2br(file_get_contents("chat.txt"));
} else {
    echo "Aucun message pour le moment.";
}
