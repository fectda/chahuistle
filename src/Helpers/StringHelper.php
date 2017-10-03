<?php
namespace Cltvo\Chahuistle\Helpers;

class StringHelper{

    public static function generateSnakeCase($string) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $string, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }


	public static function generateCamelCase($str, array $noStrip = [])
	{
	        // non-alpha and non-numeric characters become spaces
	        $str = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $str);
	        $str = trim($str);
	        // uppercase the first character of each word
	        $str = ucwords($str);
	        $str = str_replace(" ", "", $str);
	        $str = lcfirst($str);

	        return $str;
	}

}
