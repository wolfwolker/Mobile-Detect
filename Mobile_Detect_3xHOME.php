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
 * @license     http://www.opensource.org/licenses/mit-license.php  MIT License
 * @link        http://mobiledetect.net
 *              GitHub Repository: https://github.com/serbanghita/Mobile-Detect
 *              Google Code Old Project Page: http://code.google.com/p/php-mobile-detect/
 *
 * @version     3.0 (Community Donation Release)
 */

class Mobile_Detect {

    protected $userAgent = null;
    protected $httpHeaders;

    const VER = '([\w._]+)';
    const MODEL = '([\w_]+)';
    protected $what; // Cache array with the latest what() info.
    protected $searchPlaces = array(

     'mobile' => array(

       'iPhone'     => array(
                            'label'     => 'Apple',
                            'match'     => '(iPhone.*Mobile|iPod|iTunes)',
                            'ver'       => array('iPhone.*CPU[a-z ]+[VER]', 'iPod.*CPU[a-z ]+[VER]'),
                            ),

       'HTC'        => array(
                            'label'     => 'HTC',
                            'match'     => 'HTC|HTC.*(Sensation|Evo|Vision|Explorer|6800|8100|8900|A7272|S510e|C110e|Legend|Desire|T8282)|APX515CKT|Qtek9090|APA9292KT|HD_mini|Sensation.*Z710e|PG86100|Z715e|Desire.*(A8181|HD)|ADR6200|ADR6425|001HT|Inspire 4G',
                            'ver'       => array('HTC.[MODEL]', 'HTC; [MODEL]'),
                            ),

       'BlackBerry' => array(
                            'label'     => 'BlackBerry',
                            'match'     => 'BlackBerry|rim[0-9]+',
                            'ver'       => 'BlackBerry.[MODEL]',
                            ),

     ),

     'tablet' => array(

       'iPad'       => array(
                            'label'     => 'Apple',
                            'match'     => 'iPad|iPad.*Mobile',
                            'ver'       => 'iPad.*CPU[a-z ]+[VER]',
                            ),

       'Kindle'     => array(
                            'brand'     => 'Kindle',
                            'match'     => 'Kindle|Silk.*Accelerated',
                            'ver'       => array('Kindle/[VER]', 'Kindle.[MODEL]'),

                            ),

     ),

     'os' => array(

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
                            'ver'       => 'Opera Mini/[VER]'
                            ),

       'OperaMobi' => array(
                            'label'     => 'Opera Mobi',
                            'match'     => 'Opera.*Mobi',
                            'ver'       => 'Version/[VER]'
                            ),

     ),

     'other' => array(

      'WebKit'  => array(
                        'match' => 'WebKit',
                        'ver' => 'WebKit[ /][VER]'
                        ),

      'Bot'     => array(
                        'match' => 'Googlebot|DoCoMo|YandexBot|bingbot|ia_archiver|AhrefsBot|Ezooms|GSLFbot|WBSearchBot|Twitterbot|TweetmemeBot|Twikle|PaperLiBot|Wotbox|UnwindFetchor|facebookexternalhit',
                        ),

      'MobileBot' => array(
                        'match' => 'Googlebot-Mobile|YahooSeeker/M1A1-R2D2'
                        )

     )

    );

    protected $searchProperties = array(

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

    function __construct(){

        $this->setHttpHeaders();
        $this->setUserAgent();

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

    public function setUserAgent($userAgent = null){

        if(!empty($userAgent)){
            $this->userAgent = $userAgent;
        } else {
            $this->userAgent    = isset($this->httpHeaders['HTTP_USER_AGENT']) ? $this->httpHeaders['HTTP_USER_AGENT'] : null;

            if(empty($this->userAgent)){
                $this->userAgent = isset($this->httpHeaders['HTTP_X_DEVICE_USER_AGENT']) ? $this->httpHeaders['HTTP_X_DEVICE_USER_AGENT'] : null;
            }
            // Header can occur on devices using Opera Mini (can expose the real device type). Let's concatenate it (we need this extra info in the regexes).
            if(!empty($this->httpHeaders['HTTP_X_OPERAMINI_PHONE_UA'])){
                $this->userAgent .= ' '.$this->httpHeaders['HTTP_X_OPERAMINI_PHONE_UA'];
            }
        }

    }


    /**
    * Check the HTTP headers for signs of mobile.
    * This is the fastest mobile check possible; is used
    * inside isMobile() method.
    * @return boolean
    */
    public function checkHttpHeadersForMobile(){

        if(
            isset($this->httpHeaders['HTTP_ACCEPT']) &&
                (strpos($this->httpHeaders['HTTP_ACCEPT'], 'application/x-obml2d') !== false || // Opera Mini; @reference: http://dev.opera.com/articles/view/opera-binary-markup-language/
                 strpos($this->httpHeaders['HTTP_ACCEPT'], 'application/vnd.rim.html') !== false || // BlackBerry devices.
                 strpos($this->httpHeaders['HTTP_ACCEPT'], 'text/vnd.wap.wml') !== false ||
                 strpos($this->httpHeaders['HTTP_ACCEPT'], 'application/vnd.wap.xhtml+xml') !== false) ||
            isset($this->httpHeaders['HTTP_X_WAP_PROFILE'])             || // @todo: validate
            isset($this->httpHeaders['HTTP_X_WAP_CLIENTID'])            ||
            isset($this->httpHeaders['HTTP_WAP_CONNECTION'])            ||
            isset($this->httpHeaders['HTTP_PROFILE'])                   ||
            isset($this->httpHeaders['HTTP_X_OPERAMINI_PHONE_UA'])      || // Reported by Nokia devices (eg. C3)
            isset($this->httpHeaders['HTTP_X_NOKIA_IPADDRESS'])         ||
            isset($this->httpHeaders['HTTP_X_NOKIA_GATEWAY_ID'])        ||
            isset($this->httpHeaders['HTTP_X_ORANGE_ID'])               ||
            isset($this->httpHeaders['HTTP_X_VODAFONE_3GPDPCONTEXT'])   ||
            isset($this->httpHeaders['HTTP_X_HUAWEI_USERID'])           ||
            isset($this->httpHeaders['HTTP_UA_OS'])                     || // Reported by Windows Smartphones.
            isset($this->httpHeaders['HTTP_X_MOBILE_GATEWAY'])          || // Reported by Verizon, Vodafone proxy system.
            isset($this->httpHeaders['HTTP_X_ATT_DEVICEID'])            || // Send this on HTC Sensation. @ref: SensationXE_Beats_Z715e
            //HTTP_X_NETWORK_TYPE = WIFI
            ( isset($this->httpHeaders['HTTP_UA_CPU']) &&
                    $this->httpHeaders['HTTP_UA_CPU'] == 'ARM'          // Seen this on a HTC.
            )
        ){

            return true;

        }

        return false;

    }

    /**
     * Prepare the version number.
     *
     * @param $ver
     * @return int
     */
    function prepareVersionNo($ver){

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

            if(!empty($match[1])){
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

    public function browser(){



    }


    public function what($prop = ''){


        foreach($this->searchPlaces as $itemType => $items){

            foreach($items as $itemLabel => $itemArr){

                if( !empty($itemArr['match']) && $this->match($itemArr['match']) ){

                    echo 'OK = '.$itemType.'<br>';

                    switch($itemType){

                        case 'mobile':
                        case 'tablet':

                            $this->match['deviceType'] = $itemType;
                            $this->match['deviceLabel'] = $itemArr['label'];
                            $this->match['deviceVer'] = $this->getVersionFromPattern($itemArr['ver']);

                        break;

                        case 'os':

                            $this->match['os'] = $itemArr['label'];
                            $this->match['osVer'] = $this->getVersionFromPattern($itemArr['ver']);

                        break;

                        case 'browser':

                            $this->match['browser'] = $itemArr['label'];
                            $this->match['browserVer'] = $this->getVersionFromPattern($itemArr['ver']);

                        break;

                    }


                }

            }

        }

        return $this->match;


    }


}