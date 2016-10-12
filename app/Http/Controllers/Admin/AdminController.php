<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\BackendUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\Coupon;
use Exception;
use Log;
use DB;
use Excel;

class AdminController extends Controller
{
    /**
     * 维护后台主页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('coupons')->select(DB::raw('count(*) AS total,
        ifnull(sum(CASE status WHEN 1 THEN 1 ELSE 0 END), 0) AS not_use_coupon,
        ifnull(sum(CASE status WHEN 0 THEN 1 ELSE 0 END), 0) AS use_coupon'))
            ->first();

        return view('dashboard', ['coupon' => $data->total,
            'use_coupon' => $data->use_coupon,
            'not_use_coupon' => $data->not_use_coupon,
        ]);
    }

    /**
     * 后台登录页面。
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('login', ['backend_user' => new BackendUser()]);
    }

    /**
     * 后台用户登录接口。
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function doLogin(Request $request)
    {
        $account = trim($request->input('account'));
        $pwd = trim($request->input('pwd'));

        $backendUser = new BackendUser();

        $backendUser->account = $account;
        $backendUser->pwd = $pwd;

        $msg = '';

        if (mb_strlen($account) == 0)
            $msg = '用户名不能为空';
        elseif (mb_strlen($pwd) == 0)
            $msg = '密码不能为空';

        if (mb_strlen($msg) > 0)
            return view('login', ['backend_user' => $backendUser, 'result' => $msg]);

        $backendUser = BackendUser::whereAccount($account)->first();

        if (is_null($backendUser) || $backendUser->pwd != $pwd) {
            $backendUser = new BackendUser();

            $backendUser->account = $account;
            $backendUser->pwd = $pwd;

            return view('login', ['backend_user' => $backendUser, 'result' => '用户名或密码不正确']);
        }

        session(['bk_auth' => $backendUser->id, 'bk_name' => $backendUser->name]);

        return redirect()->route('backend.index');
    }

    /**
     * 后台用户登出接口。
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doLogout()
    {
        Session::flush();
        return redirect()->route('admin.login');
    }

    /**
     * 导入Coupon页面。
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function importCoupon(Request $request)
    {
        if (!$request->hasFile('coupon_file') || !$request->file('coupon_file')->isValid()) {
            return view('import', ['result' => '请选择要导入的文件']);
        }

        $file = $request->file('coupon_file');

        if (strtolower($file->getClientOriginalExtension()) != 'xlsx') {
            return view('import', ['result' => '请选择Excel格式文件']);
        }

        $uploadStatus = false;

        $fileName = $file->getClientOriginalName();

        $filePath = storage_path('upload/' . $fileName);

        try {
            $file->move(storage_path('upload'), $fileName);

            $uploadStatus = true;
        } catch (Exception $e) {
            Log::error('upload coupon file exception,exception:' . $e->getMessage());
        }

        if (!$uploadStatus) {
            return view('import', ['result' => '上传文件失败']);
        }

        Excel::load($filePath, function ($reader) {
            $results = $reader->toArray();

            if (count($results) > 0) {
                DB::beginTransaction();

                try {
                    foreach ($results as $result) {
                        $coupon = new Coupon();

                        $coupon->coupon = trim($result['coupon']);
                        $coupon->status = true;

                        $coupon->save();
                    }

                    DB::commit();
                } catch (Exception $e) {
                    Log::error('import coupon exception:' . $e->getMessage());

                    DB::rollBack();
                }
            }
        });

        return view('import', ['result' => '导入成功']);
    }

    /**
     * 导出coupon数据。
     */
    public function exportCoupon()
    {
        $queryData = DB::table('coupons')->orderBy('created_at', 'desc')->get();

        $data = [];

        array_push($data, ['coupon', 'status']);

        foreach ($queryData as $item) {
            array_push($data, [$item->coupon, $item->status]);
        }

        Excel::create('Coupons', function ($excel) use ($data) {
            $excel->sheet('Coupons', function ($sheet) use ($data) {
                $sheet->fromArray($data, null, 'A1', false, false);
            });

        })->export('xlsx');
    }

    /**
     * 导出用户领券数据。
     */
    public function exportUserMsgCoupon()
    {
        $queryData = DB::table('user_msg_coupons')->orderBy('created_at', 'desc')->get();

        $data = [];

        array_push($data, ['openid', 'name', 'mobile', 'coupon', 'created_at']);

        foreach ($queryData as $item) {
            array_push($data, [$item->openid, $item->name, $item->mobile, $item->coupon, $item->created_at]);
        }

        Excel::create('UserMsgCoupons', function ($excel) use ($data) {
            $excel->sheet('UserMsgCoupons', function ($sheet) use ($data) {
                $sheet->fromArray($data, null, 'A1', false, false);
            });

        })->export('xlsx');
    }

    /**
     * 导出用户类型数据。
     */
    public function exportUserStyle()
    {
        $queryData = DB::table('user_styles')->orderBy('created_at', 'desc')->get();

        $data = [];

        array_push($data, ['openid', 'style_type', 'style_name', 'created_at']);

        foreach ($queryData as $item) {
            array_push($data, [$item->openid, $item->style_type, $item->style_name, $item->created_at]);
        }

        Excel::create('UserStyles', function ($excel) use ($data) {
            $excel->sheet('UserStyles', function ($sheet) use ($data) {
                $sheet->fromArray($data, null, 'A1', false, false);
            });

        })->export('xlsx');
    }

    /**
     * 导出用户主题数据。
     */
    public function exportUserSubject()
    {
        $queryData = DB::table('user_subjects')->orderBy('created_at', 'desc')->get();

        $data = [];

        array_push($data, ['openid', 'subject', 'created_at']);

        foreach ($queryData as $item) {
            array_push($data, [$item->openid, $item->subject, $item->created_at]);
        }

        Excel::create('UserSubjects', function ($excel) use ($data) {
            $excel->sheet('UserSubjects', function ($sheet) use ($data) {
                $sheet->fromArray($data, null, 'A1', false, false);
            });

        })->export('xlsx');
    }
}
