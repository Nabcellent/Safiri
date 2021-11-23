<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PayPalCallback
 *
 * @mixin Eloquent
 * @mixin IdeHelperPayPalCallback
 */
class PayPalCallback extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     *  RELATIONSHIPS
     */
    public function booking(): BelongsTo {
        return $this->belongsTo(Booking::class);
    }
}
