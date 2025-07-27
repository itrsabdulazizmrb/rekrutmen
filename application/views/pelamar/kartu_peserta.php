<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Peserta Ujian</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .kartu-container { border: 2px solid #000; padding: 24px; width: 800px; margin: 30px auto; background: #fff; }
        .kartu-header { display: flex; justify-content: space-between; align-items: center; }
        .kartu-header img.logo { height: 50px; }
        .kartu-title { text-align: center; margin: 16px 0 24px 0; }
        .kartu-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        .kartu-table td { border: 1px solid #000; padding: 8px 12px; font-size: 16px; }
        .kartu-foto { width: 140px; height: 180px; object-fit: cover; border: 1px solid #000; }
        .kartu-footer { margin-top: 24px; display: flex; justify-content: space-between; align-items: flex-end; }
        .qr-code { width: 120px; height: 120px; }
        .ttd { text-align: right; margin-top: 40px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
<div class="kartu-container">
    <div class="kartu-header" style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
        <div style="display:flex; align-items:center; gap:24px;">
            <img src="<?= base_url('assets/img/logos/mastercard.png') ?>" class="logo" alt="Logo" />
            <div style="display:flex; flex-direction:column; align-items:flex-start;">
                <h2 style="margin:0; padding:0; font-size:2rem;">KARTU PESERTA UJIAN</h2>
                <div style="font-size:18px; font-weight:bold; margin-top:2px;">REKRUTMEN RSUD H. ABDUL AZIZ MARABAHAN</div>
            </div>
        </div>
        <div style="text-align:right; font-size:12px;">Tanggal Cetak: <?= date('d-m-Y') ?></div>
    </div>
    <table class="kartu-table" style="margin-bottom:16px;">
        <tr>
            <td style="width:160px;">No Peserta</td>
            <td><b><?= $no_peserta ?></b></td>
            <td rowspan="8" style="text-align:center; vertical-align:top; width:160px;">
                <img src="<?= base_url('uploads/profile_pictures/' . $foto_profil) ?>" class="kartu-foto" alt="Foto Peserta" style="margin-bottom:12px;" />
                <br />
                <?php
                // Generate QR code menggunakan goqr.me API
                if (!empty($qr_data)) {
                    $qr_url = 'https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=' . urlencode($qr_data);
                    echo '<img src="' . $qr_url . '" class="qr-code" alt="QR Code" style="margin-top:8px;" />';
                } else {
                    echo '<div style="color:red; font-size:14px; margin-top:8px;">QR code tidak tersedia (data kosong)</div>';
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><?= $nama ?></td>
        </tr>
        <tr>
            <td>Tanggal Ujian</td>
            <td><?= date('d-m-Y', strtotime($tanggal_ujian)) ?></td>
        </tr>
        <tr>
            <td>Tgl. Lahir</td>
            <td><?= date('d-m-Y', strtotime($tanggal_lahir)) ?></td>
        </tr>
        <tr>
            <td>No. Telepon</td>
            <td><?= $telepon ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td><?= $jenis_kelamin ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><?= $alamat ?></td>
        </tr>
    </table>
    
    <div style="margin-top:8px; font-size:12px; text-align:left;">
        
        <span style="color:#d00; font-weight:bold;">* Kartu ini wajib dibawa saat ujian dan ditunjukkan pada petugas.<br>* Wajib membawa identitas diri asli saat ujian berlangsung.</span>
    </div>
    <div class="ttd" style="margin-top:32px;">
        <div style="font-size:14px;">Tanda Tangan Panitia Ujian</div>
        <div style="height:60px;"></div>
        <div style="font-size:14px; font-weight:bold;">&nbsp;</div>
    </div>
    <button class="no-print" onclick="window.print()" style="margin-top:20px;">Cetak Kartu</button>
</div>
</body>
</html> 