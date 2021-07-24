<?php

declare(strict_types=1);

namespace Tests\Unit\Models\Hotel\Repository;

use Tests\TestCase;
use App\Models\Hotel\Entity\Value\Image;
use App\Models\Hotel\Entity\Value\Address;
use App\Models\Hotel\Entity\Value\Description;
use App\Models\Hotel\Entity\Value\Name;
use App\Models\Hotel\Entity\Value\Stars;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Hotel\Entity\Hotel;
use App\Models\Hotel\Contract\HotelRepositoryContract;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HotelRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private Hotel $model;
    private HotelRepositoryContract $repo;

    public function setUp(): void
    {
        $this->repo = $this->createApplication()->make(HotelRepositoryContract::class);
        $this->model = Hotel::factory()->createOne();
    }

    public function testFindById()
    {
        $model = $this->repo->findById($this->model->id);
        $this->assertEquals($model->id, $this->model->id);
    }

    public function testFindAll()
    {
        $paginator = $this->repo->findAll();
        $this->assertInstanceOf(LengthAwarePaginator::class, $paginator);
        $this->assertTrue($paginator->total() > 0);
    }

    public function testIsExistByNameAndAddress()
    {
        $result = $this->repo->isExistByNameAndAddress($this->model->name, $this->model->address);
        $this->assertTrue($result);

        $result = $this->repo->isExistByNameAndAddress($this->model->name . '-test', $this->model->address . '-test');
        $this->assertFalse($result);
    }

    public function testUpdate()
    {
        $model = clone $this->model;

        $this->repo->update(
            $model,
            new Name($name = 'test' . mt_rand(1000, 10000)),
            new Address(
                $city = 'new City',
                $address = 'new Address',
            ),
            null,
            new Stars($stars = 4),
            new Description($description = 'new Description')
        );

        $this->assertEquals($model->id, $this->model->id);
        $this->assertEquals($model->name, $name);
        $this->assertEquals($model->city, $city);
        $this->assertEquals($model->address, $address);
        $this->assertEquals($model->stars, $stars);
        $this->assertEquals($model->description, $description);
        $this->assertEmpty($model->latitude);
        $this->assertEmpty($model->longitude);
    }

    public function testCreate()
    {
        $randNum = mt_rand(1000, 10000);

        $model = $this->repo->create(
            new Name($name = 'new-test-' . $randNum),
            new Address(
                $city = 'City' . $randNum,
                $address = 'Address ' . $randNum,
            ),
            new Image($image = 'images/image.png'),
            new Stars($stars = 3),
            new Description($description = 'Description')
        );

        $this->assertIsInt($model->id);

        $result = $this->repo->findById($model->id);

        $this->assertNotEmpty($result);
        $this->assertEquals($result->id, $model->id);
        $this->assertEquals($result->name, $name);
        $this->assertEquals($result->city, $city);
        $this->assertEquals($result->address, $address);
        $this->assertEquals($result->description, $description);
        $this->assertTrue(stripos($result->image, $image) !== false);
        $this->assertEquals($result->latitude, $model->latitude);
        $this->assertEquals($result->longitude, $model->longitude);
    }

    public function testDelete()
    {
        $id = $this->model->id;

        $model = $this->repo->findById($id);
        $this->assertNotEmpty($model);

        $this->repo->delete($id);

        $model = $this->repo->findById($id);
        $this->assertEmpty($model);
    }
}
