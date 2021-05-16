<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function postsInDecade(): HasMany
    {
        return $this
            ->hasMany(Post::class, 'author_id')
            ->where('created_at', '>=', now()->subYear(10));
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function isAdult(): bool
    {
        return $this->age >= 20;
    }

    public function postsIn(int $year): Collection
    {
        return $this->posts()->whereYear('created_at', $year)->get();
    }
}

