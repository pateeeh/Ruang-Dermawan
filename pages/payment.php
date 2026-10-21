<?php
require_once __DIR__ . '/../includes/transaction.php';

const MAX_TRANSACTION_AMOUNT = 9999999999999;

$pageError = '';
$pageErrorCode = 0;
$transaction = null;
$notes = [];

$getPostString = static function (string $key): string {
    return isset($_POST[$key]) && is_string($_POST[$key]) ? trim($_POST[$key]) : '';
};

$readRupiah = static function (string $key, bool $required = true) use ($getPostString): ?int {
    $value = $getPostString($key);
    if ($value === '' && !$required) {
        return 0;
    }

    if (!preg_match('/^[0-9.,\s]*$/', $value)) {
        return null;
    }

    $digits = preg_replace('/\D/', '', $value);
    if ($digits === '' || strlen($digits) > strlen((string) MAX_TRANSACTION_AMOUNT)) {
        return null;
    }

    $amount = (int) $digits;
    return $amount <= MAX_TRANSACTION_AMOUNT ? $amount : null;
};

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrfToken = $getPostString('csrf_token');
    if (!hash_equals(transaction_csrf_token(), $csrfToken)) {
        $pageError = 'Sesi formulir kedaluwarsa atau tidak valid. Kembali ke halaman sebelumnya dan coba lagi.';
        $pageErrorCode = 400;
    }

    if ($pageError === '' && $getPostString('action') === 'simulate_payment') {
        $transactionCode = $getPostString('transaction_code');
        $demoTransaction = $_SESSION['demo_transactions'][$transactionCode] ?? null;
        if (!is_array($demoTransaction)) {
            $pageError = 'Transaksi demo tidak ditemukan di sesi ini. Silakan mulai kembali dari formulir.';
            $pageErrorCode = 404;
        } else {
            $_SESSION['demo_transactions'][$transactionCode]['status'] = 'success';
            $_SESSION['demo_transactions'][$transactionCode]['updated_at'] = date('Y-m-d H:i:s');
            header('Location: payment.php?code=' . rawurlencode($transactionCode), true, 303);
            exit;
        }
    } elseif ($pageError === '') {
    $type = $getPostString('type');
    $name = $getPostString('donor_name');
    $email = $getPostString('donor_email');
    $phone = $getPostString('donor_phone');
    $paymentMethod = $getPostString('payment_method');
    $zakatType = $getPostString('zakat_type');

    $nameLength = function_exists('mb_strlen') ? mb_strlen($name, 'UTF-8') : strlen($name);
    if ($pageError === '' && ($name === '' || $nameLength > 100)) {
        $pageError = 'Nama wajib diisi dan maksimal 100 karakter.';
        $pageErrorCode = 422;
    } elseif ($pageError === '' && (strlen($email) > 100 || filter_var($email, FILTER_VALIDATE_EMAIL) === false)) {
        $pageError = 'Masukkan alamat email yang valid (maksimal 100 karakter).';
        $pageErrorCode = 422;
    } elseif ($pageError === '' && (strlen($phone) > 20 || !preg_match('/^[0-9+().\-\s]{6,20}$/', $phone))) {
        $pageError = 'Masukkan nomor telepon yang valid (maksimal 20 karakter).';
        $pageErrorCode = 422;
    } elseif ($pageError === '' && !in_array($paymentMethod, ['transfer_bank', 'qris'], true)) {
        $pageError = 'Pilih metode pembayaran yang tersedia.';
        $pageErrorCode = 422;
    } elseif ($pageError === '' && !in_array($type, ['zakat', 'fidyah'], true)) {
        $pageError = 'Jenis transaksi tidak valid.';
        $pageErrorCode = 422;
    }

    $amount = 0;
    $details = [];

    if ($pageError === '' && $type === 'fidyah') {
        $days = filter_var($getPostString('fidyah_days'), FILTER_VALIDATE_INT);
        $rate = $readRupiah('fidyah_rate');
        if ($days === false || $days < 1 || $rate === null || $rate < 1) {
            $pageError = 'Masukkan jumlah hari dan tarif fidyah per hari yang valid, lalu tekan Hitung.';
            $pageErrorCode = 422;
        } elseif ($days > intdiv(MAX_TRANSACTION_AMOUNT, $rate)) {
            $pageError = 'Nominal fidyah melebihi batas transaksi yang didukung.';
            $pageErrorCode = 422;
        } else {
            $amount = $days * $rate;
            $details = [
                'fidyah_days' => $days,
                'fidyah_rate' => $rate,
            ];
            $zakatType = null;
        }
    } elseif ($pageError === '' && $type === 'zakat') {
        if (!in_array($zakatType, ['fitrah', 'maal', 'penghasilan'], true)) {
            $pageError = 'Pilih jenis zakat yang valid.';
            $pageErrorCode = 422;
        } elseif ($zakatType === 'fitrah') {
            $people = filter_var($getPostString('fitrah_people'), FILTER_VALIDATE_INT);
            $rate = $readRupiah('fitrah_rate');
            if ($people === false || $people < 1 || $rate === null || $rate < 1) {
                $pageError = 'Masukkan jumlah jiwa dan besaran zakat per jiwa yang valid.';
                $pageErrorCode = 422;
            } elseif ($people > intdiv(MAX_TRANSACTION_AMOUNT, $rate)) {
                $pageError = 'Nominal zakat melebihi batas transaksi yang didukung.';
                $pageErrorCode = 422;
            } else {
                $amount = $people * $rate;
                $details = ['fitrah_people' => $people, 'fitrah_rate' => $rate];
            }
        } elseif ($zakatType === 'maal') {
            $goldSilver = $readRupiah('maal_gold_silver', false);
            $cashSavings = $readRupiah('maal_cash_savings', false);
            $assets = $readRupiah('maal_assets', false);
            $debts = $readRupiah('maal_debts', false);

            if ($goldSilver === null || $cashSavings === null || $assets === null || $debts === null) {
                $pageError = 'Periksa kembali nominal harta dan hutang yang dimasukkan.';
                $pageErrorCode = 422;
            } elseif ($goldSilver > MAX_TRANSACTION_AMOUNT - $cashSavings
                || $goldSilver + $cashSavings > MAX_TRANSACTION_AMOUNT - $assets) {
                $pageError = 'Total harta melebihi batas transaksi yang didukung.';
                $pageErrorCode = 422;
            } else {
                $totalAssets = $goldSilver + $cashSavings + $assets;
                $netAssets = max(0, $totalAssets - $debts);
                $amount = (int) round($netAssets * 0.025, 0, PHP_ROUND_HALF_UP);
                $details = [
                    'maal_gold_silver' => $goldSilver,
                    'maal_cash_savings' => $cashSavings,
                    'maal_assets' => $assets,
                    'maal_debts' => $debts,
                ];
            }
        } else {
            $income = $readRupiah('income_amount', false);
            $bonus = $readRupiah('income_bonus', false);
            if ($income === null || $bonus === null || $income > MAX_TRANSACTION_AMOUNT - $bonus) {
                $pageError = 'Periksa kembali nominal pendapatan dan bonus.';
                $pageErrorCode = 422;
            } elseif ($income + $bonus < 1) {
                $pageError = 'Masukkan pendapatan atau bonus lebih dari 0.';
                $pageErrorCode = 422;
            } else {
                $amount = (int) round(($income + $bonus) * 0.025, 0, PHP_ROUND_HALF_UP);
                $details = ['income_amount' => $income, 'income_bonus' => $bonus];
            }
        }
    }

    if ($pageError === '' && ($amount < 1 || $amount > MAX_TRANSACTION_AMOUNT)) {
        $pageError = 'Nominal transaksi harus lebih dari 0 dan tidak melebihi batas yang didukung.';
        $pageErrorCode = 422;
    }

    if ($pageError === '') {
        $transactionCode = 'DEMO' . date('ymdHis') . bin2hex(random_bytes(3));
        $notes = json_encode($details, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        $_SESSION['demo_transactions'][$transactionCode] = [
            'id' => null,
            'transaction_code' => $transactionCode,
            'donor_name' => $name,
            'donor_email' => $email,
            'donor_phone' => $phone,
            'type' => $type,
            'zakat_type' => $zakatType,
            'campaign_id' => null,
            'amount' => number_format($amount, 2, '.', ''),
            'payment_method' => $paymentMethod,
            'status' => 'pending',
            'notes' => $notes,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'email_sent' => 0,
        ];

        header('Location: payment.php?code=' . rawurlencode($transactionCode), true, 303);
        exit;
    }
    }
} elseif (isset($_GET['code']) && is_string($_GET['code'])) {
    $transactionCode = $_GET['code'];
    $transaction = $_SESSION['demo_transactions'][$transactionCode] ?? null;
    if (!is_array($transaction)) {
        $pageError = 'Transaksi demo tidak ditemukan di sesi ini. Silakan mulai kembali dari formulir.';
        $pageErrorCode = 404;
    } else {
        $decodedNotes = json_decode($transaction['notes'] ?? '', true);
        $notes = is_array($decodedNotes) ? $decodedNotes : [];
    }
} else {
    $pageError = 'Mulai transaksi melalui formulir zakat atau fidyah.';
    $pageErrorCode = 400;
}

if ($pageErrorCode !== 0) {
    http_response_code($pageErrorCode);
}

$pageTitle = 'Instruksi Pembayaran — Ruang Dermawan';
$typeLabel = $transaction === null
    ? ''
    : ($transaction['type'] === 'fidyah'
        ? 'Fidyah'
        : 'Zakat ' . ucfirst((string) $transaction['zakat_type']));
$methodLabel = $transaction === null
    ? ''
    : ($transaction['payment_method'] === 'qris' ? 'QRIS' : 'Transfer bank');
$statusLabel = $transaction === null
    ? ''
    : ($transaction['status'] === 'success' ? 'Simulasi pembayaran selesai' : 'Menunggu pembayaran (demo)');
$returnUrl = $transaction !== null && $transaction['type'] === 'fidyah' ? 'fidyah.php' : 'zakat.php';
$pageHeaderTitle = $transaction === null
    ? 'Lanjutkan Kebaikanmu'
    : ($transaction['status'] === 'success' ? 'Simulasi Pembayaran Selesai' : 'Satu Langkah Lagi');
$pageHeaderDescription = $transaction === null
    ? 'Kami sedang menyiapkan ringkasan transaksi.'
    : 'Periksa ringkasan dan ikuti instruksi demo pembayaran di bawah ini.';
$pageHeaderEyebrow = 'Ringkasan Pembayaran';
$pageHeaderIcon = 'receipt_long';
$pageHeaderCurrent = '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ringkasan transaksi dan instruksi pembayaran Ruang Dermawan.">
    <title><?= transaction_escape($pageTitle) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,400,0,0" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/payment.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
</head>
<body>
    <?php require __DIR__ . '/../includes/page-header.php'; ?>

    <main class="zakat-page">
        <section class="container transaction-page">
            <?php if ($pageError !== ''): ?>
                <div class="transaction-card" role="alert">
                    <span class="material-symbols-outlined transaction-icon" aria-hidden="true">error</span>
                    <h2>Belum dapat melanjutkan</h2>
                    <p><?= transaction_escape($pageError) ?></p>
                    <a class="button button-primary" href="<?= transaction_escape($returnUrl) ?>">Kembali ke formulir</a>
                </div>
            <?php elseif ($transaction !== null): ?>
                <section class="transaction-card" aria-labelledby="transaction-title">
                    <span class="material-symbols-outlined transaction-icon" aria-hidden="true"><?= $transaction['status'] === 'success' ? 'task_alt' : 'schedule' ?></span>
                    <h2 id="transaction-title"><?= transaction_escape($statusLabel) ?></h2>
                    <?php if ($transaction['status'] === 'pending'): ?>
                        <p class="transaction-lead">Ini adalah transaksi <strong>demo</strong> dengan status <strong>pending</strong>. Data hanya disimpan sementara selama sesi ini.</p>
                    <?php else: ?>
                        <p class="transaction-lead">Status demo berubah menjadi <strong>success</strong>. Tidak ada uang yang dikirim atau pembayaran sungguhan yang terjadi.</p>
                    <?php endif; ?>

                    <dl class="transaction-summary">
                        <div>
                            <dt>Kode transaksi</dt>
                            <dd><?= transaction_escape($transaction['transaction_code']) ?></dd>
                        </div>
                        <div>
                            <dt>Jenis</dt>
                            <dd><?= transaction_escape($typeLabel) ?></dd>
                        </div>
                        <div>
                            <dt>Nominal</dt>
                            <dd>Rp <?= number_format((float) $transaction['amount'], 0, ',', '.') ?></dd>
                        </div>
                        <div>
                            <dt>Metode pembayaran</dt>
                            <dd><?= transaction_escape($methodLabel) ?></dd>
                        </div>
                        <?php if ($transaction['type'] === 'fidyah' && isset($notes['fidyah_days'], $notes['fidyah_rate'])): ?>
                            <div>
                                <dt>Rincian fidyah</dt>
                                <dd><?= (int) $notes['fidyah_days'] ?> hari × Rp <?= number_format((float) $notes['fidyah_rate'], 0, ',', '.') ?> per hari</dd>
                            </div>
                        <?php endif; ?>
                        <div>
                            <dt>Dibuat</dt>
                            <dd><?= transaction_escape(date('d/m/Y H:i', strtotime($transaction['created_at']))) ?></dd>
                        </div>
                    </dl>

                    <?php if ($transaction['status'] === 'pending'): ?>
                        <div class="transaction-instructions transaction-demo-instructions">
                            <span class="transaction-demo-badge">MODE DEMO — JANGAN TRANSFER</span>
                            <strong>Instruksi pembayaran</strong>
                            <?php if ($transaction['payment_method'] === 'transfer_bank'): ?>
                                <p>Berikut contoh tampilan informasi transfer. Nomor rekening ini hanya placeholder dan tidak dapat digunakan.</p>
                                <div class="demo-bank-details">
                                    <span>Bank</span>
                                    <strong>Bank Demo</strong>
                                    <span>Nomor rekening dummy</span>
                                    <strong class="demo-account-number">0000 0000 0000</strong>
                                    <span>Atas nama</span>
                                    <strong>Ruang Dermawan (DEMO)</strong>
                                </div>
                            <?php else: ?>
                                <p>Contoh metode QRIS. Kode berikut hanya visual demo dan bukan QR untuk dipindai.</p>
                                <div class="demo-qris-placeholder" aria-label="Placeholder QRIS demo, bukan kode pembayaran">
                                    <span aria-hidden="true">QRIS<br>DEMO</span>
                                </div>
                            <?php endif; ?>
                            <p class="transaction-warning">Jangan melakukan transfer atau memindai kode apa pun. Pembayaran sungguhan belum tersedia di mode demo ini.</p>
                        </div>
                        <form class="transaction-demo-action" action="payment.php" method="post">
                            <input type="hidden" name="csrf_token" value="<?= transaction_escape(transaction_csrf_token()) ?>">
                            <input type="hidden" name="action" value="simulate_payment">
                            <input type="hidden" name="transaction_code" value="<?= transaction_escape($transaction['transaction_code']) ?>">
                            <button class="button button-primary" type="submit">Simulasikan Pembayaran</button>
                            <p>Tombol ini hanya mengubah status demo di sesi browser. Tidak ada transaksi uang.</p>
                        </form>
                    <?php else: ?>
                        <div class="transaction-success transaction-demo-success">
                            Simulasi selesai. Status demo adalah <strong>success</strong>; transaksi ini tidak tersimpan ke database dan tidak ada uang yang dibayarkan.
                        </div>
                    <?php endif; ?>

                    <a class="button button-light transaction-home-link" href="../index.php">Kembali ke Beranda</a>
                </section>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
