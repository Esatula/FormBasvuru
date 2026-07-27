# 🎓 Stajyer Başvuru Sistemi (FormBasvuru)

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/License-MIT-green.style=for-the-badge)](LICENSE)

Stajyer Başvuru Sistemi, şirket ve kurumların stajyer alım süreçlerini uçtan uca dijitalleştirmek, başvuruları düzenli bir şekilde toplamak ve yönetim ekibinin başvuruları hızlıca değerlendirmesini sağlamak amacıyla geliştirilmiş modern ve sade bir web uygulamasıdır.

Herhangi bir ağır framework bağımlılığı olmadan **Saf PHP (Pure PHP)** ile **MVC (Model-View-Controller)** mimarisi temel alınarak sıfırdan geliştirilmiştir.

---

## 📌 Nedir? (Proje Hakkında)

Bu sistem, stajyer adaylarının online olarak bilgilerini girmelerine, özgeçmiş/ön yazı eklemelerine ve onaylı **zorunlu staj belgelerini (PDF)** sisteme yüklemelerine olanak tanır. 

Yönetici tarafında ise gelişmiş bir **Dashboard (Yönetim Paneli)** yer alır. Yönetici ekibi, gelen başvuruları anlık istatistikler eşliğinde inceleyebilir, arama/filtreleme yapabilir, adayın yüklediği PDF belgesini görüntüleyebilir ve başvuruyu tek tıkla **"Onayla"** veya **"Reddet"** olarak güncelleyebilir.

---

## ✨ Öne Çıkan Özellikler

### 👨‍🎓 Aday Arayüzü (Stajyer Adayı)
- **Modern & Sadeliği Koruyan Tasarım:** Kullanıcıyı yormayan, anlaşılır ve responsive (mobil uyumlu) form düzeni.
- **Kişisel & Eğitim Bilgileri:** Ad-soyad, iletişim, üniversite ve bölüm bilgilerinin eksiksiz alınması.
- **Ön Yazı Alanı:** Adayların kendilerini ve staj hedeflerini ifade edebilecekleri metin alanı.
- **Güvenli PDF Yükleme:** Zorunlu staj belgesinin yalnızca PDF formatında güvenli bir şekilde sunucuya yüklenmesi.

### 🛡️ Yönetici Paneli (Admin & İK)
- **Güvenli Oturum Yönetimi:** Şifre korumalı yetkili girişi.
- **Canlı İstatistik Kartları:** Toplam başvuru, Bekleyenler, Onaylananlar ve Reddedilenler sayılarını anlık gösteren gösterge paneli.
- **Gelişmiş Arama & Filtreleme:** Aday ismi, e-posta adresi veya başvuru durumuna göre saniyeler içinde arama yapma.
- **Detaylı Aday Sayfası:** Adayın tüm iletişim bilgileri, ön yazısı ve yüklediği PDF belgesinin tarayıcıda önizlenmesi/indirilmesi.
- **Hızlı Durum Güncelleme:** Başvuruyu tek tıkla onaylama veya reddetme imkanı.

---

## 📖 Kullanım Kılavuzu

### 1. Aday Başvurusu Yapma
1. Ana sayfadaki **"Hemen Başvuru Yap"** butonuna veya üst menüdeki **"Başvuru Yap"** bağlantısına tıklayın.
2. Açılan formda istenen kişisel bilgileri (Ad Soyad, E-posta, Telefon vb.) doldurun.
3. Varsa onaylı **Zorunlu Staj Belgenizi (.pdf)** dosyası seçerek form üzerinden yükleyin.
4. **"Başvurumu Gönder"** butonuna tıklayarak başvurunuzu tamamlayın.

### 2. Yönetici Paneline Giriş ve Yönetim
1. Üst navigasyon çubuğunda yer alan **"Admin Girişi"** butonuna tıklayın.
2. Yönetici bilgileri ile oturum açın:
   - **Kullanıcı Adı:** `admin`
   - **Şifre:** `quaresma7`
3. Giriş yaptıktan sonra açılan **Yönetim Paneli (Dashboard)** üzerinden:
   - Üstteki özet kartlardan başvuru durum istatistiklerini takip edebilirsiniz.
   - Arama kutusuna ad veya e-posta girerek spesifik bir adayı bulabilirsiniz.
   - Durum filtresinden sadece *Bekleyen*, *Onaylanan* veya *Reddedilen* başvuruları listeleyebilirsiniz.
   - **"İncele"** butonuna tıklayarak adayın başvuru detay sayfasına gidebilir, yüklenen PDF belgesini inceleyebilir ve **"Onayla"** / **"Reddet"** butonları ile durumu güncelleyebilirsiniz.

---

## 🛠️ Teknolojik Yapı & Mimari

- **Backend:** PHP 8.x (Pure PHP, MVC Yapısı)
- **Frontend:** HTML5, CSS3, Google Fonts (*Plus Jakarta Sans*), Bootstrap 5, Bootstrap Icons
- **Veritabanı:** SQLite / MySQL (PDO veritabanı sürücüsü)
- **Mimari:** Custom Front-Controller (`public/index.php`) & Light-weight Router

---

## 🚀 Kurulum ve Çalıştırma

### Gereksinimler
- PHP 8.0 veya üzeri
- Apache / Nginx web sunucusu (Veya PHP dahili web sunucusu)
- PDO & SQLite/MySQL PHP eklentileri

### Adım Adım Kurulum

1. **Projeyi Klonlayın:**
   ```bash
   git clone https://github.com/Esatula/FormBasvuru.git
   cd FormBasvuru
   ```

2. **Dahili PHP Sunucusu ile Çalıştırma (En Hızlı Yöntem):**
   ```bash
   php -S localhost:8000 -t public
   ```
   Ardından tarayıcınızda `http://localhost:8000` adresine gidin.

3. **XAMPP / WAMP İle Çalıştırma:**
   - Proje klasörünü `xampp/htdocs/` içerisine kopyalayın.
   - Tarayıcınızda `http://localhost/FormBasvuru/public/` adresini açın.

---

## 📂 Proje Dizin Yapısı

```
FormBasvuru/
├── app/
│   ├── Controllers/      # İstekleri karşılayan Controller sınıfları
│   ├── Core/             # Router, Database vb. çekirdek sınıflar
│   ├── Models/           # Veritabanı modelleri (Basvuru.php)
│   └── Views/            # Şablon ve arayüz dosyaları
│       ├── admin/        # Dashboard ve başvuru detay görünümleri
│       └── partials/     # Header ve footer bileşenleri
├── database/             # Veritabanı dosyaları (SQLite)
├── public/               # Dışarıya açık kök dizin
│   ├── css/              # Özel CSS tasarım dosyası (style.css)
│   ├── .htaccess         # URL rewrite kuralları
│   └── index.php         # Ana giriş dosyası (Front Controller)
├── uploads/              # Adayların yüklediği PDF belgeleri
├── config.php            # Veritabanı ve genel konfigürasyon
├── init.php              # Uygulama başlatıcı
└── README.md             # Kullanım kılavuzu ve dokümantasyon
```

---

## 📄 Lisans

Bu proje [MIT Lisansı](LICENSE) altında korunmaktadır.
