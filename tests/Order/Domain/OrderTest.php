<?php

namespace ddd\core\tests\Order\Domain;

use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{

    /**
     * @test
     */
    public function it_should_add_a_line()
    {

        $order = OrderMother::random();

        $line = OrderLineMother::random();

        $order->addLine(
            $line->id(),
            $line->name(),
            $line->quantity(),
            $line->price()
        );

        $this->assertEquals($line, $order->lines()[$line->id()]);
    }

    /**
     * @test
     */
    public function it_should_update_a_line()
    {

        $order = OrderMother::random();

        $lineId = key($order->lines());

        $order->changeLine(
            $lineId,
            'Updated Name',
            2,
            30.00
        );

        $this->assertEquals('Updated Name', $order->lines()[$lineId]->name());
        $this->assertEquals(2, $order->lines()[$lineId]->quantity());
        $this->assertEquals(30.00, $order->lines()[$lineId]->price());
    }


    /**
     * @test
     */
    public function it_should_return_total()
    {
        $order = OrderMother::random();

        $expected = 0;

        foreach ($order->lines() as $line) {
            $expected += $line->quantity() * $line->price();
        }

        $this->assertEquals($expected, $order->total());
    }

}
