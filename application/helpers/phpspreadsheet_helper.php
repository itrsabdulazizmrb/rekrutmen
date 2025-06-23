<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PhpSpreadsheet Helper
 *
 * This helper provides functions to work with PhpSpreadsheet library
 */

// Make sure the autoloader is included
if (!function_exists('load_phpspreadsheet')) {
    /**
     * Load PhpSpreadsheet library
     *
     * @return bool
     */
    function load_phpspreadsheet() {
        // Path to the autoloader
        $autoloader_path = FCPATH . 'vendor/autoload.php';
        
        // Check if the autoloader exists
        if (file_exists($autoloader_path)) {
            // Include the autoloader
            require_once $autoloader_path;
            
            // Check if the Spreadsheet class exists
            if (class_exists('PhpOffice\PhpSpreadsheet\Spreadsheet')) {
                return TRUE;
            }
        }
        
        // If we got here, something went wrong
        log_message('error', 'PhpSpreadsheet library could not be loaded');
        return FALSE;
    }
}

if (!function_exists('create_excel_template')) {
    /**
     * Create an Excel template for question import
     *
     * @param string $assessment_name
     * @param int|null $assessment_id
     * @return \PhpOffice\PhpSpreadsheet\Spreadsheet
     */
    function create_excel_template($assessment_name, $assessment_id = NULL) {
        // Load PhpSpreadsheet
        load_phpspreadsheet();
        
        // Create a new Spreadsheet object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set title
        $sheet->setTitle('Soal Pilihan Ganda');
        
        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(50);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(25);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(10);
        
        // Set header
        $sheet->setCellValue('A1', 'TEMPLATE IMPORT SOAL PILIHAN GANDA');
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        if ($assessment_id) {
            $sheet->setCellValue('A2', 'Penilaian: ' . $assessment_name);
            $sheet->mergeCells('A2:H2');
            $sheet->getStyle('A2')->getFont()->setBold(true);
            $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        }
        
        // Set table header
        $headerRow = $assessment_id ? 4 : 3;
        $sheet->setCellValue('A' . $headerRow, 'No');
        $sheet->setCellValue('B' . $headerRow, 'Pertanyaan');
        $sheet->setCellValue('C' . $headerRow, 'Opsi A');
        $sheet->setCellValue('D' . $headerRow, 'Opsi B');
        $sheet->setCellValue('E' . $headerRow, 'Opsi C');
        $sheet->setCellValue('F' . $headerRow, 'Opsi D');
        $sheet->setCellValue('G' . $headerRow, 'Kunci Jawaban');
        $sheet->setCellValue('H' . $headerRow, 'Bobot');
        
        // Style header
        $headerStyle = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'E2EFDA',
                ],
            ],
        ];
        
        $sheet->getStyle('A' . $headerRow . ':H' . $headerRow)->applyFromArray($headerStyle);
        
        // Add example rows
        $startRow = $headerRow + 1;
        for ($i = 0; $i < 5; $i++) {
            $row = $startRow + $i;
            $sheet->setCellValue('A' . $row, $i + 1);
            $sheet->setCellValue('B' . $row, 'Contoh pertanyaan ' . ($i + 1));
            $sheet->setCellValue('C' . $row, 'Opsi A');
            $sheet->setCellValue('D' . $row, 'Opsi B');
            $sheet->setCellValue('E' . $row, 'Opsi C');
            $sheet->setCellValue('F' . $row, 'Opsi D');
            $sheet->setCellValue('G' . $row, 'A');
            $sheet->setCellValue('H' . $row, '1');
        }
        
        // Style example rows
        $rowStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        
        $sheet->getStyle('A' . $startRow . ':H' . ($startRow + 4))->applyFromArray($rowStyle);
        
        // Add data validation for answer key
        $validation = $sheet->getDataValidation('G' . $startRow . ':G100');
        $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
        $validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION);
        $validation->setAllowBlank(false);
        $validation->setShowInputMessage(true);
        $validation->setShowErrorMessage(true);
        $validation->setShowDropDown(true);
        $validation->setFormula1('"A,B,C,D"');
        $validation->setPromptTitle('Kunci Jawaban');
        $validation->setPrompt('Pilih salah satu: A, B, C, atau D');
        $validation->setErrorTitle('Input salah');
        $validation->setError('Nilai harus salah satu dari: A, B, C, atau D');
        
        // Add data validation for points
        $validation = $sheet->getDataValidation('H' . $startRow . ':H100');
        $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_WHOLE);
        $validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION);
        $validation->setAllowBlank(false);
        $validation->setShowInputMessage(true);
        $validation->setShowErrorMessage(true);
        $validation->setFormula1('1');
        $validation->setFormula2('10');
        $validation->setPromptTitle('Bobot Soal');
        $validation->setPrompt('Masukkan nilai antara 1-10');
        $validation->setErrorTitle('Input salah');
        $validation->setError('Nilai harus berupa angka antara 1-10');
        
        return $spreadsheet;
    }
}

if (!function_exists('download_excel_file')) {
    /**
     * Download an Excel file
     *
     * @param \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @param string $filename
     */
    function download_excel_file($spreadsheet, $filename) {
        // Create Excel writer
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        
        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Save to output
        $writer->save('php://output');
        exit;
    }
}
