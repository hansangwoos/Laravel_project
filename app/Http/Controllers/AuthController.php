<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class AuthController extends Controller
{
    // 초기 get login 이면 showlogin 으로 login 화면으로 이동
    public function showlogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        // 입력검증
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 로그인 시도
        if(Auth::attempt($credentials)){
            // 세션공격을 막기위해 $request->session()->regenerate() 로 세션 재생성
            $request->session()->regenerate();

            // 라라벨 리다이렉터가 제공하는 intended 메소르 사용하여 dashboard 로 이동
            // intended 메소드는 사용자가 인증미들웨어에 의해 잡히기 전 원래 접근을 시도했던 URL로 사용자를 리다이렉트
            return redirect()->intended();
        };

        //
        return back()->withErrors([
            'email' => '이메일 또는 비밀번호가 올바르지 않습니다.',
            // 'password' => '비밀번호가 일치하지 않습니다.',
        ])->onlyInput('email');
    }

    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }

    public function register(){
        return view('auth.register');
    }

    public function createUser(Request $request){
        // 입력검증
        $user = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $newUser = User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
        ]);

        Auth::login($newUser);
        return redirect(route('dashboard'));
    }

}
