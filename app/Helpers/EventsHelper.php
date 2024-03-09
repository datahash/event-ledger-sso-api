<?php

namespace App\Helpers;
use App\Models\Event;
use Illuminate\Support\Facades\Hash;

class EventsHelper
{
    public static function attachParents($data, $event)
    {
        if (isset($data['parent_ids']) && count($data['parent_ids']) > 0)
        {
            $parents = Event::find($data['parent_ids']);
            $event->source()->attach($parents);
            return $parents;
        }
        return null;
    }

    public static function hashMessage($event)
    {
        $hash_message = Hash::make($event->message);

        return $hash_message;
    }
}
