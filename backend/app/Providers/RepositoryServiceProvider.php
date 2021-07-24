<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Hotel\Contract\HotelRepositoryContract;
use App\Models\Hotel\Repository\HotelRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(HotelRepositoryContract::class, HotelRepository::class);
    }
}
