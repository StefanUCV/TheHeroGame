<?php

namespace eMAG\Players;

use eMAG\Specifications\generalSkills;
use eMAG\Specifications\specialSkills;

class OrderusHero extends Stats {

    use generalSkills, specialSkills;

    function __construct()
    {

        $this->stats = [
            'health'    => rand(70, 100),
            'strength'   => rand(70, 80),
            'defence'   => rand(45, 55),
            'speed' => rand(40, 50),
            'luck'  => rand(10, 30)
        ];

    }


    public function defenseLuck()
    {
        foreach($this->specialSkills['defense'] as $name => $skill){
            $randomLuck = rand(0, 100);
            if (($skill['chance'] > $randomLuck) && $skill['type'] == 'passive')
            {
                return $skill;
            }
        }
        return false;
    }

    public function attackLuck()
    {
        foreach($this->specialSkills['attack'] as $skill){
            $randomLuck = rand(0, 100);
            if (($skill['chance'] > $randomLuck) && $skill['type'] == 'passive')
            {
                return $skill;
            }
        }
        return false;
    }


}