<?php

namespace eMAG\Game;

use eMAG\Console;
use eMAG\Settings;

class LetsFight {

    private $attacker;
    private $defender;
    private $winner;
    private $console;
    private $totalTurns = 20;
    private $damage = 0;

    function __construct($beast, $hero)
    {
        $this->console = new Settings();
        $this->attacker = $hero;
        $this->defender = $beast;
        $this->whoStrikesFirst();
    }

    private function whoStrikesFirst()
    {
        $attacker = $this->attacker;
        $defender = $this->defender;

        if ($this->defender->getInfo('speed') > $this->attacker->getInfo('speed')):
            $this->attacker = $defender;
            $this->defender = $attacker;
        endif;

        if ($this->defender->getInfo('speed') == $this->attacker->getInfo('speed'))
        {
            if ($this->defender->getInfo('luck') > $this->attacker->getInfo('luck')):
                $this->attacker = $defender;
                $this->defender = $attacker;
            endif;
        }
    }

    public function start()
    {
        if ($this->attacker->name =="Orderus"){
            echo $this->console->orderusWon($this->attacker->name. ' has the following stats: ') . PHP_EOL;
        }else{
            echo $this->console->turns($this->attacker->name. ' has the following stats: ') . PHP_EOL;
        }


        echo 'Health: ' .$this->attacker->getInfo('health'). PHP_EOL;
        echo 'Strength: ' .$this->attacker->getInfo('strength'). PHP_EOL;
        echo 'Defence: ' .$this->attacker->getInfo('defence'). PHP_EOL;
        echo 'Speed: ' .$this->attacker->getInfo('speed'). PHP_EOL;
        echo 'Luck: ' .$this->attacker->getInfo('luck'). PHP_EOL;

        if ($this->defender->name =="Orderus"){
            echo $this->console->orderusWon($this->defender->name. ' has the following stats: ') . PHP_EOL;
        }else{
            echo $this->console->turns($this->defender->name. ' has the following stats: ') . PHP_EOL;
        }


        echo 'Health: ' .$this->defender->getInfo('health'). PHP_EOL;
        echo 'Strength: ' .$this->defender->getInfo('strength'). PHP_EOL;
        echo 'Defence: ' .$this->defender->getInfo('defence'). PHP_EOL;
        echo 'Speed: ' .$this->defender->getInfo('speed'). PHP_EOL;
        echo 'Luck: ' .$this->defender->getInfo('luck'). PHP_EOL;

        echo '' . PHP_EOL;

        echo 'Let the battle begin between ' . $this->attacker->name . ' and ' . $this->defender->name . '.' . PHP_EOL;
        echo $this->attacker->name . ' attacks ' . $this->defender->name . ' first!' . PHP_EOL;
        $this->simulateBattle();
    }

    private function simulateBattle()
    {
        $turns = 1;
        while ($this->defender->getInfo('health') > 0 && $turns <= $this->totalTurns)
        {
            echo $this->console->turns('# Turn ' . $turns . ' - ' . $this->attacker->name . ' attacks! #') . PHP_EOL;

            $attacker = $this->attacker;
            $defender = $this->defender;
            $dodgeAttack = $this->defender->isLucky();
            $this->damageAmount();

            if ($dodgeAttack)
            {
                echo $this->console->alert($this->defender->name . ' dodge the hit from ' . $this->attacker->name . '.') . PHP_EOL;
            }

            if (!$dodgeAttack)
            {
                if ($this->defender->hasSpecialSkills()):
                    $defendSkill = $this->defender->defenseLuck();
                    if ($defendSkill != false):
                        echo $this->console->info('*** ' . $defendSkill['name'] . ' was used by '.$this->defender->name.', damage reduced by half! ***') . PHP_EOL;
                        switch ($defendSkill['key'])
                        {
                            case "magic_shield":
                                $this->damage = $this->damage / 2;
                                break;
                        }
                    endif;
                endif;

                if ($this->attacker->hasSpecialSkills()):
                    $attackSkill = $this->attacker->attackLuck();
                    if ($attackSkill != false):
                        echo $this->console->info('*** ' . $attackSkill['name'] . 'was used by ' .$this->attacker->name.', he will strike twice!*** ') . PHP_EOL;
                        switch ($attackSkill['key'])
                        {
                            case "rapid_strike":
                                $this->aboutAttack();
                                $this->newHealth();
                                break;
                        }
                    endif;
                endif;

                $this->aboutAttack();
                $this->newHealth();
            }

            $this->attacker = $defender;
            $this->defender = $attacker;
            $turns++;

            if ($this->checkHealth()):
                break;
            endif;
        }
        if ($this->checkWinner()->name != "Orderus"){
            echo $this->console->orderusLost($this->checkWinner()->name . ' wins the battle. So bad :(!') . PHP_EOL;
        }else{
        echo $this->console->orderusWon($this->checkWinner()->name . ' wins the battle. I`m so strong, you can`t beat me!') . PHP_EOL;
        }
    }

    private function checkWinner()
    {
        $winner = ($this->defender->getInfo('health') > $this->attacker->getInfo('health')) ? $this->defender : $this->attacker;

        if ($this->attacker->getInfo('health') <= 0):
            $winner = $this->defender;
        endif;

        if ($this->defender->getInfo('health') <= 0):
            $winner = $this->attacker;
        endif;

        $this->winner = $winner;

        return $this->winner;
    }

    private function newHealth()
    {
        $newHealth = $this->defender->getInfo('health') - $this->damage;
        $this->defender->setInfo('health',$newHealth);
    }

    private function damageAmount()
    {
        $this->damage = $this->attacker->getInfo('strength') - $this->defender->getInfo('defence');
    }

    private function aboutAttack()
    {
        echo $this->attacker->name . '(' . $this->attacker->stats['health'] . ' health)) damaged ' . $this->defender->name . '(' . $this->defender->stats['health'] . ' health) with ' . $this->damage . ' damage.' . PHP_EOL;
    }

    private function checkHealth()
    {
        if ($this->attacker->getInfo('health') <= 0 || $this->defender->getInfo('health') <= 0) return true;
    }


}
