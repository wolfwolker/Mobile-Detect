<?php
/**
 * MIT License
 * ===========
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 *
 * @author      Serban Ghita <serbanghita@gmail.com>
 *              Victor Stanciu <vic.stanciu@gmail.com> (until v.1.0)
 * @license     MIT License https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 * @link        Official page: http://mobiledetect.net
 *              GitHub Repository: https://github.com/serbanghita/Mobile-Detect
 *              Google Code Old Page: http://code.google.com/p/php-mobile-detect/
 */

class Mobile_Detect {

    protected $scriptVersion = '3.0.0';

    const VER = '([\w._]+)';
    const MODEL = '([\w_]+)';
    protected $what; // Cache array with the latest what() info.

    // External info.
    protected $userAgent = null;
    protected $httpHeaders = array();

    protected $userAgentHasChanged = false;

    // ==================================================================
    //
    // Constructor
    //
    // ------------------------------------------------------------------



    function __construct(){

        $this->setHttpHeaders();
        $this->setUserAgent();

    }

    // ==================================================================
    //
    // Core detection methods.
    //
    // ------------------------------------------------------------------

    function getItemProperties(){

        $properties = array(

            // Build properties.
            'Mobile'        => 'Mobile/[0-9a-z]+', // [a-z0-9]
            'Build'         => 'Build/[0-9a-z-_.]+', // [a-z0-9]
            'Version'       => 'Version/[0-9.]+',
            'VendorID'      => 'VendorID/[0-9]+',
            'Configuration' => 'Configuration/[a-z0-9.-]+', // insensitive
            'OS'            => 'OS [0-9._]+',
            'Profile'       => 'Profile/[a-z0-9.-]+', // insensitive
            'release'       => 'release/[0-9.]+',

            // Engine properties.
            'Gecko'         => 'Gecko/[0-9.]+',
            'Trident'       => 'Trident/[0-9.]+',
            'Presto'        => 'Presto/[0-9.]+',
            'AppleWebKit'   => 'AppleWebKit/[0-9.+]+'
        );

        return $properties;

    }

    function getItems(){


        $items = array(

            'mobile'   => array(

               'iPhone'     => array(
                                    'vendor'     => 'Apple',
                                    'match'     => '\biPhone.*Mobile|\biPod|\biTunes',
                                    'model'     => array('iPhone.*CPU[a-z ]+[VER]', 'iPod.*CPU[a-z ]+[VER]'),
                                    ),

               'Nexus'      => array(
                                    'vendor'    => 'Google',
                                    'match'     => 'Nexus One|Nexus S|Galaxy.*Nexus|Android.*Nexus.*Mobile',
                                    'model'     => array('Nexus [MODEL] Build', '[MODEL] Nexus')
                                    ),

               'HTC'        => array(
                                    'vendor'     => 'HTC',
                                    'match'     => 'HTC|HTC.*(Sensation|Evo|Vision|Explorer|6800|8100|8900|A7272|S510e|C110e|Legend|Desire|T8282)|APX515CKT|Qtek9090|APA9292KT|HD_mini|Sensation.*Z710e|PG86100|Z715e|Desire.*(A8181|HD)|ADR6200|ADR6425|001HT|Inspire 4G',
                                    'model'       => array('HTC.[MODEL]', 'HTC; [MODEL]', 'HTC/[MODEL]', ' [MODEL] Build'),
                                    ),

               'Samsung'    => array(
                                    'vendor'     => 'Samsung',
                                    'match'     => 'Samsung|BGT-S5230|GT-B2100|GT-B2700|GT-B2710|GT-B3210|GT-B3310|GT-B3410|GT-B3730|GT-B3740|GT-B5510|GT-B5512|GT-B5722|GT-B6520|GT-B7300|GT-B7320|GT-B7330|GT-B7350|GT-B7510|GT-B7722|GT-B7800|GT-C3010|GT-C3011|GT-C3060|GT-C3200|GT-C3212|GT-C3212I|GT-C3222|GT-C3300|GT-C3300K|GT-C3303|GT-C3303K|GT-C3310|GT-C3322|GT-C3330|GT-C3350|GT-C3500|GT-C3510|GT-C3530|GT-C3630|GT-C3780|GT-C5010|GT-C5212|GT-C6620|GT-C6625|GT-C6712|GT-E1050|GT-E1070|GT-E1075|GT-E1080|GT-E1081|GT-E1085|GT-E1087|GT-E1100|GT-E1107|GT-E1110|GT-E1120|GT-E1125|GT-E1130|GT-E1160|GT-E1170|GT-E1175|GT-E1180|GT-E1182|GT-E1200|GT-E1210|GT-E1225|GT-E1230|GT-E1390|GT-E2100|GT-E2120|GT-E2121|GT-E2152|GT-E2220|GT-E2222|GT-E2230|GT-E2232|GT-E2250|GT-E2370|GT-E2550|GT-E2652|GT-E3210|GT-E3213|GT-I5500|GT-I5503|GT-I5700|GT-I5800|GT-I5801|GT-I6410|GT-I6420|GT-I7110|GT-I7410|GT-I7500|GT-I8000|GT-I8150|GT-I8160|GT-I8320|GT-I8330|GT-I8350|GT-I8530|GT-I8700|GT-I8703|GT-I8910|GT-I9000|GT-I9001|GT-I9003|GT-I9010|GT-I9020|GT-I9023|GT-I9070|GT-I9100|GT-I9103|GT-I9220|GT-I9250|GT-I9300|GT-I9300 |GT-M3510|GT-M5650|GT-M7500|GT-M7600|GT-M7603|GT-M8800|GT-M8910|GT-N7000|GT-P6810|GT-P7100|GT-S3110|GT-S3310|GT-S3350|GT-S3353|GT-S3370|GT-S3650|GT-S3653|GT-S3770|GT-S3850|GT-S5210|GT-S5220|GT-S5229|GT-S5230|GT-S5233|GT-S5250|GT-S5253|GT-S5260|GT-S5263|GT-S5270|GT-S5300|GT-S5330|GT-S5350|GT-S5360|GT-S5363|GT-S5369|GT-S5380|GT-S5380D|GT-S5560|GT-S5570|GT-S5600|GT-S5603|GT-S5610|GT-S5620|GT-S5660|GT-S5670|GT-S5690|GT-S5750|GT-S5780|GT-S5830|GT-S5839|GT-S6102|GT-S6500|GT-S7070|GT-S7200|GT-S7220|GT-S7230|GT-S7233|GT-S7250|GT-S7500|GT-S7530|GT-S7550|GT-S8000|GT-S8003|GT-S8500|GT-S8530|GT-S8600|SCH-A310|SCH-A530|SCH-A570|SCH-A610|SCH-A630|SCH-A650|SCH-A790|SCH-A795|SCH-A850|SCH-A870|SCH-A890|SCH-A930|SCH-A950|SCH-A970|SCH-A990|SCH-I100|SCH-I110|SCH-I400|SCH-I405|SCH-I500|SCH-I510|SCH-I515|SCH-I600|SCH-I730|SCH-I760|SCH-I770|SCH-I830|SCH-I910|SCH-I920|SCH-LC11|SCH-N150|SCH-N300|SCH-R100|SCH-R300|SCH-R351|SCH-R400|SCH-R410|SCH-T300|SCH-U310|SCH-U320|SCH-U350|SCH-U360|SCH-U365|SCH-U370|SCH-U380|SCH-U410|SCH-U430|SCH-U450|SCH-U460|SCH-U470|SCH-U490|SCH-U540|SCH-U550|SCH-U620|SCH-U640|SCH-U650|SCH-U660|SCH-U700|SCH-U740|SCH-U750|SCH-U810|SCH-U820|SCH-U900|SCH-U940|SCH-U960|SCS-26UC|SGH-A107|SGH-A117|SGH-A127|SGH-A137|SGH-A157|SGH-A167|SGH-A177|SGH-A187|SGH-A197|SGH-A227|SGH-A237|SGH-A257|SGH-A437|SGH-A517|SGH-A597|SGH-A637|SGH-A657|SGH-A667|SGH-A687|SGH-A697|SGH-A707|SGH-A717|SGH-A727|SGH-A737|SGH-A747|SGH-A767|SGH-A777|SGH-A797|SGH-A817|SGH-A827|SGH-A837|SGH-A847|SGH-A867|SGH-A877|SGH-A887|SGH-A897|SGH-A927|SGH-B100|SGH-B130|SGH-B200|SGH-B220|SGH-C100|SGH-C110|SGH-C120|SGH-C130|SGH-C140|SGH-C160|SGH-C170|SGH-C180|SGH-C200|SGH-C207|SGH-C210|SGH-C225|SGH-C230|SGH-C417|SGH-C450|SGH-D307|SGH-D347|SGH-D357|SGH-D407|SGH-D415|SGH-D780|SGH-D807|SGH-D980|SGH-E105|SGH-E200|SGH-E315|SGH-E316|SGH-E317|SGH-E335|SGH-E590|SGH-E635|SGH-E715|SGH-E890|SGH-F300|SGH-F480|SGH-I200|SGH-I300|SGH-I320|SGH-I550|SGH-I577|SGH-I600|SGH-I607|SGH-I617|SGH-I627|SGH-I637|SGH-I677|SGH-I700|SGH-I717|SGH-I727|SGH-I777|SGH-I780|SGH-I827|SGH-I847|SGH-I857|SGH-I896|SGH-I897|SGH-I900|SGH-I907|SGH-I917|SGH-I927|SGH-I937|SGH-I997|SGH-J150|SGH-J200|SGH-L170|SGH-L700|SGH-M110|SGH-M150|SGH-M200|SGH-N105|SGH-N500|SGH-N600|SGH-N620|SGH-N625|SGH-N700|SGH-N710|SGH-P107|SGH-P207|SGH-P300|SGH-P310|SGH-P520|SGH-P735|SGH-P777|SGH-Q105|SGH-R210|SGH-R220|SGH-R225|SGH-S105|SGH-S307|SGH-T109|SGH-T119|SGH-T139|SGH-T209|SGH-T219|SGH-T229|SGH-T239|SGH-T249|SGH-T259|SGH-T309|SGH-T319|SGH-T329|SGH-T339|SGH-T349|SGH-T359|SGH-T369|SGH-T379|SGH-T409|SGH-T429|SGH-T439|SGH-T459|SGH-T469|SGH-T479|SGH-T499|SGH-T509|SGH-T519|SGH-T539|SGH-T559|SGH-T589|SGH-T609|SGH-T619|SGH-T629|SGH-T639|SGH-T659|SGH-T669|SGH-T679|SGH-T709|SGH-T719|SGH-T729|SGH-T739|SGH-T746|SGH-T749|SGH-T759|SGH-T769|SGH-T809|SGH-T819|SGH-T839|SGH-T919|SGH-T929|SGH-T939|SGH-T959|SGH-T989|SGH-U100|SGH-U200|SGH-U800|SGH-V205|SGH-V206|SGH-X100|SGH-X105|SGH-X120|SGH-X140|SGH-X426|SGH-X427|SGH-X475|SGH-X495|SGH-X497|SGH-X507|SGH-X600|SGH-X610|SGH-X620|SGH-X630|SGH-X700|SGH-X820|SGH-X890|SGH-Z130|SGH-Z150|SGH-Z170|SGH-ZX10|SGH-ZX20|SHW-M110|SPH-A120|SPH-A400|SPH-A420|SPH-A460|SPH-A500|SPH-A560|SPH-A600|SPH-A620|SPH-A660|SPH-A700|SPH-A740|SPH-A760|SPH-A790|SPH-A800|SPH-A820|SPH-A840|SPH-A880|SPH-A900|SPH-A940|SPH-A960|SPH-D600|SPH-D700|SPH-D710|SPH-D720|SPH-I300|SPH-I325|SPH-I330|SPH-I350|SPH-I500|SPH-I600|SPH-I700|SPH-L700|SPH-M100|SPH-M220|SPH-M240|SPH-M300|SPH-M305|SPH-M320|SPH-M330|SPH-M350|SPH-M360|SPH-M370|SPH-M380|SPH-M510|SPH-M540|SPH-M550|SPH-M560|SPH-M570|SPH-M580|SPH-M610|SPH-M620|SPH-M630|SPH-M800|SPH-M810|SPH-M850|SPH-M900|SPH-M910|SPH-M920|SPH-M930|SPH-N100|SPH-N200|SPH-N240|SPH-N300|SPH-N400|SPH-Z400|SWC-E100|SCH-i909|GT-N7100|GT-N8010',
                                    'model'       => array()
                ),

               // @ref: http://devblog.blackberry.com/2012/08/blackberry-10-user-agent-string/
               'BlackBerry' => array(
                                    'vendor'     => 'BlackBerry',
                                    'match'     => 'BlackBerry|rim[0-9]+|\bBB10',
                                    'model'       => 'BlackBerry.[MODEL]',
                                    ),

               'Dell'       => array(
                                    'vendor'     => 'Dell',
                                    'match'     => 'Dell.*Streak|Dell.*Aero|Dell.*Venue|DELL.*Venue Pro|Dell Flash|Dell Smoke|Dell Mini 3iX|XCD28|XCD35|\b001DL\b|\b101DL\b|\bGS01\b',
                                    'model'       => array()
                                    ),

               'Motorola'   => array(
                                    'vendor'     => 'Motorola',
                                    'match'     => 'Motorola|\bDroid\b.*Build|DROIDX|Android.*Xoom|HRI39|MOT-|A1260|A1680|A555|A853|A855|A953|A955|A956|Motorola.*ELECTRIFY|Motorola.*i1|i867|i940|MB200|MB300|MB501|MB502|MB508|MB511|MB520|MB525|MB526|MB611|MB612|MB632|MB810|MB855|MB860|MB861|MB865|MB870|ME501|ME502|ME511|ME525|ME600|ME632|ME722|ME811|ME860|ME863|ME865|MT620|MT710|MT716|MT720|MT810|MT870|MT917|Motorola.*TITANIUM|WX435|WX445|XT300|XT301|XT311|XT316|XT317|XT319|XT320|XT390|XT502|XT530|XT531|XT532|XT535|XT603|XT610|XT611|XT615|XT681|XT701|XT702|XT711|XT720|XT800|XT806|XT860|XT862|XT875|XT882|XT883|XT894|XT909|XT910|XT912|XT928',
                                    'model'       => array()
                                    ),

               'Sony'       => array(
                                    'vendor' => 'Sony',
                                    'match' => 'sony|SonyEricsson|SonyEricssonLT15iv|LT18i|E10i',
                                    'model' => array()
                                    ),

               'Asus'          => array(
                                    'vendor' => 'Asus',
                                    'match' => 'Asus.*Galaxy',
                                    'model' => array()
                ),

               // avantgo|blazer|elaine|hiptop|plucker|xiino ; @todo - complete the regex.
               'Palm'          => array(
                                    'vendor' => 'Palm',
                                    'match' => 'PalmSource|Palm',
                                    'model' => array()
                                    ),
               // Just for fun ;)
                'Vertu'         => array(
                                    'vendor' => 'Vertu',
                                    'match' => 'Vertu|Vertu.*Ltd|Vertu.*Ascent|Vertu.*Ayxta|Vertu.*Constellation(F|Quest)?|Vertu.*Monika|Vertu.*Signature',
                                    'model' => array()
                                    ),

                // @ref: http://www.pantech.co.kr/en/prod/prodList.do?gbrand=VEGA (PANTECH)
                // Most of the VEGA devices are legacy. PANTECH seem to be newer devices based on Android.
                'Pantech'       => array(
                                    'vendor' => 'Pantech',
                                    'match' => 'PANTECH|IM-A850S|IM-A840S|IM-A830L|IM-A830K|IM-A830S|IM-A820L|IM-A810K|IM-A810S|IM-A800S|IM-T100K|IM-A725L|IM-A780L|IM-A775C|IM-A770K|IM-A760S|IM-A750K|IM-A740S|IM-A730S|IM-A720L|IM-A710K|IM-A690L|IM-A690S|IM-A650S|IM-A630K|IM-A600S|VEGA PTL21|PT003|P8010|ADR910L|P6030|P6020|P9070|P4100|P9060|P5000|CDM8992|TXT8045|ADR8995|IS11PT|P2030|P6010|P8000|PT002|IS06|CDM8999|P9050|PT001|TXT8040|P2020|P9020|P2000|P7040|P7000|C790',
                                    'model' => array()
                                    ),

                // @ref: http://www.fly-phone.com/devices/smartphones/ ; Included only smartphones.
                'Fly'           => array(
                                    'vendor' => 'Fly',
                                    'match' => 'IQ230|IQ444|IQ450|IQ440|IQ442|IQ441|IQ245|IQ256|IQ236|IQ255|IQ235|IQ245|IQ275|IQ240|IQ285|IQ280|IQ270|IQ260|IQ250',
                                    'model' => array()
                                    ),

                // Added simvalley mobile just for fun. They have some interesting devices.
                // @ref: http://www.simvalley.fr/telephonie---gps-_22_telephonie-mobile_telephones_.html
                'SimValley'     => array(
                                    'vendor' => 'SimValley',
                                    'match' => '\b(SP-80|XT-930|SX-340|XT-930|SX-310|SP-360|SP60|SPT-800|SP-120|SPT-800|SP-140|SPX-5|SPX-8|SP-100|SPX-8|SPX-12)\b',
                                    'model' => array()
                                    ),

                // @Tapatalk is a mobile app; @ref: http://support.tapatalk.com/threads/smf-2-0-2-os-and-browser-detection-plugin-and-tapatalk.15565/#post-79039
                'GenericPhone'  => array(
                                    'vendor' => 'GenericPhone',
                                    'match' => 'Tapatalk|PDA;|PPC;|SAGEM|mmp|pocket|psp|symbian|Smartphone|smartfon|treo|up.browser|up.link|vodafone|wap|nokia|Series40|Series60|S60|SonyEricsson|N900|MAUI.*WAP.*Browser|LG-P500',
                                    'model' => null
                                    ),



            ),

            'tablet'  => array(

               'iPad'       => array(
                                    'vendor'    => 'Apple',
                                    'match'     => 'iPad|iPad.*Mobile',
                                    'model'       => array('iPad.*CPU[a-z ]+[VER]'),
                                    ),

               'Nexus'       => array(
                                        'vendor'    => 'Google',
                                        'match'     => '^.*Android.*Nexus(((?:(?!Mobile))|(?:(\s(7|10).+))).)*$',
                                        'model'     => array('Nexus [MODEL] Build', '[MODEL] Nexus')
                                        ),

               'Kindle'     => array(
                                    'vendor'     => 'Kindle',
                                    'match'     => 'Kindle|Silk.*Accelerated',
                                    'model'       => array('Kindle/[VER]', 'Kindle.[MODEL]'),
                                    ),

            ),

            'os'      => array(

               'Android'    => array(
                                    'label'     => 'Android OS',
                                    'match'     => 'Android',
                                    'ver'       => 'Android [VER]'
                                    ),

               'iOS'        => array(
                                    'label'     => 'iOS',
                                    'match'     => 'iphone|ipod|ipad',
                                    'ver'       => 'OS [VER]',
                                    ),

               'BlackBerry' => array(
                                    'label'     => 'BlackBerry OS',
                                    'match'     => 'BlackBerry|PlayBook|RIM Tablet OS', // @todo: split http://en.wikipedia.org/wiki/BlackBerry_Tablet_OS
                                    'ver'       => array('BlackBerry[\w]+/[VER]', 'BlackBerry.*Version/[VER]'),
                                    ),

            ),

            'browser' => array(

               'Chrome'     => array(
                                    'label'     => 'Chrome',
                                    'match'     => 'Chrome|\bCrMo\b|CriOS',
                                    'ver'       => array('Chrome/[VER]', 'CriOS/[VER]'),
                                    ),

               'Opera'      => array(
                                    'label'     => 'Opera',
                                    'match'     => 'Opera',
                                    'ver'       => 'Version/[VER]',
                                    ),

               'OperaMini' => array(
                                    'label'     => 'Opera Mini',
                                    'match'     => 'Opera.*Mini',
                                    'ver'       => 'Opera Mini/[VER]',
                                    ),

               'OperaMobi' => array(
                                    'label'     => 'Opera Mobi',
                                    'match'     => 'Opera.*Mobi',
                                    'ver'       => 'Version/[VER]',
                                    ),

               'Safari'     => array(
                                    'label'     => 'Safari',
                                    'match'     => 'Version.*Mobile.*Safari|Safari.*Mobile',
                                    'ver'       => 'Version/[VER]',
                ),

            )

        );

        return $items;


    }


    /**
    * Get the current script version.
    * This is useful for the demo.php file,
    * so people can check on what version they are testing
    * for mobile devices.
    */
    public function getScriptVersion(){

        return $this->scriptVersion;

    }

    public function setHttpHeaders($httpHeaders = null){

        if(!empty($httpHeaders)){
            $this->httpHeaders = $httpHeaders;
        } else {
            foreach($_SERVER as $key => $value){
                if(substr($key,0,5)=='HTTP_'){
                    $this->httpHeaders[$key] = $value;
                }
            }
        }

    }

    public function getHttpHeaders(){

        return $this->httpHeaders;

    }

    /**
     * Set the current User Agent string we are working on.
     * @param string $userAgent String containing the visiting User Agent.
     */
    public function setUserAgent($userAgent = null){

        // Invalidate the cache.
        $this->what = null;

        // Alternative HTTP headers can contain the real informations about the device.
        $altUserAgents = array(
            // Header can occur on devices using Opera Mini.
            'HTTP_X_OPERAMINI_PHONE_UA',
            // Vodafone specific header: http://www.seoprinciple.com/mobile-web-community-still-angry-at-vodafone/24/
            'HTTP_X_DEVICE_USER_AGENT',
            'HTTP_X_ORIGINAL_USER_AGENT',
            'HTTP_X_SKYFIRE_PHONE',
            'HTTP_X_BOLT_PHONE_UA',
            'HTTP_DEVICE_STOCK_UA',
            'HTTP_X_UCBROWSER_DEVICE_UA'
        );

        if(!empty($userAgent)){

            $this->userAgent = $userAgent;

        } else {

            $this->userAgent = isset($this->httpHeaders['HTTP_USER_AGENT']) ? $this->httpHeaders['HTTP_USER_AGENT'] : null;

            foreach($altUserAgents as $altHeader){

                if(!empty($this->httpHeaders[$altHeader])){

                    $this->userAgent .= " ".$this->httpHeaders[$altHeader];

                }

            }

        }

    }

    public function getUserAgent(){

        return $this->userAgent;

    }

    /**
    * Check the HTTP headers for signs of mobile.
    * This is the fastest mobile check possible; it's used
    * inside isMobile() method.
    * @return boolean
    */
    public function checkHttpHeadersForMobile(){

        // @todo: study HTTP_X_NETWORK_TYPE = WIFI

        $knownHttpHeaders = array(

            'HTTP_ACCEPT'                  => array('matches' => array(
                                                                        // Opera Mini; @reference: http://dev.opera.com/articles/view/opera-binary-markup-language/
                                                                        'application/x-obml2d',
                                                                        // BlackBerry devices.
                                                                        'application/vnd.rim.html',
                                                                        'text/vnd.wap.wml',
                                                                        'application/vnd.wap.xhtml+xml'
                                            )),
            'HTTP_X_WAP_PROFILE'           => null,
            'HTTP_X_WAP_CLIENTID'          => null,
            'HTTP_WAP_CONNECTION'          => null,
            'HTTP_PROFILE'                 => null,
            // Reported by Opera on Nokia devices (eg. C3).
            'HTTP_X_OPERAMINI_PHONE_UA'    => null,
            'HTTP_X_NOKIA_IPADDRESS'       => null,
            'HTTP_X_NOKIA_GATEWAY_ID'      => null,
            'HTTP_X_ORANGE_ID'             => null,
            'HTTP_X_VODAFONE_3GPDPCONTEXT' => null,
            'HTTP_X_HUAWEI_USERID'         => null,
            // Reported by Windows Smartphones.
            'HTTP_UA_OS'                   => null,
            // Reported by Verizon, Vodafone proxy system.
            'HTTP_X_MOBILE_GATEWAY'        => null,
            // Seend this on HTC Sensation. @ref: SensationXE_Beats_Z715e.
            'HTTP_X_ATT_DEVICEID'          => null,
            // Seen this on a HTC.
            'HTTP_UA_CPU'                  => array('matches' => 'ARM'),

        );

    }


    // ==================================================================
    //
    // Public utility methods.
    //
    // ------------------------------------------------------------------


    /**
     * Prepare the version number.
     *
     * @param $ver
     * @return int
     */
    function prepareVersionNo($ver){

        return $ver;

        $ver = str_replace(array('_', ' ', '/'), array('.', '.', '.'), $ver);
        $arrVer = explode('.', $ver, 2);
        $arrVer[1] = @str_replace('.', '', $arrVer[1]); // @todo: treat strings versions.
        $ver = (float)implode('.', $arrVer);

        return $ver;

    }

    public function getVersionFromPattern($patterns){

        if($patterns){ $patterns = (array)$patterns; }

        foreach($patterns as $regex){

            $regex = str_replace(array('[VER]', '[MODEL]'), array(self::VER, self::MODEL), $regex);

            // Escape the special character which is the delimiter.
            $regex = str_replace('/', '\/', $regex);

            // Identify and extract the version.
            preg_match('/'.$regex.'/is', $this->userAgent, $match);

            if($match[1]){
                $version = $this->prepareVersionNo($match[1]);
                return $version;
            }

        }

    }

    function match($regex){

        // Escape the special character which is the delimiter.
        $regex = str_replace('/', '\/', $regex);

        return (bool)preg_match('/'.$regex.'/is', $this->userAgent);

    }

    /**
     * [what description]
     * $detect->what()
     *
     * @param  string $prop [description]
     * @return [type]       [description]
     */
    public function what(){

        $getItems = $this->getItems();

        foreach($getItems as $itemType => $items){

            foreach($items as $itemLabel => $itemArr){

                if( !empty($itemArr['match']) && $this->match($itemArr['match']) ){

                    switch($itemType){

                        case 'mobile':
                        case 'tablet':

                            $this->what['deviceType'] = $itemType;
                            $this->what['deviceVendor'] = $itemArr['vendor'];
                            $this->what['deviceModel'] = $this->getVersionFromPattern($itemArr['model']);

                        break;

                        case 'os':

                            $this->what['os'] = $itemArr['label'];
                            $this->what['osVer'] = $this->getVersionFromPattern($itemArr['ver']);

                        break;

                        case 'browser':

                            $this->what['browser'] = $itemArr['label'];
                            $this->what['browserVer'] = $this->getVersionFromPattern($itemArr['ver']);

                        break;

                    }


                }

            }

        }

        return $this->what;

    }

}
