<?php

include 'Device.php';
include 'MobileDetect.php';

$m = new MobileDetect(array(
    'HTTP_USER_AGENT' => "yo yo yo",
    'HTTP_TE' => "why?",
    'HTTP_HOST' => 'huh?',
    'HTTP_garbage' => 'junk',
    'HTTP_ACCEPT' => '*/*',
    'HTTP_COOKIE' => 'blah=hello; yes=no;'
));

var_dump($m);