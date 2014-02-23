<?php

namespace PhBind\Types;


use PhBind\Validator\GenericValidator;

class DialUpOptions {
    const VALUE_NO = "no";
    const VALUE_YES = "yes";
    const VALUE_NOTIFY = "notify";
    const VALUE_REFRESH = "refresh";
    const VALUE_PASSIVE = "passive";
    const VALUE_NOTIFY_PASSIVE = "notify-passive";

    /** @var  string */
    protected $_value;

    protected function __construct($value)
    {
        GenericValidator::checkDialUpOptionAnswer($value);
        $this->_value = $value;
    }

    /**
     * @return static
     */
    public static function createAndSetNo()
    {
        $ins = new static(self::VALUE_NO);
        return $ins;
    }
    /**
     * @return static
     */
    public static function createAndSetYes()
    {
        $ins = new static(self::VALUE_YES);
        return $ins;
    }
    /**
     * @return static
     */
    public static function createAndSetNotify()
    {
        $ins = new static(self::VALUE_NOTIFY);
        return $ins;
    }
    /**
     * @return static
     */
    public static function createAndSetRefresh()
    {
        $ins = new static(self::VALUE_REFRESH);
        return $ins;
    }
    /**
     * @return static
     */
    public static function createAndSetPassive()
    {
        $ins = new static(self::VALUE_PASSIVE);
        return $ins;
    }
    /**
     * @return static
     */
    public static function createAndSetNotifyPassive()
    {
        $ins = new static(self::VALUE_NOTIFY_PASSIVE);
        return $ins;
    }

    function __toString()
    {
        return $this->_value;
    }


}