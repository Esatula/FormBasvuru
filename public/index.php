<?php
// public/index.php

require_once '../init.php';

// Yeni bir router nesnesi oluştur
$router = new App\Core\Router();

// Rotaları (URL'leri) tanımla
// Tarayıcıda /public/ adresine gelindiğinde hangi controller'ın hangi metodunun çalışacağını belirtiyoruz.
$router->get('/', ['App\Controllers\HomeController', 'index']);
$router->get('/basvuru', ['App\Controllers\BasvuruController', 'create']);
$router->post('/basvuru', ['App\Controllers\BasvuruController', 'store']);

$router->get('/login', ['App\Controllers\AuthController', 'loginPage']);
$router->post('/login', ['App\Controllers\AuthController', 'handleLogin']);
$router->get('/logout', ['App\Controllers\AuthController', 'logout']);

$router->get('/admin/dashboard', ['App\Controllers\AdminController', 'dashboard']);
$router->get('/admin/basvuru', ['App\Controllers\AdminController', 'showBasvuru']);
$router->post('/admin/basvuru/guncelle', ['App\Controllers\AdminController', 'updateBasvuruStatus']);
$router->post('/admin/basvuru/sil', ['App\Controllers\AdminController', 'deleteBasvuru']);


// // Geçici Admin Dashboard Rotası
// $router->get('/stajyer-basvuru-sistemi/public/admin/dashboard', function() {
//     session_start();
//     if (!isset($_SESSION['is_logged_in'])) {
//         header('Location: /stajyer-basvuru-sistemi/public/login');
//         exit();
//     }
//     echo "<h1>Admin Paneline Hoş Geldiniz, " . htmlspecialchars($_SESSION['user']) . "!</h1>";
//     echo '<a href="/stajyer-basvuru-sistemi/public/logout">Çıkış Yap</a>';
// });

// İsteğin URI ve Metod bilgilerini al
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Router'a isteği gönder, o da doğru controller'ı çalıştırsın
$router->dispatch($uri, $method);