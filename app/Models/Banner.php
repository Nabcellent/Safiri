<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperBanner
 */
class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'url',
        'content',
    ];
}
