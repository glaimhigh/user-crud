<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\Searchable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use Searchable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * ALlowed search fields
     * @var string[]
     */
    protected $searchFields = ['first_name', 'last_name', 'middle_name', 'email'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = ['id'];

        /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
    }

    /**
     * Returns the full_name attribute
     * @return string
     */
    public function getFullNameAttribute()
    {
        $names = [];
        foreach (['first_name', 'middle_name', 'last_name'] as $key) {
            $value = $this->getAttribute($key);
            if ( ! empty($value)) {
                $names[] = $value;
            }
        }

        return implode(' ', $names);
    }
}
