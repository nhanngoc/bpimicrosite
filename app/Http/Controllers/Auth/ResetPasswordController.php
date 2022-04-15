<?php

namespace App\Http\Controllers\Auth;

use App\Core\Support\Http\Controllers\BaseController;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->middleware('guest');
        $this->redirectTo = $config->get('base.admin_dir');
    }

    /**
     * @param Request $request
     * @param null $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.auth.reset', compact('email', 'token'));
    }
}
