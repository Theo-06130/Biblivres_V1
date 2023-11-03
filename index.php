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
} elseif ($parts[1] == "uploadFile") {
    include("page/uploadFile.php");
} elseif ($parts[1] == "newauthor") {
    include("page/auteur.php");
} else {
    header("Location: /home");
}


