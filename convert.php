<?php

declare(strict_types=1);

$short_options = "i:";  // Required value, time
$short_options .= "f:"; // Required value, from time zone
$short_options .= "t:"; // Required value, to time zone

$long_options = [
    "time:",    // Required value, time
    "from_tz:", // Required value, from time zone
    "to_tz:",   // Required value, to time zone
];

$options = getopt($short_options, $long_options);

$time   = $options['i'] ?? $options['time'] ?? null;
$fromTz = $options['f'] ?? $options['from_tz'] ?? null;
$toTz   = $options['t'] ?? $options['to_tz'] ?? null;

if (!$time || !$fromTz || !$toTz) {
    die('Please enter inputs!'.PHP_EOL);
}

$fromDateTime      = new DateTime($time, new DateTimeZone($fromTz));
$cloneFromDateTime = clone $fromDateTime;
$fromDateTime->setTimezone(new DateTimeZone($toTz));

print_r($cloneFromDateTime);
print_r($fromDateTime);
