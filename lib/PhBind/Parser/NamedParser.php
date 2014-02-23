<?php

namespace PhBind\Parser;


use PhBind\Named;
use PhBind\Zone;

class NamedParser
{

    protected $bufferText = "";

    /**
     * Create instance of NamedParser
     *
     * @return self
     */
    public static function create()
    {
        /** @var self $instance */
        $instance = new static();
        return $instance;
    }

    /**
     * Creates Named from filename
     *
     * @param $filename
     *
     * @return self
     */
    public function parseFromFileName($filename)
    {
        $fileContents = $this->getFileContents($filename);
        return self::parseFromText($fileContents);
    }


    /**
     * @param $text
     *
     * @return self
     */
    public static function parseFromText($text)
    {
        $instance             = self::create();
        $instance->bufferText = $text;
        return $instance->beginParsing();

    }

    /**
     * Return
     *
     * @return self Named Instance
     */
    protected function beginParsing()
    {
        $named = new Named();
        $this->stripComments();

        $named->setZones($this->searchForZones());

        return $named;
    }

    /**
     * Remove any comment from file
     * @return self
     */
    protected function stripComments()
    {
        //  /\*.*?\*/
        $this->bufferText = preg_replace('%/\*.*?\*/%s', '', $this->bufferText);
        //(?://|#).*?$
        $this->bufferText = preg_replace('%//.*?$%m', '', $this->bufferText);
        return $this;
    }

    /**
     * @return Zone[]
     */
    protected function searchForZones()
    {
        /** @var Zone[] $zones */
        $zones = array();

        //do i have some zones?
        if (!preg_match_all('/zone\s+"(?P<zoneName>.*?")\s+\{/i', $this->bufferText, $zoneResult)) {
            return array();
        }
        //extract zone text
        foreach ($zoneResult[0] as $zoneMarker) {
            $zoneText = $this->extractZoneStringFromText($this->bufferText, $zoneMarker);
            $zone = ZoneParser::createZoneFromText($zoneText);
            $zones[$zone->getName()] = $zone;
        }
        return $zones;
    }

    /**
     * Extracts single zone from file base on the beginning of it
     * (zone "foo" { )
     *
     * @param string $fileContents Text containing zone (probably named.conf.local)
     * @param string $zoneMarker   beginning of zone entry
     *
     * @return string
     */
    public function extractZoneStringFromText($fileContents, $zoneMarker)
    {
        $output       = "";
        $position     = strpos($fileContents, $zoneMarker);
        $bracketsCounter = 0;
        while ($position <= strlen($fileContents)) {
            $lastChar = $fileContents[$position++];
            $output .= $lastChar;

            //another opening bracket?
            if ($lastChar == "{") {
                $bracketsCounter++;
                continue;
            }
            //closure?
            if ($lastChar == "}") {
                $bracketsCounter--;
                //let's hope that the semicolon is there
                if ($bracketsCounter === 0 && $fileContents[$position] == ";") $output .= ";";
                if ($bracketsCounter === 0) break;
            }

        }
        return $output;
    }

    /**
     * Returns file contents as text
     *
     * @param $filename
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    protected function getFileContents($filename)
    {
        if (!is_file($filename) || !is_readable($filename)) {
            throw new \InvalidArgumentException("Can't read {$filename}");
        }
        return file_get_contents($filename);
    }
}