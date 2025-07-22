<!DOCTYPE html>
<html lang="id">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/gallery-logo.png') ?>">
    <title><?= $title ?></title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .logo {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .company-name {
            font-size: 18px;
            font-weight: bold;
            margin: 5px 0;
        }
        .company-address {
            font-size: 12px;
            margin: 5px 0;
        }
        .report-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin: 20px 0;
        }
        .report-info {
            margin-bottom: 20px;
        }
        .report-info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 11px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="<?= base_url('assets/img/gallery-logo.png') ?>" alt="Logo GKI" class="logo">
        <div class="company-name">RSUD H. Abdul Aziz Marabahan</div>
        <div class="company-address">
        Jl. Jenderal Sudirman No. 1, Marabahan, Kalimantan Selatan
        <br>Telp: (0511) 123-456
        </div>
    </div>

    <div class="report-title"><?= $title ?></div>

    <div class="report-info">
        <?php if (!empty($filters)): ?>
            <p><strong>Periode:</strong> <?= $filters['periode_text'] ?></p>
            <?php if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])): ?>
                <p><strong>Tanggal:</strong> <?= date('d/m/Y', strtotime($filters['tanggal_mulai'])) ?> - <?= date('d/m/Y', strtotime($filters['tanggal_selesai'])) ?></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <?= $content ?>

    <div class="footer">
        <p>Dicetak pada: <?= date('d/m/Y H:i:s') ?></p>
        <p>Halaman 1 dari 1</p>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()">Cetak Laporan</button>
    </div>
</body>
</html> 