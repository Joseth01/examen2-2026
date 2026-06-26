<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RealtimeSessionController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $response = Http::timeout(config('services.openai.timeout'))
            ->withToken(config('services.openai.key'))
            ->post(config('services.openai.url'), [
                'model' => config('services.openai.model'),
                'voice' => 'verse',
            ]);

        if ($response->failed()) {
            return response()->json(
                ['error' => 'El servicio de OpenAI no está disponible. Intente más tarde.'],
                $response->status()
            );
        }

        return response()->json($response->json());
    }
}
