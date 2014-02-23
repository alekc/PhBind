<?php

namespace PhBind\Validator;


use PhBind\Types\UpdatePolicy;
use PhBind\Zone;

class ZoneValidator extends GenericValidator{
    /**
     * Checks if this zone is a slave zone,
     * if not throw an InvalidArgumentException
     *
     * @throws \InvalidArgumentException
     */
    public static function checkIfZoneIsSlaveAndThrowExceptionIfNot($type)
    {
        if ($type != Zone::TYPE_SLAVE) {
            throw new \InvalidArgumentException("This setting can be applied to slave zone only");
        }
    }

    /**
     * Checks if it's a master zone
     * @throws \InvalidArgumentException
     */
    public static function checkIfZoneIsMasterAndThrowExceptionIfNot($type)
    {
        if ($type != Zone::TYPE_MASTER) {
            throw new \InvalidArgumentException("This setting can be applied to master zone only");
        }
    }

    /**
     * @throws \InvalidArgumentException
     */
    public static function checkIfZoneIsStubAndThrowExceptionIfNot($type){
        if ($type != Zone::TYPE_STUB) {
            throw new \InvalidArgumentException("This setting can be applied to master zone only");
        }
    }

    /**
     * @throws \InvalidArgumentException
     */
    public static function checkIfZoneIsSlaveOrStubAndThrowExceptionIfNot($type)
    {
        if (!in_array($type,array(Zone::TYPE_SLAVE,Zone::TYPE_STUB))){
            throw new \InvalidArgumentException("This setting can be applied to slave or stub zone only");
        }
    }
    public static function checkIfObjectIsInstanceOfUpdatePolicyThrowExceptionOtherWise($object){
        if (!($object instanceof UpdatePolicy)){
            throw new \Exception("This object is not UpdatePolicy type");
        }
        return $object;
    }
}