<?php

declare(strict_types=1);

namespace App\Models\Hotel\Entity\Value;

use Webmozart\Assert\Assert;

class Stars
{
    private ?int $stars;

    public function __construct(?int $stars)
    {
        if ($stars !== null) {
            Assert::integer($stars);
            Assert::lessThanEq($stars, 5);
            Assert::greaterThanEq($stars, 1);
        }

        $this->stars = $stars;
    }

    public function getStars(): ?int
    {
        return $this->stars;
    }
}
