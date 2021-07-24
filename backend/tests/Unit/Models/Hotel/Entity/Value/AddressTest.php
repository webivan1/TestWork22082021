<?php

declare(strict_types=1);

namespace Tests\Unit\Models\Hotel\Entity\Value;

use App\Models\Hotel\Entity\Value\Address;
use Tests\TestCase;
use Webmozart\Assert\InvalidArgumentException;

class AddressTest extends TestCase
{
    public function testSuccess()
    {
        $value = new Address(
            $city = ' New York ',
            $address = 'Main st. 1',
            $lat = 55.345445,
            $lon = -49.343322332
        );

        $this->assertEquals($value->getCity(), trim($city));
        $this->assertEquals($value->getAddress(), $address);
        $this->assertEquals($value->getLongitude(), $lon);
        $this->assertEquals($value->getLatitude(), $lat);
    }

    public function testFailEmptyCity()
    {
        $this->expectException(InvalidArgumentException::class);

        new Address(
            ' ',
            'Main st. 1',
        );
    }

    public function testFailMaxLengthCity()
    {
        $this->expectException(InvalidArgumentException::class);

        new Address(
            str_repeat('a', 51),
            'Main st. 1',
        );
    }

    public function testFailEmptyAddress()
    {
        $this->expectException(InvalidArgumentException::class);

        new Address(
            'New York',
            '',
        );
    }

    public function testFailMaxLengthAddress()
    {
        $this->expectException(InvalidArgumentException::class);

        new Address(
            'New York',
            str_repeat('a', 201),
        );
    }

    public function testNoRequiredParams()
    {
        $value = new Address(
            $city = ' New York ',
            $address = ' Main st. 1 ',
        );

        $this->assertEquals($value->getCity(), trim($city));
        $this->assertEquals($value->getAddress(), trim($address));
    }
}
