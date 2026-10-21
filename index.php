<?php
// Landing page utama Ruang Dermawan.
// Seluruh section beranda berada di file ini.
$pageTitle = 'Ruang Dermawan — Kebaikan Kecil, Dampak Besar';
$posterPath = __DIR__ . '/assets/images/poster_horizontal.jpg';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Salurkan zakat, infak, dan shodaqoh melalui Ruang Dermawan.">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,400,0,0" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/home.css?v=<?= filemtime(__DIR__ . '/assets/css/home.css') ?>">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
    <?php require __DIR__ . '/includes/header.php'; ?>

    <main>
<section class="campaign-slider-section" aria-label="Campaign pilihan">
    <div class="container">
        <div class="campaign-slider" role="region" aria-roledescription="carousel" aria-label="Campaign pilihan">
            <a class="campaign-slide is-active" href="campaign/detail.php?slug=bantuan-pangan" aria-label="Lihat campaign Bantuan Pangan untuk Keluarga Prasejahtera">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2Nln3IVcBLAGBTMrBDYDyoDEkrCJS3R4gu9zcs67edOZRpeMWCSYRP_hc52mlzZZYqAgXhqC8qSngnQmELkjiuIbbP2v2KzuoQtRdLdjgMlQ2F7cr8qJQvgOdcKVzMiPROjWlDfyaf7mqXLWWyU72UqYvTx_FlKIDhYsdVGijzGBcP9gNQ2dq5GTkSBZuVWBFW0_C6GWVPZAIRGH28xgqBvkwG0fTnP6aVYSZqWCWbMkiI9F76rIMwQ" alt="Bantuan bahan pangan untuk keluarga" fetchpriority="high">
                <span class="campaign-slide-shade" aria-hidden="true"></span>
                <span class="campaign-slide-copy">
                    <span class="campaign-slide-label">Campaign pilihan</span>
                    <strong>Bantu Penuhi Kebutuhan Pangan Keluarga</strong>
                    <span>Ulurkan kepedulian untuk keluarga yang membutuhkan.</span>
                    <span class="campaign-slide-cta">Lihat campaign <span aria-hidden="true">→</span></span>
                </span>
            </a>
            <a class="campaign-slide" href="campaign/detail.php?slug=beasiswa-santri" aria-label="Lihat campaign Beasiswa Pendidikan untuk Santri Dhuafa" hidden>
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBxwR1P4yL0h-AZc15BHldzFiRGgv5ta8kbBcV4d-R9zR9u7W9hwBFnMLMTx18nsv48FSUdw2PtIYzHv71Y39SOALKxbfJNzSaqq6ssIZie4El14E5IgdFY8BiCabfQd5YXPMJnTZW3E2LN0dEuRWYUUmToBw1ukQDlB6B0l0PIgfyHwefis94kIfljf4XUbfWvluNxX0TsQnEDs6xc6WK2p5ijsZgjTmOrvcbkJ9AO_qjP4KiGrvcqrg" alt="Anak-anak belajar di kelas" loading="lazy">
                <span class="campaign-slide-shade" aria-hidden="true"></span>
                <span class="campaign-slide-copy">
                    <span class="campaign-slide-label">Campaign pendidikan</span>
                    <strong>Buka Jalan Pendidikan untuk Santri</strong>
                    <span>Dukung kesempatan belajar yang lebih baik.</span>
                    <span class="campaign-slide-cta">Lihat campaign <span aria-hidden="true">→</span></span>
                </span>
            </a>
            <a class="campaign-slide" href="campaign/detail.php?slug=bantuan-banjir" aria-label="Lihat campaign Bantuan Darurat untuk Korban Banjir" hidden>
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAyC0A08k4CSLnG50bC2bCKsZZUEgK2c_QgOfw0L7Q1L-IWAFlgD8il3dsOlmisQwOmDocjMV_Lgtwre50q02QuM9F8G9RMqglilIxMmBh0WUuAqLtoPTecvYoC65Z6Bvq_rxmQ37mRbbU0pgCWx9Au_2BthSZInizd7N1LvcI6cc1EVdnj4IXDMhsg4U-DJuu4pZ75AcWEkIyj3NzfI4Y7mfORHHbGnvSbWbS5nRUsUA9HMHEop5eDmg" alt="Bantuan untuk korban bencana" loading="lazy">
                <span class="campaign-slide-shade" aria-hidden="true"></span>
                <span class="campaign-slide-copy">
                    <span class="campaign-slide-label">Bantuan kemanusiaan</span>
                    <strong>Bersama Bantu Warga Terdampak Banjir</strong>
                    <span>Dukungan Anda membantu memenuhi kebutuhan darurat.</span>
                    <span class="campaign-slide-cta">Lihat campaign <span aria-hidden="true">→</span></span>
                </span>
            </a>

            <button class="campaign-slider-arrow campaign-slider-previous" type="button" aria-label="Campaign sebelumnya">
                <span aria-hidden="true">‹</span>
            </button>
            <button class="campaign-slider-arrow campaign-slider-next" type="button" aria-label="Campaign berikutnya">
                <span aria-hidden="true">›</span>
            </button>
        </div>

        <div class="campaign-slider-dots" role="group" aria-label="Pilih campaign">
            <button class="is-active" type="button" aria-label="Tampilkan campaign bantuan pangan" aria-pressed="true"></button>
            <button type="button" aria-label="Tampilkan campaign pendidikan" aria-pressed="false"></button>
            <button type="button" aria-label="Tampilkan campaign bantuan banjir" aria-pressed="false"></button>
        </div>
    </div>
</section>

<section class="giving-shortcuts-section" aria-label="Pilih layanan">
    <div class="container giving-shortcuts">
        <a class="giving-shortcut" href="#campaign">
            <span class="material-symbols-outlined" aria-hidden="true">volunteer_activism</span>
            <span>Donasi</span>
            <span class="giving-shortcut-arrow" aria-hidden="true">→</span>
        </a>
        <a class="giving-shortcut" href="pages/zakat.php">
            <span class="material-symbols-outlined" aria-hidden="true">mosque</span>
            <span>Zakat</span>
            <span class="giving-shortcut-arrow" aria-hidden="true">→</span>
        </a>
        <a class="giving-shortcut" href="pages/fidyah.php">
            <span class="material-symbols-outlined" aria-hidden="true">rice_bowl</span>
            <span>Fidyah</span>
            <span class="giving-shortcut-arrow" aria-hidden="true">→</span>
        </a>
    </div>
</section>

<section class="campaign-section section" id="campaign">
    <div class="container">
        <div class="section-heading section-heading-left">
            <div>
                <span class="section-label">Prioritas utama</span>
                <h2>Campaign Pilihan</h2>
                <p>Kenali program yang sedang membutuhkan dukungan. Data di bawah masih berupa contoh dan nantinya diganti dari database.</p>
            </div>
            <a class="button button-light" href="campaign/index.php">Lihat Semua Campaign</a>
        </div>

        <div class="campaign-grid">
            <article class="campaign-card">
                <div class="campaign-image-wrap">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2Nln3IVcBLAGBTMrBDYDyoDEkrCJS3R4gu9zcs67edOZRpeMWCSYRP_hc52mlzZZYqAgXhqC8qSngnQmELkjiuIbbP2v2KzuoQtRdLdjgMlQ2F7cr8qJQvgOdcKVzMiPROjWlDfyaf7mqXLWWyU72UqYvTx_FlKIDhYsdVGijzGBcP9gNQ2dq5GTkSBZuVWBFW0_C6GWVPZAIRGH28xgqBvkwG0fTnP6aVYSZqWCWbMkiI9F76rIMwQ" alt="Bantuan bahan pangan untuk keluarga" loading="lazy">
                    <span class="campaign-tag">Ketahanan Pangan</span>
                </div>
                <div class="campaign-body">
                    <h3>Bantuan Pangan untuk Keluarga Prasejahtera</h3>
                    <div class="progress-track"><span style="width: 84%"></span></div>
                    <div class="campaign-amounts"><div><small>Terkumpul</small><strong>Rp 84.500.000</strong></div><div class="amount-target"><small>Target</small><strong>Rp 100.000.000</strong></div></div>
                    <a class="button button-primary button-full" href="donasi/index.php">Donasi Sekarang</a>
                </div>
            </article>

            <article class="campaign-card">
                <div class="campaign-image-wrap">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBxwR1P4yL0h-AZc15BHldzFiRGgv5ta8kbBcV4d-R9zR9u7W9hwBFnMLMTx18nsv48FSUdw2PtIYzHv71Y39SOALKxbfJNzSaqq6ssIZie4El14E5IgdFY8BiCabfQd5YXPMJnTZW3E2LN0dEuRWYUUmToBw1ukQDlB6B0l0PIgfyHwefis94kIfljf4XUbfWvluNxX0TsQnEDs6xc6WK2p5ijsZgjTmOrvcbkJ9AO_qjP4KiGrvcqrg" alt="Anak-anak belajar di kelas" loading="lazy">
                    <span class="campaign-tag">Pendidikan</span>
                </div>
                <div class="campaign-body">
                    <h3>Beasiswa Pendidikan untuk Santri Dhuafa</h3>
                    <div class="progress-track"><span style="width: 75%"></span></div>
                    <div class="campaign-amounts"><div><small>Terkumpul</small><strong>Rp 45.200.000</strong></div><div class="amount-target"><small>Target</small><strong>Rp 60.000.000</strong></div></div>
                    <a class="button button-primary button-full" href="donasi/index.php">Donasi Sekarang</a>
                </div>
            </article>

            <article class="campaign-card">
                <div class="campaign-image-wrap">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAyC0A08k4CSLnG50bC2bCKsZZUEgK2c_QgOfw0L7Q1L-IWAFlgD8il3dsOlmisQwOmDocjMV_Lgtwre50q02QuM9F8G9RMqglilIxMmBh0WUuAqLtoPTecvYoC65Z6Bvq_rxmQ37mRbbU0pgCWx9Au_2BthSZInizd7N1LvcI6cc1EVdnj4IXDMhsg4U-DJuu4pZ75AcWEkIyj3NzfI4Y7mfORHHbGnvSbWbS5nRUsUA9HMHEop5eDmg" alt="Bantuan untuk korban bencana" loading="lazy">
                    <span class="campaign-tag campaign-tag-orange">Tanggap Darurat</span>
                </div>
                <div class="campaign-body">
                    <h3>Bantuan Darurat untuk Korban Banjir</h3>
                    <div class="progress-track"><span style="width: 85%"></span></div>
                    <div class="campaign-amounts"><div><small>Terkumpul</small><strong>Rp 128.000.000</strong></div><div class="amount-target"><small>Target</small><strong>Rp 150.000.000</strong></div></div>
                    <a class="button button-primary button-full" href="donasi/index.php">Bantu Sekarang</a>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="statistics-section" aria-label="Mengapa memilih Ruang Dermawan">

    <div class="section-heading">
        <span class="section-label section-label-with-logo">
            Mengapa memilih
            <span class="section-logo">
                <img src="assets/images/logo_horizontal.png" alt="Ruang Dermawan">
            </span>
        </span>
        <p>Temukan cara berbagi yang mudah dan sesuai dengan kepedulianmu.</p>
    </div>

    <div class="container statistics-grid">
        <article class="stat-card">
            <div class="stat-heading"><span class="stat-icon material-symbols-outlined" aria-hidden="true">my_location</span><span>Tepat sasaran</span></div>
            <p class="stat-value">Pilih tujuan donasimu</p>
            <p class="stat-note">Salurkan bantuan melalui campaign yang sesuai dengan kepedulianmu.</p>
        </article>
        <article class="stat-card">
            <div class="stat-heading"><span class="stat-icon material-symbols-outlined" aria-hidden="true">visibility</span><span>Transparan</span></div>
            <p class="stat-value">Informasi yang jelas</p>
            <p class="stat-note">Lihat informasi campaign dan kebutuhan bantuan sebelum berdonasi.</p>
        </article>
        <article class="stat-card">
            <div class="stat-heading"><span class="stat-icon material-symbols-outlined" aria-hidden="true">verified_user</span><span>Amanah</span></div>
            <p class="stat-value">Menjaga kepercayaan</p>
            <p class="stat-note">Donasi dikelola dengan kepedulian dan tanggung jawab.</p>
        </article>
        <article class="stat-card">
            <div class="stat-heading"><span class="stat-icon material-symbols-outlined" aria-hidden="true">touch_app</span><span>Mudah berdonasi</span></div>
            <p class="stat-value">Berbagi lebih praktis</p>
            <p class="stat-note">Ikuti langkah donasi yang sederhana untuk mulai membantu sesama.</p>
        </article>
    </div>
</section>

<section class="impact-statistics-section" aria-label="Statistik donasi">
    <div class="container">

        <div class="impact-statistics-grid">
            <article class="impact-stat-card">
                <span class="stat-icon material-symbols-outlined" aria-hidden="true">volunteer_activism</span>
                <h3>Total Donasi Terkumpul</h3>
                <p class="impact-stat-value">Rp 14.850.000+</p>
                <p class="impact-stat-note">Angka contoh untuk tampilan awal</p>
            </article>
            <article class="impact-stat-card">
                <span class="stat-icon material-symbols-outlined" aria-hidden="true">groups</span>
                <h3>Orang Telah Berdonasi</h3>
                <p class="impact-stat-value">48.920</p>
                <p class="impact-stat-note">Angka contoh untuk tampilan awal</p>
            </article>
        </div>
    </div>
</section>

<?php if (is_file($posterPath)): ?>
<section class="poster-section" aria-label="Poster Ruang Dermawan">
    <div class="container">
        <img src="assets/images/poster_horizontal.jpg?v=<?= filemtime($posterPath) ?>" alt="Poster Ruang Dermawan" loading="lazy">
    </div>
</section>
<?php endif; ?>

    </main>

    <?php require __DIR__ . '/includes/footer.php'; ?>
    <script>
        const campaignSlider = document.querySelector('.campaign-slider');

        if (campaignSlider) {
            const slides = Array.from(campaignSlider.querySelectorAll('.campaign-slide'));
            const dots = Array.from(document.querySelectorAll('.campaign-slider-dots button'));
            let activeSlide = 0;

            const showSlide = (index) => {
                activeSlide = (index + slides.length) % slides.length;

                slides.forEach((slide, slideIndex) => {
                    slide.hidden = slideIndex !== activeSlide;
                });

                dots.forEach((dot, dotIndex) => {
                    const isActive = dotIndex === activeSlide;
                    dot.classList.toggle('is-active', isActive);
                    dot.setAttribute('aria-pressed', String(isActive));
                });
            };

            campaignSlider.querySelector('.campaign-slider-previous').addEventListener('click', () => {
                showSlide(activeSlide - 1);
            });

            campaignSlider.querySelector('.campaign-slider-next').addEventListener('click', () => {
                showSlide(activeSlide + 1);
            });

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => showSlide(index));
            });
        }
    </script>
</body>
</html>
