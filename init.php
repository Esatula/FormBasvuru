<?php
// init.php

session_start(); // OTURUM YÖNETİMİNİ BAŞLAT

// Hata raporlamayı açalım (Geliştirme aşamasında sorunları görmek için çok faydalı)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Türkiye saat dilimini ayarlayalım
date_default_timezone_set('Europe/Istanbul');

// Base URL helper fonksiyonu
function url($path = '') {
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $base = str_replace('\\', '/', dirname($scriptName));
    if ($base === '/' || $base === '.') {
        $base = '';
    }
    $path = '/' . ltrim($path, '/');
    return $base . $path;
}

// İhtiyaç duyacağımız tüm sınıfları ve dosyaları buradan yöneteceğiz.
// Bu liste proje büyüdükçe artacak!

// 1. Ayar dosyamızı dahil edelim
$config = require_once __DIR__ . '/config.php';

// 2. Çekirdek sınıflarımızı dahil edelim (henüz oluşturmadık, birazdan oluşturacağız)
require_once __DIR__ . '/app/Core/Database.php';
require_once __DIR__ . '/app/Core/Router.php';

// 3. Model sınıflarımızı dahil edelim
require_once __DIR__ . '/app/Models/Basvuru.php';

// 4. Controller sınıflarımızı dahil edelim
require_once __DIR__ . '/app/Controllers/BaseController.php';
require_once __DIR__ . '/app/Controllers/HomeController.php'; 
require_once __DIR__ . '/app/Controllers/BasvuruController.php'; 
require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/app/Controllers/AdminController.php';