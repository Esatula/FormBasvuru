<?php
// app/Controllers/BasvuruController.php

namespace App\Controllers;

use App\Models\Basvuru; // Basvuru modelini kullanacağımızı belirtiyoruz.

class BasvuruController extends BaseController {
    
    /**
     * Boş başvuru formunu gösterir. (GET isteği için)
     */
    public function create() {
        $this->view('basvuru-formu', [
            'pageTitle' => 'Yeni Başvuru'
        ]);
    }

    /**
     * Formdan gelen verileri veritabanına kaydeder. (POST isteği için)
     */
    
    public function store() {
        $data = $_POST;
        $errors = []; // Hata mesajlarını tutacak boş bir dizi oluştur.

        // --- DOĞRULAMA (VALIDATION) BAŞLANGICI ---

        // 1. Ad Soyad kontrolü: Boş olmamalı.
        if (empty(trim($data['ad_soyad']))) {
            $errors['ad_soyad'] = 'Ad Soyad alanı zorunludur.';
        }

        // 2. E-posta kontrolü: Boş olmamalı ve geçerli bir formatta olmalı.
        if (empty(trim($data['email']))) {
            $errors['email'] = 'E-posta alanı zorunludur.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Lütfen geçerli bir e-posta adresi girin.';
        }
        
        // Buraya başka doğrulamalar da eklenebilir...

        // --- DOĞRULAMA BİTİŞİ ---

        // Eğer herhangi bir hata varsa...
        if (!empty($errors)) {
            // Formu, hata mesajları ve kullanıcının girdiği eski verilerle birlikte tekrar göster.
            $this->view('basvuru-formu', [
                'pageTitle' => 'Yeni Başvuru',
                'errors' => $errors,
                'old' => $data
            ]);
            return; // Fonksiyonun devam etmesini engelle.
        }

        // --- Eğer hata yoksa, bildiğimiz işlemlere devam et ---

        $belgeYolu = null;

        if (isset($_FILES['staj_belgesi']) && $_FILES['staj_belgesi']['error'] !== UPLOAD_ERR_NO_FILE) {
            // ... (Dosya yükleme kodunun tamamı burada aynı kalacak) ...
            $file = $_FILES['staj_belgesi'];
            if ($file['error'] === UPLOAD_ERR_OK) {
                $maxFileSize = 2 * 1024 * 1024;
                if ($file['size'] > $maxFileSize) { die("Hata: Dosya boyutu 2MB'den büyük olamaz."); }
                $allowedFileType = 'application/pdf';
                $fileType = mime_content_type($file['tmp_name']);
                if ($fileType !== $allowedFileType) { die("Hata: Sadece PDF formatında dosya yükleyebilirsiniz."); }
                $dosyaAdi = uniqid() . '_' . basename($file['name']);
                $hedefKlasor = __DIR__ . '/../../uploads/';
                $belgeYolu = 'uploads/' . $dosyaAdi;
                if (!move_uploaded_file($file['tmp_name'], $hedefKlasor . $dosyaAdi)) { die("Hata: Dosya yüklenirken bir sorun oluştu."); }
            } else {
                die("Dosya yükleme hatası: Hata kodu " . $file['error']);
            }
        }

        $kayitVerisi = $data;
        $kayitVerisi['staj_belgesi_yolu'] = $belgeYolu;

        $basvuruModel = new Basvuru();
        $basvuruModel->create($kayitVerisi);

        $this->setFlash('success', 'Başvurunuz başarıyla alınmıştır. Teşekkür ederiz!');
        $this->redirect('/');
    }
}