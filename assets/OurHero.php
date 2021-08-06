<?php

namespace eMAG;

use eMAG\Players\OrderusHero;
use eMAG\Players\Stats;
use eMAG\Settings;
use eMAG\Game\LetsFight;

class OurHero {

    public static function welcome()
    {
        $settings = new Settings();
        echo $settings->alert('My name is OrderusHero and I am from eMAGIA, the most beautiful land in the whole World!!') . PHP_EOL;
    }

    public function spawnBeast()
    {
        return new Stats();
    }

    public function spawnHero()
    {
        $hero = new OrderusHero();
        $settings = new Settings();
        $hero->setName('Orderus');
        echo '' . PHP_EOL;
        echo '' . PHP_EOL;
        echo $settings->alert('Hello, my name is ' . $hero->name . ' and I`m hero in Emagia. Let`s kill some Wild Beasts and prove our strength!!') . PHP_EOL;

        return $hero;
    }

    public function battle()
    {

        //$this->welcome();
        $hero = $this->spawnHero();
        $beast = $this->spawnBeast();

        $battle = new LetsFight($hero, $beast);
        $battle->start();
    }


}