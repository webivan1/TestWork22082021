<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Repository\Contract\EloquentRepositoryContract;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements EloquentRepositoryContract
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
