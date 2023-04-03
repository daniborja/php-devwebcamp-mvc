<?php

$db = mysqli_connect(
    $_ENV['DB_HOST'] ?? '',
    $_ENV['DB_USER'] ?? '',
    $_ENV['DB_PASSWORD'] ?? '',
    $_ENV['DB_NAME'] ?? ''
);

if (!$db) {
    echo "Error: Error connecting to MySQL";
    echo "debugging error no:" . mysqli_connect_errno();
    echo "debugging error: " . mysqli_connect_error();
    exit;
}
