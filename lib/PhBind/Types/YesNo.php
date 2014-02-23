<?php
namespace PhBind\Types;


use PhBind\Validator\GenericValidator;

class YesNo {
    const VALUE_YES = "yes";
    const VALUE_NO = "no";

    protected $value;

    protected function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return static
     */
    public static function createYes()
    {
        return new static(self::VALUE_YES);
    }

    /**
     * @return static
     */
    public static function createNo()
    {
        return new static(self::VALUE_NO);
    }

    /**
     * @param $value
     *
     * @return static
     */
    public static function create($value){
        GenericValidator::checkYesNoAnswer($value);
        return new static($value);
    }

    function __toString()
    {
        return $this->value;
    }

}