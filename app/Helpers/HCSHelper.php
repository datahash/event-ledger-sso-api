<?php

namespace App\Helpers;

use App\Models\Event;
use Illuminate\Support\Facades\Http;


class HCSHelper
{
    public static function sendHashMessage($event)
    {
        $user = auth('api')->user();

        $response = Http::timeout(30)->post(env('HCS_API_MESSAGE_URL'), [
            'eventType' => 'batch',
            'eventId' => $event->uuid,
            'message' => $event->hashgraph->hash_message,
            'accountId' => $user->account_id
        ]);

        $hcs_response = $response->json();

        if (isset($hcs_response['_id']))
        {
            $event = Event::where('uuid', $hcs_response['event_id'])->first();

            $hashgraph = $event->latestHashgraph()->update([
                'hcs_id'=> $hcs_response['_id'],
                'topic_hh'=> $hcs_response['topic_hh'],
                'tx_hash_hh'=> $hcs_response['tx_hash_hh'],
                'sequence_number_hh'=>$hcs_response['sequence_number_hh'],
                'running_hash_hh'=> $hcs_response['running_hash_hh'],
                'consensus_timestamp_hh'=> $hcs_response['consensus_timestamp_hh'],
            ]);
        }
    }
}
