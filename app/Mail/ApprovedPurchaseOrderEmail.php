<?php

namespace App\Mail;

use App\Models\PurchaseOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApprovedPurchaseOrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    protected $user;
    /**
     * @var PurchaseOrder
     */
    protected $purchaseOrder;

    /**
     * PurchaseOrderEmail constructor.
     *
     * @param $user
     * @param PurchaseOrder $purchaseOrder
     */
    public function __construct($user, PurchaseOrder $purchaseOrder)
    {
        $this->user = $user;
        $this->purchaseOrder = $purchaseOrder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Purchase Order Approved')->view('emails.purchase-orders.mail_approved_po')->with([
            'purchase_order' => $this->purchaseOrder,
            'user'           => $this->user
        ]);
    }
}
