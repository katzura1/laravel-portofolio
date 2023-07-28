<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
            'captcha' => ['required', 'captcha'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('error', implode('<br/>', $validator->errors()->all()))
                ->withInput();
        }

        $credential = $request->only('email', 'password');

        if (Auth::attempt($credential)) {
            // dd('asd');
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('error', 'Invalid Credential')->withInput();
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.auth.login');
    }

    public function generateCaptcha()
    {
        return response()->json([
            'captcha' => captcha_img()
        ]);
    }
}
