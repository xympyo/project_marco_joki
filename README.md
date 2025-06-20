<li><strong>Instal Dependensi Composer:</strong><br>
Di dalam direktori proyek Anda, jalankan perintah ini untuk menginstal semua dependensi PHP:
</li>

<li><strong>Instal Dependensi Node.js & Kompilasi Aset:</strong><br>
Instal dependensi JavaScript dan kompilasi aset front-end:
</li>

<li><strong>Konfigurasi Environment (<code>.env</code>):</strong>
    <ul>
        <li>Salin file <code>.env.example</code> menjadi <code>.env</code>:
            (Di Windows, gunakan <code>copy .env.example .env</code>)</li>
        <li>Buka file <code>.env</code> dan konfigurasikan detail database Anda:
        </li>
    </ul>
</li>

<li><strong>Generate Application Key:</strong><br>
Jalankan perintah ini untuk membuat kunci aplikasi yang aman:
</li>

<li><strong>Jalankan Migrasi Database:</strong><br>
Buat tabel-tabel database yang diperlukan (termasuk tabel <code>users</code>, <code>admins</code>, dan <code>contents</code>):
</li>

<li><strong>Jalankan Database Seeder (untuk membuat admin awal):</strong><br>
Aplikasi ini mengandalkan <code>AdminSeeder</code> untuk membuat akun admin default.
    <ul>
        <li><strong>Kredensial Admin Default:</strong>
            <ul>
                <li><strong>Email:</strong> <code>admin@example.com</code></li>
                <li><strong>Password:</strong> <code>password</code></li>
                <li><strong>PENTING:</strong> Ubah kredensial ini segera setelah instalasi untuk lingkungan produksi!</li>
            </ul>
        </li>
    </ul>
</li>

<li><strong>Buat Symbolic Link Storage:</strong><br>
Ini sangat penting agar gambar yang diupload dapat diakses secara publik oleh web server. Jalankan perintah ini (pastikan terminal Anda dijalankan sebagai Administrator di Windows):
    <ul>
        <li>Pastikan Anda melihat pesan sukses seperti: "The <code>[public/storage]</code> link has been connected..."</li>
        <li>Secara visual, pastikan ada ikon shortcut/panah pada folder <code>public/storage</code> yang baru dibuat, mengarah ke <code>../storage/app/public</code>.</li>
    </ul>
</li>

<li><strong>Setel Perizinan Folder (Opsional, tapi Penting jika ada error 403):</strong><br>
Jika Anda mengalami error <code>403 Forbidden</code> saat mengakses gambar, ini berarti web server tidak memiliki izin yang cukup untuk membaca file di direktori storage.
    <ul>
        <li>Di Windows: Klik kanan pada folder <code>storage</code> (di root proyek Anda), lalu <code>Properties</code> &gt; <code>Security</code>. Pastikan akun pengguna web server Anda (misalnya: <code>Users</code>, <code>Everyone</code>, atau akun Windows Anda jika menggunakan <code>php artisan serve</code>) memiliki izin "Full control" atau setidaknya "Read", "Write", "Execute". Lakukan hal yang sama untuk folder <code>storage/app/public</code> dan folder <code>public</code>.</li>
        <li>Di Linux/macOS:
        </li>
    </ul>
</li>

<li><strong>Jalankan Server Pengembangan:</strong><br>
Mulai server lokal Laravel:
Aplikasi Anda sekarang akan berjalan di <code>[http://127.0.0.1:8000](http://127.0.0.1:8000)</code> (atau port lain yang ditunjukkan).</li>
