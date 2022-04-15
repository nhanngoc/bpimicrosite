<?php

namespace App\Models;


use App\Events\AuditLog\AuditHandlerEvent;
use Eloquent;

class AuditLog
{
    /**
     * @param string $module
     * @param \Eloquent|false $data
     * @param string $action
     * @param string $type
     * @return bool
     */
    public function handleEvent($module, $data, $action, $type = 'info')
    {
        if (!$data instanceof Eloquent || !$data->id) {
            return false;
        }
        event(new AuditHandlerEvent($module, $action, $data->id, $this->getReferenceName($module, $data), $type));

        return true;
    }

    /**
     * @param string $module
     * @param \stdClass|User|Eloquent $data
     * @return string
     */
    public function getReferenceName($module, $data)
    {
        $name = null;
        switch ($module) {
            case 'user':
            case 'auth':
                $name = $data->getFullName();
                break;
            default:
                if (!empty($data)) {
                    if (isset($data->name)) {
                        $name = $data->name;
                    } elseif (isset($data->title)) {
                        $name = $data->title;
                    } elseif (isset($data->discount_title)) {
                        $name = $data->discount_title;
                    }
                }
        }

        return $name;
    }
}
