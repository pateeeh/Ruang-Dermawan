<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="index.php" aria-label="Ruang Dermawan - Beranda">
            <img class="brand-logo" src="assets/images/logo_horizontal.png" alt="Ruang Dermawan">
        </a>

        <nav class="main-nav" id="main-navigation" aria-label="Navigasi utama">
            <a class="active" href="index.php">Beranda</a>
            <a href="pages/zakat.php">Zakat</a>
            <a href="#campaign">Infak &amp; Shodaqoh</a>
            <a href="#campaign">Campaign</a>
            <a href="#tentang-kami">Tentang Kami</a>
            <a class="button button-primary mobile-donation-link" href="#campaign">Donasi Sekarang</a>
        </nav>

        <button class="menu-toggle" type="button" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="main-navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="header-actions">
            <a class="admin-link" href="pages/login.php">Masuk Admin</a>
            <a class="button button-primary button-small desktop-donation-link" href="#campaign">Donasi Sekarang</a>
        </div>
    </div>
</header>

<script>
    (() => {
        const menuButton = document.querySelector('.menu-toggle');
        const mainNavigation = document.querySelector('.main-nav');

        const setMenuOpen = (isOpen) => {
            menuButton.setAttribute('aria-expanded', String(isOpen));
            menuButton.setAttribute('aria-label', isOpen ? 'Tutup menu navigasi' : 'Buka menu navigasi');
            mainNavigation.classList.toggle('is-open', isOpen);
        };

        menuButton.addEventListener('click', () => {
            setMenuOpen(menuButton.getAttribute('aria-expanded') !== 'true');
        });

        mainNavigation.addEventListener('click', (event) => {
            if (event.target.closest('a')) {
                setMenuOpen(false);
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && menuButton.getAttribute('aria-expanded') === 'true') {
                setMenuOpen(false);
                menuButton.focus();
            }
        });

        document.addEventListener('click', (event) => {
            if (!event.target.closest('.header-inner')) {
                setMenuOpen(false);
            }
        });
    })();
</script>
