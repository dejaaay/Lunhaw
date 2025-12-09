<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TreePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'tree_id',
        'photo_path',
        'caption',
        'growth_notes',
        'growth_status',
        'uploaded_by_user_id',
        'taken_at',
    ];

    protected $casts = [
        'taken_at' => 'datetime',
    ];

    public function tree(): BelongsTo
    {
        return $this->belongsTo(Tree::class);
    }

    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by_user_id');
    }

    public function getPhotoUrl()
    {
        return asset('storage/' . $this->photo_path);
    }
}
