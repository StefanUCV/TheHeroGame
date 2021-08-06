<?php

namespace eMAG\Players;

class Player
{
    public $name;

    public $stats = [
        'health' => 0,
        'strength' => 0,
        'defence' => 0,
        'speed' => 0,
        'luck' => 0
    ];

    public function setRandomName()
    {
        $names = [
            'Wild Beast - Canopus',
            'Wild Beast - Arcturus',
            'Wild Beast - Progus',
            'Wild Beast - Borkingar',
            'Wild Beast - Strynbbas',
            'Wild Beast - Bruzkana',
            'Wild Beast - Orsar'
        ];
        $this->setName($names[rand(0, count($names) - 1)]);
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStat($key)
    {
        return $this->stats[$key];
    }

    public function setStat($key, $value)
    {
        $this->stats[$key] = $value;
    }

    public function getAllStats()
    {
        return $this->stats;
    }

    public function isLucky()
    {
        $randomLuck = rand(0, 100);
        return  ($this->stats['luck'] > $randomLuck) ? true :false;
    }

    public function hasSpecialSkills()
    {
        return (isset($this->specialSkills)) ? true : false;
    }
}