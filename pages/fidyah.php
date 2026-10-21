<?php
require_once __DIR__ . '/../includes/transaction.php';

$pageTitle = 'Kalkulator Fidyah — Ruang Dermawan';
$pageHeaderTitle = 'Tunaikan Fidyah dengan Tenang';
$pageHeaderDescription = 'Hitung perkiraan fidyah sesuai jumlah hari dan tarif setempat, lalu lanjutkan dengan informasi yang transparan.';
$pageHeaderEyebrow = 'Layanan Fidyah';
$pageHeaderIcon = 'volunteer_activism';
$pageHeaderCurrent = 'fidyah';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hitung perkiraan fidyah berdasarkan jumlah hari dan tarif yang berlaku.">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,400,0,0" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/giving.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
</head>
<body>
    <?php require __DIR__ . '/../includes/page-header.php'; ?>

    <main class="zakat-page">
        <section class="container zakat-content" aria-label="Form pembayaran fidyah">
            <form class="zakat-form" id="fidyah-form" action="payment.php" method="post">
                <input type="hidden" name="type" value="fidyah">
                <input type="hidden" name="csrf_token" value="<?= transaction_escape(transaction_csrf_token()) ?>">

                <section class="zakat-panel">
                    <div class="zakat-panel-heading">
                        <span class="zakat-step">01</span>
                        <div>
                            <h2>Hitung fidyah</h2>
                            <p>Masukkan jumlah hari puasa yang perlu diganti dan tarif fidyah per hari sesuai ketentuan setempat.</p>
                        </div>
                    </div>

                    <div class="zakat-calculator-fields">
                        <label class="zakat-field" for="fidyah-days">
                            <span>Jumlah hari puasa</span>
                            <input id="fidyah-days" name="fidyah_days" type="number" min="1" step="1" placeholder="Contoh: 5" required>
                        </label>
                        <label class="zakat-field" for="fidyah-rate">
                            <span>Tarif fidyah per hari (rupiah)</span>
                            <input id="fidyah-rate" name="fidyah_rate" type="text" inputmode="numeric" data-currency placeholder="Masukkan tarif setempat" required>
                        </label>
                    </div>
                    <br>
                    <p class="zakat-field-hint">Tarif fidyah dapat berbeda menurut daerah dan ketentuan lembaga zakat. Pastikan tarif yang dimasukkan sesuai acuan setempat.</p>

                    <button class="fidyah-info-trigger" id="open-fidyah-info" type="button">
                        Siapa saja yang wajib membayar fidyah?
                    </button>

                    <div class="zakat-calculator-actions">
                        <button class="button button-light" id="reset-fidyah" type="button">Reset</button>
                        <button class="button button-primary" id="calculate-fidyah" type="button">
                            <span class="material-symbols-outlined" aria-hidden="true">calculate</span>
                            Hitung
                        </button>
                    </div>

                    <div class="zakat-result" aria-live="polite">
                        <span class="material-symbols-outlined" aria-hidden="true">calculate</span>
                        <div>
                            <span>Perkiraan fidyah</span>
                            <strong id="fidyah-result-amount">Isi nilai lalu tekan Hitung</strong>
                            <small id="fidyah-result-note">Jumlah hari × tarif fidyah per hari.</small>
                        </div>
                    </div>
                    <input id="fidyah-amount" name="amount" type="hidden" value="">
                </section>

                <section class="zakat-panel fidyah-intention" aria-labelledby="fidyah-intention-title">
                    <div class="zakat-panel-heading">
                        <span class="zakat-step">02</span>
                        <div>
                            <h2 id="fidyah-intention-title">Niat membayar fidyah</h2>
                            <p>Niat dapat diucapkan dalam hati saat menunaikannya.</p>
                        </div>
                    </div>
                    <div class="fidyah-intention-text">
                        <p class="fidyah-intention-arabic" lang="ar" dir="rtl">“نَوَيْتُ أَنْ أُخْرِجَ فِدْيَةَ ٱلْمُرْضِعِ فَرْضًا شَرْعًا لِلَّهِ تَعَالَى”</p>
                        <p class="fidyah-intention-transliteration">Nawaitu an ukhrija fidyatal murdhi’I Fardhaa Syar a’ lillaita’ala</p>
                        <p>Artinya: “Saya niat membayar fidyah karena "hamil/sakit" lillahi ta'ala”</p>
                    </div>
                    <p class="fidyah-intention-note">Kalimat ini hanya contoh untuk membantu menghadirkan niat; niat tidak harus dengan lafaz tertentu. Sesuaikan jika fidyah dibayarkan untuk orang lain.</p>
                </section>

                <section class="zakat-panel">
                    <div class="zakat-panel-heading">
                        <span class="zakat-step">03</span>
                        <div>
                            <h2>Data diri</h2>
                            <p>Data ini digunakan untuk keperluan pencatatan fidyah.</p>
                        </div>
                    </div>

                    <div class="zakat-donor-fields">
                        <label class="zakat-field" for="donor-name">
                            <span>Nama lengkap</span>
                            <input id="donor-name" name="donor_name" type="text" maxlength="100" autocomplete="name" required>
                        </label>
                        <label class="zakat-field" for="donor-email">
                            <span>Email</span>
                            <input id="donor-email" name="donor_email" type="email" maxlength="100" autocomplete="email" required>
                        </label>
                        <label class="zakat-field" for="donor-phone">
                            <span>Nomor telepon</span>
                            <input id="donor-phone" name="donor_phone" type="tel" maxlength="20" autocomplete="tel" required>
                        </label>
                        <label class="zakat-field" for="payment-method">
                            <span>Metode pembayaran</span>
                            <select id="payment-method" name="payment_method" required>
                                <option value="">Pilih metode pembayaran</option>
                                <option value="transfer_bank">Transfer bank</option>
                                <option value="qris">QRIS</option>
                            </select>
                        </label>
                    </div>
                </section>

                <button class="button button-primary zakat-submit" type="submit">
                    Lanjutkan ke Pembayaran
                    <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
                </button>
                <p class="zakat-submit-notice" id="fidyah-submit-notice" role="status" hidden></p>
                <p class="zakat-disclaimer">Kalkulator memberikan perkiraan berdasarkan tarif yang Anda masukkan. Pastikan ketentuan fidyah sesuai panduan lembaga zakat setempat.</p>
            </form>

            <dialog class="fidyah-info-dialog" id="fidyah-info-dialog" aria-labelledby="fidyah-info-title" aria-describedby="fidyah-info-description">
                <div class="fidyah-info-dialog-heading">
                    <div>
                        <span class="section-label">Informasi Fidyah</span>
                        <h2 id="fidyah-info-title">Siapa yang dapat wajib membayar fidyah?</h2>
                    </div>
                    <button class="fidyah-info-close" id="close-fidyah-info" type="button" aria-label="Tutup informasi">×</button>
                </div>
                <div class="fidyah-info-content" id="fidyah-info-description">
                    <p>Secara umum, fidyah dapat berlaku bagi orang yang tidak mampu berpuasa dan tidak memungkinkan menggantinya dengan qadha, seperti:</p>
                    <ul>
                        <li>Lansia yang sangat lemah dan tidak mampu berpuasa.</li>
                        <li>Orang dengan penyakit menahun yang menurut pertimbangan medis tidak memungkinkan untuk berpuasa maupun menggantinya di kemudian hari.</li>
                    </ul>
                    <p>Untuk ibu hamil atau menyusui, serta orang yang menunda qadha hingga Ramadan berikutnya, ketentuan dapat berbeda menurut kondisi dan pandangan fikih. Jangan menganggap setiap utang puasa otomatis cukup diganti dengan fidyah.</p>
                    <p class="fidyah-info-caution">Jika tidak berpuasa karena sakit sementara atau perjalanan, umumnya dibahas sebagai kewajiban qadha. Konsultasikan keadaan pribadi Anda kepada ulama atau lembaga zakat tepercaya.</p>
                </div>
                <div class="fidyah-info-dialog-actions">
                    <button class="button button-primary" id="dismiss-fidyah-info" type="button">Saya mengerti</button>
                </div>
            </dialog>

            <aside class="zakat-help">
                <span class="material-symbols-outlined" aria-hidden="true">info</span>
                <div>
                    <strong>Perlu diketahui</strong>
                    <p>Besaran fidyah dan ketentuannya dapat berbeda sesuai keadaan dan acuan yang berlaku. Konsultasikan kepada lembaga zakat jika ragu.</p>
                </div>
            </aside>
        </section>
    </main>

    <script>
        const fidyahForm = document.querySelector('#fidyah-form');
        const daysInput = document.querySelector('#fidyah-days');
        const rateInput = document.querySelector('#fidyah-rate');
        const amountInput = document.querySelector('#fidyah-amount');
        const resultAmount = document.querySelector('#fidyah-result-amount');
        const resultNote = document.querySelector('#fidyah-result-note');
        const submitNotice = document.querySelector('#fidyah-submit-notice');
        const infoDialog = document.querySelector('#fidyah-info-dialog');
        let hasCalculated = false;

        const rupiah = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        });

        const parseNumber = (value) => Number(value.replace(/\D/g, '')) || 0;
        const formatNumber = (value) => value ? new Intl.NumberFormat('id-ID').format(Number(value)) : '0';

        const formatCurrencyInput = (input) => {
            const cursor = input.selectionStart;
            const digitsBeforeCursor = input.value.slice(0, cursor).replace(/\D/g, '').length;
            const digits = input.value.replace(/\D/g, '');
            input.value = digits ? formatNumber(digits) : '';

            let nextCursor = 0;
            let digitsSeen = 0;
            while (nextCursor < input.value.length && digitsSeen < digitsBeforeCursor) {
                if (/\d/.test(input.value[nextCursor])) {
                    digitsSeen += 1;
                }
                nextCursor += 1;
            }
            input.setSelectionRange(nextCursor, nextCursor);
        };

        const calculateFidyah = () => {
            if (!daysInput.reportValidity() || !rateInput.reportValidity()) {
                return;
            }

            const days = Number(daysInput.value);
            const rate = parseNumber(rateInput.value);
            if (!Number.isInteger(days) || days < 1 || rate < 1) {
                rateInput.setCustomValidity('Masukkan tarif fidyah per hari lebih dari 0.');
                rateInput.reportValidity();
                rateInput.setCustomValidity('');
                return;
            }

            const total = days * rate;
            resultAmount.textContent = rupiah.format(total);
            resultNote.textContent = `${days} hari × ${rupiah.format(rate)} per hari.`;
            amountInput.value = String(total);
            hasCalculated = true;
            submitNotice.hidden = true;
        };

        fidyahForm.addEventListener('input', (event) => {
            if (!event.target.matches('#fidyah-days, #fidyah-rate')) {
                return;
            }

            if (event.target.matches('[data-currency]')) {
                formatCurrencyInput(event.target);
            }
            hasCalculated = false;
            amountInput.value = '';
            resultAmount.textContent = 'Nilai berubah. Tekan Hitung untuk memperbarui hasil.';
            submitNotice.hidden = true;
        });

        document.querySelector('#calculate-fidyah').addEventListener('click', calculateFidyah);
        document.querySelector('#open-fidyah-info').addEventListener('click', () => {
            infoDialog.showModal();
        });

        ['#close-fidyah-info', '#dismiss-fidyah-info'].forEach((selector) => {
            document.querySelector(selector).addEventListener('click', () => {
                infoDialog.close();
            });
        });

        infoDialog.addEventListener('click', (event) => {
            if (event.target === infoDialog) {
                infoDialog.close();
            }
        });

        document.querySelector('#reset-fidyah').addEventListener('click', () => {
            daysInput.value = '';
            rateInput.value = '';
            amountInput.value = '';
            resultAmount.textContent = 'Isi nilai lalu tekan Hitung';
            resultNote.textContent = 'Jumlah hari × tarif fidyah per hari.';
            submitNotice.hidden = true;
            hasCalculated = false;
        });

        fidyahForm.addEventListener('focusout', (event) => {
            if (event.target.matches('[data-currency]')) {
                formatCurrencyInput(event.target);
            }
        });

        fidyahForm.addEventListener('submit', (event) => {
            if (!hasCalculated) {
                event.preventDefault();
                submitNotice.textContent = 'Silakan tekan Hitung terlebih dahulu untuk mendapatkan nominal fidyah.';
                submitNotice.hidden = false;
                submitNotice.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        });
    </script>
</body>
</html>
