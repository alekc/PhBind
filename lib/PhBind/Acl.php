<?php
namespace PhBind;

use PhBind\AddressListMatch;
use PhBind\Helpers\GenericHelper;

class Acl {
    /** @var string */
    protected $_name;

    /** @var AddressListMatch  */
    protected $_addressMatchList;

    function __construct($name)
    {
        $this->_name = $name;
    }

    /**
     *
     * @param string $name
     *
     * @return static
     */
    public static function create($name)
    {
        $ins = new static($name);
        return $ins;
    }
    /**
     * @param AddressListMatch $addressMatchList
     *
     * @return Acl Instance
     */
    public function setAddressMatchList($addressMatchList)
    {
        $this->_addressMatchList = $addressMatchList;
        return $this;
    }

    function __toString()
    {
        $output = GenericHelper::prefixBySpaces($this->_addressMatchList,4);
        return <<<EOF
acl "{$this->_name}"{
{$output}
};
EOF;

    }

}