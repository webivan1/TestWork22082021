<?php

declare(strict_types=1);

namespace App\Models\Hotel\Entity\Value;

use Webmozart\Assert\Assert;

class Name
{
    private string $name;

    public function __construct(string $name)
    {
        $name = trim($name);

        Assert::notEmpty($name);
        Assert::maxLength($name, 50);

        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
