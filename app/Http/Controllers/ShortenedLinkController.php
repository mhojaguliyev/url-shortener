<?php

namespace App\Http\Controllers;

use App\Exceptions\LinkExpiredException;
use App\Http\Requests\ShortenedLinkCreateRequest;
use App\Http\Resources\ShortenedLinkResource;
use App\Services\ShortenedLinkService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Throwable;

class ShortenedLinkController extends Controller
{
    public function __construct(private readonly ShortenedLinkService $shortenedLinkService)
    {
    }

    /**
     * @param ShortenedLinkCreateRequest $request
     * @return JsonResponse
     */
    public function shorten(ShortenedLinkCreateRequest $request): JsonResponse
    {
        $shortenedLink = $this->shortenedLinkService->create($request->validated());

        return response()->json([
            'message' => 'OK',
            'data' => new ShortenedLinkResource($shortenedLink),
        ]);
    }

    /**
     * @param $token
     * @return JsonResponse|RedirectResponse
     */
    public function redirect($token): JsonResponse|RedirectResponse
    {
        try {
            $shortenedLink = $this->shortenedLinkService->getValidByToken($token);
            return redirect($shortenedLink->link);
        } catch (ModelNotFoundException|LinkExpiredException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], $exception->getCode());
        } catch (Throwable $exception) {
            return response()->json([
                'message' => 'Something went wrong. Please contact administrator'
            ], 500);
        }
    }
}
