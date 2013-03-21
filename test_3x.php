<?php
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;

$detect->setUserAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 6_0_1 like Mac OS X; da-dk) AppleWebKit/534.46.0 (KHTML, like Gecko) CriOS/21.0.1180.82 Mobile/10A523 Safari/7534.48.3');

echo '<pre>' . print_r($detect->what(), true) . '</pre>';
