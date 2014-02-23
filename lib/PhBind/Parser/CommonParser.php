<?php
namespace PhBind\Parser;


use PhBind\Types\CommonZoneOptView;

class CommonParser extends GenericParser
{
    /** @var CommonZoneOptView */
    protected $object = false;


    public static function createZoneFromText($text)
    {
        $parser = self::create()
                      ->setBuffer($text)
                      ->createObject()
                      ->beginParsing();

        return $parser->getResult();
    }

    /**
     * @return $this
     */
    protected function createObject()
    {
        $this->object = new CommonZoneOptView();
        return $this;
    }


    /**
     * Begin parsing of zone entry
     * @return self
     */
    protected function beginParsing()
    {
        $this->searchForAllowTransfer();


        $this->searchForAllowNotify();

        $this->searchForMinRefreshTime()
             ->searchForMaxRefreshTime();

        $this->searchForMinRetryTime()
             ->searchForMaxRetryTime();

        $this->searchForMaxTransferIdleIn()
             ->searchForMaxTransferIdleOut();

        $this->searchForMaxTransferTimeIn()
             ->searchForMaxTransferTimeOut();


        return $this;
    }

    /**
     * Search for min refresh time
     *
     * @return self
     */
    protected function searchForMinRefreshTime()
    {
        $value = $this->searchForGenericValue("min-refresh-time");
        if ($value !== false) {
            $this->object->setMinRefreshTime($value);
        }
        return $this;
    }

    protected function searchForMaxRefreshTime()
    {
        $value = $this->searchForGenericValue("max-refresh-time");
        if ($value !== false) {
            $this->object->setMaxRefreshTime($value);
        }
        return $this;
    }

    /**
     * @return $this
     */
    protected function searchForMinRetryTime()
    {
        $value = $this->searchForGenericValue("min-retry-time");
        if ($value !== false) {
            $this->object->setMinRetryTime($value);
        }
        return $this;
    }

    protected function searchForMaxRetryTime()
    {
        $value = $this->searchForGenericValue("max-retry-time");
        if ($value !== false) {
            $this->object->setMaxRetryTime($value);
        }
        return $this;
    }

    protected function searchForMaxTransferIdleIn()
    {
        $value = $this->searchForGenericValue("max-transfer-idle-in");
        if ($value !== false) {
            $this->object->setMaxTransferIdleIn($value);
        }
        return $this;
    }

    protected function searchForMaxTransferIdleOut()
    {
        $value = $this->searchForGenericValue("max-transfer-idle-out");
        if ($value !== false) {
            $this->object->setMaxTransferIdleOut($value);
        }
        return $this;
    }

    protected function searchForMaxTransferTimeIn()
    {
        $value = $this->searchForGenericValue("max-transfer-time-in");
        if ($value !== false) {
            $this->object->setMaxTransferTimeIn($value);
        }
        return $this;
    }

    protected function searchForMaxTransferTimeOut()
    {
        $value = $this->searchForGenericValue("max-transfer-time-out");
        if ($value !== false) {
            $this->object->setMaxTransferTimeOut($value);
        }
        return $this;
    }


    /**
     * Search for any allow-transfer block
     * @return self
     */
    protected function searchForAllowTransfer()
    {
        $genericObject = $this->searchForGenericAccessListSection("allow-transfer");
        if (!$genericObject) {
            return $this;
        }
        $this->object->setAllowTransfer($genericObject);
        return $this;
    }

    protected function searchForAllowNotify()
    {
        $genericObject = $this->searchForGenericAccessListSection("allow-notify");
        if ($genericObject !== false) {
            $this->object->setAllowNotify($genericObject);
        }
        return $this;
    }

    protected function searchForTransferSource()
    {}


    protected function getResult()
    {
        return $this->object;
    }
}