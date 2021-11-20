<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperPaymentMethod
 */
class PaymentMethod extends Model
{
    use HasFactory;
    protected $casts=[
        'description'=>"array"
    ];

    public function bookings(): HasMany {
        return $this->hasMany(Booking::class);
    }
}
