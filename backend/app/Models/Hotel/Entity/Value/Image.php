<?php

declare(strict_types=1);

namespace App\Models\Hotel\Entity\Value;

use Webmozart\Assert\Assert;

class Image
{
    private string $image;

    public function __construct(string $image)
    {
        Assert::notEmpty($image);
        Assert::maxLength($image, 200);

        $this->image = $image;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}
