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
        'consensus_timestamp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot'
    ];

    /**
     * Get source events.
     */
    public function source() {
        return $this->belongsToMany(Event::class, 'event_parent', 'event_id', 'parent_event_id');
    }

    /**
     * Get events and children .
     */
    public function children() {
        return $this->belongsToMany(Event::class, 'event_parent', 'event_id', 'parent_event_id')->with('children');
    }

    /**
     * Get account for this event.
     */
    public function account()
    {
        return $this->belongsTo(Account::class)->select(['uuid', 'name']);
    }

    /**
     * Get organisation for this event.
     */
    public function organisation()
    {
        return $this->belongsTo(Organisation::class)->select(['id', 'name']);
    }
}
