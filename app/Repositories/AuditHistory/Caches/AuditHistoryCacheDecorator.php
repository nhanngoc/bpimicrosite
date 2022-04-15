<?php

namespace App\Repositories\AuditHistory\Caches;


use App\Repositories\AuditHistory\Interfaces\AuditHistoryInterface;
use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;

class AuditHistoryCacheDecorator extends CacheAbstractDecorator implements AuditHistoryInterface
{

}
