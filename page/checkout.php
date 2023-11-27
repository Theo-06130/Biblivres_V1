<?php 

session_start();

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if ($parts[1] != "checkout") {
    header("Location: /home");
}

$database = new Database($_ENV["DB_HOST"], $_ENV["DB_PORT"], $_ENV["DB_DATABASE"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);

$conn = $database->getConnection();


