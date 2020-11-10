<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    //
    public function create($postId, Request $request)
    {
        $sessionId = $request->session()->getId();

        $files = Storage::allFiles("public/img/{$sessionId}/");
        $filesCount = count($files);

        for ($i = 0; $i < $filesCount; $i++) {
            $extension = explode('.', $files[$i])[1];
            $fileName = ($i + 1) . "-{$filesCount}.{$extension}";
            Storage::move($files[$i], "public/img/{$postId}/{$fileName}");
            Media::firstOrCreate([
                'title' => $fileName,
                'post_id' => $postId,
            ]);
        }

        Storage::deleteDirectory("public/img/{$sessionId}");

    }
    public function store(Request $request)
    {
        $sessionId = $request->session()->getId();

        foreach ($request->file('file') as $img) {
            $imgName = $img->getClientOriginalName();

            $img->storeAs("public/img/{$sessionId}", $imgName);
        }

        // return response(['success' => $imgName]);
    }

    public function delete($post)
    {
        Storage::deleteDirectory("public/img/{$post->id}");
    }
}
