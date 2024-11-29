<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Helpers\HCSHelper;
use App\Helpers\EventHelper;
use App\Http\Requests\EventPostRequest;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(EventPostRequest $request)
    {
        $data->uuid = Str::uuid()->toString();

        try {
            # Hash message
            $data->hash_message = EventsHelper::hashMessage($event);

            # Save event
            $event = Event::create($data);

            # Send hash message to Hedera Consensus Service API
            HCSHelper::sendConsensusMessage($event);

            return ResponseHelper::success('Event created', $event);
        }
        catch(\Exception $e) {

            return ResponseHelper::error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
