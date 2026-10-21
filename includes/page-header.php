<?php
$pageHeaderTitle = $pageHeaderTitle ?? 'Ruang Dermawan';
$pageHeaderDescription = $pageHeaderDescription ?? '';
$pageHeaderEyebrow = $pageHeaderEyebrow ?? 'Layanan Ruang Dermawan';
$pageHeaderIcon = $pageHeaderIcon ?? 'volunteer_activism';
$pageHeaderCurrent = $pageHeaderCurrent ?? '';
?>
<header class="site-header interior-site-header">
    <div class="container interior-header-inner">
        <a class="brand" href="../index.php" aria-label="Ruang Dermawan - Beranda">
            <img class="brand-logo" src="../assets/images/logo_horizontal.png" alt="Ruang Dermawan">
        </a>

        <nav class="interior-header-nav" aria-label="Navigasi layanan">
            <a href="../index.php">Beranda</a>
            <a class="<?= $pageHeaderCurrent === 'zakat' ? 'is-current' : '' ?>" href="zakat.php" <?= $pageHeaderCurrent === 'zakat' ? 'aria-current="page"' : '' ?>>Zakat</a>
            <a class="<?= $pageHeaderCurrent === 'fidyah' ? 'is-current' : '' ?>" href="fidyah.php" <?= $pageHeaderCurrent === 'fidyah' ? 'aria-current="page"' : '' ?>>Fidyah</a>
        </nav>

        <a class="button button-light button-small interior-home-link" href="../index.php">
            <span class="material-symbols-outlined" aria-hidden="true">arrow_back</span>
            Beranda
        </a>
    </div>
</header>

<section class="interior-page-banner" aria-labelledby="interior-page-title">
    <div class="container interior-page-banner-inner">
        <div class="interior-page-heading">
            <div class="interior-page-eyebrow">
                <span class="material-symbols-outlined" aria-hidden="true"><?= htmlspecialchars($pageHeaderIcon, ENT_QUOTES, 'UTF-8') ?></span>
                <?= htmlspecialchars($pageHeaderEyebrow, ENT_QUOTES, 'UTF-8') ?>
            </div>
            <h1 id="interior-page-title"><?= htmlspecialchars($pageHeaderTitle, ENT_QUOTES, 'UTF-8') ?></h1>
            <?php if ($pageHeaderDescription !== ''): ?>
                <p><?= htmlspecialchars($pageHeaderDescription, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>
        </div>
        <div class="interior-banner-mark" aria-hidden="true">
            <span class="material-symbols-outlined"><?= htmlspecialchars($pageHeaderIcon, ENT_QUOTES, 'UTF-8') ?></span>
        </div>
    </div>
</section>
