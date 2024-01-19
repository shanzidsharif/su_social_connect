<?php

namespace Modules\StudentModule\app\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Session;

class LoginController extends Controller
{
    private $user, $otp;

    public function __construct(User $user, Otp $otp)
    {
        $this->user = $user;
        $this->otp = $otp;
    }

    public function login()
    {
        return view('studentmodule::auth.login');
    }

    public function submit(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => 1, 'user_type' => STUDENT], $request->remember)) {
            return redirect()->route('frontend.home')->with('success', AUTH_LOGIN_200['message']);
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors(['Credentials does not match.']);
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        return redirect()->route('frontend.home')->with('success', AUTH_LOGOUT_200['message']);
    }

    public function forgot_email_form()
    {
        return view('studentmodule::auth.forget-email');
    }

    public function forgot_email_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $this->user = User::where('email', $request->email)
            ->where('user_type', STUDENT)->first();
        if($this->user)
        {
            session()->forget('user_email');
            session()->put('user_email', $request['email']);

            $rand = rand(100000, 999999);

            $otp = $this->otp;
            $otp->email = $request['email'];
            $otp->otp = $rand;
            $otp->save();

            Mail::to($request['email'])->send(new OtpMail($rand, $this->user));
            return redirect()->route('student.auth.forgot-password-otp')->with('success', "Check Your Email for Otp");
        }
        else
        {
            return redirect()->back()->withErrors('Email Not Found');
        }
    }

    public function forgot_otp_form()
    {
        return view('studentmodule::auth.forget-email-otp');
    }
    public function forgot_otp_submit(Request $request)
    {
        $request->validate([
            'otp' => 'required|integer|min:6'
        ]);
        $user_email = session('user_email');
        $otp = $this->otp->where('email', $user_email)->first();
        if ($request['otp'] === $otp->otp) {
            $otp->delete();
            return redirect()->route('student.auth.password-reset')->with('success', 'Opt matched.');
        }
        else
        {
        return back()->withErrors('Otp does not match');
        }
    }

    public function password_reset()
    {
        return view('studentmodule::auth.password-reset');
    }
    public function password_reset_submit(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'same:password',
        ]);

        $user_email = session('user_email');

        $user = $this->user->where('email', $user_email)->first();
        $user['password'] = bcrypt($request['password']);
        $user->save();

        session()->forget('user_email');

        return redirect()->route('student.auth.login')->with('success', 'Password successfully reseted.');
    }
}
