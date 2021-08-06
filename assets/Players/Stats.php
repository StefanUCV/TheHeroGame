<?php

namespace eMAG\Players;


use eMAG\Specifications\generalSkills;

class Stats extends Player {
    use generalSkills;

    function __construct()
    {
        parent::setRandomName();

        $this->stats = [
            'health'    => rand(60, 90),
            'strength'   => rand(60, 90),
            'defence'   => rand(40, 60),
            'speed' => rand(40, 60),
            'luck'  => rand(25, 40)
        ];

    }
}