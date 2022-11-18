<?php

$localhost = "127.0.0.1";
$user = "root";
$pass = "";
$db_name = "BE17_CR5_animal_adoption_wahida";

// check connection
try {
    $connect = mysqli_connect($localhost, $user, $pass, $db_name);
    // echo "Connected";
} catch (Exception $e) {
    echo "Failed to connect: " . mysqli_connect_error();
}
