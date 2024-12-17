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

        $count = count($order->lines());

        $order->addLine(
            $line->name()->value(),
            $line->quantity()->value(),
            $line->price()->value()
        );

        $this->assertCount($count + 1, $order->lines());
        $this->assertEquals($line->name()->value(), $order->lines()[$count]->name()->value());
        $this->assertEquals($line->quantity()->value(), $order->lines()[$count]->quantity()->value());
        $this->assertEquals($line->price()->value(), $order->lines()[$count]->price()->value());
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
            $line->name()->value(),
            $line->quantity()->value(),
            $line->price()->value()
        );

    }

}
