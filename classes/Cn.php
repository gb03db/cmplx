<?php


class Cn
{
    private $a = 0;
    private $b = 0;

    public function __construct(float $a = 0, float $b = 0)
    {
        $this->a = $a;
        $this->b = $b;
    }

    public function get_real(): float
    {
        return $this->a;
    }

    public function get_imaginary(): float
    {
        return $this->b;
    }

    public static function equal(cn $x, cn $y): bool
    {
        return $x->get_real() === $y->get_real() && $x->get_imaginary() === $y->get_imaginary();
    }

    public static function sum(...$args): cn
    {
        return array_reduce(
            $args,
            fn($acc, $item) => $acc->add($item),
            new static()
        );
    }

    public static function multiply(...$args): cn
    {
        return array_reduce(
            $args,
            fn($acc, $item) => $acc->mul($item),
            new static(1)
        );
    }

    public static function substract(cn $x, cn $y): cn
    {
        return (clone $x)->sub($y);
    }

    public static function divide(cn $x, cn $y): cn
    {
        return (clone $x)->div($y);
    }

    public function add(cn $val): cn
    {
        $this->a += $val->get_real();
        $this->b += $val->get_imaginary();
        return $this;
    }

    public function mul(cn $val): cn
    {
        $a = $this->a * $val->get_real() - $this->b * $val->get_imaginary();
        $b = $this->b * $val->get_real() + $this->a * $val->get_imaginary();
        $this->a = $a;
        $this->b = $b;
        return $this;
    }

    public function sub(cn $val): cn
    {
        $this->a -= $val->get_real();
        $this->b -= $val->get_imaginary();
        return $this;
    }

    public function div(cn $val): cn
    {
        $divider = $val->get_real()**2 + $val->get_imaginary()**2;
        $a = ($this->a * $val->get_real() + $this->b * $val->get_imaginary()) / $divider;
        $b = ($this->b * $val->get_real() - $this->a * $val->get_imaginary()) / $divider;
        $this->a = $a;
        $this->b = $b;
        return $this;
    }

    public function __toString()
    {
        if ($this->b == 0) {
            return "{$this->a}";
        }
        if ($this->a == 0) {
            return "{$this->b}i";
        }
        $op = ($this->b < 0) ? '' : '+';
        return sprintf('%s%s%si', $this->a, $op, $this->b);
        //return sprintf('%f%s%fi', $this->a, $op, $this->b);
    }
}
