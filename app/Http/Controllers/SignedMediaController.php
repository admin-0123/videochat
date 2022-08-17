<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SignedMediaController extends Controller
{
    public function __invoke(Request $request, Media $media, string $conversion = '')
    {
        if (! \Auth::check() || ! $request->hasValidSignature()) {
            abort(404);
        }

        ob_get_clean();

        return response()->file($media->getPath($conversion), [
            'Content-Type' => $media->mime_type,
        ]);
    }
}
