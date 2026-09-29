<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = IOFactory::load('public/excel/data_mhs.xlsx');
$sheet = $spreadsheet->getActiveSheet();
$rows = $sheet->toArray();
print_r(array_slice($rows, 0, 10));
