<?php
namespace PhBind;

use Bind\Types\AlsoNotify;
use Bind\Types\DialUpOptions;
use Bind\Types\FailWarnIgnore;
use Bind\Types\GenericList;
use Bind\Types\IpList;
use Bind\Types\OnlyFirst;
use Bind\Types\TextRawMap;
use Bind\Types\UpdatePolicy;
use Bind\Types\UpdatePolicyRule;
use Bind\Types\YesNo;
use Bind\Types\YesNoExplicit;
use Symfony\Component\ClassLoader\UniversalClassLoader;


require_once("loader.php");
$loader = new UniversalClassLoader();
$loader->registerNamespace('PhBind', __DIR__ . '/lib/');
$loader->register();

$filename = "/etc/bind/named.conf.local";
$named    = Named::createFromFile($filename);

$named->addAcl(
      Acl::create("not-these-ips")->setAddressMatchList(
         AddressListMatch::create()
                         ->disallow("192.168.0/24")
                         ->disallow("10.0/16")
      )
);
$named->addAcl(
      Acl::create("test2")->setAddressMatchList(
         AddressListMatch::create()
                         ->disallow("192.168.0/24")
                         ->disallowLocalNets()
      )
);

echo $named->getAsString();
die();

$zone      = $named->getZoneByName("ciaoitaly.net");
$slaveZone = $named->getZoneByName("caldari.net");

$addressList = AddressListMatch::create();
$addressList->allow("192.168.0.1")
            ->disallow("10.0.0.0/25");

$zone
    ->setAllowTransfer($addressList)
    ->setAllowQuery($addressList)
    ->setAllowUpdate($addressList)
    ->setAllowUpdateForwarding($addressList)
    ->setIxfrFromDifferences(YesNo::createYes())
    ->setMaxJournalSize("50k")
    ->setMultiMaster(YesNo::createNo())
    ->setNotify(YesNoExplicit::createExplicit())
    ->setCheckNames(FailWarnIgnore::createAndSetIgnore())
    ->setDelegationOnly(YesNo::createYes())
    ->setDialUp(DialUpOptions::createAndSetNotifyPassive())
    ->setForward(OnlyFirst::createAndSetFirst())
    ->setInView("valhalla")
    ->setKeyDirectory("/var/www/")
    ->setMasterFileFormat(TextRawMap::createAndSetRaw())
    ->setSigValidityInterval(100)
    ->setServerAddresses(IpList::create()->addIpv4("192.168.0.125")->addIpv4("10.0.0.0"))
    ->setServerNames(GenericList::create()->add("ns1.internetsm.com"))
    ->setUpdatePolicy(UpdatePolicy::create()->setRule(UpdatePolicyRule::create()
                                                                      ->setPermissionGrant()
                                                                      ->setIdentity("EXAMPLE.COM")
                                                                      ->setMatchType6to4Self()
                                                                      ->setTname("EXAMPLE.COM")
                                                                      ->setRr("A AAAA")
        )
    )
    ->setUseAltTransferSource(YesNo::createNo())
    ->setZoneStatistics(YesNo::createYes())
    ->setAlsoNotify(AlsoNotify::create()
                              ->addIpv4("10.0.1.2")
                              ->addMasterList("notify-them", 2034)
    )
    ->setAltTransferSource(IpList::create()
                                 ->addIpv4("10.0.0.0")
                                 ->addIpv4("127.0.0.1")
    )
    ->setForwarders(IpList::create()
                          ->addIpv4("10.0.0.199", 8080)
                          ->addIpv4("127.0.0.1")
    )
    ->setNotifySource(IpList::create()->addIpv4("10.9.0.1"))
    ->setNotifySourceV6(IpList::create()->addIpv6("FE80:0000:0000:0000:0202:B3FF:FE1E:8329"));


$slaveZone
    ->setTypeSlave()
    ->setAllowNotify($addressList) //slave
    ->setMinRefreshTime(10) //stub or slave
    ->setMaxRefreshTime(20) //stub or slave
    ->setMinRetryTime(20) //stub or slave
    ->setMaxRetryTime(30) //stub or slave
    ->setMaxTransferIdleIn(11)
    ->setMaxTransferIdleOut(12)
    ->setMaxTransferTimeIn(12)
    ->setMaxTransferTimeOut(13)
    ->setTransferSource(IpList::create()->addIpv4("192.168.0.123", 53)->add("10.0.0.1"))
    ->setTransferSourceV6(IpList::create()->addIpv6("FE80:0000:0000:0000:0202:B3FF:FE1E:8329", 53))
    ->setUpdatePolicy(UpdatePolicy::create()->setLocal());


echo $named->getAsString();
