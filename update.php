<?php
$data = json_decode(file_get_contents("https://raw.githubusercontent.com/Fyrd/caniuse/master/fulldata-json/data-2.0.json"), true);
$browsers = $data["agents"];

$fp = fopen('browsers.json', 'w');
fwrite($fp,json_encode($browsers));
fclose($fp);