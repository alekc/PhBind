<?php

namespace PhBind\Types;


class FailWarnIgnore {
    const VALUE_FAIL = "fail";
    const VALUE_WARN = "warn";
    const VALUE_IGNORE = "ignore";

    protected $_value;

    protected function __construct($value)
    {
        $this->_value = $value;
    }

    /**
     * @return static
     */
    public static function createAndSetWarn(){
        $ins = new static(self::VALUE_WARN);
        return $ins;
    }

    /**
     * @return static
     */
    public static function createAndSetFail(){
        $ins = new static(self::VALUE_FAIL);
        return $ins;
    }

    /**
     * @return static
     */
    public static function createAndSetIgnore(){
        $ins = new static(self::VALUE_IGNORE);
        return $ins;
    }

    function __toString()
    {
        return $this->_value;
    }

}