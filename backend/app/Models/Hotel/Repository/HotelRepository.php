<?php

declare(strict_types=1);

namespace App\Models\Hotel\Repository;

use App\Models\Hotel\Contract\HotelRepositoryContract;
use App\Models\Hotel\Entity\Hotel;
use App\Models\Hotel\Entity\Value\Address;
use App\Models\Hotel\Entity\Value\Description;
use App\Models\Hotel\Entity\Value\Image;
use App\Models\Hotel\Entity\Value\Name;
use App\Models\Hotel\Entity\Value\Stars;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class HotelRepository extends BaseRepository implements HotelRepositoryContract
{
    public function __construct(Hotel $model)
    {
        parent::__construct($model);
    }

    public function findById(int $id): ?Hotel
    {
        return $this->model->newQuery()->find($id);
    }

    public function isExistByNameAndAddress(string $name, string $address): bool
    {
        return $this->model->newQuery()
            ->whereName($name)
            ->whereAddress($address)->exists();
    }

    public function findByNameAndAddress(string $name, string $address): ?Hotel
    {
        return $this->model->newQuery()
            ->whereName($name)
            ->whereAddress($address)->first();
    }

    public function findAll(int $page = 1, int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->newQuery()->orderBy('created_at', 'desc')
            ->paginate(10, ['id', 'name', 'city']);
    }

    public function update(
        Hotel $model,
        Name $name,
        Address $address,
        ?Image $image,
        Stars $stars,
        Description $description
    ): void {
        $model->name = $name->getName();
        $model->city = $address->getCity();
        $model->address = $address->getAddress();
        $model->latitude = $address->getLatitude();
        $model->longitude = $address->getLongitude();
        $model->stars = $stars->getStars();
        $model->description = $description->getDescription();

        if ($image) {
            $model->image = $image->getImage();
        }

        if (!$model->save()) {
            throw new \DomainException('Error update hotel ' . $model->id);
        }
    }

    public function create(Name $name, Address $address, Image $image, Stars $stars, Description $description): Hotel
    {
        /** @var Hotel $model */
        $model = $this->model->newInstance();
        $model->name = $name->getName();
        $model->city = $address->getCity();
        $model->address = $address->getAddress();
        $model->latitude = $address->getLatitude();
        $model->longitude = $address->getLongitude();
        $model->image = $image->getImage();
        $model->stars = $stars->getStars();
        $model->description = $description->getDescription();

        if (!$model->save()) {
            throw new \DomainException('Error create hotel ' . $name->getName());
        }

        return $model;
    }

    public function delete(int $id): void
    {
        if (!$model = $this->findById($id)) {
            throw new \DomainException('This hotel does not exists');
        }

        if (!$model->delete()) {
            throw new \DomainException('Error delete hotel ' . $model->name);
        }
    }
}
