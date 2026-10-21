<?php
$loginSubmitted = $_SERVER['REQUEST_METHOD'] === 'POST';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Masuk ke panel admin Ruang Dermawan.">
    <title>Masuk Admin — Ruang Dermawan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
</head>
<body class="admin-login-page">
    <main class="admin-login-layout">
        <section class="admin-login-card" aria-labelledby="form-title">
            <div class="admin-login-card-heading">
                <img src="../assets/images/logo_ruang_dermawan.jpg" alt="Ruang Dermawan">
                <h2 id="form-title">Masuk Admin</h2>
                <p>Masukkan akun admin Anda untuk melanjutkan.</p>
            </div>

            <?php if ($loginSubmitted): ?>
                <p class="admin-login-notice" role="status">
                    Autentikasi admin belum dikonfigurasi. Form ini belum dapat memverifikasi akun.
                </p>
            <?php endif; ?>

            <form class="admin-login-form" method="post">
                <label for="admin-email">Email</label>
                <input
                    id="admin-email"
                    name="email"
                    type="email"
                    placeholder="nama@contoh.com"
                    autocomplete="username"
                    required>
                <label for="admin-password">Kata sandi</label>
                <input
                    id="admin-password"
                    name="password"
                    type="password"
                    placeholder="Masukkan kata sandi"
                    autocomplete="current-password"
                    required>

                <button class="button button-primary admin-login-submit" type="submit">Masuk ke Admin</button>
            </form>

            <p class="admin-login-footnote">Akses halaman ini khusus untuk pengelola Ruang Dermawan.</p>
        </section>
    </main>
</body>
</html>
