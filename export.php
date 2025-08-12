<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Koneksi database
$conn = new mysqli("localhost", "root", "1234", "gudang_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari tabel
$sql = "SELECT * FROM barang";
$result = $conn->query($sql);

// Buat spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Ambil nama kolom untuk header
$fields = $result->fetch_fields();
$col = 'A';
foreach ($fields as $field) {
    $sheet->setCellValue($col . '1', $field->name);
    $col++;
}

// Isi data baris
$rowNum = 2;
$result->data_seek(0); // reset pointer hasil query
while ($row = $result->fetch_assoc()) {
    $col = 'A';
    foreach ($row as $cell) {
        $sheet->setCellValue($col . $rowNum, $cell);
        $col++;
    }
    $rowNum++;
}

// Output langsung sebagai file Excel ke browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="tabel_users.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
