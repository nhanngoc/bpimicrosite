<?php

namespace App\Http\Controllers\Auth;

use App\Core\Support\Http\Controllers\BaseController;
use App\Core\Support\Http\Responses\BaseHttpResponse;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    use SendsPasswordResetEmails;


    /**
     * @var BaseHttpResponse
     */
    protected $response;

    /**
     * Create a new controller instance.
     *
     * @param BaseHttpResponse $response
     */
    public function __construct(BaseHttpResponse $response)
    {
        $this->middleware('guest');
        $this->response = $response;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.forgot-password');
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param Request $request
     * @param string $response
     * @return BaseHttpResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return $this->response->setMessage(trans($response));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {

        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return back()->with('status', "If you've provided registered e-mail, you should get recovery e-mail shortly.");
    }

    public function broker()
    {
        return Password::broker('users');
    }
}
