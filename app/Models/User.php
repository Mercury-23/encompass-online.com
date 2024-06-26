<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Lesson;
use PhpParser\Node\Expr\Cast\Object_;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'type',
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

    protected $appends = [
        'information',
        'Address'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'information' => 'object'
    ];

    /**
     * Checks if user is an admin.
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->type == 'admin';
    }


    /* Address relationship */
    public function address(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Addresses::class);
    }

    /*
    * Has Role
    * @
    * */
    public function hasRole(string $role): bool
    {
        // todo - could make this so it checks array of roles
        // check if user has role
        return $this->type === $role;
    }

    /*
     * Lessons
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'teacher_id');
    }

    public function getInformationAttribute()
    {

        return Info::where('user_id', $this->id)->first()->information ?? (object)[];

    }

    public function getAddressAttribute()
    {

        return Addresses::where('user_id', $this->id)->first()->address ?? (object)[];

    }
}
