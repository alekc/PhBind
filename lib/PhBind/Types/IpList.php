<?php

namespace PhBind\Types;


/**
 * Class IpList
 * @package PhBind\Types
 */
class IpList extends GenericList
{


    /**
     * @param      $ip
     *
     * @param int  $port
     *
     * @return $this
     */
    public function addIpv4($ip, $port = null)
    {
        $this->_values[] = new Ipv4($ip, $port);
        return $this;
    }

    /**
     * @param string $value
     * @param int    $port
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function add($value, $port = null)
    {
        if ($value == "*") {
            $this->_values[] = "*";
            return $this;
        }
        if (Ipv4::test($value)) {
            $this->_values[] = new Ipv4($value, $port);
            return $this;
        }
        if (Ipv6::test($value)) {
            $this->_values[] = new Ipv6($value, $port);
            return $this;
        }
        throw new \InvalidArgumentException("{$value} is invalid address");
    }


    /**
     * @param      $ip
     *
     * @param int  $port
     *
     * @return $this
     */
    public function addIpv6($ip, $port = null)
    {
        $this->_values[] = new Ipv6($ip, $port);
        return $this;
    }

}