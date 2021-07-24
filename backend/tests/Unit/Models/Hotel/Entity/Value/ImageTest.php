<?php

declare(strict_types=1);

namespace Tests\Unit\Models\Hotel\Entity\Value;

use App\Models\Hotel\Entity\Value\Image;
use Tests\TestCase;
use Webmozart\Assert\InvalidArgumentException;

class ImageTest extends TestCase
{
    public function testSuccess()
    {
        $value = new Image($file = 'images/test.png');
        $this->assertEquals($value->getImage(), $file);
    }

    public function testEmptyValue()
    {
        $this->expectException(InvalidArgumentException::class);

        new Image('');
    }

    public function testMaxValue()
    {
        $this->expectException(InvalidArgumentException::class);

        new Image(str_repeat('a', 201));
    }
}
