<?php

use App\Enums\Tariff\TariffEnum;

return [
    'statuses' => [
        TariffEnum::ACTIVE => 'Active',
        TariffEnum::CLOSED => 'Closed',
        TariffEnum::DRAFT  => 'Draft',
    ],
];
