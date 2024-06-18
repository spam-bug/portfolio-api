<?php

namespace App\Http\Controllers\Message;

use App\Http\Requests\Message\StoreMessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\JsonResponse;

class MessageController
{
    public function index(): JsonResponse
    {
        $messages = Message::latest()->get();

        return response()->json([
            'data' => MessageResource::collection($messages),
            'meta' => [
                'total_messages' => $messages->count(),
                'unread_messages' => $messages->where('seened', false)->count(),
            ]
        ]);
    }

    public function store(StoreMessageRequest $request): JsonResponse
    {
        return response()->json([
            'data' => new MessageResource($request->createMessage())
        ], 201);
    }

    public function show(Message $message): JsonResponse
    {
        return response()->json([
            'data' => new MessageResource($message)
        ]);
    }

    public function destroy(Message $message): JsonResponse
    {
        $message->delete();

        return response()->json(['message' => 'Message has been deleted!']);
    }
}
