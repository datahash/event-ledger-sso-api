<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'account_id',
        'organisation_id',
        'created_by',
        'message_id',
        'message',
        'hash_message',
        'reference',
        'topic_id',
        'transaction_id',
        'consensus_timestamp_seconds',
        'consensus_timestamp_nanos'
    ];
}
