<?php

namespace App\Http\Controllers;

use App\Repositories\Setting\Interfaces\SettingInterface;
use Illuminate\Routing\Controller;

class SettingController extends Controller
{
    /**
     * @var SettingInterface
     */
    protected $settingRepository;

    protected $settingStore;

    public function __construct(SettingInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    //

    public function getOptions()
    {
        return view('settings.general');
    }
}
