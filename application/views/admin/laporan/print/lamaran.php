<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Pelamar</th>
            <th>Lowongan</th>
            <th>Status</th>
            <th>Tanggal Lamaran</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($lamaran as $application) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $application->pelamar_nama ?></td>
            <td><?= $application->lowongan_judul ?></td>
            <td>
                <?php
                $status_text = '';
                switch($application->status) {
                    case 'pending':
                        $status_text = 'Pending';
                        break;
                    case 'direview':
                        $status_text = 'Direview';
                        break;
                    case 'seleksi':
                        $status_text = 'Seleksi';
                        break;
                    case 'wawancara':
                        $status_text = 'Wawancara';
                        break;
                    case 'diterima':
                        $status_text = 'Diterima';
                        break;
                    case 'ditolak':
                        $status_text = 'Ditolak';
                        break;
                    default:
                        $status_text = ucfirst($application->status);
                }
                echo $status_text;
                ?>
            </td>
            <td><?= date('d/m/Y H:i', strtotime($application->tanggal_lamaran)) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table> 