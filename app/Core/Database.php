<?php
// app/Core/Database.php

namespace App\Core;

// PHP'nin veritabanı işlemleri için kullandığı PDO sınıfını kullanacağımızı belirtiyoruz.
use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $config = require __DIR__ . '/../../config.php';
        $db_config = $config['database'];

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        // 1. Öncelikli olarak MySQL bağlantısını dene
        try {
            $dsn = "mysql:host={$db_config['host']};port={$db_config['port']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
            $this->pdo = new PDO($dsn, $db_config['user'], $db_config['password'], $options);
            return;
        } catch (PDOException $e) {
            // MySQL bağlantısı başarısız olursa SQLite yedeğine geç
        }

        // 2. SQLite Fallback (MySQL çalışmıyorsa yerel SQLite veritabanını kullan)
        try {
            $sqlitePath = $db_config['sqlite_path'];
            $dbDir = dirname($sqlitePath);
            if (!is_dir($dbDir)) {
                mkdir($dbDir, 0777, true);
            }

            $this->pdo = new PDO("sqlite:" . $sqlitePath, null, null, $options);
            $this->initSqliteTables();
        } catch (PDOException $e) {
            die("Veritabanı bağlantısı kurulamadı: " . $e->getMessage());
        }
    }

    private function initSqliteTables() {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS basvurular (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                ad_soyad TEXT NOT NULL,
                email TEXT NOT NULL UNIQUE,
                telefon TEXT DEFAULT NULL,
                universite TEXT DEFAULT NULL,
                bolum TEXT DEFAULT NULL,
                on_yazi TEXT DEFAULT NULL,
                staj_belgesi_yolu TEXT DEFAULT NULL,
                durum TEXT NOT NULL DEFAULT 'Bekliyor',
                basvuru_tarihi DATETIME DEFAULT CURRENT_TIMESTAMP
            );

            CREATE TABLE IF NOT EXISTS yoneticiler (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                ldap_kullanici_adi TEXT NOT NULL UNIQUE,
                ad_soyad TEXT NOT NULL,
                rol TEXT NOT NULL DEFAULT 'Yonetici',
                son_giris_tarihi DATETIME DEFAULT NULL
            );
        ");
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}