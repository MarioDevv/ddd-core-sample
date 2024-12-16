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
            $line->name()->value(),
            $line->quantity()->value(),
            $line->price()->value()
        );

        $this->assertEquals($line, $order->lines()[$line->id()]);
    }

    /**
     * @test
     */
    public function it_should_update_a_line()
    {

        $order = OrderMother::random();

        $lineId = $order->lines()->first()->id();

        $order->changeLine(
            $lineId,
            'Updated Name',
            2,
            500
        );

        $this->assertEquals('Updated Name', $order->lines()[$lineId]->name()->value());
        $this->assertEquals(2, $order->lines()[$lineId]->quantity()->value());
        $this->assertEquals(500, $order->lines()[$lineId]->price()->value());
    }


    /**
     * @test
     */
    public function it_should_return_total()
    {
        $order = OrderMother::random();

        $expected = 0;

        foreach ($order->lines() as $line) {
            $expected += $line->quantity()->value() * $line->price()->value();
        }

        $expected = $expected / 100;

        $this->assertEquals($expected, $order->total());
    }

    /**
     * @test
     */
    public function it_should_return_error_when_status_not_valid()
    {
        $this->expectException(\InvalidArgumentException::class);
        OrderMother::random(status: 10);
    }

    /**
     * @test
     */
    public function it_should_return_error_when_line_price_is_lower_than_minimum()
    {
        $this->expectException(\InvalidArgumentException::class);

        $order = OrderMother::random();

        $line = OrderLineMother::random(price: 100);

        $order->addLine(
            $line->id(),
            $line->name()->value(),
            $line->quantity()->value(),
            $line->price()->value()
        );

    }

}
