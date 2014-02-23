<?php

namespace PhBind\Parser;

use PhBind\Types\UpdatePolicyRule;

class UpdatePolicyRuleParser {
    /**
     * @param $text
     *
     * @return UpdatePolicyRule|bool
     */
    public static function parseText($text){

        if (!preg_match('/(grant|deny)\s+(.*?)\s+(6to4-self|external|krb5-self|krb5-subdomain|ms-self|ms-subdomain|name|self|selfsub|selfwildcard|subdomain|tcp-self|wildcard|zonesub)\s{0,}(.*?)(?:\s+(.*?)){0,1}\s{0,};/', $text, $regs)) {
            return false;
        }
        $updatePolicy = UpdatePolicyRule::create()
            ->setPermission($regs[1])
            ->setIdentity($regs[2])
            ->setMatchType($regs[3]);

        if ($regs[4]){
            $updatePolicy->setTname($regs[4]);
            if ($regs[5]){
                $updatePolicy->setRr($regs[5]);
            }
        }
        return $updatePolicy;
    }
}