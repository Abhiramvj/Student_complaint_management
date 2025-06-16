<?php

namespace App\Jobs;

use App\Mail\ResponseToUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendResponse implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $complaint)
    {
        $this->complaint = $complaint;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       $departmentHead = $this->complaint->department->users()
    ->where('role', 'department_head')
    ->first();

    if($departmentHead) {
        Mail::to($this->complaint->user->email)->queue(new ResponseToUser($this->complaint, $departmentHead));
    }

    }
}
