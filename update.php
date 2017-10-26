<?php
$data = json_decode(file_get_contents("https://raw.githubusercontent.com/Fyrd/caniuse/master/fulldata-json/data-2.0.json"), true);
$browsers = $data["agents"];

$fp = fopen('browsers.json', 'w');
fwrite($fp,json_encode($browsers));
fclose($fp);


$before = file_get_contents("analytics.txt");
$after = file_get_contents("newanalytics.txt");

$fa = fopen('analytics.txt', 'w');
fwrite($fa,$before . PHP_EOL . $after);
fclose($fa);

$fna = fopen('newanalytics.txt', 'w');
fwrite($fna,"");
fclose($fna);