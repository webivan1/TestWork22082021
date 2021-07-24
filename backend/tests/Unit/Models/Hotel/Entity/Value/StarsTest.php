<?php

declare(strict_types=1);

namespace Tests\Unit\Models\Hotel\Entity\Value;

use App\Models\Hotel\Entity\Value\Stars;
use Tests\TestCase;
use Webmozart\Assert\InvalidArgumentException;

class StarsTest extends TestCase
{
    public function testSuccess()
    {
        for ($i = 1; $i <= 5; $i++) {
            $value = new Stars($i);
            $this->assertEquals($i, $value->getStars());
        }
    }

    public function testLessThanOneValue()
    {
        $this->expectException(InvalidArgumentException::class);

        new Stars(0);
    }

    public function testMoreThanFiveValue()
    {
        $this->expectException(InvalidArgumentException::class);

        new Stars(6);
    }
}
