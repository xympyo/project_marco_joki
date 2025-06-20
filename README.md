<h1>Aplikasi Laundry Sepatu Profesional</h1>
<h2>Selamat datang di repositori Aplikasi Laundry Sepatu Profesional! Aplikasi web ini dibangun menggunakan Laravel dan dirancang untuk mengelola layanan laundry sepatu, dengan dua jenis pengguna utama: Pengguna Biasa dan Administrator.</h2>

<h1>Deskripsi Aplikasi</h1>
<h2>Aplikasi ini menyediakan platform sederhana untuk:</h2>
<ol>
    <li>
        <h3>Pengguna Biasa: Melihat daftar layanan laundry sepatu, mendaftar, login, dan logout.</h3>
    </li>
    <li>
        <h3>Administrator: Login ke panel admin untuk menambah dan menghapus layanan laundry sepatu yang ditampilkan di halaman utama.</h3>
    </li>
</ol>

<h1>Tujuan utama dari aplikasi ini adalah untuk mendemonstrasikan alur otentikasi (login/logout) untuk berbagai peran pengguna, serta dasar-dasar manajemen konten (CRUD sederhana).</h1>

<h1>Fitur Utama</h1>
<ol>
    <li>
        <h2>
            Halaman Utama (Landing Page): Menampilkan daftar layanan laundry sepatu yang tersedia (dikelola oleh admin).
        </h2>
    </li>
    <li>
        <h2>
            Otentikasi Pengguna:
        </h2>
        <ol>
            <li>
                <h3>
                    Pendaftaran pengguna biasa.
                </h3>
            </li>
            <li>
                <h3>
                    Login pengguna biasa.
                </h3>
            </li>
            <li>
                <h3>
                    Logout pengguna biasa.
                </h3>
            </li>
        </ol>
    </li>
    <li>
        <h2>
            Panel Admin:
        </h2>
        <ol>
            <li>
                <h3>
                    Login admin khusus.
                </h3>
            </li>
            <li>
                <h3>
                    Dasbor admin untuk menambah layanan baru (judul, deskripsi, gambar, harga, hari pengerjaan).
                </h3>
            </li>
            <li>
                <h3>
                    Menghapus layanan yang sudah ada.
                </h3>
            </li>
            <li>
                <h3>
                    Logout admin.
                </h3>
            </li>
            <li>
                <h3>
                    Manajemen Gambar: Upload gambar layanan langsung ke penyimpanan Laravel (Laravel Storage).
                </h3>
            </li>
            <li>
                <h3>
                    Sesi Non-Permanen: Sesi pengguna (baik admin maupun biasa) akan otomatis di-logout setelah navigasi ke halaman lain. Ini sengaja dirancang untuk mendemonstrasikan alur login/logout berulang kali.
                </h3>
            </li>
        </ol>
    </li>
</ol>

<h1>Persyaratan Sistem</h1>
<h2>Untuk menjalankan aplikasi ini di komputer Anda, pastikan Anda memiliki perangkat lunak berikut terinstal:</h2>
<ol>
    <li>
        <h3>
            PHP: Versi 8.2 atau lebih tinggi (Laravel 12).
        </h3>
    </li>
    <li>
        <h3>
           Composer: Manajer dependensi PHP.
        </h3>
    </li>
    <li>
        <h3>
            Node.js & NPM: Dibutuhkan untuk mengompilasi aset front-end (CSS/JS).
        </h3>
    </li>
    <li>
        <h3>
            Database: MySQL, PostgreSQL, SQLite, atau SQL Server. (Contoh ini menggunakan MySQL/MariaDB yang biasa disediakan oleh Laragon/XAMPP/WAMP).
        </h3>
    </li>
    <li>
        <h3>
            Web Server: Apache, Nginx, atau PHP Built-in Server (php artisan serve).
        </h3>
    </li>
</ol>

<h1>Panduan Instalasi</h1>
<h2>Ikuti langkah-langkah di bawah ini untuk menginstal dan menjalankan aplikasi di komputer Anda.</h2>
<ol>
    <li>
        <h3>Clone Repositori:</h3>
        <ol>
            <li>
                <h3>Buka terminal atau Git Bash, lalu clone repositori aplikasi ini:</h3>
            </li>
            <ol>
                <li>
                    <h4>git clone <URL_REPOSITORI_ANDA></h4>
                </li>
                <li>
                    <h4>cd <NAMA_FOLDER_PROYEK></h4>
                </li>
            </ol>
        </ol>
    </li>
    <li>
        <h3>Instal Dependensi Composer:</h3>
        <ol>
            <li>
                <h4>Di dalam direktori proyek Anda, jalankan perintah ini untuk menginstal semua dependensi PHP:</h4>
            </li>
            <li>
                <h4>composer install</h4>
            </li>
        </ol>
    </li>
    <li>
        <h3>Instal Dependensi Node.js & Kompilasi Aset:</h3>
        <ol>
            <li>
                <h4>npm install</h4>
            </li>
            <li>
                <h4>npm run dev</h4>
            </li>
        </ol>
    </li>
    <li>
        <h3>Konfigurasi Environment (.env):</h3>
        <ol>
            <li>
                <h4>Salin file .env.example menjadi .env:</h4>
            </li>
            <li>
                <h4>cp .env.example .env</h4>
            </li>
            <li>
                <h4>(Di Windows, gunakan copy .env.example .env)</h4>
            </li>
            <li>
                <h4>Buka file .env dan konfigurasikan detail database Anda:</h4>
                <ol>
                    <li>
                        <h4>
                            APP_NAME="Shoe Laundry"
                            APP_ENV=local
                            APP_KEY=
                            APP_DEBUG=true
                            APP_URL=http://127.0.0.1:8000 # Pastikan ini sesuai dengan URL server lokal Anda
                            DB_CONNECTION=mysql
                            DB_HOST=127.0.0.1
                            DB_PORT=3306
                            DB_DATABASE=laravel_shoe_laundry # Ubah sesuai nama database Anda
                            DB_USERNAME=root # Ubah sesuai username database Anda
                            DB_PASSWORD= # Ubah sesuai password database Anda
                        </h4>
                    </li>
                </ol>
            </li>
        </ol>
    </li>
    <li>
        <h3>Generate Application Key:</h3>
        <ol>
            <li>
                <h4>Jalankan perintah ini untuk membuat kunci aplikasi yang aman:</h4>
            </li>
            <li>
                <h4>php artisan key:generate</h4>
            </li>
        </ol>
    </li>
    <li>
        <h3>Jalankan Migrasi Database:</h3>
        <ol>
            <li>
                <h4>php artisan migrate:fresh --seed</h4>
            </li>
        </ol>
    </li>
    <li>
        <h3>Jalankan Database Seeder (untuk membuat admin awal):</h3>
        <ol>
            <li>
                <h4>php artisan db:seed --class=AdminSeeder</h4>
                <ol>
                    <li>
                        <h4>
                            Kredensial Admin Default:
                        </h4>
                        <ol>
                            <li>
                                <h4>
                                    Email: admin@example.com
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    Password: password
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    PENTING: Ubah kredensial ini segera setelah instalasi untuk lingkungan produksi!
                                </h4>
                            </li>
                        </ol>
                    </li>
                </ol>
            </li>
        </ol>
    </li>
    <li>
        <h3>Buat Symbolic Link Storage:</h3>
        <ol>
            <li>
                <h4>Ini sangat penting agar gambar yang diupload dapat diakses secara publik oleh web server. Jalankan perintah ini (pastikan terminal Anda dijalankan sebagai Administrator di Windows):</h4>
            </li>
            <li>
                <h4>php artisan storage:link</h4>
            </li>
            <li>
                <h4>Pastikan Anda melihat pesan sukses seperti: "The [public/storage] link has been connected..."</h4>
            </li>
            <li>
                <h4>Secara visual, pastikan ada ikon shortcut/panah pada folder public/storage yang baru dibuat, mengarah ke ../storage/app/public."</h4>
            </li>
        </ol>
    </li>
    <li>
        <h3>Setel Perizinan Folder (Opsional, tapi Penting jika ada error 403): Jika Anda mengalami error 403 Forbidden saat mengakses gambar, ini berarti web server tidak memiliki izin yang cukup untuk membaca file di direktori storage.</h3>
        <ol>
            <li>
                <h4>Di Windows: Klik kanan pada folder storage (di root proyek Anda), lalu Properties > Security. Pastikan akun pengguna web server Anda (misalnya: Users, Everyone, atau akun Windows Anda jika menggunakan php artisan serve) memiliki izin "Full control" atau setidaknya "Read", "Write", "Execute". Lakukan hal yang sama untuk folder storage/app/public dan folder public.</h4>
            </li>
            <li>
                <h4>Di Linux/macOS:</h4>
            </li>
            <li>
                <h4>sudo chmod -R 775 storage bootstrap/cache sudo chown -R www-data:www-data storage bootstrap/cache # Sesuaikan www-data dengan user/group web server Anda"</h4>
            </li>
            <li>
                <h4>Secara visual, pastikan ada ikon shortcut/panah pada folder public/storage yang baru dibuat, mengarah ke ../storage/app/public."</h4>
            </li>
        </ol>
    </li>
    <li>
        <h3>Jalankan Server Pengembangan:</h3>
        <ol>
            <li>
                <h4>Mulai server lokal Laravel:</h4>
            </li>
            <li>
                <h4>php artisan serve</h4>
            </li>
            <li>
                <h4>Aplikasi Anda sekarang akan berjalan di http://127.0.0.1:8000 (atau port lain yang ditunjukkan)."</h4>
            </li>
            <li>
                <h4>Secara visual, pastikan ada ikon shortcut/panah pada folder public/storage yang baru dibuat, mengarah ke ../storage/app/public."</h4>
            </li>
        </ol>
    </li>
</ol>

<h1>Penggunaan Aplikasi</h1>
<h2>Alur Pengguna Biasa</h2>
<ol>
    <li>
        <h3>Akses Halaman Utama: Buka http://127.0.0.1:8000 di browser Anda. Anda akan melihat daftar layanan yang telah ditambahkan oleh admin.</h3>
    </li>
    <li>
        <h3>Registrasi: Klik "Register" di header. Isi detail Anda dan daftar.</h3>
    </li>
    <li>
        <h3>Login: Setelah registrasi atau jika Anda sudah punya akun, klik "Login". Masukkan kredensial Anda.</h3>
    </li>
    <li>
        <h3>Dasbor Pengguna: Setelah login, Anda akan diarahkan ke /dashboard.</h3>
    </li>
    <li>
        <h3>Logout Otomatis: Perhatikan bahwa jika Anda menavigasi ke halaman lain (misalnya kembali ke /), sesi Anda akan otomatis di-logout. Ini adalah fitur yang disengaja untuk mendemonstrasikan alur login/logout.</h3>
    </li>
</ol>
<h2>Alur Administrator</h2>
<ol>
    <li>
        <h3>Akses Halaman Login Admin: Buka http://127.0.0.1:8000/admin/login.</h3>
    </li>
    <li>
        <h3>Login Admin: Gunakan kredensial admin default yang dibuat oleh seeder (admin@example.com / password).</h3>
    </li>
    <li>
        <h3>Dasbor Admin: Setelah login, Anda akan diarahkan ke /admin/dashboard.</h3>
    </li>
    <li>
        <h3>Tambah Layanan: Gunakan formulir "Add New Shoe Laundry Service" untuk menambahkan layanan baru.</h3>
        <ol>
            <li>
                <h3>Pastikan untuk mengunggah file gambar (bukan URL).</h3>
            </li>
        </ol>
    </li>
    <li>
        <h3>Lihat & Hapus Layanan: Layanan yang Anda tambahkan akan muncul di tabel "Existing Shoe Laundry Services". Anda dapat menghapus layanan dari sini.</h3>
    </li>
    <li>
        <h3>Logout Otomatis: Sama seperti pengguna biasa, sesi admin juga akan otomatis di-logout setelah navigasi ke halaman lain.</h3>
    </li>
</ol>

<h1>Catatan Penting & Pemecahan Masalah</h1>
<ol>
    <li>
        <h2>Sesi Tidak Permanen: Perilaku logout otomatis setelah navigasi adalah fitur yang disengaja untuk tujuan demonstrasi. Dalam aplikasi produksi, sesi biasanya bertahan lebih lama.</h2>
    </li>
    <li>
        <h2>Kredensial Admin Default: Pastikan untuk mengubah kredensial admin default (admin@example.com/password) segera di database Anda jika Anda berencana mengadaptasi ini untuk lingkungan produksi.</h2>
    </li>
    <li>
        <h2>Error ERR_TOO_MANY_REDIRECTS: Ini biasanya terjadi jika middleware guest atau auth Anda salah dikonfigurasi. Pastikan Anda telah mengikuti semua langkah konfigurasi middleware dan routing yang diberikan.</h2>
    </li>
    <li>
        <h2>Error 403 Forbidden pada Gambar: Ini menunjukkan masalah perizinan atau symbolic link. Pastikan php artisan storage:link berhasil membuat symbolic link (cek ikon shortcut pada folder public/storage), dan pastikan web server Anda (user yang menjalankan php artisan serve) memiliki izin baca yang cukup untuk folder storage/app/public dan public.</h2>
    </li>
    <li>
        <h2>Membersihkan Cache Laravel: Jika Anda mengubah konfigurasi, rute, atau tampilan Blade, selalu jalankan php artisan optimize:clear dan php artisan serve ulang.</h2>
    </li>
    <li>
        <h2>Folder storage/app/private: Sepertinya ada konfigurasi di config/filesystems.php Anda yang mengarahkan disk 'local' ke storage_path('app/private'). Pastikan Anda telah menerapkan perubahan terbaru pada ContentController yang secara eksplisit menyimpan ke disk 'public' menggunakan storePublicly('images/content', 'public'). Gambar yang diupload sebelum perubahan ini masih mungkin berada di storage/app/private/public dan tidak akan ditampilkan. Anda perlu mengupload ulang setelah perubahan di ContentController atau memindahkan file secara manual.</h2>
    </li>
</ol>

<h1>Jika Anda mengalami masalah, periksa kembali semua langkah instalasi dan konfigurasi dengan cermat.</h1>
