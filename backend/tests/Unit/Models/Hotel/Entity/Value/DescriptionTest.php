<?php

declare(strict_types=1);

namespace Tests\Unit\Models\Hotel\Entity\Value;

use App\Models\Hotel\Entity\Value\Description;
use Tests\TestCase;

class DescriptionTest extends TestCase
{
    public function testSuccess()
    {
        $value = new Description($text = 'Test description text');
        $this->assertEquals($text, $value->getDescription());
    }

    public function testEmptyString()
    {
        $value = new Description('');
        $this->assertNull($value->getDescription());
    }

    public function testNull()
    {
        $value = new Description(null);
        $this->assertNull($value->getDescription());
    }
}
