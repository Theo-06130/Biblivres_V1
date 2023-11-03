<?php


require_once realpath(__DIR__ . '/vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
});

$parts = explode("/", $_SERVER["REQUEST_URI"]);

// gestion des redirections

if ($parts[1] == "home") {
    include("page/home.php");
} elseif ($parts[1] == "livre") {
    include("page/livre.php");
} elseif ($parts[1] == "UpdateDB") {
    include("UpdateDB.php");
} elseif ($parts[1] == "newlivre") {
    include("page/newlivre.php");
} elseif ($parts[1] == "newauteur") {
    include("page/newauteur.php");
} else {
    header("Location: /home");
}


