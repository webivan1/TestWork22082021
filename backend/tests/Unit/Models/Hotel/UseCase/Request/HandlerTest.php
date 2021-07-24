<?php

declare(strict_types=1);

namespace Tests\Unit\Models\Hotel\UseCase\Request;

use App\Models\Hotel\Entity\Hotel;
use App\Models\Hotel\UseCase\Request\Command;
use App\Models\Hotel\UseCase\Request\Handler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HandlerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        Hotel::factory(10)->create();
    }

    public function testGetList()
    {
        $command = new Command();
        $command->page = 1;

        $handler = $this->createApplication()->make(Handler::class);
        $paginator = $handler->getList($command);

        $this->assertInstanceOf(LengthAwarePaginator::class, $paginator);
        $this->assertTrue($paginator->total() >= 10);
    }
}
