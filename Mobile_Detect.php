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

            'tablet'  => array(

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
                                    'buildVer'  => 'Safari/[VER]'
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
                            $this->what['deviceLabel'] = $itemArr['label'];
                            $this->what['deviceVer'] = $this->getVersionFromPattern($itemArr['ver']);

                        break;

                        case 'os':

                            $this->what['os'] = $itemArr['label'];
                            $this->what['osVer'] = $this->getVersionFromPattern($itemArr['ver']);

                        break;

                        case 'browser':

                            $this->what['browser'] = $itemArr['label'];
                            $this->what['browserVer'] = $this->getVersionFromPattern($itemArr['ver']);
                            $this->what['browserBuildVer'] = $this->getVersionFromPattern($itemArr['buildVer']);

                        break;

                    }


                }

            }

        }

        return $this->what;

    }

}