<?php

namespace App\Jobs;

use Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Mail\CustomerVendorInfoEmail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendCustomerVendorInfoEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    protected $customerVendor;
    /**
     * @var
     */
    protected $user;
    /**
     * @var
     */
    protected $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($customerVendor, $user, $type = 'send')
    {
        $this->customerVendor = $customerVendor;
        $this->user = $user;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo 'Start send email';
        $to = array();
        $cc = array();
        if ($this->type === 'send') {
            $userLists = User::where(['company_id' => $this->user->company_id])->get();
            $to = array();
            foreach ($userLists as $user)
            {
                if (!$user->isSuperUser() && $user->hasPermission('position.account')) {
                    $to[] = $user->email;
                }
            }
            $cc = [];
        }
        if ($this->type === 'approved') {
            $to = $this->user->email;
            $cc = [];
        }
        $email = new CustomerVendorInfoEmail($this->customerVendor, $this->user);
        Mail::to($to)->cc($cc)->send($email);
        echo 'End send email';
    }
}
