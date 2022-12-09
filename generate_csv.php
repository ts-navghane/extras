<?php

declare(strict_types=1);

$short_options = "n:";   // Required value, no of rows
$short_options .= "m::"; // Optional value, mode of the file

$long_options = [
    "no_of_rows:", // Required value, no of rows
    "mode::",      // Optional value, mode of the file
];

$options = getopt($short_options, $long_options);

if (isset($options['n']) || isset($options['no_of_rows'])) {
    $totalNoRows = $options['n'] ?? $options['no_of_rows'];
} else {
    die('Please enter no. of rows!'.PHP_EOL);
}

$start = microtime(true);
$mode  = $options['m'] ?? $options['mode'] ?? 'a';

$file      = fopen('test_'.$totalNoRows.'.csv', $mode.'b+');
$batchSize = 10000;

if ($totalNoRows <= 0) {
    die('Please enter positive number!'.PHP_EOL);
}

if ($totalNoRows <= $batchSize) {
    $batchSize = $totalNoRows;
}

$loopTimes = ceil($totalNoRows / $batchSize);

for ($j = 1; $j <= $loopTimes; $j++) {
    $result = [];
    for ($i = 1; $i <= $batchSize; ++$i) {
        $result[] = [
            'id'        => $i,
            'firstname' => 'John'.$i,
            'lastname'  => 'Doe'.$i,
            'email'     => 'john.doe'.$i.'@mailtest.mautic.com',
        ];
        fputcsv($file, $result[$i - 1]);
    }
}
fclose($file);

echo 'Time required: '.(microtime(true) - $start).' seconds.'.PHP_EOL;
