<?php
namespace PhBind\Types;


class Ipv4 {
    protected $_ip;
    protected $_ipType = "ipv4";
    protected $_port;
    function __construct($ip,$port = null)
    {
        if (!$this->test($ip)){
            throw new \InvalidArgumentException("This is not valid {$this->_ipType} address");
        }
        $this->_ip = $ip;
        $this->_port = $port;
    }

    public static function test($ip)
    {
        if (!preg_match('/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/m', $ip)) {
            return false;
        }
        return true;
    }

    function __toString()
    {
        $output = $this->_ip;
        if (!is_null($this->_port)){
            $output .= " port {$this->_port}";
        }
        return $output;
    }


}