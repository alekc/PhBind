<?php
namespace PhBind\Types;


class UpdatePolicyRule
{
    const PERMISSION_DENY  = "deny";
    const PERMISSION_GRANT = "grant";

    const MATCH_TYPE_6_TO_4_SELF    = "6to4-self";
    const MATCH_TYPE_EXTERNAL       = "external";
    const MATCH_TYPE_KRB5_SELF      = "krb5-self";
    const MATCH_TYPE_KRB5_SUBDOMAIN = "krb5-subdomain";
    const MATCH_TYPE_MS_SELF        = "ms-self";
    const MATCH_TYPE_MS_SUBDOMAIN   = "ms-subdomain";
    const MATCH_TYPE_NAME           = "name";
    const MATCH_TYPE_SELF           = "self";
    const MATCH_TYPE_SELFSUB        = "selfsub";
    const MATCH_TYPE_SELFWILDCARD   = "selfwildcard";
    const MATCH_TYPE_SUBDOMAIN      = "subdomain";
    const MATCH_TYPE_TCP_SELF       = "tcp-self";
    const MATCH_TYPE_WILDCARD       = "wildcard";
    const MATCH_TYPE_ZONESUB        = "zonesub";

    protected $_permission;
    protected $_identity;
    protected $_matchType;
    protected $_tname;
    protected $_rr;


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
     * Sets
     *
     * @param $value
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setPermission($value)
    {
        $value = strtolower(trim($value));
        if (!($value == "grant" || $value == "deny")) {
            throw new \InvalidArgumentException("Value must be 'grant' or 'deny'");
        }
        $this->_permission = $value;
        return $this;
    }

    /**
     * @return self Instance
     */
    public function setPermissionDeny()
    {
        $this->_permission = self::PERMISSION_DENY;
        return $this;
    }

    /**
     * @return self Instance
     */
    public function setPermissionGrant()
    {
        $this->_permission = self::PERMISSION_GRANT;
        return $this;
    }

    /**
     * @param mixed $identity
     *
     * @return self Instance
     */
    public function setIdentity($identity)
    {
        $this->_identity = $identity;
        return $this;
    }

    /**
     * @return array
     */
    public static function getMatchTypesAsArray()
    {
        $values = array(
            "6to4-self"      => "6to4-self",
            "external"       => "external",
            "krb5-self"      => "krb5-self",
            "krb5-subdomain" => "krb5-subdomain",
            "ms-self"        => "ms-self",
            "ms-subdomain"   => "ms-subdomain",
            "name"           => "name",
            "self"           => "self",
            "selfsub"        => "selfsub",
            "selfwildcard"   => "selfwildcard",
            "subdomain"      => "subdomain",
            "tcp-self"       => "tcp-self",
            "wildcard"       => "wildcard",
            "zonesub"        => "zonesub",
        );
        return $values;
    }

    public function setMatchType($value)
    {
        $value = strtolower(trim($value));
        if (!in_array($value, self::getMatchTypesAsArray())) {
            throw new \InvalidArgumentException("Match type value is invalid");
        }
        $this->_matchType = $value;
        return $this;
    }

    /**
     * @return self Instance
     */
    public function setMatchType6to4Self()
    {
        $this->_matchType = self::MATCH_TYPE_6_TO_4_SELF;
        return $this;
    }

    /**
     * @return self Instance
     */
    public function setMatchExternal()
    {
        $this->_matchType = self::MATCH_TYPE_EXTERNAL;
        return $this;
    }

    /**
     * @return self Instance
     */
    public function setMatchTypeKrb5Self()
    {
        $this->_matchType = self::MATCH_TYPE_KRB5_SELF;
        return $this;
    }


    /**
     * @return self Instance
     */
    public function setMatchTypeKrb5Subdomain()
    {
        $this->_matchType = self::MATCH_TYPE_KRB5_SUBDOMAIN;
        return $this;
    }


    /**
     * @return self Instance
     */
    public function setMatchTypeMsSelf()
    {
        $this->_matchType = self::MATCH_TYPE_MS_SELF;
        return $this;
    }


    /**
     * @return self Instance
     */
    public function setMatchTypeMsSubdomain()
    {
        $this->_matchType = self::MATCH_TYPE_MS_SUBDOMAIN;
        return $this;
    }

    /**
     * @return self Instance
     */
    public function setMatchTypeName()
    {
        $this->_matchType = self::MATCH_TYPE_NAME;
        return $this;
    }

    /**
     * @return self Instance
     */
    public function setMatchTypeSelf()
    {
        $this->_matchType = self::MATCH_TYPE_SELF;
        return $this;
    }

    /**
     * @return self Instance
     */
    public function setMatchTypeSelfSub()
    {
        $this->_matchType = self::MATCH_TYPE_SELFSUB;
        return $this;
    }

    /**
     * @return self Instance
     */
    public function setMatchTypeSelfWildcard()
    {
        $this->_matchType = self::MATCH_TYPE_SELFWILDCARD;
        return $this;
    }


    /**
     * @return self Instance
     */
    public function setMatchTypeSubDomain()
    {
        $this->_matchType = self::MATCH_TYPE_SUBDOMAIN;
        return $this;
    }

    /**
     * @return self Instance
     */
    public function setMatchTypeTcpSelf()
    {
        $this->_matchType = self::MATCH_TYPE_TCP_SELF;
        return $this;
    }

    /**
     * @return self Instance
     */
    public function setMatchTypeWildcard()
    {
        $this->_matchType = self::MATCH_TYPE_WILDCARD;
        return $this;
    }

    /**
     * @return self Instance
     */
    public function setMatchTypeZoneSub()
    {
        $this->_matchType = self::MATCH_TYPE_ZONESUB;
        return $this;
    }

    /**
     * @param mixed $rr
     *
     * @return self Instance
     */
    public function setRr($rr)
    {
        $this->_rr = $rr;
        return $this;
    }

    /**
     * @param mixed $tname
     *
     * @return self Instance
     */
    public function setTname($tname)
    {
        $this->_tname = $tname;
        return $this;
    }

    function __toString()
    {
        if (!$this->_identity || !$this->_matchType || !$this->_permission) {
            throw new \Exception("You must define identity, match type and permission in order to use update policy rule");
        }
        $output = "{$this->_permission} {$this->_identity} {$this->_matchType}";
        if ($this->_tname) {
            $output .= " {$this->_tname}";
            if ($this->_rr) {
                $output .= " {$this->_rr}";
            }
        }
        return $output;
    }

}