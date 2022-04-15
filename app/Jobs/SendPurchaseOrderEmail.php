<?php

namespace App\Jobs;

use App\Mail\PurchaseOrderEmail;
use App\Models\PurchaseOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendPurchaseOrderEmail implements ShouldQueue
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
     * @var
     */
    protected $to;
    /**
     * @var
     */
    protected $cc;
    /**
     * SendPurchaseOrderEmail constructor.
     *
     * @param $user
     * @param PurchaseOrder $purchaseOrder
     */
    public function __construct($user, $purchaseOrder, $to, $cc)
    {
        $this->user = $user;
        $this->purchaseOrder = $purchaseOrder;
        $this->to = $to;
        $this->cc = $cc;
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
        $email = new PurchaseOrderEmail($this->user, $this->purchaseOrder);
        Mail::to($this->to)->cc($this->cc)->send($email);
        echo 'End send email';
    }
}
