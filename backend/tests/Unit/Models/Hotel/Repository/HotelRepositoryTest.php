<?php

declare(strict_types=1);

namespace Tests\Unit\Models\Hotel\Repository;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Hotel\Entity\Value\Image;
use App\Models\Hotel\Entity\Value\Address;
use App\Models\Hotel\Entity\Value\Description;
use App\Models\Hotel\Entity\Value\Name;
use App\Models\Hotel\Entity\Value\Stars;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Hotel\Entity\Hotel;
use App\Models\Hotel\Contract\HotelRepositoryContract;

class HotelRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private function getRepo(): HotelRepositoryContract
    {
        return $this->app->make(HotelRepositoryContract::class);
    }

    private function getModel(): Hotel
    {
        return Hotel::factory()->createOne();
    }

    public function testFindById()
    {
        $item = $this->getModel();
        $model = $this->getRepo()->findById($item->id);
        $this->assertEquals($model->id, $item->id);
    }

    public function testFindAll()
    {
        $paginator = $this->getRepo()->findAll();
        $this->assertInstanceOf(LengthAwarePaginator::class, $paginator);
    }

    public function testIsExistByNameAndAddress()
    {
        $item = $this->getModel();

        $result = $this->getRepo()->isExistByNameAndAddress($item->name, $item->address);
        $this->assertTrue($result);

        $result = $this->getRepo()->isExistByNameAndAddress($item->name . '-test', $item->address . '-test');
        $this->assertFalse($result);
    }

    public function testFindByNameAndAddress()
    {
        $item = $this->getModel();

        $result = $this->getRepo()->findByNameAndAddress($item->name, $item->address);
        $this->assertNotEmpty($result);

        $result = $this->getRepo()->findByNameAndAddress($item->name . '-test', $item->address . '-test');
        $this->assertEmpty($result);
    }

    public function testUpdate()
    {
        $model = $this->getModel();

        $this->getRepo()->update(
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

        $this->assertNotEmpty($model->id);
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

        $model = $this->getRepo()->create(
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

        $result = $this->getRepo()->findById($model->id);

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
        $model = $this->getModel();
        $id = $model->id;

        $model = $this->getRepo()->findById($id);
        $this->assertNotEmpty($model);

        $this->getRepo()->delete($id);

        $model = $this->getRepo()->findById($id);
        $this->assertEmpty($model);
    }
}
