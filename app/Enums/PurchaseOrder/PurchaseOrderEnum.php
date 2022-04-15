<?php

namespace App\Enums\PurchaseOrder;

use App\Core\Support\Enum;
use Html;

class PurchaseOrderEnum extends Enum
{
    public const NEW      = 'new';
    public const PENDING  = 'pending';
    public const CANCEL   = 'cancel';
    public const APPROVED = 'approved';

    /**
     * @var string
     */
    public static $langPath = 'purchase-order.statuses';

    /**
     * @return string
     */
    public function toHtml()
    {
        switch ($this->value) {
            case self::NEW:
                return Html::tag('span', self::NEW()->label(), ['class' => 'label-primary status-label'])
                    ->toHtml();
            case self::PENDING:
                return Html::tag('span', self::PENDING()->label(), ['class' => 'label-warning status-label'])
                    ->toHtml();
            case self::CANCEL:
                return Html::tag('span', self::CANCEL()->label(), ['class' => 'label-danger status-label'])
                    ->toHtml();
            case self::APPROVED:
                return Html::tag('span', self::APPROVED()->label(), ['class' => 'label-success status-label'])
                    ->toHtml();
            default:
                return parent::toHtml();
        }
    }
}
