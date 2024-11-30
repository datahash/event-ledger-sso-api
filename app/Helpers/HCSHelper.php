<?php

namespace App\Helpers;

use App\Models\Event;
use Illuminate\Support\Facades\Http;


class HCSHelper
{
    public static function sendConsensusMessage($event)
    {
        $response = Http::timeout(30)->withHeaders([
                'x-api-key' => env('HCS_API_KEY')
            ])->post(env('HCS_API_MESSAGE_URL'), [
            'message' => $event->hash_message,
            'topic_id' => $event->topic_id,
            'allow_synchronous_consensus' => true,
            'reference' => $event->reference
        ]);

        $consensus = $response->json();

        return $consensus['data'];
    }

    public static function getTransaction($transaction_id)
    {
        $pos = strrpos($transaction_id, '.');
        $transaction_id = substr_replace($transaction_id, '-', $pos, 1);
        $transaction_id = str_replace('@', '-', $transaction_id);

        $url = env("HCS_MIRRORNODE_URL")."/api/v1/transactions/%s";
        $url = sprintf($url, $transaction_id);

        $response = Http::get($url);

        $transaction = $response->json();

        return $transaction['transactions'][0];
    }
}
