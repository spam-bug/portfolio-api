<?php

namespace App\Http\Controllers\Message;


use App\Models\Message;
use Illuminate\Http\JsonResponse;

class UnreadMessageCountController
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'unread_messages' => Message::where('seened', false)->count()
        ]);
    }
}
