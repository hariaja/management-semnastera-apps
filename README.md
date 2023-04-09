# Seminar Nasional Teknologi dan Riset
Manajemen Seminar Nasional Teknologi dan Riset di Politeknik Sukabumi

### Cara Install:
- Clone projek ini dengan perintah git clone https://github.com/hariaja/management-semnastera-apps.git
* Jalankan semua perintah pada terminal projek dan lakukan secara berurutan

```
composer install
```

```
cp .env.example .env
```

```
php artisan key:generate
```

```
npm install
```

```
npm run dev
```

Kemudian setup database dan hubungkan dengan projek, lalu jalankan perintah
```
php artisan migrate:fresh --seed
```
Jalankan serve dengan:
```
php artisan serve
```

Jika ketika menjalankan projek ada gambar yang tidak muncul, cukup jalankan perintah
```
php artisan storage:link
```

### Note:
- Memiliki PHP versi 8.0 ke atas
- Memiliki node JS yang sudah terinstall di local
- Pastikan sudah menginstall composer terbaru atau minimal versi 2.4.1
- Projek ini dibuat dan dibangun menggunakan Laravel versi 10.6.2 documentation: https://laravel.com/docs/10.x