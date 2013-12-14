<?php

include 'Mobile_Detect.php';

$phones = Mobile_Detect::getPhoneDevices();
$browsers = Mobile_Detect::getBrowsers();
$oses = Mobile_Detect::getOperatingSystems();
$tablets = Mobile_Detect::getTabletDevices();
$uas = Mobile_Detect::getUserAgents();
$utilities = Mobile_Detect::getUtilities();

$devices = array();

$devices['phoneDevices'] = array();
$devices['tabletDevices'] = array();
$devices['browsers'] = array();
$devices['operatingSystems'] = array();
$devices['utilities'] = array();

foreach ($phones as $phone => $regex) {
    $devices['phoneDevices'][$phone] = array(
        'regex' => $regex,
        'matchType' => 'regex',
        'model' => array(),
        'property' => array()
    );
}

foreach ($tablets as $tablet => $regex) {
    $devices['tabletDevices'][$phone] = array(
        'regex' => $regex,
        'matchType' => 'regex',
        'model' => array(),
        'property' => array()
    );
}

foreach ($browsers as $browser => $regex) {
    $devices['browsers'][$browser] = array(
        'regex' => $regex,
        'matchType' => 'regex',
        'model' => array(),
        'property' => array()
    );
}

foreach ($oses as $os => $regex) {
    $devices['operatingSystems'][$os] = array(
        'regex' => $regex,
        'matchType' => 'regex'
    );
}

foreach ($utilities as $utility => $regex) {
    $devices['utilities'][$utility] = array(
        'regex' => $regex,
        'matchType' => 'regex',
        'bot' => stripos($utility, 'bot') !== false,//marked for "unknown" but should be true or false
    );
}

$arrayOpen = 'array(';
$arrayClose = ')';
$res = '';
$baseTabs = 2;

$res .= $arrayOpen . "\n";

foreach ($devices as $deviceType => $subDevices) {
    $res .= getTabSpace($baseTabs) . str_pad("'$deviceType'", 20 ) . '=> ' . $arrayOpen . "\n";

    foreach ($subDevices as $name => $params) {
        $res .= getTabSpace($baseTabs+1) . str_pad("'$name'", 20) . '=> ';
        $res .= $arrayOpen . "\n";

        foreach ($params as $subKey => $subVal) {
            $res .= getTabSpace($baseTabs+2) . str_pad("'$subKey'", 20) . '=> ';
            if (is_array($subVal)) {
                $res .= $arrayOpen . $arrayClose . ',';//@todo nothing to do here because these are ALWAYS empty
            } elseif (is_null($subVal)) {
                $res .= "null,";
            }
            else {
                $res .= str_replace('\\\\', '\\', var_export($subVal, true)) . ',';
            }
            $res .= "\n";
        }

        $res .= getTabSpace($baseTabs+1) . $arrayClose . ",\n";
        $res .= "\n";
    }

    $res .= getTabSpace($baseTabs) . $arrayClose . ",\n";
}

$res .= getTabSpace(1) . $arrayClose . ";\n";

$mobileDetect = file_get_contents('MobileDetect.php');

list($pre, $post) = explode('//MARKER_START', $mobileDetect);
list($body, $post) = explode('//MARKER_END', $post);

$pre = trim($pre);
$post = getTabSpace(1) . trim($post) . "\n";

$mobileDetect = $pre . "\n" . getTabSpace(1) . '//MARKER_START' . "\n";
$mobileDetect .= getTabSpace(1) . 'protected static $items = ';
$mobileDetect .= $res;
$mobileDetect .= getTabSpace(1) . "//MARKER_END" . "\n" . $post;
file_put_contents('MobileDetect.php', $mobileDetect);

function getTabSpace($tabs, $tabWidth = 4, $tabChar = ' ') {
    return str_repeat($tabChar, $tabWidth * $tabs);
}
