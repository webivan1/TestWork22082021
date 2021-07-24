<?php

declare(strict_types=1);

namespace App\Models\Hotel\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $city
 * @property string $address
 * @property string|null $description
 * @property integer|null $stars
 * @property float|null $latitude
 * @property float|null $longitude
 */
class Hotel extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'image',
        'city',
        'address',
        'description',
        'stars',
        'latitude',
        'longitude'
    ];

    public function getImageAttribute($value): string
    {
        return env('APP_URL') . Storage::url($value);
    }

    public function getCreatedAtAttribute($value): string
    {
        return (new \DateTime($value))->format('d-m-Y H:i');
    }

    public function getUpdatedAtAttribute($value): string
    {
        return (new \DateTime($value))->format('d-m-Y H:i');
    }
}
