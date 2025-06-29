<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show($type, $id)
    {
        $model = match ($type) {
            'post' => \App\Models\Post::class,
            'video' => \App\Models\Video::class,
            'audio' => \App\Models\Audio::class,
            default => null
        };

        if (!$model) return response()->json(['error' => 'Type not found'], 404);

        $item = $model::findOrFail($id);

        return response()->json([
            'data' => $item->comments
        ]);
    }
}