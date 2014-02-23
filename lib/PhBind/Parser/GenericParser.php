<?php
/**
 * Created by PhpStorm.
 * User: Alekc
 * Date: 16/02/14
 * Time: 15.17
 */

namespace PhBind\Parser;


class GenericParser {
    protected $buffer;

    /**
     * Factory
     *
     * @return ZoneParser
     */
    public static function create()
    {
        /** @var ZoneParser $ins */
        $ins = new static();
        return $ins;
    }

    /**
     * @param $key
     *
     * @return bool|string
     */
    protected function searchForGenericValue($key){
        if (!preg_match("/{$key}\s+(.*?)\s{0,};/", $this->buffer, $regs)) {
            return false;
        }
        $this->buffer = str_replace($regs[0], "", $this->buffer);
        return trim($regs[1]);
    }

    /**
     * @param $sectionName
     *
     * @return \Bind\AddressListMatch|bool
     */
    protected function searchForGenericAccessListSection($sectionName)
    {
        if (!preg_match("/\s+{$sectionName}\s+\{(.*?)\}\s{0,};/s", $this->buffer, $regs)) {
            return false;
        }
        $addressMatchList = AddressListMatchParser::parseText($regs[1]);
        //remove parsed string
        $this->buffer = str_replace($regs[0], "", $this->buffer);
        return $addressMatchList;
    }

    /**
     * Sets buffer for parsing
     *
     * @param $text
     *
     * @return ZoneParser
     */
    protected function setBuffer($text)
    {
        $this->buffer = $text;
        return $this;
    }
}