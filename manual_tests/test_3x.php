<?php
error_reporting(E_ALL && ~E_NOTICE);
include_once '../Mobile_Detect.php';
include_once 'mobilePerVendor_useragents.inc.php';

$detect = new Mobile_Detect;

$readyVendors = array('Apple', 'Google', 'HTC');

$html = '
<style type="text/css">
    #results { border-collapse:collapse; }
    #results th, #results td { font-size:10px; font-family:Arial; border: 1px solid #ccc; }
</style>
';

$html .= '<table id="results" class="tablesorter" cellspacing="0" cellpadding="0">';
    $html .= '
<thead>
    <tr>
        <th width="50%">User-Agent</th>
        <th>deviceType</th>
        <th>deviceVendor</th>
        <th>deviceModel</th>
        <th>os</th>
        <th>osVer</th>
        <th>browser</th>
        <th>browserVer</th>
    </tr>
</thead>
<tbody>';

foreach($mobilePerVendor_userAgents as $brand => $deviceArr){

    if(!in_array($brand, $readyVendors)){ continue; }

    foreach($deviceArr as $userAgent => $conditions){

        $userAgentString = ( is_array($conditions) ? $userAgent : $conditions );
        $detect->setUserAgent($userAgentString);
        $what = null;
        $what = $detect->what();

        $html .= '<tr>';
            $html .= '<td>'.$userAgentString.'</td>';

            $html .= '<td>'.$what['deviceType'].'</td>';
            $html .= '<td>'.$what['deviceVendor'].'</td>';
            $html .= '<td>'.$what['deviceModel'].'</td>';
            $html .= '<td>'.$what['os'].'</td>';
            $html .= '<td>'.$what['osVer'].'</td>';
            $html .= '<td>'.$what['browser'].'</td>';
            $html .= '<td>'.$what['browserVer'].'</td>';

        $html .= '</tr>';

    }

}

$html .= '</tbody></table>';

echo $html;
