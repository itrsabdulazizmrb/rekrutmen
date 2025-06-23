<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Fonnte Helper
 *
 * Helper functions for sending WhatsApp messages using the Fonnte API
 */

if (!function_exists('kirim_whatsapp')) {
    /**
     * Send a WhatsApp message using Fonnte API
     *
     * @param string $phone_number The recipient's phone number (with country code, no + or spaces)
     * @param string $message The message to send
     * @param string $api_key The Fonnte API key (default is the one provided)
     * @return array Response from the API
     */
    function kirim_whatsapp($phone_number, $message, $api_key = 'nFi7goGNVJiG25gCbL7k') {
        // Clean the phone number (remove spaces, +, etc.)
        $phone_number = preg_replace('/[^0-9]/', '', $phone_number);

        // Add country code if not present (assuming Indonesia)
        if (substr($phone_number, 0, 2) !== '62') {
            // If number starts with 0, replace it with 62
            if (substr($phone_number, 0, 1) === '0') {
                $phone_number = '62' . substr($phone_number, 1);
            } else {
                $phone_number = '62' . $phone_number;
            }
        }

        // Prepare the data for the API request
        $data = [
            'target' => $phone_number,
            'message' => $message,
        ];

        // Initialize cURL
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                'Authorization: ' . $api_key
            ],
        ]);

        // Execute the request
        $response = curl_exec($curl);

        // Check for errors
        $error = null;
        if (curl_errno($curl)) {
            $error = curl_error($curl);
        }

        // Close cURL
        curl_close($curl);

        // Parse the response
        $result = json_decode($response, true);

        // Return the result
        return [
            'success' => isset($result['status']) && $result['status'] === true,
            'message' => isset($result['message']) ? $result['message'] : null,
            'error' => $error,
            'response' => $result
        ];
    }
}

if (!function_exists('dapatkan_pesan_status_lamaran')) {
    /**
     * Get the appropriate message for an application status change
     *
     * @param string $status The new application status
     * @param string $job_title The job title
     * @param string $applicant_name The applicant's name
     * @return string The message to send
     */
    function dapatkan_pesan_status_lamaran($status, $job_title, $applicant_name) {
        // Informasi perusahaan
        $nama = 'Gallery Kembang Ilung';
        $logo = '🌸'; 
        $kontak = [
            'phone' => '+62 812 0000 0000',
            'email' => 'gallerykembangilung@mail.com'
        ];
        $alamat = 'Desa Banyu Hirang, Kecamatan Amuntai Selatan, Kabupaten Hulu Sungai Tengah, Kalimantan Selatan';

        // Tanggal perubahan status
        $current_date = date('d-m-Y H:i');

        // Header pesan yang sama untuk semua status
        $header = "*{$logo} {$nama} - NOTIFIKASI STATUS LAMARAN*\n\n";

        // Footer pesan yang sama untuk semua status
        $footer = "\n*Informasi Kontak HR:*\nTelepon: {$kontak['phone']}\nEmail: {$kontak['email']}\n\nJika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami.\n\n*{$nama}*\n{$alamat}\n\n_Pesan ini dikirim secara otomatis pada {$current_date}_";

        // Isi pesan berdasarkan status
        $messages = [
            'menunggu' => [
                'title' => '📋 STATUS: DALAM PROSES PENINJAUAN',
                'body' => "Halo *{$applicant_name}*,\n\nLamaran Anda untuk posisi *\"{$job_title}\"* telah kami terima dan saat ini sedang dalam proses peninjauan.\n\n*Tanggal Update:* {$current_date}\n\n*Langkah Selanjutnya:*\n1. Tim rekrutmen kami sedang meninjau lamaran Anda\n2. Kami akan menghubungi Anda kembali dalam 3-5 hari kerja\n3. Silakan periksa email dan WhatsApp Anda secara berkala"
            ],

            'pending' => [
                'title' => '📋 STATUS: DALAM PROSES PENINJAUAN',
                'body' => "Halo *{$applicant_name}*,\n\nLamaran Anda untuk posisi *\"{$job_title}\"* telah kami terima dan saat ini sedang dalam proses peninjauan.\n\n*Tanggal Update:* {$current_date}\n\n*Langkah Selanjutnya:*\n1. Tim rekrutmen kami sedang meninjau lamaran Anda\n2. Kami akan menghubungi Anda kembali dalam 3-5 hari kerja\n3. Silakan periksa email dan WhatsApp Anda secara berkala"
            ],

            'direview' => [
                'title' => '🔍 STATUS: SEDANG DIREVIEW',
                'body' => "Halo *{$applicant_name}*,\n\nLamaran Anda untuk posisi *\"{$job_title}\"* sedang dalam proses review oleh tim HR.\n\n*Tanggal Update:* {$current_date}\n\n*Status Saat Ini:* Tim HR sedang mengevaluasi kualifikasi dan pengalaman Anda.\n\n*Langkah Selanjutnya:*\n1. Proses review akan memakan waktu 2-3 hari kerja\n2. Pastikan dokumen yang Anda kirimkan lengkap dan dapat diakses\n3. Kami akan menghubungi Anda jika memerlukan informasi tambahan"
            ],

            'reviewed' => [
                'title' => '🔍 STATUS: TELAH DITINJAU',
                'body' => "Halo *{$applicant_name}*,\n\nLamaran Anda untuk posisi *\"{$job_title}\"* telah selesai ditinjau oleh tim rekrutmen kami.\n\n*Tanggal Update:* {$current_date}\n\n*Langkah Selanjutnya:*\n1. Tim rekrutmen sedang mengevaluasi semua lamaran yang masuk\n2. Kandidat yang terpilih akan dihubungi untuk tahap selanjutnya dalam 5-7 hari kerja\n3. Silakan persiapkan dokumen tambahan jika diperlukan"
            ],

            'seleksi' => [
                'title' => '📝 STATUS: TAHAP SELEKSI',
                'body' => "Halo *{$applicant_name}*,\n\nSelamat! Lamaran Anda untuk posisi *\"{$job_title}\"* telah lolos tahap review awal.\n\n*Tanggal Update:* {$current_date}\n\n*Status Saat Ini:* Anda akan mengikuti tahap seleksi lebih lanjut.\n\n*Langkah Selanjutnya:*\n1. Anda mungkin akan diminta mengikuti tes atau assessment online\n2. Siapkan waktu untuk mengikuti proses seleksi dalam 3-7 hari kerja\n3. Pastikan koneksi internet stabil jika ada tes online\n4. Tim HR akan menghubungi Anda dengan detail lebih lanjut"
            ],

            'shortlisted' => [
                'title' => '⭐ STATUS: MASUK DAFTAR KANDIDAT TERPILIH',
                'body' => "Halo *{$applicant_name}*,\n\nSelamat! Lamaran Anda untuk posisi *\"{$job_title}\"* telah masuk dalam daftar kandidat terpilih.\n\n*Tanggal Update:* {$current_date}\n\n*Langkah Selanjutnya:*\n1. Tim rekrutmen akan menghubungi Anda dalam 2-3 hari kerja untuk mengatur jadwal wawancara\n2. Siapkan dokumen pendukung seperti portofolio, sertifikat, dan referensi\n3. Pelajari lebih lanjut tentang perusahaan dan posisi yang Anda lamar"
            ],

            'wawancara' => [
                'title' => '🎯 STATUS: UNDANGAN WAWANCARA',
                'body' => "Halo *{$applicant_name}*,\n\nSelamat! Anda telah lolos tahap seleksi untuk posisi *\"{$job_title}\"*.\n\n*Tanggal Update:* {$current_date}\n\n*Status Saat Ini:* Anda diundang untuk mengikuti tahap wawancara.\n\n*Langkah Selanjutnya:*\n1. Tim HR akan menghubungi Anda dalam 1-2 hari kerja untuk mengatur jadwal wawancara\n2. Siapkan dokumen asli: KTP, Ijazah, Sertifikat, dan CV terbaru\n3. Pelajari profil dan deskripsi pekerjaan dengan baik"
            ],

            'interviewed' => [
                'title' => '🗣️ STATUS: TAHAP WAWANCARA',
                'body' => "Halo *{$applicant_name}*,\n\nKami ingin mengundang Anda untuk wawancara terkait lamaran Anda untuk posisi *\"{$job_title}\"*.\n\n*Tanggal Update:* {$current_date}\n\n*Langkah Selanjutnya:*\n1. Tim HR akan menghubungi Anda dalam 1-2 hari kerja untuk mengatur jadwal wawancara\n2. Siapkan dokumen identitas dan dokumen pendukung lainnya\n3. Pelajari informasi tentang perusahaan dan persiapkan pertanyaan yang ingin Anda ajukan"
            ],

            'offered' => [
                'title' => '🎉 STATUS: PENAWARAN KERJA',
                'body' => "Halo *{$applicant_name}*,\n\nSelamat! Kami dengan senang hati menawarkan Anda posisi *\"{$job_title}\"* di perusahaan kami.\n\n*Tanggal Update:* {$current_date}\n\n*Langkah Selanjutnya:*\n1. Tim HR akan menghubungi Anda dalam 1-2 hari kerja untuk membahas detail penawaran\n2. Siapkan dokumen-dokumen berikut: KTP, NPWP, Ijazah, dan dokumen pendukung lainnya\n3. Pelajari kontrak kerja yang akan dikirimkan melalui email"
            ],

            'diterima' => [
                'title' => '🌟 STATUS: DITERIMA',
                'body' => "Halo *{$applicant_name}*,\n\nSelamat! Anda telah resmi diterima untuk posisi *\"{$job_title}\"* di perusahaan kami. Kami sangat senang Anda akan bergabung dengan tim kami.\n\n*Tanggal Update:* {$current_date}\n\n*Langkah Selanjutnya:*\n1. Tim HR akan menghubungi Anda untuk proses onboarding\n2. Siapkan dokumen-dokumen berikut: KTP, NPWP, Ijazah, Rekening Bank, dan dokumen pendukung lainnya\n3. Harap hadir pada sesi orientasi karyawan baru sesuai jadwal yang akan diberikan"
            ],

            'hired' => [
                'title' => '🌟 STATUS: DITERIMA',
                'body' => "Halo *{$applicant_name}*,\n\nSelamat! Anda telah resmi diterima untuk posisi *\"{$job_title}\"* di perusahaan kami. Kami sangat senang Anda akan bergabung dengan tim kami.\n\n*Tanggal Update:* {$current_date}\n\n*Langkah Selanjutnya:*\n1. Tim HR akan menghubungi Anda untuk proses onboarding\n2. Siapkan dokumen-dokumen berikut: KTP, NPWP, Ijazah, Rekening Bank, dan dokumen pendukung lainnya\n3. Harap hadir pada sesi orientasi karyawan baru sesuai jadwal yang akan diberikan"
            ],

            'ditolak' => [
                'title' => '📝 STATUS: TIDAK TERPILIH',
                'body' => "Halo *{$applicant_name}*,\n\nTerima kasih atas minat Anda pada posisi *\"{$job_title}\"*. Setelah meninjau lamaran Anda dengan seksama, kami memutuskan untuk melanjutkan dengan kandidat lain yang lebih sesuai dengan kebutuhan kami saat ini.\n\n*Tanggal Update:* {$current_date}\n\n*Langkah Selanjutnya:*\n1. Anda dapat melamar untuk posisi lain yang sesuai dengan kualifikasi Anda di website kami\n2. Tingkatkan keterampilan dan pengalaman Anda untuk meningkatkan peluang di masa depan\n3. Pantau lowongan kerja baru di website kami"
            ],

            'rejected' => [
                'title' => '📝 STATUS: TIDAK TERPILIH',
                'body' => "Halo *{$applicant_name}*,\n\nTerima kasih atas minat Anda pada posisi *\"{$job_title}\"*. Setelah meninjau lamaran Anda dengan seksama, kami memutuskan untuk melanjutkan dengan kandidat lain yang lebih sesuai dengan kebutuhan kami saat ini.\n\n*Tanggal Update:* {$current_date}\n\n*Langkah Selanjutnya:*\n1. Anda dapat melamar untuk posisi lain yang sesuai dengan kualifikasi Anda di website kami\n2. Tingkatkan keterampilan dan pengalaman Anda untuk meningkatkan peluang di masa depan\n3. Pantau lowongan kerja baru di website kami"
            ]
        ];

        // Jika status tidak ditemukan, gunakan status menunggu
        $status_data = isset($messages[$status]) ? $messages[$status] : $messages['menunggu'];

        // Gabungkan semua bagian pesan
        $full_message = $header . $status_data['title'] . "\n\n" . $status_data['body'] . $footer;

        return $full_message;
    }
}
