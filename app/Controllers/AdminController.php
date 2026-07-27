<?php
// app/Controllers/AdminController.php

namespace App\Controllers;

use App\Models\Basvuru; // Basvuru modelimizi kullanacağız.

class AdminController extends BaseController {

    public function dashboard() {
        // 1. Önce giriş yapmış mı diye kontrol et.
        $this->checkAuth();

        // 2. Formdan gelen filtreleri al (GET metodu ile).
        $filters = [
            'search' => $_GET['search'] ?? '',
            'status' => $_GET['status'] ?? ''
        ];

        // 3. Başvuru modelinden bir nesne oluştur.
        $basvuruModel = new Basvuru();
        
        // 4. Filtreleri modele göndererek ilgili başvuruları al.
        $basvurular = $basvuruModel->getAll($filters);

        // 5. Gelen verileri ve filtreleri view'e göndererek admin panelini göster.
        $this->view('admin/dashboard', [
            'pageTitle'  => 'Admin Paneli',
            'basvurular' => $basvurular,
            'filters'    => $filters // Formun doldurulması için
        ]);
    }

    public function showBasvuru() {
        $this->checkAuth(); // Güvenlik kontrolü

        // URL'den ID'yi al (?id=5 gibi)
        $id = $_GET['id'] ?? null;

        // ID yoksa veya geçerli değilse, panele geri yönlendir.
        if (!$id || !is_numeric($id)) {
            $this->redirect('/admin/dashboard');
        }

        $basvuruModel = new Basvuru();
        $basvuru = $basvuruModel->findById($id);

        // Eğer o ID ile bir başvuru bulunamazsa, yine panele yönlendir.
        if (!$basvuru) {
            $this->redirect('/admin/dashboard');
        }

        $this->view('admin/basvuru-detay', [
            'pageTitle' => 'Başvuru Detayı',
            'basvuru' => $basvuru
        ]);
    }

    public function updateBasvuruStatus() {
        $this->checkAuth(); // Güvenlik kontrolü

        // Formdan gelen ID ve yeni durumu al
        $id = $_POST['id'] ?? null;
        $durum = $_POST['durum'] ?? null;

        // Gerekli bilgiler yoksa veya geçersizse, panele geri yönlendir.
        if (!$id || !$durum || !in_array($durum, ['Onaylandı', 'Reddedildi'])) {
            $this->redirect('/admin/dashboard');
        }

        $basvuruModel = new Basvuru();
        $basvuruModel->updateStatus($id, $durum);

        // İşlem bittikten sonra kullanıcıyı tekrar aynı başvurunun detay sayfasına yönlendir.
        // Bu sayede yaptığı değişikliği hemen görebilir.
        $this->setFlash('success', 'Başvuru durumu başarıyla güncellendi.');
        $this->redirect('/admin/basvuru?id=' . $id);
    }

    public function deleteBasvuru() {
        $this->checkAuth();

        $id = $_POST['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            $this->redirect('/admin/dashboard');
        }

        $basvuruModel = new Basvuru();
        $basvuruModel->delete($id);

        $this->setFlash('success', 'Başvuru kalıcı olarak silindi.');
        $this->redirect('/admin/dashboard');
    }
}