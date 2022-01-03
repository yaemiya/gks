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

class SupplierController extends Controller
{
    // ユーザー一覧画面表示
    public function index()
    {
        if(empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('SupplierController/index start! auth user id='.Auth::user()->user_id);

        $users = User::all();
        return view('supplier.index', compact('users'));
    }

    // ユーザー登録画面表示
    public function create()
    {
        // セッション切れ
        if(empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('SupplierController/create start! auth user id='.Auth::user()->user_id);

        // 管理者権限以外でのアクセス
        if(Auth::user()->role !== '1')
        {
            Log::error('SupplierController/create unauthorized access error! auth user id='.Auth::user()->user_id);
            return view('error');
        }

        return view('supplier.register');
    }

    // ユーザー登録処理
    public function store(Request $request)
    {
        if(empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('SupplierController/store start! auth user id='.Auth::user()->user_id);
        
        // 管理者権限以外でのアクセス
        if(Auth::user()->role !== '1')
        {
            Log::error('SupplierController/store unauthorized access error! auth user id='.Auth::user()->user_id);
            return view('error');
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
            Log::error('SupplierController/store create() error! auth user id='.Auth::user()->user_id);
            return view('error');
        }
        return redirect('supplier');
    }


    // ユーザー詳細画面表示
    public function show($user_id)
    {
        if(empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('SupplierController/show start!');
        
        if(!$user_id)
        {
            Log::error('SupplierController/show no user_id error! auth user id='.Auth::user()->user_id.' user_id='.$user_id);
            return view('error');
        }

        $user = User::find($user_id);
        if(!$user)
        {
            Log::error('SupplierController/show find() error! auth user id='.Auth::user()->user_id.' user_id='.$user_id);
            return view('error');
        }

        return view('supplier/detail', compact('user'));
    }


    // ユーザー編集画面表示
    public function edit($user_id)
    {
        if(empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('SupplierController/edit start!');
        
        // 管理者権限以外でのアクセス
        if(Auth::user()->role !== '1')
        {
            Log::error('SupplierController/edit unauthorized access error! auth user id='.Auth::user()->user_id);
            return view('error');
        }

        if(!$user_id)
        {
            Log::error('SupplierController/edit no user_id error! auth user id='.Auth::user()->user_id.' user_id='.$user_id);
            return view('error');
        }
        $user = User::find($user_id);
        if(!$user)
        {
            Log::error('SupplierController/edit find() error! auth user id='.Auth::user()->user_id.' user_id='.$user_id);;
            return view('error');
        }

        return view('supplier/edit', compact('user'));
    }


    // ユーザー更新処理
    public function update(Request $request)
    {
        if(empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('SupplierController/update start!');
        
        // 管理者権限以外でのアクセス
        if(Auth::user()->role !== '1')
        {
            Log::error('SupplierController/update unauthorized access error! auth user id='.Auth::user()->user_id);
            return view('error');
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
            Log::error('SupplierController/update no user_id error! auth user id='.Auth::user()->user_id.' user_id='.$request->user_id);
            return view('error');
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
            Log::error('SupplierController/update update() error! auth user id='.Auth::user()->user_id.' user_id='.$user_id);
            return view('error');
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

        Log::info('SupplierController/update start!');
        
        // 管理者権限以外でのアクセス
        if(Auth::user()->role !== '1')
        {
            Log::error('SupplierController/destroy unauthorized access error! auth user id='.Auth::user()->user_id);
            return view('error');
        }

        if(!$request->user_id)
        {
            Log::error('SupplierController/destroy no user_id error! auth user id='.Auth::user()->user_id.' user_id='.$user_id);
            return view('error');
        }
        $user = User::find($request->user_id);
        $result = $user->delete();
        if(!$result)
        {
            Log::error('SupplierController/destroy delete() error! auth user id='.Auth::user()->user_id.' user_id='.$user_id);
            return view('error');
        }

        return redirect('supplier');
    }
}