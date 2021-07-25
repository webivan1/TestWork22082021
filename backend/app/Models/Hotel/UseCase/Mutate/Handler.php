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
        $name = new Value\Name($command->name);
        $address = new Value\Address($command->city, $command->address, $command->latitude, $command->longitude);
        $image = new Value\Image($command->image);
        $stars = new Value\Stars($command->stars);
        $desc = new Value\Description($command->description);

        if ($this->repository->isExistByNameAndAddress($name->getName(), $address->getAddress())) {
            throw new \DomainException('This hotel is already exists');
        }

        return $this->repository->create($name, $address, $image, $stars, $desc);
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
        $this->repository->delete($model->id);
    }
}
