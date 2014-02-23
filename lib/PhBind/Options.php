<?php

namespace PhBind;


use PhBind\Helpers\GenericHelper;
use PhBind\Types\YesNo;

class Options {
    /** @var  YesNo */
    protected $_provideIxFr;

    /** @var  YesNo */
    protected $_requestIxFr;

    /** @var  int */
    protected $_serialQueryRate;


    /** @var  int */
    protected $_transfersIn;

    /** @var  int */
    protected $_transfersOut;

    /**
     * @param \Bind\Types\YesNo $provideIxFr
     *
     * @return self Instance
     */
    public function setProvideIxFr($provideIxFr)
    {
        $this->_provideIxFr = GenericHelper::checkIfObjectIsInstanceOfYesNoThrowExceptionOtherWise($provideIxFr);
        return $this;
    }

    /**
     * @param \Bind\Types\YesNo $requestIxFr
     *
     * @return self Instance
     */
    public function setRequestIxFr($requestIxFr)
    {
        GenericHelper::checkIfZoneIsSlaveAndThrowExceptionIfNot($this->_type);
        $this->_requestIxFr = GenericHelper::checkIfObjectIsInstanceOfYesNoThrowExceptionOtherWise($requestIxFr);
        return $this;
    }

    /**
     * @param int $serialQueryRate
     *
     * @return self Instance
     */
    public function setSerialQueryRate($serialQueryRate)
    {
        $this->_serialQueryRate = intval($serialQueryRate);
        return $this;
    }
    /**
     * @param int $transfersIn
     *
     * @return self Instance
     */
    public function setTransfersIn($transfersIn)
    {
        ZoneValidator::checkIfZoneIsSlaveAndThrowExceptionIfNot($this->_type);
        $this->_transfersIn = intval($transfersIn);
        return $this;
    }

    /**
     * @param int $transfersOut
     *
     * @return self Instance
     */
    public function setTransfersOut($transfersOut)
    {
        ZoneValidator::checkIfZoneIsSlaveAndThrowExceptionIfNot($this->_type);
        $this->_transfersOut = intval($transfersOut);
        return $this;
    }

}