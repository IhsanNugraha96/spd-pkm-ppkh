<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Pembuatan Akun</title>
</head>
<body>
    <h1>Selamat Datang!</h1>
    <p>Akun Anda telah berhasil dibuat.</p>
    <p>email = <?= $email ?> </p>
    <p>password = <?= $password ?></p>
    <br>
    <p>Silakan login <a href="<?= url('login') ?>">disini</a> menggunakan email dan password yang telah didaftarkan.</p>

    <br>
    <p>ini merupakan pesan otomatis dari aplikasi SPD PKM PPKH</p>
    <p>Terima kasih.</p>
</body>
</html>