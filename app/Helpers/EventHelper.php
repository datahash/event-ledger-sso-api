<?php

namespace App\Helpers;
use App\Models\Event;
use App\Models\Organisation;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ResponseHelper;

class EventHelper
{
    public static function hashMessage($event)
    {
        $hash_message = Hash::make($event->message);

        return $hash_message;
    }

    public static function attachParents($parent_ids, $event)
    {
        if (count($parent_ids) > 0)
        {
            $parents = Event::find($data['parent_ids']);
            $event->source()->attach($parents);
            return $parents;
        }
        return null;
    }
}
