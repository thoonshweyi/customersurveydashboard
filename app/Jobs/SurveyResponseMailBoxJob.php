<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\StudentMailBoxJob;
use App\Mail\SurveyResponseMailBox;
use Illuminate\Support\Facades\Mail;

class SurveyResponseMailBoxJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
            
    public function __construct($data)
    {   
        $this->data = $data;
    }

    public function handle(): void
    {
        Mail::to($this->data["to"])->send(new SurveyResponseMailBox($this->data));
    }
}
