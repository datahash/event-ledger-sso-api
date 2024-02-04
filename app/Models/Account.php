<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'uuid'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function organisations()
    {
        return $this->hasMany(Organisation::class);
    }
}
