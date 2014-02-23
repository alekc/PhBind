<?php
namespace PhBind\Types;


use PhBind\Validator\GenericValidator;

class TextRawMap {
    const VALUE_TEXT = "text";
    const VALUE_RAW = "raw";
    const VALUE_MAP = "map";

    protected $_value;

    function __construct($value)
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
        $ins = new static(GenericValidator::checkTextRawMapAnswer($value));
        return $ins;
    }

    /**
     * @return static
     */
    public static function createAndSetText()
    {
        $ins = new static(self::VALUE_TEXT);
        return $ins;
    }

    /**
     * @return static
     */
    public static function createAndSetRaw()
    {
        $ins = new static(self::VALUE_RAW);
        return $ins;
    }

    /**
     * @return static
     */
    public static function createAndSetMap()
    {
        $ins = new static(self::VALUE_MAP);
        return $ins;
    }

    function __toString()
    {
        return $this->_value;
    }


}