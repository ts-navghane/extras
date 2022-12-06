<?php

declare(strict_types=1);

if (1 === $argc) {
    die('Please provide inputs');
}

[$fileName, $time, $from, $to] = $argv;

$fromDateTime      = new \DateTime($time, new \DateTimeZone($from));
$cloneFromDateTime = clone $fromDateTime;
$fromDateTime->setTimezone(new \DateTimeZone($to));

print_r($cloneFromDateTime);
print_r($fromDateTime);
