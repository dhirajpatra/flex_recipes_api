__Language :__ [English](README.md) | Bahasa Indonesia

# PHP Technical Task
API untuk menyarankan resep makan siang

## Manajemen Waktu
Tidak ada batasan waktu untuk mengerjakan *task* ini. Anda bebas mengatur waktu untuk menyelesaikan *requirement* yang kami minta.

## Penilaian
Kriteria penilaian kami akan memperhatikan hal - hal berikut:
- Bagaimana struktur aplikasinya. 
- *Code quality (Clean code)*.
- Kualitas dari *test* (*Unit test*).
- Pengertian pada masalah.
- Penggunaan `git`.
- Implementasi dan eksekusi akhir.
- *Commits*, ini akan membantu kami untuk mengerti, bagaimana alur kerja dan keputusan anda selama mengerjakan *task* ini.

## User Story
Sebagai *User*, saya ingin melakukan *request* ke *API* yang akan menentukan dari sekumpulan resep, apa yang dapat saya persiapkan untuk makan siang hari ini, berdasarkan bahan - bahan di kulkas saya. Sehingga saya dapat memutuskan apa yang akan saya makan.

__Kriteria Utama__
- Ketika saya melalukan request ke `/lunch` endpoint, saya harus mendapatkan *response* resep dalam bentuk `JSON`, yang dapat saya persiapkan berdasarkan bahan - bahan yang ada di kulkas saya.
- Ketika ada bahan saya, yang sudah melewati tanggal `use-by`, saya harus tidak mendapatkan resep yang mengandung bahan tersebut.
- Ketika ada bahan saya, yang sudah melewati tanggal `best-before`, tetapi masih belum melewatin tanggal `use-by`, resep yang mengandung bahan yang tidak segar, harus terletak pada bagian bawah dari *response*.

__Kriteria Tambahan__
- Aplikasi HARUS memiliki unit / integration tests (contohnya `PHPUnit`).
- Aplikasi HARUS diselesaikan dengan pendekatan `OOP`.
- Aplikasi HARUS sesuai dengan `PSR`.
- Semua dependencies HARUS diinstal melalui `Composer` (tidak perlu untuk commit dependencies, cukup `composer.lock` saja).
- Gunakan `PHP5.6` atau `PHP7`.
- Semua instruksi untuk instalasi, cara build, testing dan menjalankan HARUS tersedia pada file `README.md` yang berada di folder utama aplikasi.

## Framework
Gunakan `Symfony micro framework` (https://symfony.com/doc/current/setup.html) untuk membuat aplikasi API.

## Application Data
Untuk tujuan *task* ini, Aplikasi harus dengan mudah membaca data dari 2 *JSON file* yang kami sediakan. Konten untuk *JSON file* ini dapat anda lihat [disini](src/App/Ingredient/data.json) dan [disini](src/App/Recipe/data.json).
 
## Submission
Aplikasi harus di *commit* ke __public repository__ di `GitHub` or `BitBucket` (`<lastname>-<firstname>-techtask-php`) dan mohon informasikan *link repository* anda kepada kami.

## Bonus
Konfigurasikan sebuah *environment* `Docker`, sehingga dapat melakukan test dan menjalankan aplikasi dengan cepat. Aplikasi harus terinstall dalam satu perintah.
