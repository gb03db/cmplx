<?php

use Cn;
use PHPUnit\Framework\TestCase;

class CnTest extends TestCase
{

    /**
     * @dataProvider dataProvider
     */
    public function test(...$args)
    {
        $res = array_pop($args);
        $call = array_pop($args);
        $this->assertSame($res,
            (string)forward_static_call_array(['Cn', $call], array_map(
                fn($pair) => new Cn($pair[0], $pair[1]),
                $args
            ))
        );
    }

    public function dataProvider()
    {
        return [
            [[0, 0], [0, 0], 'sum', '0'],
            [[0, 0], [1, 0], 'sum', '1'],
            [[5, 7], [5.5, -2], [0, 0], 'sum', '10.5+5i'],
            [[2, 7.2], [1, 0], 'multiply', '2+7.2i'],
            [[2, 7.2], [1, 1], 'multiply', '-5.2+9.2i'],
            [[5, 7], [5.5, -2], 'multiply', '41.5+28.5i'],
            [[5, 7], [5.5, -2], [0, 0], 'multiply', '0'],
            [[2, 7.2], [1, 1], 'substract', '1+6.2i'],
            [[2, 7.2], [1, 1], 'divide', '4.6+2.6i'],
        ];
    }
}

