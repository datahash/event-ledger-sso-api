<?php

namespace App\Helpers;

use App\Models\Event;
use Illuminate\Support\Facades\Http;


class HCSHelper
{
    public static function sendConsensusMessage($event)
    {
        $response = Http::timeout(30)->post(env('HCS_API_MESSAGE_URL'), [
            'message' => $event->hash_message,
            'topic_id' => $event->topic_id,
            'allow_synchronous_consensus' => true,
            'reference' => $event->uuid
        ]);

        $consensus = $response->json();

        if (isset($consensus['transaction_id']))
        {
            $url = env('HCS_MIRRORNODE_URL')."/api/v1/topics/%s/messages/%s"
            $url = sprintf($url, $consensus['topic_id'], $consensus['topic_sequence_number'])
            $response = Http::get($url)

            $transaction = $response->json();

            $event->transaction_id = $consensus['transaction_id']
            $event->topic_sequence_number = $consensus['topic_sequence_number']
            $event->reference = $consensus['reference']
            $event->consensus_timestamp = $transaction['consensus_timestamp']

            $event->update();
        }
    }
}
