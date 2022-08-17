<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function image(UploadImageRequest $request)
    {
        $image = \Storage::disk('public')->putFile('editor-images', request()->file('image'));

        $url = url('/storage/'.$image);

        return $this->success(['success' => true, 'url' => $url]);
    }
}
