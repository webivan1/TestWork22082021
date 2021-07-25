<?php

declare(strict_types=1);

namespace Tests\Unit\Models\Hotel\UseCase\Mutate;

use App\Models\Hotel\Contract\HotelRepositoryContract;
use App\Models\Hotel\Entity\Hotel;
use App\Models\Hotel\UseCase\Mutate\Command;
use App\Models\Hotel\UseCase\Mutate\Handler;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HandlerTest extends TestCase
{
    use DatabaseTransactions;

    private function getHandler(): Handler
    {
        return $this->app->make(Handler::class);
    }

    public function testCreate()
    {
        /** @var Hotel $fake */
        $fake = Hotel::factory()->makeOne();

        $command = $this->getCommand($fake);

        $model = $this->getHandler()->create($command);

        $this->assertNotEmpty($model->id);
        $this->assertEquals($command->name, $model->name);
        $this->assertEquals($command->city, $model->city);
        $this->assertEquals($command->address, $model->address);
        $this->assertEquals($command->description, $model->description);
        $this->assertTrue(stripos($model->image, $command->image) !== false);
        $this->assertEquals($command->latitude, $model->latitude);
        $this->assertEquals($command->longitude, $model->longitude);
    }

    public function testAlreadyExists()
    {
        $this->expectException(\DomainException::class);

        /** @var Hotel $fake */
        $model = Hotel::factory()->createOne();

        $command = $this->getCommand($model);

        $this->getHandler()->create($command);
    }

    public function testUpdate()
    {
        /** @var Hotel $model */
        $model = Hotel::factory()->createOne();
        $copyModel = clone $model;

        $command = $this->getCommand($model);
        $command->name = 'New Name ' . mt_rand(1000, 10000);
        $command->address = 'New Address ' . mt_rand(1000, 10000);
        $command->description = 'New Description ' . mt_rand(1000, 10000);

        $this->getHandler()->update($copyModel, $command);

        $this->assertEquals($model->id, $copyModel->id);
        $this->assertEquals($command->name, $copyModel->name);
        $this->assertEquals($command->address, $copyModel->address);
        $this->assertEquals($command->description, $copyModel->description);
    }

    public function testRemove()
    {
        /** @var Hotel $model */
        $model = Hotel::factory()->createOne();
        $id = $model->id;
        $repo = $this->app->make(HotelRepositoryContract::class);

        $this->getHandler()->remove($model);

        $model = $repo->findById($id);

        $this->assertEmpty($model);
    }

    private function getCommand(Hotel $model): Command
    {
        $command = new Command();
        $command->name = $model->name;
        $command->city = $model->city;
        $command->address = $model->address;
        $command->image = $model->image;
        $command->longitude = $model->longitude;
        $command->latitude = $model->latitude;
        $command->description = $model->description;
        $command->stars = $model->stars;
        return $command;
    }
}
