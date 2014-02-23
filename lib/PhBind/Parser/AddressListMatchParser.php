<?php
namespace PhBind\Parser;


use PhBind\AddressListMatch;

class AddressListMatchParser {
    /**
     * @param $text
     *
     * @return AddressListMatch|bool
     */
    public static function parseText($text)
    {
        $entities = explode(";",$text);
        if (!count($entities)){
            //no keys found
            return false;
        }
        //generation of AddressListMatch
        $addressListMatch = AddressListMatch::create();
        foreach ($entities as $entity){
            $addressListMatch->addGenericEntity($entity);
        }
        return $addressListMatch;
    }

}