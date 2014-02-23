<?php
namespace PhBind;

use PhBind\Parser\NamedParser;

class Named {
    /** @var  Zone[] */
    protected $zones;

    /** @var Acl[] */
    protected $_acl;

    protected $_controls; //todo
    protected $_keys; //todo

    /**
     * @param $acl
     *
     * @return static
     */
    public function addAcl($acl)
    {
        $this->_acl[] = $acl;
        return $this;
    }

    /**
     * Return named
     * @param string $filename Filename path
     *
     * @return Named
     */
    public static function createFromFile($filename)
    {
        $named = NamedParser::create()->parseFromFileName($filename);
        return $named;
    }

    /**
     * @param Zone[] $zones
     *
     * @return Named Instance
     */
    public function setZones($zones)
    {
        $this->zones = $zones;
        return $this;
    }

    /**
     * Returns zone if exists, false otherwise
     * @param $zoneName
     *
     * @return Zone
     */
    public function getZoneByName($zoneName){
        if (!isset($this->zones[$zoneName])){
            return false;
        }
        return $this->zones[$zoneName];
    }

    /**
     * Return named string representation
     *
     * @return string
     */
    public function getAsString()
    {
        $output = <<<EOF
{$this->getChilds($this->_acl)}
{$this->getChilds($this->zones)}
EOF;
        return $output;
    }

    /**
     * Returns all zones in their string representations
     * @return string
     */
    protected function getChilds($objects)
    {
        $output = "";
        foreach ($objects as $object){
            $output .= (string) $object . "\n";
        }
        return $output;
    }

    function __toString()
    {
        return $this->getAsString();
    }
}