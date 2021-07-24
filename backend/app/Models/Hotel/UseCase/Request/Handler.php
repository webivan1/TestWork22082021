<?php

declare(strict_types=1);

namespace App\Models\Hotel\UseCase\Request;

use App\Models\Hotel\Contract\HotelRepositoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Handler
{
    private HotelRepositoryContract $repository;

    public function __construct(HotelRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function getList(Command $command): LengthAwarePaginator
    {
        return $this->repository->findAll($command->page);
    }
}
