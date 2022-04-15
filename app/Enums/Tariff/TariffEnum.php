<?php

namespace App\Enums\Tariff;

use App\Core\Support\Enum;
use Html;

/**
 * @method static TariffEnum ACTIVE()
 * @method static TariffEnum CLOSED()
 * @method static TariffEnum DRAFT()
 */
class TariffEnum extends Enum
{
    public const ACTIVE = 'active';
    public const CLOSED = 'closed';
    public const DRAFT = 'draft';

    /**
     * @var string
     */
    public static $langPath = 'tariff.statuses';


    /**
     * @return string
     */
    public function toHtml()
    {
        switch ($this->value) {
            case self::ACTIVE:
                return Html::tag('span', self::ACTIVE()->label(), ['class' => 'label-primary status-label'])
                    ->toHtml();
            case self::CLOSED:
                return Html::tag('span', self::CLOSED()->label(), ['class' => 'label-warning status-label'])
                    ->toHtml();
            case self::DRAFT:
                return Html::tag('span', self::DRAFT()->label(), ['class' => 'label-danger status-label'])
                    ->toHtml();
            default:
                return null;
        }
    }
}
