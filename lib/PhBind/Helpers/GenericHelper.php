<?php
namespace PhBind\Helpers;


class GenericHelper {
    /**
     * Prefix each line after first one with specified number of spaces
     *
     * @param string $text
     * @param int    $numberOfSpaces
     *
     * @return mixed
     */
    public static function prefixBySpaces($text, $numberOfSpaces = 4)
    {
        $text = (string) $text;
        $prefix = sprintf("%{$numberOfSpaces}s", "");
        return preg_replace('/^(.)/m', $prefix . '$1', $text);
    }
    public static function removeEmptyLines($text)
    {
        return preg_replace('/(?:\s+(\r{0,1}\n)){2}/m', '$1', $text);
    }
}