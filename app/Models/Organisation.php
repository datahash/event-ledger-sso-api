<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'abn',
        'address_1',
        'address_2',
        'city',
        'state',
        'postcode',
        'country',
        'phone',
        'mobile',
        'email',
        'delivery_address_1',
        'delivery_address_2',
        'delivery_city',
        'delivery_state',
        'delivery_postcode',
        'organisation_type_id',
        'organisation_role_id',
        'api_client_id',
        'account_id',
        'topic_id',
        'created_by'
    ];

    protected $hidden = ['api_client_secret'];
}
