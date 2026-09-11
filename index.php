<?php

// --- TEMPORAL PARA DEPURAR ERROR 500 ---
ini_set('display_errors', 1);
error_reporting(E_ALL);

set_error_handler(function($errno, $errstr, $errfile, $errline) {
    header('Content-Type: application/json');
    echo json_encode([
        'error' => "PHP Error [$errno]: $errstr",
        'file'  => basename($errfile),
        'line'  => $errline
    ]);
    exit;
});

// 1. Requerir el gestor global
require_once __DIR__ . '/../plugins/routes.php';

// (Opcional pero recomendado) Fijar la ruta de este index como la base de la app
Routes::setPath(__DIR__);

// 2. Obtener la última versión directamente
$ultima_version = Routes::getVersion("last");

if ($ultima_version) {
    header("Location: " . $ultima_version . "/index.php");
    exit();
} else {
    die("No se encontró ninguna versión disponible.");
}