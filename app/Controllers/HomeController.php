<?php
// app/Controllers/HomeController.php

namespace App\Controllers;

// Artık HomeController, BaseController'ın tüm özelliklerine sahip.
class HomeController extends BaseController {
    
    public function index() {
        // BaseController'dan gelen 'view' metodunu kullanarak
        // 'anasayfa' isimli view dosyasını yükle ve ona veri gönder.
        $this->view('anasayfa', [
            'pageTitle' => 'Ana Sayfa'
        ]);
    }
}