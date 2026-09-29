<?php
$zip = new ZipArchive();
if ($zip->open('public/excel/data_mhs.xlsx') === TRUE) {
    $sharedStringsXml = $zip->getFromName('xl/sharedStrings.xml');
    preg_match_all('/<t[^>]*>(.*?)<\/t>/s', $sharedStringsXml, $matches);
    $strings = $matches[1];
    echo "Total strings: " . count($strings) . "\n";
    echo "Sample strings:\n";
    print_r(array_slice($strings, 0, 30));
    $zip->close();
} else {
    echo "Failed to open zip";
}
