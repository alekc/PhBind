<?php
namespace PhBind\Types;

class AlsoNotify extends GenericList
{
    /**
     * @param string $ip
     * @param int    $port
     *
     * @return $this
     */
    public function addIpv4($ip, $port = null)
    {
        $this->_values[] = new Ipv4($ip, $port);
        return $this;
    }

    /**
     * @param string $masterList
     * @param int    $port
     */
    public function addMasterList($masterList, $port = null)
    {
        $entry = "\"{$masterList}\"";
        if ($port) {
            $entry .= " port {$port}";
        }
        $this->_values[] = $entry;
        return $this;
    }
}