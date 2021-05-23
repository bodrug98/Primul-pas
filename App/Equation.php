<?php

namespace App;

class Equation
{
    private $a;
    private $b;
    private $c;
    private $x1 = 0;
    private $x2 = 0;

    function __construct($a, $b, $c) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    function solve()
    {
        $delta = $this->b * $this->b - 4 * $this->a * $this->c;

        if ($delta > 0) {
            $this->x1 = (-$this->b - sqrt($delta))/(2*$this->a);
            $this->x2 = (-$this->b + sqrt($delta))/(2*$this->a);
        } else if ($delta == 0) {
            $this->x1 = $x2 = (-$this->b) / (2 * $this->a);
        } else {
            $realPart = (float) (-$this->b/(2*$this->a));
            $imaginaryPart = sqrt(-$delta)/(2*$this->a);

            $this->x1 = $realPart . "+" . $imaginaryPart . "i";
            $this->x2 = $realPart . "-" . $imaginaryPart . "i";
        }

        return array($this->x1, $this->x2);
    }
    
    function get_x1() {
        return $this->x1;
    }
    
    function get_x2() {
        return $this->x2;
    }
}