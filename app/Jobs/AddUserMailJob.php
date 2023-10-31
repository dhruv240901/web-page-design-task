<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Mail\AddUserMail;

class AddUserMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $email, $userdata, $randompassword;
    /**
     * Create a new job instance.
     */
    public function __construct($email,$userdata,$randompassword)
    {
        $this->email=$email;
        $this->userdata=$userdata;
        $this->randompassword=$randompassword;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new AddUserMail($this->userdata,$this->randompassword));
    }
}
