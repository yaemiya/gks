<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Rules\isLoginFormat;    // 追加

class AccountController extends Controller
{
    // ユーザー一覧画面表示
    public function index(Request $req)
    {
        Log::info('AccountController/index start!');
        $users = User::all();
        return view('account.index', compact('users'));

    }

    // ユーザー登録画面表示
    public function create()
    {
        return view('account.register');
    }

    // ユーザー登録処理
    public function store(Request $request)
    {
        Log::info('AccountController/store start!');
        $request->validate([
            'login_id' => ['bail', 'required', 'string', new isLoginFormat, 'between:8,16'],
            'emp_no' => ['bail', 'required', 'string', 'regex:/^[A-Za-z0-9]*$/', 'size:4', 'unique:users,emp_no'],
            'last_name' => ['bail', 'required', 'string', 'max:20'],
            'first_name' => ['bail', 'required', 'string', 'max:20'],
            'email' => ['bail', 'required', 'string','regex:/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', 'email', 'max:255', 'unique:users'],
            'password' => ['bail', 'required', 'regex:/^[A-Za-z0-9]*$/', 'between:8,16', 'confirmed'],
            'tel_1' => ['bail', 'required', 'string', 'numeric', 'digits_between:1,5'],
            'tel_2' => ['bail', 'required', 'string', 'numeric', 'digits_between:1,5'],
            'tel_3' => ['bail', 'required', 'string', 'numeric', 'digits_between:1,5'],
            'role' => ['bail', 'required', 'in:1,2']
        ]);

        $user = User::create([
            'login_id' => $request->login_id,
            'emp_no' => $request->emp_no,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tel' => $request->tel_1.$request->tel_2.$request->tel_3,
            'role' => $request->role,
        ]);
        if(!$user)
        {
            Log::error('AccountController/store create() error!');
            return view('error');
        }

        return redirect('account');
    }

    // ユーザー詳細画面表示
    public function show(Request $request)
    {
        Log::info('AccountController/show start!');
        $user = User::find->login_id;
        if(!$user)
        {
            Log::eror('AccountController/show find() error! user=' .Auth::user->user_id.')
        }
    }
}