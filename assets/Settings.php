<?php

namespace eMAG;

use eMAG\Colors;

class Settings {

    public $colors;

    function __construct()
    {
        $this->colors = new Colors();
    }

    public static function debug($var)
    {
        $debug = var_dump($var);
        echo $debug;
        exit();
    }

    public function info($string)
    {
        return $this->colors->getColoredString($string, 'yellow', 'none');
    }

    public function orderusWon($string)
    {
        return $this->colors->getColoredString($string, 'yellow', 'none');
    }
    public function orderusLost($string)
    {
        return $this->colors->getColoredString($string, 'cyan', 'none');
    }
    public function turns($string)
    {
        return $this->colors->getColoredString($string, 'red', 'none');
    }

    public function alert($string)
    {
        return $this->colors->getColoredString($string, 'green', 'none');
    }
}