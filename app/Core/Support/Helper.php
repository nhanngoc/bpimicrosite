<?php

namespace App\Core\Support;

use Exception;
use File;

class Helper
{
    public static function autoload($directory)
    {
        $helpers = File::glob($directory . '/*.php');
        foreach ($helpers as $helper) {
            File::requireOnce($helper);
        }
    }

    public static function handleViewCount($object, $session_name)
    {
        $blank_array = [];
        if (!array_key_exists($object->id, session()->get($session_name, $blank_array))) {
            try {
                $object->views += 1;
                $object->save();
                session()->put($session_name . '.' . $object->id, time());
                return true;
            } catch (Exception $ex) {
                return false;
            }
        } else {
            return false;
        }
    }
}
