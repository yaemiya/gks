<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\Plant;
use App\Models\Shop;
use App\Models\Address;
use App\Models\SupplierPlantRelation;
use App\Models\SupplierShopRelation;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;

class SupplierController extends Controller
{

    // 仕入業者一覧画面表示
    public function index()
    {
        // セッション切れ
        if (empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('SupplierController/index start! auth user_id=' . Auth::user()->user_id);

        $suppliers = Supplier::all();

        return view('supplier.supplier_index', compact('suppliers'));
    }



    // 仕入業者詳細画面表示
    public function show($supplier_id)
    {
        if (empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('SupplierController/show start!');

        if (!$supplier_id)
        {
            Log::error('SupplierController/show no supplier_id error! auth user_id=' . Auth::user()->user_id . ' supplier_id=' . $supplier_id);
            $message = __('messages.err.dbErr');
            return view('error', compact('message'));
        }

        $supplier = Supplier::find($supplier_id);
        if (!$supplier)
        {
            Log::error('SupplierController/show find() error! auth user_id=' . Auth::user()->user_id . ' supplier_id=' . $supplier_id);
            $message = __('messages.err.dbErr');
            return view('error', compact('message'));
        }

        return view('supplier/supplier_detail', compact('user'));
    }



    // 仕入業者登録画面表示
    public function create()
    {
        $func = 'SupplierController/create';
        // セッション切れ
        if (empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info($func . ':' . $func . ' start! auth user_id=' . Auth::user()->user_id);

        // 管理者権限以外でのアクセス
        if (Auth::user()->role !== '1')
        {
            Log::error($func . ': unauthorized access error! auth user_id=' . Auth::user()->user_id);
            $message = __('messages.err.accessErr');
            return view('error', compact('message'));
        }

        // 工場リストの取得
        $plants = Plant::all();
        if (!$plants)
        {
            Log::error($func . ': Plant::all() error! auth user_id=' . Auth::user()->user_id);
            $message = __('messages.err.dbErr');
            return view('error', compact('message'));
        }

        // 店舗リストの取得
        $shops = Shop::all();
        if (!$shops)
        {
            Log::error($func . ': Shop::all() error! auth user_id=' . Auth::user()->user_id);
            $message = __('messages.err.dbErr');
            return view('error', compact('message'));
        }

        return view('supplier.supplier_register', compact('plants', 'shops'));
    }



    // 仕入業者登録処理
    public function store(Request $request)
    {
        $func = 'SupplierController/store';

        if (empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info($func . ':' . $func . ' start! auth user_id=' . Auth::user()->user_id);

        // 管理者権限以外でのアクセス
        if (Auth::user()->role !== '1')
        {
            Log::error($func . ':unauthorized access error! auth user_id=' . Auth::user()->user_id);
            $message = __('messages.err.accessErr');
            return view('error', compact('message'));
        }

        // ポストデータの存在チェック
        if (empty($request))
        {
            Log::error($func . ':no post data error! auth user_id=' . Auth::user()->user_id);
            $message = __('messages.err.noPostDataErr');
            return view('error', compact('message'));
        }

        $request->validate([
            'supplierName' => ['bail', 'required', 'string', 'max:30'],
            'repName' => ['bail', 'required', 'string', 'max:30'],
            'postalCode1' => ['bail', 'required', 'string', 'digits:3'],
            'postalCode2' => ['bail', 'required', 'string', 'digits:4'],
            'prefecture' => ['bail', 'required', 'string', 'max:4'],
            'address' => ['bail', 'required', 'string', 'max:50'],
            'houseNum' => ['bail', 'required', 'string', 'max:10'],
            'building' => ['bail', 'nullable', 'max:50'],
            'email' => ['bail', 'required', 'string', 'regex:/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', 'email', 'max:255'],
            'tel1' => ['bail', 'required', 'string', 'numeric', 'digits_between:1,5'],
            'tel2' => ['bail', 'required', 'string', 'numeric', 'digits_between:1,5'],
            'tel3' => ['bail', 'required', 'string', 'numeric', 'digits_between:1,5'],
            'businessKind' => ['bail', 'required', 'in:2,3']
        ]);

        // 独自バリデーション
        $telLen = strlen($request->tel1 . $request->tel2 . $request->tel2); // 電話番号の桁数
        if ($telLen < 10 || $telLen > 11)
        {
            Log::error($func . ':total tel length error! auth user_id=' . Auth::user()->user_id . ' tel1=' . $request->tel1 . ' tel2=' . $request->tel2 . ' tel3=' . $request->tel3);
            $errs[] = __('validation.tel_size');
        }

        if ($request->businessKind === '2' && !isset($request->plantId)) // 種別に工場が選択されていて取引工場が選択されていないとき
        {
            Log::error($func . ':plant not selected error! auth user_id=' . Auth::user()->user_id . ' business_kind=' . $request->businessKind);
            $errs[] = __('validation.plantId');
        }
        if ($request->businessKind === '3' && !isset($request->shopId)) // 種別に店舗が選択されていて取引店舗が選択されていないとき
        {
            Log::error($func . 'shop not selected error! auth user_id=' . Auth::user()->user_id . ' business_kind=' . $request->businessKind);
            $errs[] = __('validation.shopId');
        }

        if (isset($errs)) // 独自エラーがあるとき
        {
            return back()->withInput()->withErrors($errs);
        }

        DB::beginTransaction();

        // アドレステーブルへ登録
        $address = Address::create([
            'postal_code1' => $request->postalCode1,
            'postal_code2' => $request->postalCode2,
            'prefecture' => $request->prefecture,
            'address' => $request->address,
            'house_num' => $request->houseNum,
            'building' => $request->building,
            'email' => $request->email,
            'tel' => $request->tel1 . $request->tel2 . $request->tel3,
        ]);
        if (!isset($address->id))
        {
            Log::error($func . ':Address::create() error! auth user_id=' . Auth::user()->user_id . ' postal_code=' . $request->postalCode1 . ' postal_code2=' . $request->postalCode2 . ' postal_code2=' . $request->postalCode2 . ' prefecture=' . $request->prefecture . ' address=' . $request->address . ' house_num=' . $request->houseNum . ' building=' . $request->building . ' tel=' . $request->tel1 . $request->tel2 . $request->tel3);
            $message = __('messages.err.dbErr');
            DB::rollBack();
            return view('error', compact('message'));
        }

        // 仕入業者テーブルへ登録
        $supplier = Supplier::create([
            'supplier_name' => $request->supplierName,
            'rep_name' => $request->repName,
            'address_id' => $address->id,
            'business_kind' => $request->businessKind
        ]);
        if (!isset($supplier->id))
        {
            Log::error($func . ':Supplier::create() error! auth user_id=' . Auth::user()->user_id . ' supplier_name=' . $request->supplierName . ' rep_name=' . $request->repName . ' address_id=' . $address->id . ' business_kind=' . $request->businessKind);
            $message = __('messages.err.dbErr');
            DB::rollBack();
            return view('error', compact('message'));
        }

        // 紐づきテーブル（仕入業者-工場）
        if ($request->businessKind === '2')
        {
            $spr = SupplierPlantRelation::create([
                'supplier_id' => $supplier->id,
                'plant_id' => $request->plantId
            ]);
            if (!isset($spr->id))
            {
                Log::error($func . ':SupplierPlantRelation::create() error! auth user_id=' . Auth::user()->user_id . ' supplier_id=' . $supplier->id . ' plant_id=' . $request->plantId);
                $message = __('messages.err.dbErr');
                DB::rollBack();
                return view('error', compact('message'));
            }
        }
        elseif ($request->businessKind === '3')
        {
            $ssr = SupplierShopRelation::create([
                'supplier_id' => $supplier->id,
                'shop_id' => $request->shopId
            ]);
            if (!isset($ssr->id))
            {
                Log::error($func . ':SupplierShopRelation::create() error! auth user_id=' . Auth::user()->user_id . ' supplier_id=' . $supplier->id . ' shop_id=' . $request->shopId);
                $message = __('messages.err.dbErr');
                DB::rollBack();
                return view('error', compact('message'));
            }
        }

        DB::commit();

        return redirect('supplier');
    }



    // 仕入業者編集画面表示
    public function edit($supplier_id)
    {
        if (empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('SupplierController/edit start!');

        // 管理者権限以外でのアクセス
        if (Auth::user()->role !== '1')
        {
            Log::error('SupplierController/edit unauthorized access error! auth user_id=' . Auth::user()->user_id);
            $message = __('messages.err.accessErr');
            return view('error', compact('message'));
        }

        if (!$supplier_id)
        {
            Log::error('SupplierController/edit no supplier_id error! auth user_id=' . Auth::user()->user_id . ' supplier_id=' . $supplier_id);
            $message = __('messages.err.dbErr');
            return view('error', compact('message'));
        }
        $supplier = Supplier::find($supplier_id);
        if (!$supplier)
        {
            Log::error('SupplierController/edit find() error! auth user_id=' . Auth::user()->user_id . ' supplier_id=' . $supplier_id);
            $message = __('messages.err.dbErr');
            return view('error', compact('message'));
        }

        return view('supplier/supplier_edit', compact('user'));
    }


    // 仕入業者更新処理
    public function update(Request $request)
    {
        if (empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('SupplierController/update start!');

        // 管理者権限以外でのアクセス
        if (Auth::user()->role !== '1')
        {
            Log::error('SupplierController/update unauthorized access error! auth user_id=' . Auth::user()->user_id);
            $message = __('messages.err.accessErr');
            return view('error', compact('message'));
        }

        $request->validate([
            'login_id' => ['bail', 'required', 'string', new isLoginFormat, 'between:8,16'],
            'emp_no' => ['bail', 'required', 'string', 'regex:/^[A-Za-z0-9]*$/', 'size:4'],
            'last_name' => ['bail', 'required', 'string', 'max:20'],
            'first_name' => ['bail', 'required', 'string', 'max:20'],
            'email' => ['bail', 'required', 'string', 'regex:/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', 'email', 'max:255'],
            'password' => ['bail', 'required', 'regex:/^[A-Za-z0-9]*$/', 'between:8,16', 'confirmed'],
            'tel' => ['bail', 'required', 'string', 'numeric', 'digits_between:10,11'],
            'role' => ['bail', 'required', 'in:1,2']
        ]);

        if (!$request->supplier_id)
        {
            Log::error('SupplierController/update no supplier_id error! auth user_id=' . Auth::user()->user_id . ' supplier_id=' . $request->supplier_id);
            $message = __('messages.err.dbErr');
            return view('error', compact('message'));
        }

        $result = Supplier::where('supplier_id', $request->supplier_id)
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
        if (!$result)
        {
            Log::error('SupplierController/update update() error! auth user_id=' . Auth::user()->user_id . ' supplier_id=' . $supplier_id);
            $message = __('messages.err.dbErr');
            return view('error', compact('message'));
        }

        return redirect('supplier');
    }


    // 仕入業者削除処理
    public function destroy(Request $request)
    {
        if (empty(Auth::user()))
        {
            return redirect('/');
        }

        Log::info('SupplierController/update start!');

        // 管理者権限以外でのアクセス
        if (Auth::user()->role !== '1')
        {
            Log::error('SupplierController/destroy unauthorized access error! auth user_id=' . Auth::user()->user_id);
            $message = __('messages.err.accessErr');
            return view('error', compact('message'));
        }

        if (!$request->supplier_id)
        {
            Log::error('SupplierController/destroy no supplier_id error! auth user_id=' . Auth::user()->user_id . ' supplier_id=' . $supplier_id);
            $message = __('messages.err.dbErr');
            return view('error', compact('message'));
        }
        $supplier = Supplier::find($request->supplier_id);
        $result = $supplier_ > delete();
        if (!$result)
        {
            Log::error('SupplierController/destroy delete() error! auth user_id=' . Auth::user()->user_id . ' supplier_id=' . $supplier_id);
            $message = __('messages.err.dbErr');
            return view('error', compact('message'));
        }

        return redirect('supplier');
    }
}
