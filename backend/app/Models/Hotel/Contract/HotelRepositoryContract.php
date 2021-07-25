<?php

declare(strict_types=1);

namespace App\Models\Hotel\Contract;

use App\Models\Hotel\Entity\Hotel;
use App\Models\Hotel\Entity\Value\Address;
use App\Models\Hotel\Entity\Value\Description;
use App\Models\Hotel\Entity\Value\Image;
use App\Models\Hotel\Entity\Value\Name;
use App\Models\Hotel\Entity\Value\Stars;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface HotelRepositoryContract
{
    public function findById(int $id): ?Hotel;
    public function findAll(int $page = 1): LengthAwarePaginator;
    public function findByNameAndAddress(string $name, string $address): ?Hotel;
    public function isExistByNameAndAddress(string $name, string $address): bool;
    public function create(Name $name, Address $address, Image $image, Stars $stars, Description $description): Hotel;
    public function update(
        Hotel $model,
        Name $name,
        Address $address,
        ?Image $image,
        Stars $stars,
        Description $description
    ): void;
    public function delete(int $id): void;
}
