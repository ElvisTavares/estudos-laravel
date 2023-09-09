<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManagerStatic as Image;


class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $imagePath;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $image = Image::make(public_path($this->imagePath));
        $image = Image::make(public_path($this->imagePath));
        $image->resize(300, 200);
        $image->save();
    
    }
}
