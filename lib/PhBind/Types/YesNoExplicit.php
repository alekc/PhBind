<?php
namespace PhBind\Types;


use PhBind\Validator\GenericValidator;

class YesNoExplicit extends YesNo{
    const VALUE_EXPLICIT = "explicit";

    /**
     * @return static
     */
    public static function createExplicit()
    {
        return new static(self::VALUE_EXPLICIT);
    }

    /**
     * @param $value
     *
     * @return static
     */
    public static function create($value){
        GenericValidator::checkYesNoExplicitAnswer($value);
        return new static($value);
    }
}