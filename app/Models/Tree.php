<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tree extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'species',
        'common_name',
        'scientific_name',
        'description',
        'location',
        'latitude',
        'longitude',
        'planted_at',
        'status',
        'co2_offset',
        'current_photo_path',
        'notes',
        'is_available',
    ];

    protected $casts = [
        'planted_at' => 'datetime',
        'latitude' => 'float',
        'longitude' => 'float',
        'co2_offset' => 'integer',
        'is_available' => 'boolean',
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function adoptions(): HasMany
    {
        return $this->hasMany(Adoption::class);
    }

    public function activeAdoption()
    {
        return $this->hasOne(Adoption::class)->where('status', 'active');
    }

    public function adoptedByUser()
    {
        return $this->hasOneThrough(User::class, Adoption::class, 'tree_id', 'id', 'id', 'user_id')->where('adoptions.status', 'active');
    }

    public function sponsorships(): HasMany
    {
        return $this->hasMany(Sponsorship::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(TreePhoto::class)->orderByDesc('taken_at');
    }

    public function latestPhoto()
    {
        return $this->hasOne(TreePhoto::class)->latestOfMany('taken_at');
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeNearby($query, $latitude, $longitude, $radiusKm = 50)
    {
        $latOffset = $radiusKm / 111.0;
        $lngOffset = $radiusKm / (111.0 * cos(deg2rad($latitude)));

        return $query->whereBetween('latitude', [$latitude - $latOffset, $latitude + $latOffset])
                     ->whereBetween('longitude', [$longitude - $lngOffset, $longitude + $lngOffset]);
    }
}
