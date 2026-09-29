<?php
$zip = new ZipArchive();
if ($zip->open('public/excel/data_mhs.xlsx') === TRUE) {
    $sharedStringsXml = $zip->getFromName('xl/sharedStrings.xml');
    preg_match_all('/<t[^>]*>(.*?)<\/t>/s', $sharedStringsXml, $matches);
    $strings = $matches[1];
    
    $npms = [];
    foreach ($strings as $str) {
        $str = trim($str);
        if (preg_match('/^06\.\d{4}\.\d{1}\.\d{5}$/', $str)) {
            $npms[] = $str;
        }
    }
    
    echo "Total NPMs found matching 06.XXXX.X.XXXXX: " . count($npms) . "\n";
    echo "Sample NPMs:\n";
    print_r(array_slice($npms, 0, 20));
    $zip->close();
}
