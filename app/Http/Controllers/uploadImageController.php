<?php

namespace App\Http\Controllers;

use App\Events\ImageUploadEvent;
use App\Jobs\ResizeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class uploadImageController extends Controller
{
    public function uploadImage(Request $request)
    {
       
        $imagePath = $request->file('image')->store('uploads', 'public');

        event(new ImageUploadEvent($imagePath));

        dispatch(new ResizeImage($imagePath));

        return response()->json(['msg' => 'Upload ok']);
    }
}
