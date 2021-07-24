<?php

declare(strict_types=1);

namespace App\Models\Hotel\Entity\Value;

class Description
{
    private ?string $description;

    public function __construct(?string $description)
    {
        $this->description = $description ? trim($description) : null;
    }

    public function getDescription(): ?string
    {
        return empty($this->description) ? null : $this->description;
    }
}
