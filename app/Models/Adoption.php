<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tree_id',
        'status',
        'adopted_at',
        'transferred_at',
        'transferred_to_user_id',
        'notes',
    ];

    protected $casts = [
        'adopted_at' => 'datetime',
        'transferred_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tree(): BelongsTo
    {
        return $this->belongsTo(Tree::class);
    }

    public function transferredToUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'transferred_to_user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
