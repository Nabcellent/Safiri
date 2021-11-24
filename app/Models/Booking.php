<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperBooking
 */
class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'destination_id',
        'payment_method_id',
        'guests',
        'is_paid',
        'total',
        'amount_paid',
        'service_fee',
        'start_at',
        'end_at',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getDatesAttribute(): string {
        return "{$this->start_at} ~ {$this->end_at}";
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function destination(): BelongsTo {
        return $this->belongsTo(Destination::class);
    }
    public function paymentMethod(): BelongsTo {
        return $this->belongsTo(PaymentMethod::class);
    }
}
