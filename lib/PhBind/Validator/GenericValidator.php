<?php
namespace PhBind\Validator;


use PhBind\Acl;
use PhBind\Types\AlsoNotify;
use PhBind\Types\DialUpOptions;
use PhBind\Types\FailWarnIgnore;
use PhBind\Types\IpList;
use PhBind\Types\OnlyFirst;
use PhBind\Types\TextRawMap;
use PhBind\Types\YesNo;
use PhBind\Types\YesNoExplicit;

class GenericValidator
{
    /**
     * @param $value
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function checkYesNoAnswer($value)
    {
        $value = strtolower($value);
        if (!in_array($value, array(YesNo::VALUE_NO, YesNo::VALUE_YES))) {
            throw new \InvalidArgumentException("This setting can be only setted to yes, no value");
        }
        return $value;
    }

    /**
     * @param $value
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function checkFailWarnIgnore($value)
    {
        $value = strtolower($value);
        if (!in_array($value, array(FailWarnIgnore::VALUE_WARN,
            FailWarnIgnore::VALUE_IGNORE,
            FailWarnIgnore::VALUE_FAIL))
        ) {
            throw new \InvalidArgumentException("This setting can be only setted to warn,ignore,fail");
        }
        return $value;
    }

    /**
     * @param $value
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function checkYesNoExplicitAnswer($value)
    {
        $value = strtolower($value);
        if (!in_array($value, array(YesNo::VALUE_NO, YesNo::VALUE_YES, YesNoExplicit::VALUE_EXPLICIT))) {
            throw new \InvalidArgumentException("This setting can be only setted to yes, no value");
        }
        return $value;
    }

    /**
     * @param $value
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function checkTextRawMapAnswer($value)
    {
        $value = strtolower($value);
        if (!in_array($value, array(
            TextRawMap::VALUE_MAP,
            TextRawMap::VALUE_RAW,
            TextRawMap::VALUE_TEXT
        ))
        ) {
            throw new \InvalidArgumentException("This setting can be only setted to text|raw|map value");
        }
        return $value;
    }

    /**
     * @param $value
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function checkDialUpOptionAnswer($value)
    {
        $value = strtolower($value);
        if (!in_array($value, array(
            DialUpOptions::VALUE_NO,
            DialUpOptions::VALUE_NOTIFY,
            DialUpOptions::VALUE_NOTIFY_PASSIVE,
            DialUpOptions::VALUE_PASSIVE,
            DialUpOptions::VALUE_REFRESH,
            DialUpOptions::VALUE_YES,
        ))
        ) {
            throw new \InvalidArgumentException("Invalid value for Dial Up Option");
        }
        return $value;
    }

    /**
     * @param $value
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function checkOnlyFirstAnswer($value)
    {
        $value = strtolower($value);
        if (!in_array($value, array(OnlyFirst::VALUE_FIRST, OnlyFirst::VALUE_ONLY))) {
            throw new \InvalidArgumentException("This setting can be only setted to only,first value");
        }
        return $value;
    }

    /**
     * @param $object
     *
     * @return YesNo
     * @throws \Exception
     */
    public static function checkIfObjectIsInstanceOfYesNoThrowExceptionOtherWise($object)
    {
        if (!($object instanceof YesNo)) {
            throw new \Exception("This object is not YesNo type");
        }
        return $object;
    }

    /**
     * @param $object
     *
     * @return mixed
     * @throws \Exception
     */
    public static function checkIfObjectIsInstanceOfYesNoExplicitThrowExceptionOtherWise($object)
    {
        if (!($object instanceof YesNoExplicit)) {
            throw new \Exception("This object is not YesNoExplicit type");
        }
        return $object;
    }

    /**
     * @param $object
     *
     * @return mixed
     * @throws \Exception
     */
    public static function checkIfObjectIsInstanceOfFailWarnIgnoreThrowExceptionOtherWise($object)
    {
        if (!($object instanceof FailWarnIgnore)) {
            throw new \Exception("This object is not FailWarnIgnore type");
        }
        return $object;
    }

    /**
     * @param $object
     *
     * @return mixed
     * @throws \Exception
     */
    public static function checkIfObjectIsInstanceOfDialUpOptionsThrowExceptionOtherWise($object)
    {
        if (!($object instanceof DialUpOptions)) {
            throw new \Exception("This object is not FailWarnIgnore type");
        }
        return $object;
    }

    /**
     * @param $object
     *
     * @return mixed
     * @throws \Exception
     */
    public static function checkIfObjectIsInstanceOfOnlyFirstThrowExceptionOtherWise($object)
    {
        if (!($object instanceof OnlyFirst)) {
            throw new \Exception("This object is not OnlyFirst type");
        }
        return $object;
    }

    /**
     * @param $object
     *
     * @return mixed
     * @throws \Exception
     */
    public static function checkIfObjectIsInstanceOfTextRawMapThrowExceptionOtherWise($object)
    {
        if (!($object instanceof TextRawMap)) {
            throw new \Exception("This object is not TextRawMap type");
        }
        return $object;
    }

    public static function checkIfObjectIsInstanceOfIpListThrowExceptionOtherWise($object)
    {
        if (!($object instanceof IpList)) {
            throw new \Exception("This object is not IpList type");
        }
        return $object;
    }

    public static function checkIfObjectIsAclThrowExceptionOtherWise($object)
    {
        if (!($object instanceof Acl)) {
            throw new \Exception("This object is not Acl type");
        }
        return $object;
    }

    public static function checkIfObjectIsInstanceOfAlsoNotifyThrowExceptionOtherWise($object)
    {
        if (!($object instanceof AlsoNotify)) {
            throw new \Exception("This object is not AlsoNotify type");
        }
        return $object;
    }

    /**
     * @param int $currentValue Current value to check
     * @param int $maxAllowedValue maximum allowedvalue
     *
     * @return int
     * @throws \InvalidArgumentException
     */
    public static function checkIfValueIsBiggerThanOfAndThrowExceptionIfNot($currentValue, $maxAllowedValue)
    {
        $value = intval($currentValue);
        if ($value > $maxAllowedValue) {
            throw new \InvalidArgumentException("Maximum allowed value is {$maxAllowedValue}");
        }
        return $value;
    }

}