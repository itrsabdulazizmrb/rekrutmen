<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Pelamar</th>
            <th>Penilaian</th>
            <th>Lowongan</th>
            <th>Skor</th>
            <th>Status</th>
            <th>Waktu Pengerjaan</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($hasil_penilaian as $result) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $result->pelamar_nama ?></td>
            <td><?= $result->penilaian_judul ?></td>
            <td><?= $result->lowongan_judul ?: '-' ?></td>
            <td>
                <?php if ($result->status == 'selesai') : ?>
                    <?= $result->nilai ?>
                <?php else : ?>
                    -
                <?php endif; ?>
            </td>
            <td>
                <?php
                $status_text = '';
                switch($result->status) {
                    case 'pending':
                        $status_text = 'Pending';
                        break;
                    case 'sedang_dikerjakan':
                        $status_text = 'Sedang Dikerjakan';
                        break;
                    case 'selesai':
                        $status_text = 'Selesai';
                        break;
                    default:
                        $status_text = ucfirst($result->status);
                }
                echo $status_text;
                ?>
            </td>
            <td>
                <?php if ($result->waktu_pengerjaan) : ?>
                    <?= $result->waktu_pengerjaan ?> menit
                <?php else : ?>
                    -
                <?php endif; ?>
            </td>
            <td><?= date('d/m/Y H:i', strtotime($result->tanggal_mulai)) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table> 