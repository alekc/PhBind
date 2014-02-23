<?php
namespace PhBind;

use PhBind\Helpers\GenericHelper;
use PhBind\Types\CommonZoneOptView;

use PhBind\Types\FailWarnIgnore;
use PhBind\Types\GenericList;
use PhBind\Types\IpList;


use PhBind\Types\UpdatePolicy;
use PhBind\Types\YesNo;

use PhBind\Validator\ZoneValidator;

/**
 * Class Zone
 * @package PhBind
 */
//http://www.zytrax.com/books/dns/ch7/zone.html
class Zone extends CommonZoneOptView
{

    const CHECK_NAMES_WARN = "warn";
    const CHECK_NAMES_FAIL = "fail";
    const CHECK_NAMES_INFO = "info";

    const TYPE_DELEGATION_ONLY = "delegation-only";
    const TYPE_FORWARD         = "forward";
    const TYPE_HINT            = "hint";
    const TYPE_IN_VIEW         = "in-view";
    const TYPE_MASTER          = "master";
    const TYPE_REDIRECT        = "redirect";
    const TYPE_SLAVE           = "slave";
    const TYPE_STATIC_STUB     = "static-stub";
    const TYPE_STUB            = "stub";

    protected $_name;
    protected $_file;

    /** @var  AddressListMatch */
    protected $_allowUpdate;


    protected $_database; //exists?

    /** @var  YesNo */
    protected $_delegationOnly;





    /** @var  string */
    protected $_inView;






    protected $_masters; //todo











    /** @var  IpList */
    protected $_serverAddresses;

    /** @var  GenericList */
    protected $_serverNames;



    /** @var  UpdatePolicy */
    protected $_updatePolicy;




    protected $textParseBuffer = "";


    public function create()
    {
        /** @var self $ins */
        $ins = new static();
        return $ins;
    }

    /**
     * Creates and save zone from txt
     *
     * @param $text
     *
     * @return Zone
     */
    public static function createFromText($text)
    {
        //todo:
    }


    /**
     * Sets Zone Name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    /**
     * Sets Type
     *
     * @todo: check for restriction, i.e 9.9 and other
     *
     * @param $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }

    /**
     * @return self
     */
    public function setTypeMaster()
    {
        $this->_type = self::TYPE_MASTER;
        return $this;
    }
    /**
     * @return self
     */
    public function setTypeSlave()
    {
        $this->_type = self::TYPE_SLAVE;
        return $this;
    }




    /**
     * Sets zone file name
     *
     * @param $file
     *
     * @return self
     */
    public function setFile($file)
    {
        $this->_file = $file;
        return $this;
    }


    /**
     * @param \Bind\AddressListMatch $allowUpdate
     *
     * @todo: add check for mutually exclusivity
     * @todo: add support for key
     *
     * @return self Instance
     */
    public function setAllowUpdate($allowUpdate)
    {
        ZoneValidator::checkIfZoneIsMasterAndThrowExceptionIfNot($this->_type);
        $this->_allowUpdate = $allowUpdate;
        return $this;
    }


    /**
     * @param mixed $checkNames
     *
     * @return self Instance
     */
    public function setCheckNames($checkNames)
    {
        $this->_checkNames = ZoneValidator::checkIfObjectIsInstanceOfFailWarnIgnoreThrowExceptionOtherWise($checkNames);
        return $this;
    }

    /**
     * @param \Bind\Types\YesNo $delegationOnly
     *
     * @return self Instance
     */
    public function setDelegationOnly($delegationOnly)
    {
        $this->_delegationOnly = ZoneValidator::checkIfObjectIsInstanceOfYesNoThrowExceptionOtherWise($delegationOnly);
        return $this;
    }


    /**
     * @param string $inView
     *
     * @todo: add checking for bind version (> 9.10).
     * Also to check if appliable only if zone is in view
     *
     * @return self Instance
     */
    public function setInView($inView)
    {
        $this->_inView = $inView;
        return $this;
    }


    /**
     * @param \Bind\Types\IpList $serverAddresses
     *
     * @return self Instance
     */
    public function setServerAddresses($serverAddresses)
    {
        $this->_serverAddresses = ZoneValidator::checkIfObjectIsInstanceOfIpListThrowExceptionOtherWise($serverAddresses);
        return $this;
    }

    /**
     * @param \Bind\Types\GenericList $serverNames
     *
     * @return self Instance
     */
    public function setServerNames($serverNames)
    {
        $this->_serverNames = $serverNames;
        return $this;
    }


    /**
     * @param \Bind\Types\UpdatePolicy $updatePolicy
     *
     * @return self Instance
     */
    public function setUpdatePolicy($updatePolicy)
    {
        $this->_updatePolicy = ZoneValidator::checkIfObjectIsInstanceOfUpdatePolicyThrowExceptionOtherWise($updatePolicy);
        return $this;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return string
     */
    public function getAsString()
    {
        $commonOptions = parent::getAsString();
        $output = <<<EOF
zone "{$this->getName()}" {
    {$this->getGenericField("type", $this->_type)}
    {$this->getGenericField("file", $this->_file, true)}
    {$this->getGenericFieldEnclosedByBrackets("allow-update", $this->_allowUpdate)}

    {$this->getGenericField("check-names", $this->_checkNames)}
    {$this->getGenericField("delegation-only", $this->_delegationOnly)}

    {$this->getGenericFieldEnclosedByBrackets("in-view", $this->_inView,true)}

    {$this->getGenericFieldEnclosedByBrackets("server-addresses", $this->_serverAddresses)}
    {$this->getGenericFieldEnclosedByBrackets("server-names", $this->_serverNames)}
    {$this->getGenericFieldEnclosedByBrackets("update-policy", $this->_updatePolicy)}

    {$this->prefixBySpaces($commonOptions,4)}
};
EOF;
        $output = GenericHelper::removeEmptyLines($output);
        return $output;
    }


    /**
     * @param YesNo $value
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setIxfrFromDifferences($value)
    {
        $this->_ixfrFromDifferences = ZoneValidator::checkIfObjectIsInstanceOfYesNoThrowExceptionOtherWise($value);
        return $this;
    }

    function __toString()
    {
        return $this->getAsString();
    }

}