<?php
namespace PhBind\Types;


class UpdatePolicy {
    /**
     * @var mixed
     */
    protected $_value;
    /**
    *
    * @return static
    */
    public static function create()
    {
        $ins = new static();
        return $ins;
    }

    /**
     * @return static
     */
    public function setLocal(){
        $this->_value = "local";
        return $this;
    }

    /**
     * @param $rule
     *
     * @return static
     */
    public function setRule($rule){
        $this->_value = $rule;
        return $this;
    }

    function __toString()
    {
        $output = (string) $this->_value;
        if (!empty($output)){
            $output .= ";";
        }
        return $output;
    }


}