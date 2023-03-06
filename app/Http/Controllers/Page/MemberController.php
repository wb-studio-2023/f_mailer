<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use userAgent;

class MemberController extends Controller
{
    //
    public function showRegistForm(Request $request) {
        return view('member.regist.' . $request->uaStr . '.showForm');
    }

    public function registConfirm(Request $request) {
        $validated  = $request->validate([
            'adress' => 'required', 'string', 'email:strict,dns,spoof', 'max:255', 'unique:members',
            'password' => 'required',Password::min(8)->letters()->mixedCase()->numbers(),
        ],
        [
            'adress.required' => '件名を入力してください',
            'password.required' => '件名を入力してください',
        ]);

        return view('member.regist.' . $request->uaStr . '.confirm');
    }

    public function registExecution(Request $request) {
        // var_dump('complete');
        return view('member.regist.' . $request->uaStr . '.execution');
    }

    public function verityExecution(Request $request) {
        return view('member.regist.' . $request->uaStr . '.verity');
    }

    public function showLoginForm(Request $request) {
        return view('member.login.showForm');
    }

    public function login(Request $request) {

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => config('const.STATUS.VERIFIED'),
        ];
        $guard = 'member';

        if(\Auth::guard($guard)->attempt($credentials)) {
            return redirect()->route('member.scenario.list');
        }

        return back()->withErrors([
            'auth' => ['認証に失敗しました']
        ]);
    }
}
