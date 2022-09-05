<?php

namespace App\Http\Controllers;

use App\Jobs\videoupl;
use Illuminate\Support\Facades\Validator;

use App\Models\video;
use Facade\FlareClient\Stacktrace\File as StacktraceFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
            'name' => ['required'],
            'video' => ['required', 'mimes:jpg,mp4,3gp,ogg,ogx,webm']


        ]);
        if ($validator->fails()) {

            return back()->withInput()->withErrors($validator);
        } else
            // $video =  Storage::putFile('video', $req->file('video'));;
            videoupl::dispatch($req);
        return redirect()->back();
    }
}
