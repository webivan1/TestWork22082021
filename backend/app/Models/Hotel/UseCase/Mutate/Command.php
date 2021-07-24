<?php

declare(strict_types=1);

namespace App\Models\Hotel\UseCase\Mutate;

class Command
{
    public string $name;
    public string $city;
    public string $address;
    public ?float $latitude = null;
    public ?float $longitude = null;
    public ?string $image = null;
    public ?int $stars = null;
    public ?string $description = null;
}
