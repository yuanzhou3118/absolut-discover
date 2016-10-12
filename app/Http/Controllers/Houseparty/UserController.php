<?php

namespace App\Http\Controllers\Houseparty;

use App\HousePartyUser;
use Illuminate\Http\Request;
use Curl;
use URL;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;
use Exception;

class UserController extends Controller
{
    const MOBILE_REG = '/^1[34578]\d{9}$/';

    const BIRTHDAY_REG = '/^[\d]{4}[\d]{2}[\d]{2}$/';

    const MOBILE_URL = 'https://prcws.acxiom.com.cn/PRC/rest/customer/sendSMS';//prcws

    const SOURCE_NAME = '11eb84085955487c412ebdfec3ff729b';
    const WECHAT_SOURCE_NAME = 'e41fe8aa1bf2b73b3c13bd320ee10580';
    const GDT_SOURCE_NAME = 'b5c4803d253be5aa31e9a31feff4e189';

//    const DATA_POST_URL = 'https://uat01.acxiom.com.cn/PRC/rest/customer/dataCollect';
    const DATA_POST_URL = 'https://prcws.acxiom.com.cn/PRC/rest/customer/dataCollect';

    const BEHAVIOR_POST_URL = 'https://prcws.acxiom.com.cn/PRC/rest/customer/BehaviorCollect';


    /**
     * 活动页面。
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $openid = trim($request->input('openid'));

        if (!$request->session()->has('openid') && mb_strlen($openid) == 0) {//跳转授权页面
            $unixtime = time();
            $key = 'gyp2016';
            $a = '5spzSmcI0h';
            $token = md5($key . $unixtime);

            $url = 'http://www.digiwine.com/sha-abswechat/skip.php?reurl=' .
                urlencode('http://absolut.pernod-ricard-china.com/sha-abs-houseparty/index.html') . '&type=userinfo';
            return response()->json(['result' => 2, 'url' => $url]);
//            return redirect('http://www.digiwine.com/sha-abswechat/skip.php?reurl=' .
//                urlencode(URL::route('house.party.user.home')) . '&type=base');
        }

        if (!$request->session()->has('openid')) {
            session(['openid' => $openid]);
        } else {
            $request->session()->forget('openid');
            session(['openid' => $openid]);
        }

        if (mb_strlen($openid) == 0) {
            Session::forget('openid');

            return redirect()->route('house.party.user.home');
        }

        return response()->json(['result' => 1]);
//        return view('')
    }

    /**
     * 提交openid信息到acxiom
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userInfo(Request $request)
    {
        $openid = trim($request->input('openid'));

        if (!$request->session()->has('openid')) {
            session(['openid' => $openid]);
        }

        $openid = strval(session('openid'));

        if (mb_strlen($openid) == 0) {
            return response()->json(['result' => 0]);
        }

        try {
            $ts = date('Y-m-d H:i:s.B');

            $sign = md5(md5("AbsolutAD" . $ts) . $ts);

            $source_name = self::SOURCE_NAME;

            $openId = $openid;

            $time = microtime(true);

            $response = Curl::to(self::DATA_POST_URL)
                ->withOption('SSL_VERIFYPEER', 0)
                ->withOption('SSL_VERIFYHOST', 0)
                ->withOption('SSL_CIPHER_LIST', 'TLSv1')
                ->withOption('HEADER', 0)
                ->withData(compact('ts', 'sign', 'source_name', 'openId'))
                ->asJson(true)
                ->withTimeout(60)
                ->post();

            $source_name = self::WECHAT_SOURCE_NAME;
            $response2 = Curl::to(self::DATA_POST_URL)
                ->withOption('SSL_VERIFYPEER', 0)
                ->withOption('SSL_VERIFYHOST', 0)
                ->withOption('SSL_CIPHER_LIST', 'TLSv1')
                ->withOption('HEADER', 0)
                ->withData(compact('ts', 'sign', 'source_name', 'openId'))
                ->asJson(true)
                ->withTimeout(60)
                ->post();

            $source_name = self::GDT_SOURCE_NAME;
            $response3 = Curl::to(self::DATA_POST_URL)
                ->withOption('SSL_VERIFYPEER', 0)
                ->withOption('SSL_VERIFYHOST', 0)
                ->withOption('SSL_CIPHER_LIST', 'TLSv1')
                ->withOption('HEADER', 0)
                ->withData(compact('ts', 'sign', 'source_name', 'openId'))
                ->asJson(true)
                ->withTimeout(60)
                ->post();

//            Log::info('time span for acxiom user coupon api,openid:' . $openid .
//                ',time:' . round(microtime(true) - $time, 4) . 's');

            Log::info('send openid to acxiom,data:' . $openid .
                ', response:' . json_encode($response));
            Log::info('send openid to acxiom,data:' . $openid .
                ', response2:' . json_encode($response2));
            Log::info('send openid to acxiom,data:' . $openid .
                ', response3:' . json_encode($response3));

            Log::info('send openid to acxiom,data:' . json_encode(compact('ts', 'sign', 'source_name', 'openId')));

            if (!is_array($response) || $response['RETURN_CODE'] != '000') {
                Log::error('send openid to acxiom fail, openid:' . $openid);
            }

            if (!is_array($response2) || $response2['RETURN_CODE'] != '000') {
                Log::error('send openid to acxiom fail, openid:' . $openid);
            }

            if (!is_array($response3) || $response3['RETURN_CODE'] != '000') {
                Log::error('send openid to acxiom fail, openid:' . $openid);
            }
        } catch (Exception $e) {
            Log::error('send openid to acxiom exception,openid:' . $openid . ',exception:' . $e->getMessage());
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
            return response()->json(['result' => 2]);
        }

        if (!$request->session()->has('openid')) {
            return response()->json(['result' => 3]);
        }

        $openid = strval(session('openid'));

        if (mb_strlen($openid) == 0) {
            return response()->json(['result' => 4]);
        }

        $captcha = mt_rand(1000, 9999);

        session(['code' => $captcha]);

        try {
            $ts = date('Y-m-d H:i:s.B');

            $sign = md5(md5("AbsolutAD" . $ts) . $ts);

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
     * 验证验证码，提交数据给安可臣
     * result:0失败，1成功
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendUserDataToAcxiom(Request $request)
    {
        $utm_source = trim($request->input('utm_source'));

        $utm_medium = trim($request->input('utm_medium'));

        $partyName = trim($request->input('party_name'));

        $name = trim($request->input('name'));

        if (mb_strlen($name) == 0 || mb_strlen($name) > 20) {
            return response()->json(['result' => 2]);
        }

        $cityName = trim($request->input('city'));

        if (mb_strlen($cityName) == 0 || mb_strlen($cityName) > 20) {
            return response()->json(['result' => 3]);
        }

        $theme = trim($request->input('theme'));
        Log::info('theme:' . $theme);
        if (mb_strlen($theme) == 0 || mb_strlen($theme) > 20) {
            Log::info('mb_theme:' . $theme);
            return response()->json(['result' => 0]);
        }

        $themeArr = explode('-', $theme);

        $partyVenue = $themeArr[1];

        switch ($partyVenue) {
            case 1:
                $partyVenue = '闯破古堡';
                break;
            case 2:
                $partyVenue = '掌控天台';
                break;
            case 3:
                $partyVenue = '轰袭地下室';
                break;
            case 4:
                $partyVenue = '顽爆仓库';
                break;
            default:
                break;
        }

        $partyTheme = $themeArr[2];

        switch ($partyTheme) {
            case 1:
                $partyTheme = '玩色世界';
                break;
            case 2:
                $partyTheme = '假面狂欢';
                break;
            case 3:
                $partyTheme = '电音波潮';
                break;
            case 4:
                $partyTheme = '极幻球场';
                break;
            default:
                break;
        }

        $drink = $themeArr[3];

        $drinkPreference = null;

        switch ($drink) {
            case 1:
                $drinkPreference = '绝对伏特加纯饮';
                break;
            case 2:
                $drinkPreference = '1份伏特加+5份西瓜汁';
                break;
            case 3:
                $drinkPreference = '1份伏特加+5份乌龙茶';
                break;
            case 4:
                $drinkPreference = '1份伏特加+5份碳酸饮料';
                break;
            default:
                break;
        }

        $mobile = trim($request->input('mobile'));

        if (preg_match(self::MOBILE_REG, $mobile) == 0) {
            return response()->json(['result' => 4]);
        }

        $captcha = trim($request->input('captcha'));

        if (mb_strlen($captcha) == 0) {
            return response()->json(['result' => 5]);
        }

//        session(['code' => 1111]);

        if (!$request->session()->has('code')) {
            return response()->json(['result' => 6]);
        }

        $code = strval(session('code'));


        if ($captcha != $code) {
            return response()->json(['result' => 7]);
        }

        if (!$request->session()->has('openid')) {
            return response()->json(['result' => 8]);
        }

        $openid = strval(session('openid'));
//        return response()->json(['result' => $result]);
        if (mb_strlen($openid) == 0) {
            return response()->json(['result' => 9]);
        }

        $birthDay = intval(trim($request->input('birthday')));

        if (preg_match(self::BIRTHDAY_REG, $birthDay) == 0) {
            return response()->json(['result' => 10]);
        }

        $ts = date('Y-m-d H:i:s.B');

        $sign = md5(md5("AbsolutAD" . $ts) . $ts);

        $source_name = self::SOURCE_NAME;

        if($utm_source == 'gdt'){
            $source_name = self::GDT_SOURCE_NAME;
        }
        if($utm_source == 'wechat'){
            $source_name = self::WECHAT_SOURCE_NAME;
        }

        try {
            $time = microtime(true);

            $timestamp = date('Y-m-d H:i:s.B');

            $data2 = [
                'credential_type' => 'openId',
                'credentialID' => $openid,
                'timestamp' => $timestamp,
                'behavior_code' => 'bhv_ABS_002',
                'behavior_content' => [
                    'drinking_set' => $drinkPreference,
                ],
            ];
            $data3 = [
                'credential_type' => 'openId',
                'credentialID' => $openid,
                'timestamp' => $timestamp,
                'behavior_code' => 'bhv_ABS_003',
                'behavior_content' => [
                    'party_venue' => $partyVenue,
                ],
            ];
            $data4 = [
                'credential_type' => 'openId',
                'credentialID' => $openid,
                'timestamp' => $timestamp,
                'behavior_code' => 'bhv_ABS_004',
                'behavior_content' => [
                    'party_theme' => $partyTheme,
                ],
            ];

            $response2 = Curl::to(self::BEHAVIOR_POST_URL)
                ->withOption('SSL_VERIFYPEER', 0)
                ->withOption('SSL_VERIFYHOST', 0)
                ->withOption('SSL_CIPHER_LIST', 'TLSv1')
                ->withOption('HEADER', 0)
                ->withData(array_merge(compact('ts', 'sign', 'source_name'), $data2))
                ->asJson(true)
                ->withTimeout(60)
                ->post();

            $response3 = Curl::to(self::BEHAVIOR_POST_URL)
                ->withOption('SSL_VERIFYPEER', 0)
                ->withOption('SSL_VERIFYHOST', 0)
                ->withOption('SSL_CIPHER_LIST', 'TLSv1')
                ->withOption('HEADER', 0)
                ->withData(array_merge(compact('ts', 'sign', 'source_name'), $data3))
                ->asJson(true)
                ->withTimeout(60)
                ->post();

            $response4 = Curl::to(self::BEHAVIOR_POST_URL)
                ->withOption('SSL_VERIFYPEER', 0)
                ->withOption('SSL_VERIFYHOST', 0)
                ->withOption('SSL_CIPHER_LIST', 'TLSv1')
                ->withOption('HEADER', 0)
                ->withData(array_merge(compact('ts', 'sign', 'source_name'), $data4))
                ->asJson(true)
                ->withTimeout(60)
                ->post();

//            Log::info('time span for ankechen user coupon api,openid:' . $openid .
//                ',time:' . round(microtime(true) - $time, 4) . 's');

            Log::info('send '.$utm_source.' drinking_set to ankechen,data: ' . json_encode(array_merge(compact('ts', 'sign', 'source_name'), $data2)) . ', response:' . json_encode($response2));

            Log::info('send '.$utm_source.' party_venue to ankechen,data: ' . json_encode(array_merge(compact('ts', 'sign', 'source_name'), $data3)) . ', response:' . json_encode($response3));

            Log::info('send '.$utm_source.' party_theme to ankechen,data: ' . json_encode(array_merge(compact('ts', 'sign', 'source_name'), $data4)) . ', response:' . json_encode($response4));

            if (!is_array($response2) || $response2['RETURN_CODE'] != '000') {
                Log::error('send drinking_set to ankechen fail, openid:' . $openid);
            }
            if (!is_array($response3) || $response3['RETURN_CODE'] != '000') {
                Log::error('send drinking_set to ankechen fail, openid:' . $openid);
            }
            if (!is_array($response4) || $response4['RETURN_CODE'] != '000') {
                Log::error('send drinking_set to ankechen fail, openid:' . $openid);
            }
        } catch (Exception $e) {
            Log::error('send drinking_set to ankechen exception,openid:' . $openid . $e->getMessage());
        }

        Session::forget('code');

        try {
            $birthday = $birthDay;

            $openId = $openid;

            $username = $name;

            $city = $cityName;

            $cellphone = $mobile;

            $preferredDrinkingOccasion = '21004';

            $time = microtime(true);

            $response = Curl::to(self::DATA_POST_URL)
                ->withOption('SSL_VERIFYPEER', 0)
                ->withOption('SSL_VERIFYHOST', 0)
                ->withOption('SSL_CIPHER_LIST', 'TLSv1')
                ->withOption('HEADER', 0)
                ->withData(compact('ts', 'sign', 'source_name', 'birthday', 'username', 'cellphone', 'city', 'openId', 'preferredDrinkingOccasion'))
                ->asJson(true)
                ->withTimeout(60)
                ->post();

//            Log::info('time span for ankechen user coupon api,openid:' . $openid .
//                ',time:' . round(microtime(true) - $time, 4) . 's');

            Log::info('send house_party_user to ankechen,data: ' . json_encode(compact('ts', 'sign', 'source_name', 'birthday', 'username', 'cellphone', 'city', 'openId', 'preferredDrinkingOccasion')) . ', response:' . json_encode($response));

            if (!is_array($response) || $response['RETURN_CODE'] != '000') {
                Log::error('send house_party_user to ankechen fail, mobile:' . $mobile);
            }
        } catch (Exception $e) {
            Log::error('send user coupon to ankechen exception,openid:' . $openid . ',mobile:' . $mobile .
                ',name:' . $name . ',city' . $cityName . 'exception:' . $e->getMessage());
        }

        $user = new HousePartyUser();
        $user->openid = $openid;
        $user->username = $name;
        $user->mobile = $mobile;
        $user->city = $cityName;
        $user->party_name = $partyName;
        $user->birthday = $birthDay;
        $user->theme = $theme;
        $user->utm_source = $utm_source;
        $user->utm_medium = $utm_medium;

        $result = 0;

        try {
            $user->save();

            $result = 1;

        } catch (Exception $e) {
            Log::error('save user_msg,openid:' . $openid . ',user_id:' . $user->id . ',theme:' . $theme . ',exception:' . $e->getMessage());
        }

        return response()->json(['result' => $result]);
    }


    /**
     * 分享页面的场景接口
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function theme(Request $request)
    {
        $openid = trim($request->input('openid'));
//        return response()->json(['result' => $result]);
        if (mb_strlen($openid) == 0) {
            return response()->json(['result' => 9]);
        }

        $user = HousePartyUser::whereOpenid($openid)->first();
        $theme = $user->theme;

        return response()->json(['theme' => $theme]);
    }

}
