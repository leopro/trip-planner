<?php

namespace Leopro\TripPlanner\Domain\Tests;

use Leopro\TripPlanner\Domain\ValueObject\Point;

class PointTest extends \PHPUnit_Framework_TestCase
{
    public function testDistance()
    {
        $firstPoint = new Point(-3.386665, 36.736908);
        $secondPoint = new Point(-3.428112, 35.932846);

        $this->assertEquals(89, $firstPoint->getCartographicDistance($secondPoint));
        $this->assertEquals(98, $firstPoint->getApproximateRoadDistance($secondPoint));
    }
} 