<?php
namespace PhBind;

/**
 * Class AddressListMatch
 * @package Address
 */
class AddressListMatch
{
    /** matches no host IP addresses */
    const DEFAULT_TYPE_NONE = "none";

    /** matches all host IP addresses */
    const DEFAULT_TYPE_ANY = "any";

    /**
     * matches all the IP address(es) of the server on which BIND
     * is running but only when accessed from the same host (internal).
     */
    const DEFAULT_TYPE_LOCALHOST = "localhost";

    /**
     *  matches all the IP address(es) and subnetmasks
     *  of the server on which BIND is running.
     */
    const DEFAULT_TYPE_LOCALNETS = "localnets";


    /**
     * @var array
     */
    protected $_allow = array();

    /**
     * @var array
     */
    protected $_disallow = array();

    /**
     * @return AddressListMatch
     */
    public static function create()
    {
        /** @var self $ins */
        $ins = new static();
        return $ins;
    }

    /**
     * @param $entity
     *
     * @return self
     */
    public function addGenericEntity($entity){
        $entity = trim($entity);
        if ($entity == ""){
            return $this;
        }
        if ($entity[0] == "!"){
            $this->disallow($entity);
        } else {
            $this->allow($entity);
        }
        return $this;
    }
    /**
     * Allow ip
     *
     * @param string $entry entry to add in allow list
     *
     * @todo: check for ip/network/acl/local zone and add quotes if needed
     * @return $this
     */
    public function allow($entry)
    {
        $this->_allow[] = $entry;
        return $this;
    }

    /**
     * Disallow ip
     *
     * @param string $entry
     *
     * @todo: check for ip/network/acl/local zone
     * @return $this
     */
    public function disallow($entry)
    {
        $this->_disallow[] = $entry;
        return $this;
    }

    /**
     * Clear all addresses
     *
     * @return $this
     */
    public function clean()
    {
        $this->_allow    = array();
        $this->_disallow = array();
        return $this;
    }

    /**
     * @return $this
     */
    public function allowNone()
    {
        return $this->allow(self::DEFAULT_TYPE_NONE);
    }

    /**
     * @return $this
     */
    public function allowAny()
    {
        return $this->allow(self::DEFAULT_TYPE_ANY);
    }

    /**
     * @return $this
     */
    public function allowLocalhost()
    {
        return $this->allow(self::DEFAULT_TYPE_LOCALHOST);
    }

    /**
     * @return $this
     */
    public function allowLocalNets()
    {
        return $this->allow(self::DEFAULT_TYPE_LOCALNETS);
    }

    /**
     * @return $this
     */
    public function disallowNone()
    {
        return $this->disallow(self::DEFAULT_TYPE_NONE);
    }

    /**
     * @return $this
     */
    public function disallowAny()
    {
        return $this->disallow(self::DEFAULT_TYPE_ANY);
    }

    /**
     * @return $this
     */
    public function disallowLocalhost()
    {
        return $this->disallow(self::DEFAULT_TYPE_LOCALHOST);
    }

    /**
     * @return $this
     */
    public function disallowLocalNets()
    {
        return $this->disallow(self::DEFAULT_TYPE_LOCALNETS);
    }

    /**
     * Ritrova la stringa
     *
     * @return string
     */
    public function getAsString()
    {
        $separator = ";\n";
        $output = "";
        if (count($this->_allow)) {
            $output .= implode($separator, $this->_allow) . $separator;
        }
        foreach ($this->_disallow as $entry){
            $output .= "!" . $entry . $separator;
        }
        return substr($output,0,strlen($output)-1);
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->getAsString();
    }

}