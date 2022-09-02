<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

use App\Models\video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        return view('video.index');
    }
    public function create()
    {
        return view('video.create');
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'video' => ['required', 'mimes:jpg, mp4, 3gp, ogg, ogx, webm', 'max:2048'],
            'name' => ['required']

        ]);
        if ($validator->fails()) {

            return back()->withInput()->withErrors($validator);
        } else
            $video = new video;
        $video->video_name = $req->input('name');
        if ($req->hasFile('video')) {

            $file = $req->file('video');
            $extension = $file->getClientOriginalExtension();
            $filename = config('app.default_storage') . time() . '.' . $extension;
            $file->move('uploads/video/', $filename);
            $video->video = $filename;
        }

        $video->save();
        return redirect()->back()->with('status', 'Video added successfully');
    }
}
