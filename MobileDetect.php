<?php

class MobileDetect
{
    const MATCH_TYPE_REGEX          = 'regex';
    const MATCH_TYPE_STRIPOS        = 'stripos';

    //MARKER_START
    protected static $items = array(
        'phoneDevices'      => array(
            'iPhone'            => array(
                'regex'             => '\biPhone.*Mobile|\biPod',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'BlackBerry'        => array(
                'regex'             => 'BlackBerry|\bBB10\b|rim[0-9]+',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'HTC'               => array(
                'regex'             => 'HTC|HTC.*(Sensation|Evo|Vision|Explorer|6800|8100|8900|A7272|S510e|C110e|Legend|Desire|T8282)|APX515CKT|Qtek9090|APA9292KT|HD_mini|Sensation.*Z710e|PG86100|Z715e|Desire.*(A8181|HD)|ADR6200|ADR6400L|ADR6425|001HT|Inspire 4G|Android.*\bEVO\b',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Nexus'             => array(
                'regex'             => 'Nexus One|Nexus S|Galaxy.*Nexus|Android.*Nexus.*Mobile',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Dell'              => array(
                'regex'             => 'Dell.*Streak|Dell.*Aero|Dell.*Venue|DELL.*Venue Pro|Dell Flash|Dell Smoke|Dell Mini 3iX|XCD28|XCD35|\b001DL\b|\b101DL\b|\bGS01\b',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Motorola'          => array(
                'regex'             => 'Motorola|\bDroid\b.*Build|DROIDX|Android.*Xoom|HRI39|MOT-|A1260|A1680|A555|A853|A855|A953|A955|A956|Motorola.*ELECTRIFY|Motorola.*i1|i867|i940|MB200|MB300|MB501|MB502|MB508|MB511|MB520|MB525|MB526|MB611|MB612|MB632|MB810|MB855|MB860|MB861|MB865|MB870|ME501|ME502|ME511|ME525|ME600|ME632|ME722|ME811|ME860|ME863|ME865|MT620|MT710|MT716|MT720|MT810|MT870|MT917|Motorola.*TITANIUM|WX435|WX445|XT300|XT301|XT311|XT316|XT317|XT319|XT320|XT390|XT502|XT530|XT531|XT532|XT535|XT603|XT610|XT611|XT615|XT681|XT701|XT702|XT711|XT720|XT800|XT806|XT860|XT862|XT875|XT882|XT883|XT894|XT901|XT907|XT909|XT910|XT912|XT928|XT926|XT915|XT919|XT925',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Samsung'           => array(
                'regex'             => 'Samsung|SGH-I337|BGT-S5230|GT-B2100|GT-B2700|GT-B2710|GT-B3210|GT-B3310|GT-B3410|GT-B3730|GT-B3740|GT-B5510|GT-B5512|GT-B5722|GT-B6520|GT-B7300|GT-B7320|GT-B7330|GT-B7350|GT-B7510|GT-B7722|GT-B7800|GT-C3010|GT-C3011|GT-C3060|GT-C3200|GT-C3212|GT-C3212I|GT-C3262|GT-C3222|GT-C3300|GT-C3300K|GT-C3303|GT-C3303K|GT-C3310|GT-C3322|GT-C3330|GT-C3350|GT-C3500|GT-C3510|GT-C3530|GT-C3630|GT-C3780|GT-C5010|GT-C5212|GT-C6620|GT-C6625|GT-C6712|GT-E1050|GT-E1070|GT-E1075|GT-E1080|GT-E1081|GT-E1085|GT-E1087|GT-E1100|GT-E1107|GT-E1110|GT-E1120|GT-E1125|GT-E1130|GT-E1160|GT-E1170|GT-E1175|GT-E1180|GT-E1182|GT-E1200|GT-E1210|GT-E1225|GT-E1230|GT-E1390|GT-E2100|GT-E2120|GT-E2121|GT-E2152|GT-E2220|GT-E2222|GT-E2230|GT-E2232|GT-E2250|GT-E2370|GT-E2550|GT-E2652|GT-E3210|GT-E3213|GT-I5500|GT-I5503|GT-I5700|GT-I5800|GT-I5801|GT-I6410|GT-I6420|GT-I7110|GT-I7410|GT-I7500|GT-I8000|GT-I8150|GT-I8160|GT-I8190|GT-I8320|GT-I8330|GT-I8350|GT-I8530|GT-I8700|GT-I8703|GT-I8910|GT-I9000|GT-I9001|GT-I9003|GT-I9010|GT-I9020|GT-I9023|GT-I9070|GT-I9082|GT-I9100|GT-I9103|GT-I9220|GT-I9250|GT-I9300|GT-I9305|GT-I9500|GT-I9505|GT-M3510|GT-M5650|GT-M7500|GT-M7600|GT-M7603|GT-M8800|GT-M8910|GT-N7000|GT-S3110|GT-S3310|GT-S3350|GT-S3353|GT-S3370|GT-S3650|GT-S3653|GT-S3770|GT-S3850|GT-S5210|GT-S5220|GT-S5229|GT-S5230|GT-S5233|GT-S5250|GT-S5253|GT-S5260|GT-S5263|GT-S5270|GT-S5300|GT-S5330|GT-S5350|GT-S5360|GT-S5363|GT-S5369|GT-S5380|GT-S5380D|GT-S5560|GT-S5570|GT-S5600|GT-S5603|GT-S5610|GT-S5620|GT-S5660|GT-S5670|GT-S5690|GT-S5750|GT-S5780|GT-S5830|GT-S5839|GT-S6102|GT-S6500|GT-S7070|GT-S7200|GT-S7220|GT-S7230|GT-S7233|GT-S7250|GT-S7500|GT-S7530|GT-S7550|GT-S7562|GT-S7710|GT-S8000|GT-S8003|GT-S8500|GT-S8530|GT-S8600|SCH-A310|SCH-A530|SCH-A570|SCH-A610|SCH-A630|SCH-A650|SCH-A790|SCH-A795|SCH-A850|SCH-A870|SCH-A890|SCH-A930|SCH-A950|SCH-A970|SCH-A990|SCH-I100|SCH-I110|SCH-I400|SCH-I405|SCH-I500|SCH-I510|SCH-I515|SCH-I600|SCH-I730|SCH-I760|SCH-I770|SCH-I830|SCH-I910|SCH-I920|SCH-I959|SCH-LC11|SCH-N150|SCH-N300|SCH-R100|SCH-R300|SCH-R351|SCH-R400|SCH-R410|SCH-T300|SCH-U310|SCH-U320|SCH-U350|SCH-U360|SCH-U365|SCH-U370|SCH-U380|SCH-U410|SCH-U430|SCH-U450|SCH-U460|SCH-U470|SCH-U490|SCH-U540|SCH-U550|SCH-U620|SCH-U640|SCH-U650|SCH-U660|SCH-U700|SCH-U740|SCH-U750|SCH-U810|SCH-U820|SCH-U900|SCH-U940|SCH-U960|SCS-26UC|SGH-A107|SGH-A117|SGH-A127|SGH-A137|SGH-A157|SGH-A167|SGH-A177|SGH-A187|SGH-A197|SGH-A227|SGH-A237|SGH-A257|SGH-A437|SGH-A517|SGH-A597|SGH-A637|SGH-A657|SGH-A667|SGH-A687|SGH-A697|SGH-A707|SGH-A717|SGH-A727|SGH-A737|SGH-A747|SGH-A767|SGH-A777|SGH-A797|SGH-A817|SGH-A827|SGH-A837|SGH-A847|SGH-A867|SGH-A877|SGH-A887|SGH-A897|SGH-A927|SGH-B100|SGH-B130|SGH-B200|SGH-B220|SGH-C100|SGH-C110|SGH-C120|SGH-C130|SGH-C140|SGH-C160|SGH-C170|SGH-C180|SGH-C200|SGH-C207|SGH-C210|SGH-C225|SGH-C230|SGH-C417|SGH-C450|SGH-D307|SGH-D347|SGH-D357|SGH-D407|SGH-D415|SGH-D780|SGH-D807|SGH-D980|SGH-E105|SGH-E200|SGH-E315|SGH-E316|SGH-E317|SGH-E335|SGH-E590|SGH-E635|SGH-E715|SGH-E890|SGH-F300|SGH-F480|SGH-I200|SGH-I300|SGH-I320|SGH-I550|SGH-I577|SGH-I600|SGH-I607|SGH-I617|SGH-I627|SGH-I637|SGH-I677|SGH-I700|SGH-I717|SGH-I727|SGH-i747M|SGH-I777|SGH-I780|SGH-I827|SGH-I847|SGH-I857|SGH-I896|SGH-I897|SGH-I900|SGH-I907|SGH-I917|SGH-I927|SGH-I937|SGH-I997|SGH-J150|SGH-J200|SGH-L170|SGH-L700|SGH-M110|SGH-M150|SGH-M200|SGH-N105|SGH-N500|SGH-N600|SGH-N620|SGH-N625|SGH-N700|SGH-N710|SGH-P107|SGH-P207|SGH-P300|SGH-P310|SGH-P520|SGH-P735|SGH-P777|SGH-Q105|SGH-R210|SGH-R220|SGH-R225|SGH-S105|SGH-S307|SGH-T109|SGH-T119|SGH-T139|SGH-T209|SGH-T219|SGH-T229|SGH-T239|SGH-T249|SGH-T259|SGH-T309|SGH-T319|SGH-T329|SGH-T339|SGH-T349|SGH-T359|SGH-T369|SGH-T379|SGH-T409|SGH-T429|SGH-T439|SGH-T459|SGH-T469|SGH-T479|SGH-T499|SGH-T509|SGH-T519|SGH-T539|SGH-T559|SGH-T589|SGH-T609|SGH-T619|SGH-T629|SGH-T639|SGH-T659|SGH-T669|SGH-T679|SGH-T709|SGH-T719|SGH-T729|SGH-T739|SGH-T746|SGH-T749|SGH-T759|SGH-T769|SGH-T809|SGH-T819|SGH-T839|SGH-T919|SGH-T929|SGH-T939|SGH-T959|SGH-T989|SGH-U100|SGH-U200|SGH-U800|SGH-V205|SGH-V206|SGH-X100|SGH-X105|SGH-X120|SGH-X140|SGH-X426|SGH-X427|SGH-X475|SGH-X495|SGH-X497|SGH-X507|SGH-X600|SGH-X610|SGH-X620|SGH-X630|SGH-X700|SGH-X820|SGH-X890|SGH-Z130|SGH-Z150|SGH-Z170|SGH-ZX10|SGH-ZX20|SHW-M110|SPH-A120|SPH-A400|SPH-A420|SPH-A460|SPH-A500|SPH-A560|SPH-A600|SPH-A620|SPH-A660|SPH-A700|SPH-A740|SPH-A760|SPH-A790|SPH-A800|SPH-A820|SPH-A840|SPH-A880|SPH-A900|SPH-A940|SPH-A960|SPH-D600|SPH-D700|SPH-D710|SPH-D720|SPH-I300|SPH-I325|SPH-I330|SPH-I350|SPH-I500|SPH-I600|SPH-I700|SPH-L700|SPH-M100|SPH-M220|SPH-M240|SPH-M300|SPH-M305|SPH-M320|SPH-M330|SPH-M350|SPH-M360|SPH-M370|SPH-M380|SPH-M510|SPH-M540|SPH-M550|SPH-M560|SPH-M570|SPH-M580|SPH-M610|SPH-M620|SPH-M630|SPH-M800|SPH-M810|SPH-M850|SPH-M900|SPH-M910|SPH-M920|SPH-M930|SPH-N100|SPH-N200|SPH-N240|SPH-N300|SPH-N400|SPH-Z400|SWC-E100|SCH-i909|GT-N7100|GT-N7105|SCH-I535',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'LG'                => array(
                'regex'             => '\bLG\b;|(LG|LG-)?(C800|C900|E400|E610|E900|E-900|F160|F180K|F180L|F180S|730|855|L160|LS840|LS970|LU6200|MS690|MS695|MS770|MS840|MS870|MS910|P500|P700|P705|VM696|AS680|AS695|AX840|C729|E970|GS505|272|C395|E739BK|E960|L55C|L75C|LS696|LS860|P769BK|P350|P500|P509|P870|UN272|US730|VS840|VS950|LN272|LN510|LS670|LS855|LW690|MN270|MN510|P509|P769|P930|UN200|UN270|UN510|UN610|US670|US740|US760|UX265|UX840|VN271|VN530|VS660|VS700|VS740|VS750|VS910|VS920|VS930|VX9200|VX11000|AX840A|LW770|P506|P925|P999)',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Sony'              => array(
                'regex'             => 'SonyST|SonyLT|SonyEricsson|SonyEricssonLT15iv|LT18i|E10i|LT28h|SonyEricssonMT27i',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Asus'              => array(
                'regex'             => 'Asus.*Galaxy|PadFone.*Mobile',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Micromax'          => array(
                'regex'             => 'Micromax.*\b(A210|A92|A88|A72|A111|A110Q|A115|A116|A110|A90S|A26|A51|A35|A54|A25|A27|A89|A68|A65|A57|A90)\b',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Palm'              => array(
                'regex'             => 'PalmSource|Palm',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Vertu'             => array(
                'regex'             => 'Vertu|Vertu.*Ltd|Vertu.*Ascent|Vertu.*Ayxta|Vertu.*Constellation(F|Quest)?|Vertu.*Monika|Vertu.*Signature',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Pantech'           => array(
                'regex'             => 'PANTECH|IM-A850S|IM-A840S|IM-A830L|IM-A830K|IM-A830S|IM-A820L|IM-A810K|IM-A810S|IM-A800S|IM-T100K|IM-A725L|IM-A780L|IM-A775C|IM-A770K|IM-A760S|IM-A750K|IM-A740S|IM-A730S|IM-A720L|IM-A710K|IM-A690L|IM-A690S|IM-A650S|IM-A630K|IM-A600S|VEGA PTL21|PT003|P8010|ADR910L|P6030|P6020|P9070|P4100|P9060|P5000|CDM8992|TXT8045|ADR8995|IS11PT|P2030|P6010|P8000|PT002|IS06|CDM8999|P9050|PT001|TXT8040|P2020|P9020|P2000|P7040|P7000|C790',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Fly'               => array(
                'regex'             => 'IQ230|IQ444|IQ450|IQ440|IQ442|IQ441|IQ245|IQ256|IQ236|IQ255|IQ235|IQ245|IQ275|IQ240|IQ285|IQ280|IQ270|IQ260|IQ250',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'SimValley'         => array(
                'regex'             => '\b(SP-80|XT-930|SX-340|XT-930|SX-310|SP-360|SP60|SPT-800|SP-120|SPT-800|SP-140|SPX-5|SPX-8|SP-100|SPX-8|SPX-12)\b',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'GenericPhone'      => array(
                'regex'             => 'Tapatalk|PDA;|SAGEM|mmp|pocket|psp|symbian|Smartphone|smartfon|treo|up.browser|up.link|vodafone|wap|nokia|Series40|Series60|S60|SonyEricsson|N900|MAUI.*WAP.*Browser',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

        ),
        'tabletDevices'     => array(
            'GenericPhone'      => array(
                'regex'             => 'Android.*\b97D\b|Tablet(?!.*PC)|ViewPad7|BNTV250A|MID-WCDMA|LogicPD Zoom2|\bA7EB\b|CatNova8|A1_07|CT704|CT1002|\bM721\b|rk30sdk|\bEVOTAB\b',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

        ),
        'browsers'          => array(
            'Chrome'            => array(
                'regex'             => '\bCrMo\b|CriOS|Android.*Chrome/[.0-9]* (Mobile)?',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Dolfin'            => array(
                'regex'             => '\bDolfin\b',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Opera'             => array(
                'regex'             => 'Opera.*Mini|Opera.*Mobi|Android.*Opera|Mobile.*OPR/[0-9.]+',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Skyfire'           => array(
                'regex'             => 'Skyfire',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'IE'                => array(
                'regex'             => 'IEMobile|MSIEMobile',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Firefox'           => array(
                'regex'             => 'fennec|firefox.*maemo|(Mobile|Tablet).*Firefox|Firefox.*Mobile',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Bolt'              => array(
                'regex'             => 'bolt',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'TeaShark'          => array(
                'regex'             => 'teashark',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Blazer'            => array(
                'regex'             => 'Blazer',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Safari'            => array(
                'regex'             => 'Version.*Mobile.*Safari|Safari.*Mobile',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Tizen'             => array(
                'regex'             => 'Tizen',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'UCBrowser'         => array(
                'regex'             => 'UC.*Browser|UCWEB',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'DiigoBrowser'      => array(
                'regex'             => 'DiigoBrowser',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Puffin'            => array(
                'regex'             => 'Puffin',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'Mercury'           => array(
                'regex'             => '\bMercury\b',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

            'GenericBrowser'    => array(
                'regex'             => 'NokiaBrowser|OviBrowser|OneBrowser|TwonkyBeamBrowser|SEMC.*Browser|FlyFlow|Minimo|NetFront|Novarra-Vision|MQQBrowser|MicroMessenger',
                'matchType'         => 'regex',
                'model'             => array(),
                'property'          => array(),
            ),

        ),
        'operatingSystems'  => array(
            'AndroidOS'         => array(
                'regex'             => 'Android',
                'matchType'         => 'regex',
            ),

            'BlackBerryOS'      => array(
                'regex'             => 'blackberry|\bBB10\b|rim tablet os',
                'matchType'         => 'regex',
            ),

            'PalmOS'            => array(
                'regex'             => 'PalmOS|avantgo|blazer|elaine|hiptop|palm|plucker|xiino',
                'matchType'         => 'regex',
            ),

            'SymbianOS'         => array(
                'regex'             => 'Symbian|SymbOS|Series60|Series40|SYB-[0-9]+|\bS60\b',
                'matchType'         => 'regex',
            ),

            'WindowsMobileOS'   => array(
                'regex'             => 'Windows CE.*(PPC|Smartphone|Mobile|[0-9]{3}x[0-9]{3})|Window Mobile|Windows Phone [0-9.]+|WCE;',
                'matchType'         => 'regex',
            ),

            'WindowsPhoneOS'    => array(
                'regex'             => 'Windows Phone 8.0|Windows Phone OS|XBLWP7|ZuneWP7',
                'matchType'         => 'regex',
            ),

            'iOS'               => array(
                'regex'             => '\biPhone.*Mobile|\biPod|\biPad',
                'matchType'         => 'regex',
            ),

            'MeeGoOS'           => array(
                'regex'             => 'MeeGo',
                'matchType'         => 'regex',
            ),

            'MaemoOS'           => array(
                'regex'             => 'Maemo',
                'matchType'         => 'regex',
            ),

            'JavaOS'            => array(
                'regex'             => 'J2ME/|\bMIDP\b|\bCLDC\b',
                'matchType'         => 'regex',
            ),

            'webOS'             => array(
                'regex'             => 'webOS|hpwOS',
                'matchType'         => 'regex',
            ),

            'badaOS'            => array(
                'regex'             => '\bBada\b',
                'matchType'         => 'regex',
            ),

            'BREWOS'            => array(
                'regex'             => 'BREW',
                'matchType'         => 'regex',
            ),

        ),
        'utilities'         => array(
            'DesktopMode'       => array(
                'regex'             => 'WPDesktop',
                'matchType'         => 'regex',
                'bot'               => false,
            ),

            'TV'                => array(
                'regex'             => 'SonyDTV|HbbTV',
                'matchType'         => 'regex',
                'bot'               => false,
            ),

            'WebKit'            => array(
                'regex'             => '(webkit)[ /]([\w.]+)',
                'matchType'         => 'regex',
                'bot'               => false,
            ),

            'Bot'               => array(
                'regex'             => 'Googlebot|DoCoMo|YandexBot|bingbot|ia_archiver|AhrefsBot|Ezooms|GSLFbot|WBSearchBot|Twitterbot|TweetmemeBot|Twikle|PaperLiBot|Wotbox|UnwindFetchor|facebookexternalhit',
                'matchType'         => 'regex',
                'bot'               => true,
            ),

            'MobileBot'         => array(
                'regex'             => 'Googlebot-Mobile|DoCoMo|YahooSeeker/M1A1-R2D2',
                'matchType'         => 'regex',
                'bot'               => true,
            ),

            'Console'           => array(
                'regex'             => '\b(Nintendo|Nintendo WiiU|PLAYSTATION|Xbox)\b',
                'matchType'         => 'regex',
                'bot'               => false,
            ),

            'Watch'             => array(
                'regex'             => 'SM-V700',
                'matchType'         => 'regex',
                'bot'               => false,
            ),

        ),
    );
    //MARKER_END
    /**
     * A list of possible HTTP Request headers.
     * 
     * @var array
     */
    protected static $requestHeaders = array(
        'Accept',
        'Accept-Charset',
        'Accept-Encoding',
        'Accept-Language',
        'Accept-Datetime',
        'Authorization',
        'Cache-Control',
        'Connection',
        'Cookie',
        'Content-Length',
        'Content-MD5',
        'Content-Type',
        'Date',
        'Expect',
        'From',
        'Host',
        'Permanent',
        'If-Match',
        'If-Modified-Since',
        'If-None-Match',
        'If-Range',
        'If-Unmodified-Since',
        'Max-Forwards',
        'Origin',
        'Pragma',
        'Proxy-Authorization',
        'Range',
        'Referer',
        'TE',
        'Upgrade',
        'User-Agent',
        'Via',
        'Warning'
    );

    //some kind of executable strategy for detection
    //@todo is this necessary?
    protected $strategy;

    /**
     * An associative array of headers in standard format. So the keys will be "User-Agent", and "Accepts" versus
     * the all caps PHP format.
     *
     * @var array
     */
    protected $headers = array();

    /**
     * @param $headers \Iterator|array|string When it's a string, it's assumed to be User-Agent.
     */
    public function __construct($headers = null)
    {
        if (is_string($headers)) {
            $headers = array('User-Agent' => $headers);
        }

        //when no headers are provided, get them from _SERVER super global
        if ($headers === null) {
            $headers = $_SERVER;
        }

        if ($headers instanceof \Iterator) {
            $headers = iterator_to_array($headers, true);
        }

        //load up the headers
        foreach ($headers as $key => $value) {
            try {
                $standardKey = $this->standardizeHeader($key);
                $this->headers[$standardKey] = $value;
            } catch (InvalidArgumentException $e) {
                //ignore this key and move on
                continue;
            }
        }
    }

    /**
     * Retrieve a list of phone device match specs.
     *
     * @return array
     */
    protected static function getPhoneDevices()
    {
        return static::$items['phoneDevices'];
    }

    /**
     * Retrieve a list of tablet device match specs.
     *
     * @return array
     */
    protected static function getTabletDevices()
    {
        return static::$items['tabletDevices'];
    }

    /**
     * Retrieve a list of browser match specs.
     *
     * @return array
     */
    protected static function getBrowsers()
    {
        return static::$items['browsers'];
    }

    /**
     * Retrieve a list of OS match specs.
     *
     * @return array
     */
    protected static function getOperatingSystems()
    {
        return static::$items['operatingSystems'];
    }

    /**
     * Retrieve a list of utility match specs.
     *
     * @return array
     */
    protected static function getUtilities()
    {
        return static::$items['utilities'];
    }

    /**
     * Retrieves a header.
     *
     * @param $key string The header.
     * @return string|null If the header is available, it's returned. Null otherwise.
     */
    public function getHeader($key)
    {
        return isset($this->headers[$key]) ? $this->headers[$key] : null;
    }

    /**
     * Set an HTTP header.
     *
     * @param $key
     * @param $value
     * @return $this
     * @throws InvalidArgumentException When the $key isn't a valid HTTP request header name.
     */
    public function setHeader($key, $value)
    {
        $key = $this->standardizeHeader($key);
        $this->headers[$key] = $value;
        return $this;
    }

    /**
     * Retrieves the user agent header.
     *
     * @return null|string The value or null if it doesn't exist.
     */
    public function getUserAgent()
    {
        return $this->getHeader('User-Agent');
    }

    /**
     * @param $headerName string
     * @return string The header, normalized, so HTTP_USER_AGENT becomes User-Agent
     * @throws InvalidArgumentException When the $headerName isn't a valid HTTP request header name.
     */
    protected function standardizeHeader($headerName)
    {
        if (strpos($headerName, 'HTTP_') === 0) {
            $headerName = substr($headerName, 5);
            $headerBits = explode('_', $headerName);

            array_walk($headerBits, function(& $v){
                //ignore MD5 and TE which should not be modified
                if ($v == 'MD5' || $v == 'TE') {
                    return;
                }
                $v = strtolower($v);
                $v = ucwords($v);
            });

            $headerName = implode('-', $headerBits);
        }

        //check for non-extension headers that are not standard
        if ($headerName[0] != 'X' && !in_array($headerName, static::$requestHeaders)) {
            throw new InvalidArgumentException("The request header $headerName isn't a recognized HTTP header name");
        }

        return $headerName;
    }

    /**
     * If header-based simple detection is feasible, this method will return the device information. Otherwise
     * null is returned indicating this type of detection wasn't feasible.
     *
     * @return null|Device
     */
    protected function headerDetect()
    {
        //do some simple checks here
        //@todo actually implement this
        return null;
    }

    /**
     * In the format of partial and variable regexes, this method returns whether or not a match was made
     * against some value.
     *
     * @param $value string The value to match up against.
     * @param $partialRegex string The partial regex. So we expect something like 'A|B' rather than '/A|B/i' here.
     * @param $modifiers string (optional) Something like 'i' to indicate case insensitivity. Default: 'i'.
     *
     * @return bool True if matched.
     */
    protected function matches($value, $partialRegex, $modifiers = 'i')
    {
        //@todo replace things like [VAR] with something useful in $partialRegex
        return preg_match("/$partialRegex/$modifiers", $value) === 1;
    }

    protected function getDeviceTypeKey(Device $device = null, array $search)
    {
        foreach ($search as $deviceName => $deviceTest) {
            //at least 'regex' and 'matchType' should be present
            if (!isset($deviceTest['matchType'])) {
                throw new LogicException("Invalid array passed for $deviceName: " . print_r($deviceTest, true));
            }

            if ($deviceTest['matchType'] == static::MATCH_TYPE_REGEX) {
                //sanity check
                if (!isset($deviceTest[static::MATCH_TYPE_REGEX])) {
                    throw new LogicException("The match type is 'regex', but there's no regular expression: "
                        . print_r($deviceTest, true));
                }

                if ($this->matches($device->getUserAgent(), $deviceTest['regex']))
                {
                    //found it!
                    return $deviceName;
                }
            }

            if ($deviceTest['matchType'] == static::MATCH_TYPE_STRIPOS) {
                //sanity check
                if (!isset($deviceTest[static::MATCH_TYPE_STRIPOS])) {
                    throw new LogicException("The match type is 'stripos', but there's no string to match against: "
                        . print_r($deviceTest, true));
                }

                if (false !== stripos($device->getUserAgent(), $deviceTest[static::MATCH_TYPE_STRIPOS]))
                {
                    //found it!
                    return $deviceName;
                }
            }
        }
    }

    /**
     *
     * @param $device string (optional) In case there's a special device implementation.
     * @return Device The device we've detected.
     * @throws InvalidArgumentException
     */
    public function detect($device = 'Device')
    {
        $userAgent = $this->getUserAgent();

        //if a device class was past, try to instantiate
        if (class_exists($device) and is_subclass_of($device, 'Device')) {
            $device = new $device($userAgent);
        } else {
            throw new InvalidArgumentException("$device is not a real class or isn't a child class of Device.");
        }

        //try a phone detection
        if ($this->getDeviceTypeKey($device, static::getPhoneDevices())) {
            //@todo fill device with phone-ish stuff
            $device->setType(Device::TYPE_MOBILE);
            $this->detectOs($device);
            $this->detectBrowser($device);
        } elseif ($this->getDeviceTypeKey($device, static::getTabletDevices())) {
            //@todo fill device with tablet-ish stuff
            $device->setType(Device::TYPE_TABLET);
            $this->detectOs($device);
            $this->detectBrowser($device);
        } elseif ($this->getDeviceTypeKey($device, static::getUtilities())) {
            //@todo fill device with utility-ish stuff
            $device->setType(Device::TYPE_BOT);
        } else {
            $device->setType(Device::TYPE_DESKTOP);
            $this->detectOs($device);
            $this->detectBrowser($device);
        }

        //0. start simple detection to help us later
        //1. we need to detect device type
        //2. we need to detect OS
        //3. we need to detect browser

        return $device;
    }
}
