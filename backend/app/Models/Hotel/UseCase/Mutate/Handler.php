<?php

declare(strict_types=1);

namespace App\Models\Hotel\UseCase\Mutate;

use App\Models\Hotel\Entity\Hotel;
use App\Models\Hotel\Entity\Value;
use App\Models\Hotel\Contract\HotelRepositoryContract;

class Handler
{
    private HotelRepositoryContract $repository;

    public function __construct(HotelRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function create(Command $command): Hotel
    {
        return $this->repository->create(
            new Value\Name($command->name),
            new Value\Address($command->city, $command->address, $command->latitude, $command->longitude),
            new Value\Image($command->image),
            new Value\Stars($command->stars),
            new Value\Description($command->description)
        );
    }

    public function update(Hotel $model, Command $command): void
    {
        $this->repository->update(
            $model,
            new Value\Name($command->name),
            new Value\Address($command->city, $command->address, $command->latitude, $command->longitude),
            $command->image ? new Value\Image($command->image) : null,
            new Value\Stars($command->stars),
            new Value\Description($command->description)
        );
    }

    public function remove(Hotel $model): void
    {
        if ($model->image) {

        }

        $this->repository->delete($model->id);
    }
}
