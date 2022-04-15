<?php

use App\Core\Base\Enums\BaseStatusEnum;

return [
    'statuses' => [
        BaseStatusEnum::DRAFT     => 'Draft',
        BaseStatusEnum::PENDING   => 'Pending',
        BaseStatusEnum::PUBLISHED => 'Published',
    ],
];
