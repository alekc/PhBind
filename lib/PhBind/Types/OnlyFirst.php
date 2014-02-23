<?php
namespace PhBind\Types;


class OnlyFirst {
    /**
     *
     */
    const VALUE_ONLY = "only";
    /**
     *
     */
    const VALUE_FIRST = "first";

    /** @var string */
    protected $_value;

    /**
     * @param $value
     */
    protected function __construct($value)
    {
        $this->_value = $value;
    }

    /**
     * @param $value
     *
     * @return static
     */
    public static function create($value)
    {
        $ins = new static($value);
        return $ins;
    }

    /**
     * @return static
     */
    public static function createAndSetOnly(){
        $ins = new static(self::VALUE_ONLY);
        return $ins;
    }

    /**
     * @return static
     */
    public static function createAndSetFirst(){
        $ins = new static(self::VALUE_FIRST);
        return $ins;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->_value;
    }

}