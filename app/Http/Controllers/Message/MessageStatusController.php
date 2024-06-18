<?php

namespace App\Http\Controllers\Message;

use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\JsonResponse;

class MessageStatusController
{
    public function update(Message $message): JsonResponse
    {
        $message->update(['seened' => true]);

        return response()->json([
            'data' => new MessageResource($message),
            'message' => 'Message has been marked as seen.'
        ]);
    }
}
