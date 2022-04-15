<?php

namespace App\Jobs;

use App\Mail\ApprovedPurchaseOrderEmail;
use App\Models\PurchaseOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendApprovedPurchaseOrderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    protected $user;
    /**
     * @var PurchaseOrder
     */
    protected $purchaseOrder;

    /**
     * SendPurchaseOrderEmail constructor.
     *
     * @param $user
     * @param PurchaseOrder $purchaseOrder
     */
    public function __construct($user, $purchaseOrder)
    {
        $this->user = $user;
        $this->purchaseOrder = $purchaseOrder;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        echo 'Start send email';
        $email = new ApprovedPurchaseOrderEmail($this->user, $this->purchaseOrder);
        Mail::to('dhvu@fastmail.com')->cc(['trac.tran@opsgreat.vn', 'dang.vu@opsgreat.vn'])->send($email);
        echo 'End send email';
    }
}
