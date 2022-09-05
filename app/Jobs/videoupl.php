<?php

namespace App\Jobs;

use App\Http\Controllers\VideoController;
use App\Models\video;
use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class videoupl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $req;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($req)
    {
        $this->req =
            $req;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $video = new video();
        if ($this->req) {
            $file = $this->req;
            dd($file);
            $extension = $file->getClientOriginalExtension();
            $filename = config('app.default_storage') . microtime() . '.' . $extension;
            $file->move('uploads/video/', $filename);
            $video->video = $filename;
        }

        $video->save();
    }
}
