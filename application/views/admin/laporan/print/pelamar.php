<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Pendidikan</th>
            <th>Total Lamaran</th>
            <th>Tanggal Daftar</th>
            <th>Last Login</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($pelamar as $applicant) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $applicant->nama_lengkap ?></td>
            <td><?= $applicant->email ?></td>
            <td><?= $applicant->pendidikan ?: '-' ?></td>
            <td><?= $applicant->total_lamaran ?></td>
            <td><?= date('d/m/Y', strtotime($applicant->dibuat_pada)) ?></td>
            <td>
                <?= $applicant->login_terakhir ? date('d/m/Y H:i', strtotime($applicant->login_terakhir)) : 'Belum pernah' ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table> 