<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo_path',
        'bio',
        'phone',
        'address',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function adoptions(): HasMany
    {
        return $this->hasMany(Adoption::class);
    }

    public function trees(): HasMany
    {
        return $this->hasMany(Tree::class, 'user_id');
    }

    public function sponsorships(): HasMany
    {
        return $this->hasMany(Sponsorship::class);
    }

    public function uploadedPhotos(): HasMany
    {
        return $this->hasMany(TreePhoto::class, 'uploaded_by_user_id');
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isNgo()
    {
        return $this->role === 'ngo';
    }

    public function isLgu()
    {
        return $this->role === 'lgu';
    }

    public function isManager()
    {
        return in_array($this->role, ['admin', 'ngo', 'lgu']);
    }

    public function getAdoptedTreesCount()
    {
        return $this->adoptions()->where('status', 'active')->count();
    }

    public function getTotalCo2Offset()
    {
        return $this->adoptions()
            ->where('status', 'active')
            ->join('trees', 'adoptions.tree_id', '=', 'trees.id')
            ->sum('trees.co2_offset');
    }

    public function getTotalSponsored()
    {
        return $this->sponsorships()
            ->where('status', 'completed')
            ->sum('amount');
    }
}
