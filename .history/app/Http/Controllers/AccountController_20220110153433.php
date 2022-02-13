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
    public function index()
    {
        if(empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('AccountController/index start! auth user id='.Auth::user()->user_id);

        $users = User::all();
        if(!$users)
        {
            Log::error('SupplierController/create all() error! auth user_id='.Auth::user()->user_id);
            $message = __('messages.dbErr');
            return view('error', compact('message'));
        }
        return view('account.index', compact('users'));
    }

    // ユーザー登録画面表示
    public function create()
    {
        $var = NULL;
echo (!isset($var));


        // セッション切れ
        if(empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('AccountController/create start! auth user id='.Auth::user()->user_id);

        // 管理者権限以外でのアクセス
        if(Auth::user()->role !== '1')
        {
            Log::error('AccountController/create unauthorized access error! auth user id='.Auth::user()->user_id);
            $message = __('messages.accessErr');
            return view('error', compact('message'));
        }

        return view('account.register');
    }

    // ユーザー登録処理
    public function store(Request $request)
    {
        if(empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('AccountController/store start! auth user id='.Auth::user()->user_id);
        
        // 管理者権限以外でのアクセス
        if(Auth::user()->role !== '1')
        {
            Log::error('AccountController/store unauthorized access error! auth user id='.Auth::user()->user_id);
            $message = '不正アクセルが発生しました。';
            return view('error', compact('message'));
        }

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
            Log::error('AccountController/store create() error! auth user id='.Auth::user()->user_id);
            $message = __('messages.dbErr');
            return view('error', compact('message'));
        }
        return redirect('account');
    }


    // ユーザー詳細画面表示
    public function show($user_id)
    {
        if(empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('AccountController/show start!');
        
        if(!$user_id)
        {
            Log::error('AccountController/show no user_id error! auth user id='.Auth::user()->user_id.' user_id='.$user_id);
            $message = __('messages.dbErr');
            return view('error', compact('message'));
        }

        $user = User::find($user_id);
        if(!$user)
        {
            Log::error('AccountController/show find() error! auth user id='.Auth::user()->user_id.' user_id='.$user_id);
            $message = __('messages.dbErr');
            return view('error', compact('message'));
        }
        return view('account/detail', compact('user'));
    }


    // ユーザー編集画面表示
    public function edit($user_id)
    {
        if(empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('AccountController/edit start!');
        
        // 管理者権限以外でのアクセス
        if(Auth::user()->role !== '1')
        {
            Log::error('AccountController/edit unauthorized access error! auth user id='.Auth::user()->user_id);
            $message = __('messages.accessErr');
            return view('error', compact('message'));
        }

        if(!$user_id)
        {
            Log::error('AccountController/edit no user_id error! auth user id='.Auth::user()->user_id.' user_id='.$user_id);
            $message = __('messages.dbErr');
            return view('error', compact('message'));
        }
        $user = User::find($user_id);
        if(!$user)
        {
            Log::error('AccountController/edit find() error! auth user id='.Auth::user()->user_id.' user_id='.$user_id);
            $message = __('messages.dbErr');
            return view('error', compact('message'));
        }

        return view('account/edit', compact('user'));
    }


    // ユーザー更新処理
    public function update(Request $request)
    {
        if(empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('AccountController/update start!');
        
        // 管理者権限以外でのアクセス
        if(Auth::user()->role !== '1')
        {
            Log::error('AccountController/update unauthorized access error! auth user id='.Auth::user()->user_id);
            $message = __('messages.accessErr');
            return view('error', compact('message'));
        }

        $request->validate([
            'login_id' => ['bail', 'required', 'string', new isLoginFormat, 'between:8,16'],
            'emp_no' => ['bail', 'required', 'string', 'regex:/^[A-Za-z0-9]*$/', 'size:4'],
            'last_name' => ['bail', 'required', 'string', 'max:20'],
            'first_name' => ['bail', 'required', 'string', 'max:20'],
            'email' => ['bail', 'required', 'string','regex:/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', 'email', 'max:255'],
            'password' => ['bail', 'required', 'regex:/^[A-Za-z0-9]*$/', 'between:8,16', 'confirmed'],
            'tel' => ['bail', 'required', 'string', 'numeric', 'digits_between:10,11'],
            'role' => ['bail', 'required', 'in:1,2']
        ]);

        if(!$request->user_id)
        {
            Log::error('AccountController/update no user_id error! auth user id='.Auth::user()->user_id.' user_id='.$request->user_id);
            $message = __('messages.dbErr');
            return view('error', compact('message'));
        }

        $result = User::where('user_id', $request->user_id)
            ->update([
                'login_id' => $request->login_id,
                'emp_no' => $request->emp_no,
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'tel' => $request->tel,
                'role' => $request->role,
        ]);
        if(!$result)
        {
            Log::error('AccountController/update update() error! auth user id='.Auth::user()->user_id.' user_id='.$user_id);
            $message = __('messages.dbErr');
            return view('error', compact('message'));
        }

        return redirect('account');
    }


    // ユーザー削除処理
    public function destroy(Request $request)
    {
        if(empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('AccountController/update start!');
        
        // 管理者権限以外でのアクセス
        if(Auth::user()->role !== '1')
        {
            Log::error('AccountController/destroy unauthorized access error! auth user id='.Auth::user()->user_id);
            $message = __('messages.accessErr');
            return view('error', compact('message'));
        }

        if(!$request->user_id)
        {
            Log::error('AccountController/destroy no user_id error! auth user id='.Auth::user()->user_id.' user_id='.$user_id);
            return view('error');
        }
        $user = User::find($request->user_id);
        $result = $user->delete();
        if(!$result)
        {
            Log::error('AccountController/destroy delete() error! auth user id='.Auth::user()->user_id.' user_id='.$user_id);
            return view('error');
        }

        return redirect('account');
    }
}