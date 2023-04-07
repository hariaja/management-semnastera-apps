# management-semnastera-apps
Manajemen Seminar Nasional Teknologi dan Riset di Politeknik Sukabumi

Aplikasi ini dibuat untuk memenuhi salah satu syarat kelulusan D3 di Program Studi Teknik Komputer Politeknik Sukabumi

Cara Install:
- Clone projek ini dengan perintah git clone https://github.com/hariaja/management-semnastera-apps.git
* Jalankan semua perintah pada terminal projek dan lakukan secara berurutan

- composer install
- cp .env.example .env
- php artisan key:generate
- npm install
- npm run dev

Kemudian setup database dan hubungkan dengan projek, lalu jalankan perintah
- php artisan migrate:fresh --seed
