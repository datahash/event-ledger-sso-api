<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Helpers\HCSHelper;
use App\Helpers\EventHelper;
use App\Http\Requests\EventStoreRequest;
use Illuminate\Support\Str;

class EventClientController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $content = json_decode($request->getContent(), true);
            $event = new Event;

            $event->uuid = Str::uuid()->toString();
            $event->account_id = session()->get('account_id');
            $event->organisation_id = session()->get('organisation_id');
            $event->created_by = session()->get('user_id');
            $event->topic_id = session()->get('topic_id');
            $event->event_type = $content['event_type'];
            $event->message = $request->getContent();
            $event->reference = session()->get('account_id').'/'.session()->get('organisation_id').'/'.$event->uuid;

            foreach ($content as $key => $value) {
                if (str_contains($key, 'foreign_event_')) {
                    $event->foreign_id = $content[$key];
                }
            }

            # Hash message
            $event->hash_message = EventHelper::hashMessage($event);

            # Send hash message to Hedera Consensus Service API
            $consensus = HCSHelper::sendConsensusMessage($event);
            // $transaction = HCSHelper::getTransaction($consensus['transaction_id']);

            $event->transaction_id = $consensus['transaction_id'];
            $event->explorer_url = $consensus['explorer_url'];
            // $event->consensus_timestamp = $transaction['consensus_timestamp'];

            # Save event
            $event->save();

            return ResponseHelper::success('Event created', $event);
        }
        catch(\Exception $e) {

            return ResponseHelper::error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $event = Event::where('uuid', $id)->first();

            if ($event->consensus_timestamp == null) {
                $transaction = HCSHelper::getTransaction($event->transaction_id);
                $event->consensus_timestamp = $transaction['consensus_timestamp'];
                $event->update();
            }

            return ResponseHelper::success('Event', $event);
        }
        catch(\Exception $e) {

            return ResponseHelper::error($e->getMessage(), $e->getCode());
        }
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
