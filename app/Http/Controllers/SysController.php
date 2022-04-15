<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Core\Support\Http\Responses\BaseHttpResponse;
use Artisan;
use Exception;

class SysController extends Controller
{
    //run migrate
    public function sysMigrate() {
        try {
            Artisan::call("migrate");
            return "Success";
        } catch (Exception $e) {
            return $e;
        }
    }
}
