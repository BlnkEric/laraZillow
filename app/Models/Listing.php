<?php

namespace App\Models;

use App;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;
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
    
    protected $sortable = [
        'price', 'created_at'
    ];

    public function owner(): BelongsTo {
        return $this->belongsTo(
            App\Models\User::class, 
            'by_user_id');
    }

    public function offers(): HasMany {
        return $this->hasMany(Offer::class, 'listing_id');
    }

    public function images(): HasMany {
        return $this->hasMany(ListingImage::class);
    }

    public function scopeMostRecent(Builder $query): Builder {
        return $query->orderByDesc('created_at');
    }

    // listings that does not have offers at all or have offers but not sold yet
    public function scopeWithoutSold(Builder $query): Builder {
        // return $query->doesntHave('offers')
        //     ->orWhereHas(
        //         'offers', 
        //         fn(Builder $query) 
        //             => $query->whereNull('accepted_at')
        //                         ->whereNull('rejected_at'));

        return $query->WhereNull('sold_at');

    }

    public function scopeSold(Builder $query): Builder {
        // just sold listings - accepted_at field is not null !! - not optimized
        // return $query->WhereHas(
        //         'offers', 
        //         fn(Builder $query) => $query->whereNotNull('accepted_at'));

        // just sold listings - accepted_at field is not null !! - best practice !!
        return $query->WhereNotNull('sold_at');

    }

    public function scopeFilter(Builder $query, Array $filters): Builder {
        return $query->when(
            $filters['priceFrom'] ?? false,
            fn ($query, $value) => $query->where('price', '>=', $value)
        )
        ->when(
            $filters['priceTo'] ?? false,
            fn ($query, $value) => $query->where('price', '<=', $value)
        )
        ->when(
            $filters['beds'] ?? false,
            fn ($query, $value) => $query->where('beds', (int)$value < 6 ? '=' : '>=', $value)
        )
        ->when(
            $filters['baths'] ?? false,
            fn ($query, $value) => $query->where('baths', (int)$value < 6 ? '=' : '>=', $value)
        )        
        ->when(
            $filters['areaFrom'] ?? false,
            fn ($query, $value) => $query->where('area', '>=', $value)
        )
        ->when(
            $filters['areaTo'] ?? false,
            fn ($query, $value) => $query->where('area', '<=', $value)
        )
        ->when(
            $filters['deleted'] ?? false,
            // only trashed
            // fn ($query, $value) => $query->onlyTrashed()
            fn ($query, $value) => $query->withTrashed()
        )
        ->when(
            $filters['by'] ?? false,
            fn ($query, $value) => 
            !in_array($value, $this->sortable)
            ? $query
            : $query->orderBy($value, $filters['order'] ?? 'desc')
        );
    }
}
