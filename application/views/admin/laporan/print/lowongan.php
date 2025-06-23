<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Lowongan</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Status</th>
            <th>Tanggal Dibuat</th>
            <th>Batas Waktu</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($lowongan as $job) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $job->judul ?></td>
            <td><?= $job->kategori_nama ?: 'Tidak ada kategori' ?></td>
            <td><?= $job->lokasi ?></td>
            <td>
                <?php if ($job->status == 'aktif') : ?>
                    Aktif
                <?php elseif ($job->status == 'nonaktif') : ?>
                    Nonaktif
                <?php else : ?>
                    Expired
                <?php endif; ?>
            </td>
            <td><?= date('d/m/Y', strtotime($job->dibuat_pada)) ?></td>
            <td><?= date('d/m/Y', strtotime($job->batas_waktu)) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table> 