<?php

namespace App\Jobs;

use App\Mail\ComplaintSubmitted;
use App\Mail\ComplaintToDepartment;
use App\Models\Complaint;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendComplaint implements ShouldQueue
{
    use Queueable,Dispatchable,InteractsWithQueue,SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $complaint;

    public function __construct(Complaint $complaint)
    {
        $this->complaint = $complaint;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->complaint->user->email)->queue(new ComplaintSubmitted($this->complaint));
       $departmentUsers = $this->complaint->department->users()->where('role', 'department_head')->get();

foreach ($departmentUsers as $user) {
    Mail::to($user->email)->queue(new ComplaintToDepartment($this->complaint));
}
}
}
