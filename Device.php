<?php

/**
 * Class Device
 *
 * Defines properties for a particular device.
 */
class Device
{
    const TYPE_MOBILE           = 0;
    const TYPE_DESKTOP          = 1;
    const TYPE_TABLET           = 2;

    protected static $itemsProperties = array(
        // Build specific version.
        'Mobile'        => 'Mobile/[REGEX]',
        'Build'         => 'Build/[REGEX]',
        // Device specific version.
        'iPad'          => 'iPad.*CPU[a-z ]+[REGEX]',
        // Browser version.
        'Chrome'        => array('Chrome/[REGEX]', 'CriOS/[REGEX]', 'CrMo/[REGEX]'),
        // Engine version.
        // OS version.
        // [...]
    );

    protected $type;

    protected $userAgent;

    protected $model;
    protected $modelVersion;
    protected $operatingSystem;
    protected $operatingSystemVersion;
    protected $browser;
    protected $browserVersion;

    public function __construct($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        if ($type != static::TYPE_DESKTOP && $type != static::TYPE_MOBILE && $type != static::TYPE_TABLET) {
            throw new InvalidArgumentException("Unrecognized type: '$type'");
        }

        $this->type = $type;
        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function getModelVersion()
    {
        return $this->modelVersion;
    }

    public function setModelVersion($version)
    {
        $this->modelVersion = $version;
        return $this;
    }

    public function getOperatingSystem()
    {
        return $this->operatingSystem;
    }

    public function setOperatingSystem($os)
    {
        $this->operatingSystem = $os;
        return $this;
    }

    public function getOperatingSystemVersion()
    {
        return $this->operatingSystemVersion;
    }

    public function setOperatingSystemVersion($version)
    {
        $this->operatingSystemVersion = $version;
        return $this;
    }

    public function getBrowser()
    {
        return $this->browser;
    }

    public function setBrowser($browser)
    {
        $this->browser = $browser;
        return $this;
    }

    public function getBrowserVersion()
    {
        return $this->browser;
    }

    public function setBrowserVersion($version)
    {
        $this->browserVersion = $version;
        return $this;
    }

    public function isMobile()
    {
        return $this->type == static::TYPE_MOBILE;
    }

    public function isDesktop()
    {
        return $this->type == static::TYPE_DESKTOP;
    }

    public function isTablet()
    {
        return $this->type == static::TYPE_TABLET;
    }

    public function undetected()
    {
        return $this->type === null;
    }

    public function __call($method, $args)
    {
        //in here we would do checks against the static::$itemsProperties
    }
}
