# Website CariFreelance

Website **CariFreelance** adalah platform berbasis web yang mempertemukan **Client** dan **Freelancer**. Aplikasi ini dibuat menggunakan **Laravel** dengan sistem **multi-role** dan alur registrasi bertahap.

## Tujuan Aplikasi

* Menyediakan platform pencarian freelancer seperti Fiverr
* Menerapkan konsep **multi-role user** (Client & Freelancer)
* Mengimplementasikan alur **registrasi modern berbasis Google**
* Melatih penggunaan Laravel MVC, autentikasi, dan relasi database

## Teknologi yang Digunakan

* Laravel
* Blade Template
* MySQL
* Laravel Authentication
* MVC Architecture

## Role Pengguna

Aplikasi memiliki tiga peran utama:

1. **Client**

   * Memposting proyek
   * Memilih freelancer berdasarkan proposal
   * Memantau progress pengerjaan
   * Berkomunikasi dengan freelancer melalui fitur chat
   * Mengajukan pembatalan jika terjadi masalah

2. **Freelancer**

   * Melihat daftar proyek yang tersedia
   * Mengajukan proposal pada proyek client
   * Mengerjakan proyek dan mengupdate progress
   * Berkomunikasi langsung dengan client melalui chat

3. **Admin**

   * Mengontrol seluruh data aplikasi
   * Mengelola user, proyek, dan transaksi
   * Menangani laporan dan pembatalan proyek
   * Menjaga sistem agar tetap aman dan terpercaya

Role disimpan di tabel `users` dan digunakan untuk menentukan hak akses dashboard.

## Alur Kerja Aplikasi

### Registrasi Akun

* User melakukan pendaftaran menggunakan akun Google
* Sistem menyimpan data dasar user ke tabel `users`
* User diwajibkan memilih role sebelum dapat melanjutkan

### Pengisian Profil

* Setelah memilih role, user mengisi profil sesuai perannya
* Data profil disimpan di tabel terpisah:

  * `client_profiles`
  * `freelancer_profiles`
* Kedua tabel memiliki foreign key ke tabel `users`

### Proyek dan Proposal

* Client membuat proyek dan menyimpannya ke tabel `projects`
* Freelancer melihat proyek yang tersedia
* Freelancer mengajukan proposal yang disimpan di tabel `proposals`
* Client memilih proposal yang sesuai untuk memulai proyek

### Progress dan Pemantauan

* Freelancer mengirim update progress pengerjaan
* Data progress disimpan di tabel `project_progress`
* Client dapat memantau progress secara real-time
* Client dapat mengajukan pembatalan jika proyek bermasalah

### Chat Client & Freelancer

* Client dan freelancer dapat berkomunikasi melalui fitur chat
* Pesan disimpan di tabel `messages`
* Chat hanya dapat diakses oleh pihak yang terlibat dalam proyek

### Fitur Tambahan

* **Pencarian (Search)**

  * User dapat mencari proyek atau freelancer berdasarkan kata kunci
  * Pencarian dilakukan melalui query ke database menggunakan Eloquent
  * Fitur ini memanfaatkan parameter request dan query builder Laravel agar hasil lebih relevan

* **Saldo & Transaksi Internal**

  * Sistem memiliki saldo internal yang tersimpan di database aplikasi
  * Client melakukan pembayaran ke sistem, lalu saldo ditahan oleh platform
  * Saldo akan diteruskan ke freelancer setelah proyek selesai
  * Semua transaksi tercatat untuk keamanan dan transparansi

* **Notifikasi yang jelas**

  * Sistem mengirim notifikasi apabila terdapat interaksi antara client dan freelancer, misalnya ketika menerima pesan atau terdapat freelancer yang mengajukan prfoposal, dan sebagainya.

## Penjelasan Cara Kerja Kode

### Struktur MVC

* **Model**

  * `User` mengelola data user dan role
  * `ClientProfile` dan `FreelancerProfile` mengelola data profil
  * `Project`, `Proposal`, `ProjectProgress`, dan `Message` mengelola data utama aplikasi

* **Controller**

  * `AuthController` menangani proses registrasi dan login
  * `Client` controller mengelola proyek dan pemantauan
  * `Freelancer` controller mengelola proposal dan progress
  * `Admin` controller mengelola seluruh data sistem

* **View**

  * Menggunakan Blade Template
  * Tampilan dashboard dibedakan berdasarkan role

### Routing

* Route dipisahkan berdasarkan role menggunakan group route
* Middleware digunakan untuk membatasi akses

### Middleware & Keamanan

* `auth` memastikan user sudah login
* `role` middleware membatasi akses berdasarkan role
* Validasi request digunakan pada setiap form input

## Kelebihan Sistem

* Sistem multi-role yang jelas
* Alur kerja proyek mendekati aplikasi freelance nyata
* Pemantauan progress proyek
* Fitur chat internal
* Sistem dikontrol oleh admin untuk menjaga kepercayaan

