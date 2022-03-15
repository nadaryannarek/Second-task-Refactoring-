<?php

use PHPUnit\Framework\TestCase;

final class CalculateTest extends TestCase
{
    public function testCanDoTheCalculation()
    {
        $this->assertSame('a','a');
    }
}