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
 * @property Carbon $created_at
 * @property Carbon $updated_at
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
        'longitude',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function toArray(): array
    {
        return array_merge(parent::toArray(), array_filter([
            'image' => $this->image ? Storage::url($this->image) : null,
            'created_at' => $this->created_at ? $this->created_at->format('d-m-Y H:i') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('d-m-Y H:i') : null,
            'latitude' => $this->latitude ? (float) $this->latitude : null,
            'longitude' => $this->longitude ? (float) $this->longitude : null,
        ]));
    }
}
