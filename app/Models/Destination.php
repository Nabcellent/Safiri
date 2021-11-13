<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperDestination
 */
class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id',
        'category_id',
        'name',
        'image',
        'price',
        'vicinity',
        'distance',
        'location',
        'website',
        'rating',
        'description',
    ];

    protected $casts = [
        'location' => 'array'
    ];

    public function category(): BelongsTo {
        return self::belongsTo(Category::class);
    }

    public function destinationImages(): HasMany {
        return self::hasMany(DestinationImage::class);
    }
}
