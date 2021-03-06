<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cats()
    {
        return $this->hasMany(Cat::class);
    }

    public function owns(Cat $cat)
    {
        return $this->id == $cat->user_id;

    }

    public function canEdit(Cat $cat)
    {
        return $this->is_admin or $this->owns($cat);
    }

    protected static function boot()
    {
        parent::boot();

        User::deleting(function ($user) {
            if ($user->cats->count()) {
                return false;
            }
        });
    }
}
