<?php
namespace PhBind\Types;


class GenericList {
    /**
     * @var array
     */
    protected $_values = array();

    /**
     * @return static
     */
    public static function create()
    {
        $ins = new static();
        return $ins;
    }

    /**
     * @param $value
     */
    public function add($value)
    {
        $this->_values[] = $value;
        return $this;
    }

    /**
     * @return string
     */
    function __toString()
    {
        if (!count($this->_values)) {
            return "";
        }
        $separator = ";\n";
        $output    = implode($separator, $this->_values) . $separator;
        return substr($output, 0, strlen($output) - 1);
    }
}