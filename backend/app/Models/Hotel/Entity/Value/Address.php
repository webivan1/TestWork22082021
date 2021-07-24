<?php

declare(strict_types=1);

namespace App\Models\Hotel\Entity\Value;

use Webmozart\Assert\Assert;

class Address
{
    private string $city;
    private string $address;
    private ?float $latitude;
    private ?float $longitude;

    public function __construct(string $city, string $address, ?float $latitude = null, ?float $longitude = null)
    {
        $city = trim($city);
        $address = trim($address);

        Assert::notEmpty($city);
        Assert::maxLength($city, 50);
        Assert::notEmpty($address);
        Assert::maxLength($address, 200);

        if ($latitude) {
            Assert::float($latitude);
            Assert::maxLength($latitude, 25);
        }

        if ($longitude) {
            Assert::float($longitude);
            Assert::maxLength($longitude, 25);
        }

        $this->city = $city;
        $this->address = $address;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }
}
