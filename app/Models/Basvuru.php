<?php
// app/Models/Basvuru.php

namespace App\Models;

use App\Core\Database; // Database sınıfımızı kullanıyoruz
use PDO;

class Basvuru {
    private $db;

    public function __construct() {
        // Database sınıfından veritabanı bağlantısını alıyoruz.
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Yeni bir başvuruyu veritabanına ekler.
     * @param array $data Formdan gelen veriler ($_POST)
     */
    public function create($data) {
        try {
            $sql = "INSERT INTO basvurular (ad_soyad, email, telefon, universite, bolum, on_yazi, staj_belgesi_yolu) 
                    VALUES (:ad_soyad, :email, :telefon, :universite, :bolum, :on_yazi, :staj_belgesi_yolu)";
            
            $stmt = $this->db->prepare($sql);

            // Tüm parametreleri bir dizi içinde doğrudan execute metoduna gönderiyoruz.
            $stmt->execute([
                ':ad_soyad'           => $data['ad_soyad'],
                ':email'              => $data['email'],
                ':telefon'            => $data['telefon'],
                ':universite'         => $data['universite'],
                ':bolum'              => $data['bolum'],
                ':on_yazi'            => $data['on_yazi'],
                ':staj_belgesi_yolu'  => $data['staj_belgesi_yolu'] ?? null
            ]);
            
            return true;

        } catch (\PDOException $e) {
            // Hata olursa (örn: aynı email ile ikinci kayıt) hatayı yazdır.
            die("Kayıt Hatası: " . $e->getMessage());
        }
    }
    
    
    /**
     * Filtrelere göre tüm başvuruları veritabanından çeker.
     * @param array $filters Arama ve durum filtrelerini içeren dizi.
     */
    public function getAll($filters = []) {
        try {
            // Temel SQL sorgusu
            $sql = "SELECT * FROM basvurular WHERE 1=1";
            $params = []; // Sorguya bağlanacak parametreler

            // Eğer arama filtresi varsa...
            if (!empty($filters['search'])) {
                // DÜZELTME: Parametre isimlerini benzersiz hale getiriyoruz: :search_ad ve :search_email
                $sql .= " AND (ad_soyad LIKE :search_ad OR email LIKE :search_email)";
                
                // DÜZELTME: Her iki parametreye de aynı değeri bağlıyoruz.
                $params[':search_ad'] = '%' . $filters['search'] . '%';
                $params[':search_email'] = '%' . $filters['search'] . '%';
            }

            // Eğer durum filtresi varsa... (Bu kısım aynı, doğru çalışıyor)
            if (!empty($filters['status'])) {
                $sql .= " AND durum = :status";
                $params[':status'] = $filters['status'];
            }
            
            $sql .= " ORDER BY basvuru_tarihi DESC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            
            return $stmt->fetchAll();

        } catch (\PDOException $e) {
            die("Veri Çekme Hatası: " . $e->getMessage());
        }
    }

    public function findById($id) {
        try {
            $sql = "SELECT * FROM basvurular WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            // fetch() -> tek bir satır getirir, fetchAll() -> tüm satırları getirir.
            return $stmt->fetch(); 
        } catch (\PDOException $e) {
            die("Veri Çekme Hatası: " . $e->getMessage());
        }
    }

    public function updateStatus($id, $status) {
        try {
            $sql = "UPDATE basvurular SET durum = :durum WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':durum' => $status,
                ':id'    => $id
            ]);
            return true;
        } catch (\PDOException $e) {
            die("Durum Güncelleme Hatası: " . $e->getMessage());
        }
    }
}