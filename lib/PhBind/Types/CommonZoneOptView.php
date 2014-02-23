<?php

namespace PhBind\Types;


use PhBind\AddressListMatch;
use PhBind\Types\AlsoNotify;
use PhBind\Helpers\GenericHelper;
use PhBind\Validator\GenericValidator;
use PhBind\Validator\ZoneValidator;
use PhBind\Zone;

class CommonZoneOptView {
    protected $_type;

    /** @var  AddressListMatch */
    protected $_allowNotify;

    /** @var  AddressListMatch */
    protected $_allowQuery;

    /** @var  AddressListMatch */
    protected $_allowTransfer;

    /** @var  AddressListMatch */
    protected $_allowUpdateForwarding;

    /**
     * allow-notify applies to slave zones only and defines a match list,
     * for example, IP address(es) that are allowed to NOTIFY this server
     * and implicitly update the zone in addition to those hosts defined
     * in the masters option for the zone.
     * http://www.zytrax.com/books/dns/ch7/xfer.html#also-notify
     *
     * @var AlsoNotify
     */
    protected $_alsoNotify;

    /** @var IpList */
    protected $_altTransferSource;

    /** @var IpList */
    protected $_altTransferSourceV6; //todo

    /** @var DialUpOptions */
    protected $_dialUp;

    /** @var  OnlyFirst */
    protected $_forward;

    /** @var  IpList */
    protected $_forwarders;

    /** @var YesNo */
    protected $_ixfrFromDifferences;

    /** @var  string */
    protected $_keyDirectory;

    /** @var  TextRawMap */
    protected $_masterFileFormat;

    protected $_maxJournalSize;

    protected $_maxRefreshTime;
    protected $_minRefreshTime;

    /** @var  mixed */
    protected $_minRetryTime;
    /** @var  mixed */
    protected $_maxRetryTime;

    protected $_maxTransferIdleIn;
    protected $_maxTransferIdleOut;


    protected $_maxTransferTimeIn;
    protected $_maxTransferTimeOut;

    /** @var  YesNo */
    protected $_multiMaster;

    /** @var  YesNoExplicit */
    protected $_notify;

    /** @var IpList */
    protected $_notifySource;

    /** @var IpList */
    protected $_notifySourceV6;

    /** @var int */
    protected $_sigValidityInterval;

    /** @var  IpList */
    protected $_transferSource;
    /** @var  IpList */
    protected $_transferSourceV6;

    /** @var  YesNo */
    protected $_useAltTransferSource;

    /** @var  YesNo */
    protected $_zoneStatistics;
    /** @var  FailWarnIgnore */
    protected $_checkNames;

    /**
     * @param int $maxJournalSize Max journal size in bytes
     *
     * @return self Instance
     */
    public function setMaxJournalSize($maxJournalSize)
    {
        $this->_maxJournalSize = $maxJournalSize;
        return $this;
    }

    /**
     * Sets allow-notify rule
     *
     * @param AddressListMatch $addressListMatch
     *
     * @return static
     */
    public function setAllowNotify($addressListMatch)
    {
        ZoneValidator::checkIfZoneIsSlaveAndThrowExceptionIfNot($this->_type);
        $this->_allowNotify = $addressListMatch;
        return $this;
    }

    /**
     * @param \Bind\Types\IpList $notifySource
     *
     * @return self Instance
     */
    public function setNotifySource($notifySource)
    {
        $this->_notifySource = GenericValidator::checkIfObjectIsInstanceOfIpListThrowExceptionOtherWise($notifySource);
        return $this;
    }

    /**
     * @param \Bind\Types\IpList $notifySourceV6
     *
     * @return self Instance
     */
    public function setNotifySourceV6($notifySourceV6)
    {
        $this->_notifySourceV6 = GenericValidator::checkIfObjectIsInstanceOfIpListThrowExceptionOtherWise($notifySourceV6);
        return $this;
    }



    /**
     * @param AddressListMatch $allowTransfer
     *
     * @return static
     */
    public function setAllowTransfer($allowTransfer)
    {
        $this->_allowTransfer = $allowTransfer;
        return $this;
    }

    /**
     * @param \Bind\AddressListMatch $allowQuery
     *
     * @return static Instance
     */
    public function setAllowQuery($allowQuery)
    {
        $this->_allowQuery = $allowQuery;
        return $this;
    }

    /**
     * @param \Bind\AddressListMatch $allowUpdateForwarding
     *
     * @return static Instance
     */
    public function setAllowUpdateForwarding($allowUpdateForwarding)
    {
        $this->_allowUpdateForwarding = $allowUpdateForwarding;
        return $this;
    }

    /**
     * @param mixed $maxRefreshTime
     *
     * @return static Instance
     */
    public function setMaxRefreshTime($maxRefreshTime)
    {
        ZoneValidator::checkIfZoneIsSlaveOrStubAndThrowExceptionIfNot($this->_type);
        $this->_maxRefreshTime = intval($maxRefreshTime);
        return $this;
    }

    /**
     * @param mixed $minRefreshTime
     *
     * @return static Instance
     */
    public function setMinRefreshTime($minRefreshTime)
    {
        ZoneValidator::checkIfZoneIsSlaveOrStubAndThrowExceptionIfNot($this->_type);
        $this->_minRefreshTime = intval($minRefreshTime);
        return $this;
    }

    /**
     * Only valid for slave zones.
     * Inbound zone transfers making no progress in this many minutes will be terminated.
     *
     * @param mixed $maxTransferIdleIn
     *
     * @return static Instance
     */
    public function setMaxTransferIdleIn($maxTransferIdleIn)
    {
        ZoneValidator::checkIfZoneIsSlaveAndThrowExceptionIfNot($this->_type);
        $this->_maxTransferIdleIn = ZoneValidator::checkIfValueIsBiggerThanOfAndThrowExceptionIfNot($maxTransferIdleIn, 40320);
        return $this;
    }

    /**
     * @param mixed $maxTransferIdleOut
     *
     * @return static Instance
     */
    public function setMaxTransferIdleOut($maxTransferIdleOut)
    {
        ZoneValidator::checkIfZoneIsSlaveAndThrowExceptionIfNot($this->_type);
        $this->_maxTransferIdleOut = ZoneValidator::checkIfValueIsBiggerThanOfAndThrowExceptionIfNot($maxTransferIdleOut, 40320);
        return $this;
    }

    /**
     * @param mixed $maxTransferTimeIn
     *
     * @return static Instance
     */
    public function setMaxTransferTimeIn($maxTransferTimeIn)
    {
        ZoneValidator::checkIfZoneIsSlaveAndThrowExceptionIfNot($this->_type);
        $this->_maxTransferTimeIn = ZoneValidator::checkIfValueIsBiggerThanOfAndThrowExceptionIfNot($maxTransferTimeIn, 40320);
        return $this;
    }

    /**
     * @param mixed $maxTransferTimeOut
     *
     * @return static Instance
     */
    public function setMaxTransferTimeOut($maxTransferTimeOut)
    {
        ZoneValidator::checkIfZoneIsSlaveAndThrowExceptionIfNot($this->_type);
        $this->_maxTransferTimeOut = ZoneValidator::checkIfValueIsBiggerThanOfAndThrowExceptionIfNot($maxTransferTimeOut, 40320);
        return $this;
    }

    /**
     * @param int $maxRetryTime
     *
     * @return static Instance
     */
    public function setMaxRetryTime($maxRetryTime)
    {
        ZoneValidator::checkIfZoneIsSlaveOrStubAndThrowExceptionIfNot($this->_type);
        $this->_maxRetryTime = $maxRetryTime;
        return $this;
    }

    /**
     * @param \Bind\Types\IpList $forwarders
     *
     * @return self Instance
     */
    public function setForwarders($forwarders)
    {
        $this->_forwarders = GenericValidator::checkIfObjectIsInstanceOfIpListThrowExceptionOtherWise($forwarders);
        return $this;
    }


    /**
     * @param mixed $minRetryTime
     *
     * @return static Instance
     */
    public function setMinRetryTime($minRetryTime)
    {
        ZoneValidator::checkIfZoneIsSlaveOrStubAndThrowExceptionIfNot($this->_type);
        $this->_minRetryTime = $minRetryTime;
        return $this;
    }

    /**
     * @param \Bind\Types\YesNo $multiMaster
     *
     * @return static Instance
     */
    public function setMultiMaster($multiMaster)
    {
        $this->_multiMaster = ZoneValidator::checkIfObjectIsInstanceOfYesNoThrowExceptionOtherWise($multiMaster);
        return $this;
    }

    /**
     * @param \Bind\Types\YesNoExplicit $notify
     *
     * @return static Instance
     */
    public function setNotify($notify)
    {
        $this->_notify = ZoneValidator::checkIfObjectIsInstanceOfYesNoExplicitThrowExceptionOtherWise($notify);
        return $this;
    }

    /**
     * @param \Bind\Types\DialUpOptions $dialUp
     *
     * @return static Instance
     */
    public function setDialUp($dialUp)
    {
        $this->_dialUp = ZoneValidator::checkIfObjectIsInstanceOfDialUpOptionsThrowExceptionOtherWise($dialUp);
        return $this;
    }

    /**
     * @param \Bind\Types\OnlyFirst $forward
     *
     * @return static Instance
     */
    public function setForward($forward)
    {
        $this->_forward = ZoneValidator::checkIfObjectIsInstanceOfOnlyFirstThrowExceptionOtherWise($forward);
        return $this;
    }

    /**
     * @param string $keyDirectory
     *
     * @return static Instance
     */
    public function setKeyDirectory($keyDirectory)
    {
        $this->_keyDirectory = $keyDirectory;
        return $this;
    }

    /**
     * @param \Bind\Types\TextRawMap $masterFileFormat
     *
     * @return static Instance
     */
    public function setMasterFileFormat($masterFileFormat)
    {
        $this->_masterFileFormat = ZoneValidator::checkIfObjectIsInstanceOfTextRawMapThrowExceptionOtherWise($masterFileFormat);
        return $this;
    }

    /**
     * @param int $sigValidityInterval
     *
     * @return static Instance
     */
    public function setSigValidityInterval($sigValidityInterval)
    {
        $this->_sigValidityInterval = ZoneValidator::checkIfValueIsBiggerThanOfAndThrowExceptionIfNot($sigValidityInterval, 3660);
        return $this;
    }

    /**
     * @param \Bind\Types\IpList $altTransferSource
     *
     * @return self Instance
     */
    public function setAltTransferSource($altTransferSource)
    {
        $this->_altTransferSource = GenericValidator::checkIfObjectIsInstanceOfIpListThrowExceptionOtherWise($altTransferSource);
        return $this;
    }

    /**
     * @param \Bind\Types\IpList $altTransferSourceV6
     *
     * @return self Instance
     */
    public function setAltTransferSourceV6($altTransferSourceV6)
    {
         $this->_altTransferSourceV6 = GenericValidator::checkIfObjectIsInstanceOfIpListThrowExceptionOtherWise($altTransferSourceV6);
        return $this;
    }


    /**
     * @param \Bind\Types\IpList $transferSourceV6
     *
     * @return static Instance
     */
    public function setTransferSourceV6($transferSourceV6)
    {
        ZoneValidator::checkIfZoneIsSlaveAndThrowExceptionIfNot($this->_type);
        $this->_transferSourceV6 = ZoneValidator::checkIfObjectIsInstanceOfIpListThrowExceptionOtherWise($transferSourceV6);
        return $this;
    }

    /**
     * @param \Bind\Types\IpList $transferSource
     *
     * @return static Instance
     */
    public function setTransferSource($transferSource)
    {
        ZoneValidator::checkIfZoneIsSlaveAndThrowExceptionIfNot($this->_type);
        $this->_transferSource = ZoneValidator::checkIfObjectIsInstanceOfIpListThrowExceptionOtherWise($transferSource);
        return $this;
    }

    /**
     * @param \Bind\Types\YesNo $useAltTransferSource
     *
     * @return static Instance
     */
    public function setUseAltTransferSource($useAltTransferSource)
    {
        $this->_useAltTransferSource = ZoneValidator::checkIfObjectIsInstanceOfYesNoThrowExceptionOtherWise($useAltTransferSource);
        return $this;
    }

    /**
     * @param \Bind\Types\YesNo $useZoneStatistics
     *
     * @return self Instance
     */
    public function setZoneStatistics($useZoneStatistics)
    {
        $this->_zoneStatistics = GenericValidator::checkIfObjectIsInstanceOfYesNoThrowExceptionOtherWise($useZoneStatistics);
        return $this;
    }

    /**
     * @param AlsoNotify $alsoNotify
     *
     * @return self Instance
     */
    public function setAlsoNotify($alsoNotify)
    {
        $this->_alsoNotify = GenericValidator::checkIfObjectIsInstanceOfAlsoNotifyThrowExceptionOtherWise($alsoNotify);
        return $this;
    }

    public function getAsString()
    {
        $output = <<<EOF
{$this->getGenericFieldEnclosedByBrackets("allow-notify", $this->_allowNotify)}
{$this->getGenericFieldEnclosedByBrackets("allow-query", $this->_allowQuery)}
{$this->getGenericFieldEnclosedByBrackets("allow-transfer", $this->_allowTransfer)}

{$this->getGenericFieldEnclosedByBrackets("allow-update-forwarding", $this->_allowUpdateForwarding)}
{$this->getGenericFieldEnclosedByBrackets("also-notify", $this->_alsoNotify)}

{$this->getGenericField("dialup", $this->_dialUp)}
{$this->getGenericField("forward", $this->_forward)}
{$this->getGenericFieldEnclosedByBrackets("forwarders", $this->_forwarders)}

{$this->getGenericField("ixfr-from-differences", $this->_ixfrFromDifferences)}
{$this->getGenericField("key-directory", $this->_keyDirectory,true)}
{$this->getGenericField("masterfile-format", $this->_masterFileFormat)}
{$this->getGenericField("max-journal-size", $this->_maxJournalSize)}
{$this->getGenericField("min-refresh-time", $this->_minRefreshTime)}
{$this->getGenericField("max-refresh-time", $this->_maxRefreshTime)}
{$this->getGenericField("min-retry-time", $this->_minRetryTime)}
{$this->getGenericField("max-retry-time", $this->_maxRetryTime)}
{$this->getGenericField("max-transfer-idle-in", $this->_maxTransferIdleIn)}
{$this->getGenericField("max-transfer-idle-out", $this->_maxTransferIdleOut)}
{$this->getGenericField("max-transfer-time-in", $this->_maxTransferTimeIn)}
{$this->getGenericField("max-transfer-time-out", $this->_maxTransferTimeOut)}
{$this->getGenericField("multi-master", $this->_multiMaster)}
{$this->getGenericField("notify", $this->_notify)}
{$this->getGenericField("notify-source", $this->_notifySource)}
{$this->getGenericField("notify-source-v6", $this->_notifySourceV6)}
{$this->getGenericField("sig-validity-interval", $this->_sigValidityInterval)}

{$this->getGenericFieldEnclosedByBrackets("transfer-source", $this->_transferSource)}
{$this->getGenericFieldEnclosedByBrackets("transfer-source-v6", $this->_transferSourceV6)}
{$this->getGenericField("use-alt-transfer-source", $this->_useAltTransferSource)}
{$this->getGenericField("zone-statistics", $this->_zoneStatistics)}
EOF;
        $output = GenericHelper::removeEmptyLines($output);
        return $output;
    }

    /**
     * @param string $fieldName
     * @param string $fieldValue
     * @param bool   $encloseFieldValueInQuotes
     *
     * @return string
     */
    protected function getGenericField($fieldName, $fieldValue, $encloseFieldValueInQuotes = false)
    {
        if ($fieldValue == null) {
            return "";
        }
        if ($encloseFieldValueInQuotes) {
            $fieldValue = '"' . $fieldValue . '"';
        }
        return "{$fieldName} {$fieldValue};";
    }

    /**
     * @param $fieldName
     * @param $fieldValue
     *
     * @return string
     */
    protected function getGenericFieldEnclosedByBrackets($fieldName, $fieldValue, $encloseFieldValueInQuotes = false)
    {
        if (is_null($fieldValue)) {
            return "";
        }
        if ($encloseFieldValueInQuotes) {
            $fieldValue = '"' . $fieldValue . '";';
        }
        $output = <<<EOF
{$fieldName} {
{$this->prefixBySpaces($fieldValue, 8)}
};
EOF;
        return $output;
    }

    /**
     * @inheritdoc
     */
    protected function prefixBySpaces($text, $numberOfSpaces = 4)
    {
        return GenericHelper::prefixBySpaces($text, $numberOfSpaces);
    }

}