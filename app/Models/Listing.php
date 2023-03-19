<?php

namespace App\Models;

use App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = [
        'baths',
        'beds',
        'area',
        'city',
        'code',
        'street',
        'street_nr',
        'price',
    ];

    public function owner(): BelongsTo {
        return $this->belongsTo(
            App\Models\User::class, 
            'by_user_id');
    }
}
