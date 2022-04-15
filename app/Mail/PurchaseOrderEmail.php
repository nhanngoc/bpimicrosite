<?php

namespace App\Mail;

use App\Models\PurchaseOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseOrderEmail extends Mailable
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
        return $this->subject('Created Purchase Order')->view('emails.purchase-orders.mail_create_po')->with([
            'purchase_order' => $this->purchaseOrder,
            'user'           => $this->user
        ]);
    }
}
