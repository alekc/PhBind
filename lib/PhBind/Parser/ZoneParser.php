<?php
namespace PhBind\Parser;


use PhBind\Types\UpdatePolicy;
use PhBind\Zone;

class ZoneParser extends CommonParser
{
    /** @var Zone */
    protected $object = false;

    /**
     * @inheritdoc
     */
    protected function createObject()
    {
        $this->object = new Zone();
        return $this;
    }

    protected function beginParsing()
    {
        $this->searchForUpdatePolicy();
        $this->searchForName()
             ->searchForType();

        $this->searchForFile();
        parent::beginParsing();
        return $this;
    }

    /**
     * Update Policy
     *
     * @return $this
     */
    protected function searchForUpdatePolicy()
    {
        if (!preg_match('/update-policy\s+\{(.*?)\};/s', $this->buffer, $regs)) {
            return $this;
        }
        //is it local
        if (trim(strtolower(str_replace(" ", "", $regs[1]))) == "local;") {
            $this->object->setUpdatePolicy(UpdatePolicy::create()->setLocal());
            return $this;
        }
        //parse of updatepolicyrule
        $updatePolicyRule = UpdatePolicyRuleParser::parseText($regs[1]);
        $this->object->setUpdatePolicy(UpdatePolicy::create()->setRule($updatePolicyRule));
        $this->buffer = str_replace($regs[0], "", $this->buffer);
        return $this;
    }

    /**
     * Search for zone name
     *
     * @todo: add check for existence of name
     * @return $this
     */
    protected function searchForName()
    {
        if (preg_match('/zone\s+"(.*?)"\s+\{/i', $this->buffer, $regs)) {
            $this->object->setName($regs[1]);
        }
        return $this;
    }


    /**
     * @return \Bind\Parser\ZoneParser
     */
    protected function searchForType()
    {
        //\s+type\s+(?:delegation-only|forward|hint|in-view|master|redirect|slave|static-stub|stub)\s{0,};
        if (preg_match('/\s+type\s+(delegation-only|forward|hint|in-view|master|redirect|slave|static-stub|stub)\s{0,};/i', $this->buffer, $regs)) {
            $this->object->setType($regs[1]);
        }
        return $this;
    }

    /**
     * @return $this
     */
    protected function searchForFile()
    {
        //\s+file\s+"(.*?)"\s{0,};
        if (preg_match('/\s+file\s+"(.*?)"\s{0,};/i', $this->buffer, $regs)) {
            $this->object->setFile($regs[1]);
        }
        return $this;
    }

}