<?php
require_once __DIR__ . '/../includes/transaction.php';

$pageTitle = 'Kalkulator Zakat — Ruang Dermawan';
$pageHeaderTitle = 'Tunaikan Zakat dengan Mudah';
$pageHeaderDescription = 'Pilih jenis zakat, hitung perkiraan kewajiban, lalu siapkan pembayaran dengan langkah yang jelas.';
$pageHeaderEyebrow = 'Layanan Zakat';
$pageHeaderIcon = 'volunteer_activism';
$pageHeaderCurrent = 'zakat';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pilih jenis zakat dan hitung perkiraan zakat Anda di Ruang Dermawan.">
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
        <!-- <section class="zakat-intro">
            <div class="container">
                <span class="section-label">Zakat</span>
                <h1>Tunaikan Zakat dengan Mudah</h1>
                <p>Pilih jenis zakat, hitung perkiraan kewajiban, lalu lengkapi data diri Anda.</p>
            </div>
        </section> -->

        <section class="container zakat-content" aria-label="Form pembayaran zakat">
            <form class="zakat-form" id="zakat-form" action="payment.php" method="post">
                <input type="hidden" name="type" value="zakat">
                <input type="hidden" name="csrf_token" value="<?= transaction_escape(transaction_csrf_token()) ?>">
                <section class="zakat-panel">
                    <div class="zakat-panel-heading">
                        <span class="zakat-step">01</span>
                        <div>
                            <h2>Pilih jenis zakat</h2>
                            <p>Pilih jenis zakat yang ingin Anda tunaikan.</p>
                        </div>
                    </div>

                    <label class="zakat-field" for="zakat-type">
                        <span>Jenis zakat</span>
                        <select id="zakat-type" name="zakat_type" required>
                            <option value="fitrah">Zakat Fitrah</option>
                            <option value="maal">Zakat Maal</option>
                            <option value="penghasilan">Zakat Penghasilan</option>
                        </select>
                    </label>
                </section>

                <section class="zakat-panel">
                    <div class="zakat-panel-heading">
                        <span class="zakat-step">02</span>
                        <div>
                            <h2>Kalkulator zakat</h2>
                            <p>Isi nominal yang diminta, lalu tekan tombol Hitung untuk melihat perkiraan zakat.</p>
                        </div>
                    </div>

                    <div class="zakat-calculator-fields" data-zakat-fields="fitrah">
                        <label class="zakat-field" for="fitrah-people">
                            <span>Jumlah jiwa</span>
                            <input id="fitrah-people" name="fitrah_people" type="number" min="1" step="1" value="1" required>
                        </label>
                        <label class="zakat-field" for="fitrah-rate">
                            <span>Besaran zakat per jiwa (rupiah)</span>
                            <input id="fitrah-rate" name="fitrah_rate" type="text" inputmode="numeric" data-currency placeholder="Contoh: 45.000" required>
                        </label>
                    </div>

                    <div class="zakat-calculator-fields" data-zakat-fields="maal" hidden>
                        <label class="zakat-field" for="maal-gold-silver">
                            <span>Nilai emas, perak, dan/atau permata</span>
                            <input id="maal-gold-silver" name="maal_gold_silver" type="text" inputmode="numeric" data-currency value="0" required>
                        </label>
                        <label class="zakat-field" for="maal-cash-savings">
                            <span>Uang tunai, tabungan, deposito</span>
                            <input id="maal-cash-savings" name="maal_cash_savings" type="text" inputmode="numeric" data-currency value="0" required>
                        </label>
                        <label class="zakat-field" for="maal-assets">
                            <span>Kendaraan, rumah, aset lain</span>
                            <input id="maal-assets" name="maal_assets" type="text" inputmode="numeric" data-currency value="0" required>
                        </label>
                        <label class="zakat-field" for="maal-debts">
                            <span>Jumlah hutang/cicilan (opsional)</span>
                            <input id="maal-debts" name="maal_debts" type="text" inputmode="numeric" data-currency value="0">
                        </label>
                    </div>

                    <div class="zakat-calculator-fields" data-zakat-fields="penghasilan" hidden>
                        <label class="zakat-field" for="income-amount">
                            <span>Jumlah pendapatan per bulan (rupiah)</span>
                            <input id="income-amount" name="income_amount" type="text" inputmode="numeric" data-currency value="0" required>
                        </label>
                        <label class="zakat-field" for="income-bonus">
                            <span>Bonus, THR, dan lainnya (rupiah)</span>
                            <input id="income-bonus" name="income_bonus" type="text" inputmode="numeric" data-currency value="0">
                        </label>
                    </div>

                    <div class="zakat-calculator-actions">
                        <button class="button button-light zakat-reset" id="reset-zakat" type="button">Reset</button>
                        <button class="button button-primary zakat-calculate" id="calculate-zakat" type="button">
                            <span class="material-symbols-outlined" aria-hidden="true">calculate</span>
                            Hitung
                        </button>
                    </div>

                    <div class="zakat-result" aria-live="polite">
                        <span class="material-symbols-outlined" aria-hidden="true">calculate</span>
                        <div>
                            <span id="zakat-result-label">Perkiraan zakat fitrah</span>
                            <strong id="zakat-result-amount">Isi nilai lalu tekan Hitung</strong>
                            <small id="zakat-result-note">Besaran zakat fitrah mengikuti ketentuan setempat.</small>
                        </div>
                    </div>
                    <input id="zakat-amount" name="amount" type="hidden" value="">
                </section>

                <section class="zakat-panel">
                    <div class="zakat-panel-heading">
                        <span class="zakat-step">03</span>
                        <div>
                            <h2>Data diri</h2>
                            <p>Data ini digunakan untuk keperluan pencatatan zakat.</p>
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
                <p class="zakat-submit-notice" id="zakat-submit-notice" role="status" hidden>
                    Silakan tekan Hitung terlebih dahulu untuk mendapatkan nominal zakat.
                </p>
                <p class="zakat-disclaimer">Kalkulator ini memberikan perkiraan. Untuk memastikan nisab dan besaran yang tepat, ikuti panduan lembaga zakat setempat.</p>
            </form>

            <aside class="zakat-help">
                <span class="material-symbols-outlined" aria-hidden="true">info</span>
                <div>
                    <strong>Perlu diketahui</strong>
                    <p>Perhitungan Maal dan Penghasilan di sini adalah perkiraan 2,5% dari nominal yang dimasukkan. Pastikan harta atau penghasilan telah memenuhi nisab dan haul sesuai acuan lembaga zakat.</p>
                </div>
            </aside>
        </section>
    </main>

    <script>
        const zakatForm = document.querySelector('#zakat-form');
        const zakatType = document.querySelector('#zakat-type');
        const resultLabel = document.querySelector('#zakat-result-label');
        const resultAmount = document.querySelector('#zakat-result-amount');
        const resultNote = document.querySelector('#zakat-result-note');
        const amountInput = document.querySelector('#zakat-amount');
        const calculateButton = document.querySelector('#calculate-zakat');
        const resetButton = document.querySelector('#reset-zakat');
        const submitNotice = document.querySelector('#zakat-submit-notice');
        let hasCalculated = false;
        const rupiah = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        });

        const parseNumber = (value) => Number(value.replace(/\D/g, '')) || 0;
        const getNumber = (id) => parseNumber(document.querySelector(`#${id}`).value);
        const formatNumber = (value) => value ? new Intl.NumberFormat('id-ID').format(Number(value)) : '0';
        const formatCurrencyInput = (input) => {
            const cursor = input.selectionStart;
            const digitsBeforeCursor = input.value.slice(0, cursor).replace(/\D/g, '').length;
            const digits = input.value.replace(/\D/g, '');
            input.value = formatNumber(digits);

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

        const updateVisibleFields = () => {
            const selectedType = zakatType.value;

            document.querySelectorAll('[data-zakat-fields]').forEach((group) => {
                const isActive = group.dataset.zakatFields === selectedType;
                group.hidden = !isActive;
                group.querySelectorAll('input').forEach((input) => {
                    input.disabled = !isActive;
                    input.required = isActive;
                });
            });
            hasCalculated = false;
            amountInput.value = '';
            submitNotice.hidden = true;
            resultAmount.textContent = 'Isi nilai lalu tekan Hitung';
            resultLabel.textContent = `Perkiraan zakat ${selectedType === 'maal' ? 'maal' : selectedType === 'penghasilan' ? 'penghasilan' : 'fitrah'}`;
        };

        const calculateZakat = () => {
            const selectedType = zakatType.value;
            const fields = document.querySelector(`[data-zakat-fields="${selectedType}"]`);
            const activeInputs = Array.from(fields.querySelectorAll('input'));

            if (!activeInputs.every((input) => input.reportValidity())) {
                return;
            }

            let amount = 0;
            let label = '';
            let note = '';

            if (selectedType === 'fitrah') {
                const people = getNumber('fitrah-people');
                const rate = getNumber('fitrah-rate');
                if (!Number.isInteger(people) || people < 1) {
                    document.querySelector('#fitrah-people').reportValidity();
                    return;
                }
                if (rate < 1) {
                    const rateInput = document.querySelector('#fitrah-rate');
                    rateInput.setCustomValidity('Masukkan nominal zakat per jiwa lebih dari 0.');
                    rateInput.reportValidity();
                    rateInput.setCustomValidity('');
                    return;
                }
                amount = people * rate;
                label = 'Perkiraan zakat fitrah';
                note = `${people || 0} jiwa × ${rupiah.format(rate || 0)}`;
            } else if (selectedType === 'maal') {
                const goldSilver = getNumber('maal-gold-silver');
                const cashSavings = getNumber('maal-cash-savings');
                const otherAssets = getNumber('maal-assets');
                const debts = getNumber('maal-debts');
                const netAssets = Math.max(0, goldSilver + cashSavings + otherAssets - debts);
                amount = netAssets * 0.025;
                label = 'Perkiraan zakat maal';
                note = `Total harta ${rupiah.format(goldSilver + cashSavings + otherAssets)} dikurangi hutang ${rupiah.format(debts)}. Perkiraan 2,5%; pastikan nisab dan haul terpenuhi.`;
            } else {
                const income = getNumber('income-amount');
                const bonus = getNumber('income-bonus');
                const monthlyIncome = income + bonus;
                if (monthlyIncome < 1) {
                    document.querySelector('#income-amount').setCustomValidity('Masukkan pendapatan atau bonus lebih dari 0.');
                    document.querySelector('#income-amount').reportValidity();
                    document.querySelector('#income-amount').setCustomValidity('');
                    return;
                }
                amount = monthlyIncome * 0.025;
                label = 'Perkiraan zakat penghasilan';
                note = `${rupiah.format(income)} pendapatan + ${rupiah.format(bonus)} bonus. Pastikan telah memenuhi nisab.`;
            }

            resultLabel.textContent = label;
            resultAmount.textContent = rupiah.format(amount);
            resultNote.textContent = note;
            amountInput.value = String(Math.round(amount));
            hasCalculated = true;
            submitNotice.hidden = true;
        };

        zakatForm.addEventListener('input', (event) => {
            if (event.target.closest('[data-zakat-fields]')) {
                if (event.target.matches('[data-currency]')) {
                    formatCurrencyInput(event.target);
                }
                hasCalculated = false;
                amountInput.value = '';
                submitNotice.hidden = true;
                resultAmount.textContent = 'Nilai berubah. Tekan Hitung untuk memperbarui hasil.';
            }
        });
        zakatForm.addEventListener('focusout', (event) => {
            if (event.target.matches('[data-currency]')) {
                formatCurrencyInput(event.target);
            }
        });
        zakatType.addEventListener('change', updateVisibleFields);
        calculateButton.addEventListener('click', calculateZakat);
        resetButton.addEventListener('click', () => {
            const activeFields = document.querySelector(`[data-zakat-fields="${zakatType.value}"]`);
            activeFields.querySelectorAll('[data-currency]').forEach((input) => {
                input.value = '0';
            });
            if (zakatType.value === 'fitrah') {
                document.querySelector('#fitrah-people').value = '1';
            }
            hasCalculated = false;
            amountInput.value = '';
            submitNotice.hidden = true;
            resultLabel.textContent = `Perkiraan zakat ${zakatType.value === 'maal' ? 'maal' : zakatType.value === 'penghasilan' ? 'penghasilan' : 'fitrah'}`;
            resultAmount.textContent = 'Isi nilai lalu tekan Hitung';
            resultNote.textContent = zakatType.value === 'fitrah'
                ? 'Besaran zakat fitrah mengikuti ketentuan setempat.'
                : 'Nilai kalkulator telah direset.';
        });
        zakatForm.addEventListener('submit', (event) => {
            if (!hasCalculated) {
                event.preventDefault();
                submitNotice.textContent = 'Silakan tekan Hitung terlebih dahulu untuk mendapatkan nominal zakat.';
                submitNotice.hidden = false;
                calculateButton.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });

        updateVisibleFields();
    </script>
</body>
</html>
