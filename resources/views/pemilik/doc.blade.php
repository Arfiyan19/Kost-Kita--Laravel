@extends('layouts.backend')
@section('title','Dokumentasi Aplikasi')
@section('content')
<div class="card">
    <div class="card-header pl-2 pt-2">
        Dokumentasi Aplikasi Papikost
    </div>
    <div class="card-block">
        <p>
            Halo guys, sebelumnya terima kasih karena sudah menggunakan aplikasi sederhana buatan saya. Saya amat sangat bersyukur apabila aplikasi ini bisa membantu teman-teman dalam belajar atau menjadikan aplikasi ini sebagai bisnis kosan (jika yang mempunyai usaha kosan). <br>
            Disini saya hanya ingin memberikan beberapa catatan agar aplikasi ini bisa berjalan dengan baik.
        </p>
        <h6 class="card-title">Cara Penggunaan Aplikasi</h6>
        <ol>
            <li>Sebelum membuat kosan baru, pastikan kamu sudah menjalankan perintah <b>"php artisan db:seed --class=provinsiSeeder"</b></li>
            <li>Karena pada versi baru ini saya menambahkan beberapa perubahan yang mengharuskan menjalankan perintah tersebut</li>
            <li>Agar email notification berjalan dengan sempurna pastikan kamu sudah memperbarui perngaturan pada file <b>.env</b></li>
            <li>Untuk pengaturan nya kalian bisa cari di Google, atau bisa langsung menghubungi saya</li>
            <li>Pada saat menambahkan gambar, pastikan ukuran gambar HD dan tidak pecah, agar kualitas gambar yang dihasilkan baik</li>
        </ol>
        <p>
            Thanks you, jika ada hal yang ingin kalian tanyakan bisa menghubungi saya melalui Line atau Email yaa.
            <h6 class="card-title">Kontak</h6>
            <ol>
                <li>Line @andridesmana29</li>
                <li>Email <a href="mailto:andridesmana29@outlook.com">andridesmana29@outlook.com</a></li>
            </ol>
        </p>
    </div>
</div>
<div class="card">
    <div class="card-header pl-2 pt-2">
        Logs Perubahan Aplikasi Papikost
    </div>
    <div class="card-block">
        <h6 class="card-title">Versi 1.1.0</h6>
        <ol>
            <li>Penambahan upload foto untuk pemilik kosan pada saat membuat kosan</li>
            <li>penambahan fitur aktif dan non-aktif pada sistem booking</li>
            <li>Penambahan nama provinsi pada saat membuat kosan</li>
            <li>Pada halaman dasboard pemilik kosan kini bisa mengetahui berapa kamar dan siapa penghuni nya</li>
            <li>Penambahan kategori</li>
        </ol>
        <h6 class="card-title">Versi 1.0</h6>
        <ol>
            <li>Penambahan fitur booking</li>
            <li>Penambahan fitur email notification</li>
            <li>Perbaikan sistem pembayaran</li>
            <li>Penambahan keterangan sisa hari pada halaman <b>"my-room"</b></li>
        </ol>
    </div>
</div>
@endsection