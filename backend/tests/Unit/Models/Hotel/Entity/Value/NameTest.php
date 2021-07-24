<?php

declare(strict_types=1);

namespace Tests\Unit\Models\Hotel\Entity\Value;

use App\Models\Hotel\Entity\Value\Name;
use Tests\TestCase;
use Webmozart\Assert\InvalidArgumentException;

class NameTest extends TestCase
{
    public function testSuccess()
    {
        $value = new Name($title = 'Test name');
        $this->assertEquals($title, $value->getName());
    }

    public function testFailEmpty()
    {
        $this->expectException(InvalidArgumentException::class);

        new Name(' ');
    }

    public function testErrorMaxLength()
    {
        $this->expectException(InvalidArgumentException::class);

        new Name(str_repeat('a', 51));
    }
}
