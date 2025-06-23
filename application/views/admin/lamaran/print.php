<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Lamaran - <?= $application->applicant_name ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #2c3e50;
        }

        .header h2 {
            margin: 5px 0 0 0;
            font-size: 16px;
            color: #7f8c8d;
            font-weight: normal;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            border-bottom: 1px solid #bdc3c7;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .info-grid {
            display: table;
            width: 100%;
        }

        .info-row {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            width: 150px;
            font-weight: bold;
            padding: 5px 10px 5px 0;
            vertical-align: top;
        }

        .info-value {
            display: table-cell;
            padding: 5px 0;
            vertical-align: top;
        }

        .status {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status.pending { background-color: #f39c12; color: white; }
        .status.reviewed { background-color: #3498db; color: white; }
        .status.interview { background-color: #9b59b6; color: white; }
        .status.diterima { background-color: #27ae60; color: white; }
        .status.ditolak { background-color: #e74c3c; color: white; }

        .cover-letter {
            background-color: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #3498db;
            margin: 15px 0;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #7f8c8d;
            border-top: 1px solid #bdc3c7;
            padding-top: 15px;
        }

        @media print {
            body { margin: 0; padding: 15px; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SISTEM REKRUTMEN</h1>
        <h2>Laporan Detail Lamaran</h2>
    </div>

    <div class="section">
        <div class="section-title">Informasi Pelamar</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Nama Lengkap:</div>
                <div class="info-value"><?= $application->applicant_name ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value"><?= $application->applicant_email ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Telepon:</div>
                <div class="info-value"><?= $profile->telepon ?? 'Tidak tersedia' ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Alamat:</div>
                <div class="info-value"><?= $profile->alamat ?? 'Tidak tersedia' ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Tanggal Lahir:</div>
                <div class="info-value"><?= $profile->tanggal_lahir ? date('d F Y', strtotime($profile->tanggal_lahir)) : 'Tidak tersedia' ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Jenis Kelamin:</div>
                <div class="info-value"><?= $profile->jenis_kelamin ? ucfirst($profile->jenis_kelamin) : 'Tidak tersedia' ?></div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Informasi Lowongan</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Judul Lowongan:</div>
                <div class="info-value"><?= $job->judul ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Lokasi:</div>
                <div class="info-value"><?= $job->lokasi ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Jenis Pekerjaan:</div>
                <div class="info-value"><?= $job->jenis_pekerjaan ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Kategori:</div>
                <div class="info-value"><?= $job->nama_kategori ?? 'Tidak dikategorikan' ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Batas Waktu:</div>
                <div class="info-value"><?= date('d F Y', strtotime($job->batas_waktu)) ?></div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Detail Lamaran</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Tanggal Lamaran:</div>
                <div class="info-value"><?= date('d F Y H:i', strtotime($application->tanggal_lamaran)) ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Status:</div>
                <div class="info-value">
                    <span class="status <?= $application->status ?>">
                        <?= $application->status == 'pending' ? 'Pending' :
                            ($application->status == 'reviewed' ? 'Direview' :
                            ($application->status == 'interview' ? 'Wawancara' :
                            ($application->status == 'diterima' ? 'Diterima' : 'Ditolak'))) ?>
                    </span>
                </div>
            </div>
            <?php if ($application->catatan_admin) : ?>
            <div class="info-row">
                <div class="info-label">Catatan Admin:</div>
                <div class="info-value"><?= nl2br($application->catatan_admin) ?></div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($application->surat_lamaran) : ?>
    <div class="section">
        <div class="section-title">Surat Lamaran</div>
        <div class="cover-letter">
            <?= nl2br($application->surat_lamaran) ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="section">
        <div class="section-title">Pendidikan</div>
        <div class="info-value">
            <?= $profile->pendidikan ? nl2br($profile->pendidikan) : 'Tidak tersedia' ?>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Pengalaman Kerja</div>
        <div class="info-value">
            <?= $profile->pengalaman ? nl2br($profile->pengalaman) : 'Tidak tersedia' ?>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Keterampilan</div>
        <div class="info-value">
            <?= $profile->keahlian ?? 'Tidak tersedia' ?>
        </div>
    </div>

    <div class="footer">
        <p>Dicetak pada: <?= date('d F Y H:i:s') ?></p>
        <p>Sistem Rekrutmen - <?= base_url() ?></p>
    </div>

    <?php if (isset($application->cv) && $application->cv) : ?>
    <div class="section">
        <div class="section-title">CV/Resume</div>
        <div class="info-value">
            <p><strong>File CV:</strong> <?= $application->cv ?></p>
            <p><em>File CV dapat diunduh melalui sistem untuk review lebih lanjut.</em></p>
        </div>
    </div>
    <?php endif; ?>

    <script>
        
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
