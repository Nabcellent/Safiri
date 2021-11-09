<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperDestinationImage
 */
class DestinationImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function destination(): BelongsTo {
        return self::belongsTo(Destination::class);
    }
}
