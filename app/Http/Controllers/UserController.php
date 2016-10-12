<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\UsedCoupon;
use App\UserMsgCoupon;
use App\UserMsgNoCoupon;
use App\UserStyle;
use App\UserSubject;
use Illuminate\Http\Request;
use App\Http\Requests;
use Exception;
use Log;
use DB;
use URL;
use Session;
use Curl;

class UserController extends Controller
{
    const MOBILE_REG = '/^1[34578]\d{9}$/';

    const MOBILE_URL = 'https://prcws.acxiom.com.cn/PRC/rest/customer/sendSMS';//prcws

    const SOURCE_NAME = 'd1bbf8894f456c940158c339f131c143';

    const DATA_POST_URL = 'https://prcws.acxiom.com.cn/PRC/rest/customer/dataCollect';//uat01

    const BEHAVIOR_POST_URL = 'https://prcws.acxiom.com.cn/PRC/rest/customer/BehaviorCollect';

    /**
     * 活动页面。
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $openid = trim($request->input('openid'));

        if (!$request->session()->has('openid') && mb_strlen($openid) == 0) {
            return redirect('http://www.digiwine.com/sha-abswechat/skip.php?reurl=' .
                urlencode(URL::route('user.home')) . '&type=base');
        }

        if (!$request->session()->has('openid')) {
            session(['openid' => $openid]);
        } else {
            $openid = strval(session('openid'));
        }

        if (mb_strlen($openid) == 0) {
            Session::forget('openid');

            return redirect()->route('user.home');
        }

        $userMsgCoupon = UserMsgCoupon::whereOpenid($openid)->first();

        if (!is_null($userMsgCoupon)) {
            return view('index', ['is_join' => true, 'coupon' => $userMsgCoupon->coupon]);
        }

        return view('index', ['is_join' => false]);
    }

    /**
     * 二维码页面。
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function qrCode()
    {
        return view('share');
    }

    /**
     * 提交用户给安客臣接口。
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userInfo(Request $request)
    {
        if (!$request->session()->has('openid')) {
            return response()->json(['result' => 0]);
        }

        $openid = strval(session('openid'));

        if (mb_strlen($openid) == 0) {
            return response()->json(['result' => 0]);
        }

//        $userInfo = new UserInfo();
//
//        $userInfo->openid = $openid;
//
//        try {
//            $userInfo->save();
//        } catch (Exception $e) {
//            Log::error('add user_info exception,openid:' . $openid . ',exception:' . $e->getMessage());
//        }

        try {
            $ts = date('Y-m-d H:i:s.B');

            $sign = md5(md5("PRC" . $ts) . $ts);

            $source_name = self::SOURCE_NAME;

            $openId = $openid;

            $time = microtime(true);

            $response = Curl::to(self::DATA_POST_URL)
                ->withData(compact('ts', 'sign', 'source_name', 'openId'))
                ->asJson(true)
                ->withTimeout(60)
                ->post();

            Log::info('time span for ankechen user coupon api,openid:' . $openid .
                ',time:' . round(microtime(true) - $time, 4) . 's');

            Log::info('send openid to ankechen,openid:' . $openid .
                ', response:' . json_encode($response));

            if (!is_array($response) || $response['RETURN_CODE'] != '000') {
                Log::error('send openid to ankechen fail, openid:' . $openid);
            }
        } catch (Exception $e) {
            Log::error('send openid to ankechen exception,openid:' . $openid . ',exception:' . $e->getMessage());
        }

        return response()->json(['result' => 1]);
    }

    /**
     * 提交用户主题接口。
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userSubject(Request $request)
    {
        $subject1 = intval(trim($request->input('subject1')));

        $subject2 = intval(trim($request->input('subject2')));

        $subject3 = intval(trim($request->input('subject3')));

        $subject4 = intval(trim($request->input('subject4')));

        $pattern = '/^(0|1)$/';

        if (preg_match($pattern, $subject1) == 0) {
            return response()->json(['result' => 0]);
        }

        if (preg_match($pattern, $subject2) == 0) {
            return response()->json(['result' => 0]);
        }

        if (preg_match($pattern, $subject3) == 0) {
            return response()->json(['result' => 0]);
        }

        if (preg_match($pattern, $subject4) == 0) {
            return response()->json(['result' => 0]);
        }

        if (!$request->session()->has('openid')) {
            return response()->json(['result' => 0]);
        }

        $openid = strval(session('openid'));

        if (mb_strlen($openid) == 0) {
            return response()->json(['result' => 0]);
        }

        $userSubject = new UserSubject();

        $userSubject->openid = $openid;
        $userSubject->subject = implode('-', [$subject1, $subject2, $subject3, $subject4]);

        try {
            $userSubject->save();
        } catch (Exception $e) {
            Log::error('add user_subject exception,openid:' . $openid . ',exception:' . $e->getMessage());
        }

        return response()->json(['result' => 1]);
    }

    /**
     * 提交用户类型接口。
     * result：0失败，1成功
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userStyle(Request $request)
    {
        $styleType = trim($request->input('style_type'));

        $styleName = trim($request->input('style_name'));

        if (mb_strlen($styleType) == 0 || mb_strlen($styleName) == 0) {
            return response()->json(['result' => 0]);
        }

        if (!$request->session()->has('openid')) {
            return response()->json(['result' => 0]);
        }

        $openid = strval(session('openid'));

        if (mb_strlen($openid) == 0) {
            return response()->json(['result' => 0]);
        }

        try {
            $ts = date('Y-m-d H:i:s.B');

            $sign = md5(md5("PRC" . $ts) . $ts);

            $source_name = self::SOURCE_NAME;

            $timestamp = date('Y-m-d H:i:s.B');

            $data = [
                'credential_type' => 'openId',
                'credentialID' => $openid,
                'timestamp' => $timestamp,
                'behavior_code' => 'bhv_ABS_001',
                'behavior_content' => [
                    'style_type' => $styleType,
                    'style_name' => $styleName
                ],
            ];

            $responseBehavior = Curl::to(self::BEHAVIOR_POST_URL)
                ->withOption('SSL_VERIFYPEER', 0)
                ->withOption('SSL_VERIFYHOST', 0)
                ->withOption('SSL_CIPHER_LIST', 'TLSv1')
                ->withOption('HEADER', 0)
                ->withData(array_merge(compact('ts', 'sign', 'source_name'), $data))
                ->asJson(true)
                ->withTimeout(60)
                ->post();

            Log::info('send behavior to ankechen,data: ' . json_encode(array_merge(compact('ts', 'sign', 'source_name'), $data)) . ', response:' . json_encode($responseBehavior));
        } catch (Exception $e) {
            Log::error('send behavior to ankechen exception,openid:' . $openid . ',exception:' . $e->getMessage());
        }
        $userStyle = new UserStyle();

        $userStyle->openid = $openid;
        $userStyle->style_name = $styleName;
        $userStyle->style_type = $styleType;

        try {
            $userStyle->save();
        } catch (Exception $e) {
            Log::error('add user_style exception,openid:' . $openid . ',exception:' . $e->getMessage());
        }

        return response()->json(['result' => 1]);
    }

    /**
     * 获取短信验证码接口。
     * result：0失败，1成功
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function mobile(Request $request)
    {
        $mobile = trim($request->input('mobile'));

        if (preg_match(self::MOBILE_REG, $mobile) == 0) {
            return response()->json(['result' => 0]);
        }

        if (!$request->session()->has('openid')) {
            return response()->json(['result' => 0]);
        }

        $openid = strval(session('openid'));

        if (mb_strlen($openid) == 0) {
            return response()->json(['result' => 0]);
        }

        $captcha = mt_rand(1000, 9999);

        session(['code' => $captcha]);

        try {
            $ts = date('Y-m-d H:i:s.B');

            $sign = md5(md5("PRC" . $ts) . $ts);

            $source_name = self::SOURCE_NAME;

            $cellphone = $mobile;

            $smsContent = '您的验证码：' . $captcha;

            $time = microtime(true);

            $response = Curl::to(self::MOBILE_URL)
                ->withData(compact('ts', 'sign', 'source_name', 'cellphone', 'smsContent'))
                ->asJson(true)
                ->withTimeout(60)
                ->post();

            Log::info('time span for ankechen mobile api,openid:' . $openid .
                ',time:' . round(microtime(true) - $time, 4) . 's');

            Log::info('send mobile to ankechen,openid:' . $openid .
                ', response:' . json_encode($response));

            if (!is_array($response) || $response['RETURN_CODE'] != '000') {
                Log::error('send captcha to ankechen fail, mobile:' . $mobile);
            }
        } catch (Exception $e) {
            Log::error('send captcha to ankechen exception,mobile:' . $mobile . ',exception:' . $e->getMessage());
        }

        return response()->json(['result' => 1]);
    }

    /**
     * 提交申领接口。
     *result:0失败，1成功，2领取失败
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function userCoupon(Request $request)
    {
        $name = trim($request->input('name'));

        if (mb_strlen($name) == 0 || mb_strlen($name) > 20) {
            return response()->json(['result' => 9]);
        }

        $mobile = trim($request->input('mobile'));

        if (preg_match(self::MOBILE_REG, $mobile) == 0) {
            return response()->json(['result' => 8]);
        }

        $captcha = trim($request->input('captcha'));

        if (mb_strlen($captcha) == 0) {
            return response()->json(['result' => 7]);
        }

        if (!$request->session()->has('code')) {
            return response()->json(['result' => 6]);
        }

        $code = strval(session('code'));
//        $code = 1111;

        if ($captcha != $code) {
            return response()->json(['result' => 4]);
        }

        if (!$request->session()->has('openid')) {
            return response()->json(['result' => 44]);
        }

        $openid = strval(session('openid'));

        if (mb_strlen($openid) == 0) {
            return response()->json(['result' => 3]);
        }

        Session::forget('code');

        $userMsgCoupon = UserMsgCoupon::whereOpenid($openid)->first();

        //已经领取过了。
        if (!is_null($userMsgCoupon)) {
            if (mb_strlen($userMsgCoupon->coupon) > 0) {
                return response()->json(['result' => 1, 'coupon' => $userMsgCoupon->coupon]);
            } else {
                return response()->json(['result' => 2]);
            }
        }

        try {
            $ts = date('Y-m-d H:i:s.B');

            $sign = md5(md5("PRC" . $ts) . $ts);

            $source_name = self::SOURCE_NAME;

            $openId = $openid;

            $username = $name;

            $cellphone = $mobile;

            $time = microtime(true);

            $response = Curl::to(self::DATA_POST_URL)
                ->withData(compact('ts', 'sign', 'source_name', 'cellphone', 'username', 'openId'))
                ->asJson(true)
                ->withTimeout(60)
                ->post();

            Log::info('time span for ankechen user coupon api,openid:' . $openid .
                ',time:' . round(microtime(true) - $time, 4) . 's');

            Log::info('send user coupon to ankechen,openid:' . $openid .
                ', response:' . json_encode($response));

            if (!is_array($response) || $response['RETURN_CODE'] != '000') {
                Log::error('send user coupon to ankechen fail, mobile:' . $mobile);
            }
        } catch (Exception $e) {
            Log::error('send user coupon to ankechen exception,openid:' . $openid . ',mobile:' . $mobile .
                ',name:' . $name . ',exception:' . $e->getMessage());
        }

//        //无coupon时处理。
//        if (Coupon::whereStatus(true)->count() == 0) {
//            $this->noCoupon([
//                'mobile' => $mobile,
//                'name' => $name,
//                'openid' => $openid,
//            ]);
//
//            return response()->json(['result' => 2]);
//        }

        $myCoupon = $this->getCoupon($mobile, $name, $openid);

        if (is_null($myCoupon)) {
            $this->failCoupon($mobile, $name, $openid);

            return response()->json(['result' => 2]);
        }

        return response()->json(['result' => 1, 'coupon' => $myCoupon]);
    }

    /**
     * 无coupon时处理。
     *
     * @param array $info
     */
    protected function noCoupon(Array $info)
    {
        $userMsgNoCoupon = new UserMsgNoCoupon();

        $userMsgNoCoupon->openid = $info['openid'];
        $userMsgNoCoupon->name = $info['name'];
        $userMsgNoCoupon->mobile = $info['mobile'];

        try {
            $userMsgNoCoupon->save();
        } catch (Exception $e) {
            Log::error('add no_coupon exception,openid:' . $info['openid'] . ',exception:' . $e->getMessage());
        }
    }

    /**
     * 未成功领取coupon处理。
     *
     * @param $mobile
     * @param $name
     * @param $openid
     */
    protected function failCoupon($mobile, $name, $openid)
    {
        $userMsgCoupon = new UserMsgCoupon();

        $userMsgCoupon->coupon = '';
        $userMsgCoupon->openid = $openid;
        $userMsgCoupon->name = $name;
        $userMsgCoupon->mobile = $mobile;

        try {
            $userMsgCoupon->save();

        } catch (Exception $e) {
            Log::error('add fail get coupon exception,openid:' . $openid . ',exception:' . $e->getMessage());
        }
    }

    /**
     * 领取coupon处理。
     *
     * @param $mobile
     * @param $name
     * @param $openid
     * @return null
     */
    protected function getCoupon($mobile, $name, $openid)
    {
        if (Coupon::whereStatus(true)->count() == 0) {
            return null;
        }

        $rand = mt_rand(1, 100);

        if ($rand <= 70) {
            Log::info('user get rand:' . $rand);

            return null;
        }

        $coupon = Coupon::whereStatus(true)->orderByRaw('RAND()')->first();

        if (is_null($coupon)) {
            return null;
        }

        $userMsgCoupon = new UserMsgCoupon();

        $userMsgCoupon->coupon = $coupon->coupon;
        $userMsgCoupon->openid = $openid;
        $userMsgCoupon->name = $name;
        $userMsgCoupon->mobile = $mobile;

        $coupon->status = false;

        $usedCoupon = new UsedCoupon();

        $usedCoupon->coupon = $coupon->coupon;

        $result = false;

        DB::beginTransaction();

        try {
            $userMsgCoupon->save();

            $coupon->save();

            $usedCoupon->save();

            DB::commit();

            $result = true;
        } catch (Exception $e) {
            Log::error('add get coupon exception,openid:' . $openid .
                ',coupon:' . $coupon->coupon . ',exception:' . $e->getMessage());

            DB::rollBack();
        }

        return $result ? $coupon->coupon : null;
    }
}
