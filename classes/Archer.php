<?php

class Archer extends Character{

    private $arrowNumber = 20;
    private $arrow = false;

    public function turn($target) {
        $rand = rand(1, 10);
        if ($this->arrowNumber == 0) {
            $status = $this->attack($target);
        } else if ($rand > 2 || $this->arrow) {
            $status = $this->arrow($target);
        } else if ($rand <= 2) {
            $status = $this->weakness();
        }
        return $status;
    }

    public function arrow($target) {
        $lessPoints = rand(1, 20);
        $this->arrowNumber -= 1;
        $arrowDamage = $lessPoints * $this->damage;
        $target->setHealthPoints($arrowDamage);
        $status = "$this->name lance une flèche sur $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    }

    public function weakness() {
        $this->arrow = true;
        $rand = rand(15, 30)/10;
        $arrow = $this->damage * $rand;    
        $status = "$this->name va viser un point faible !";
        $this->arrow = false;
        return $status;
    }

    public function setHealthPoints($damage) {
        if (!$this->arrow) {
            $this->healthPoints -= round($damage);
        }
        $this->arrow = false;
        $this->isAlive();
        return;
    }

    public function attack($target) {
        $target->setHealthPoints($this->damage);
        $status = "$this->name donne un coup de dague à $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    }
}


?>