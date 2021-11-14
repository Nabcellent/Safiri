<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperReview
 */
class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'comment',
        'rating',
        'profile_photo',
        'created_at',
    ];

    public function reviews(): BelongsTo {
        return self::belongsTo(Destination::class);
    }
}
