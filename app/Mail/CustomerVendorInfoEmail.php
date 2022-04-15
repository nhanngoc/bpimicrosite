<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerVendorInfoEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    protected $customerVendor;
    /**
     * @var
     */
    protected $user;

    /**
     * CustomerVendorInfoEmail constructor.
     *
     * @param $customerVendor
     * @param $user
     */
    public function __construct($customerVendor, $user)
    {
        //
        $this->customerVendor = $customerVendor;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Customer/Vendor Request')->view('emails.customer-vendor.information')->with([
            'vendor' => $this->customerVendor,
            'user'   => $this->user
        ]);
    }
}
