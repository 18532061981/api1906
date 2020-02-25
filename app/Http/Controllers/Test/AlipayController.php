<?php

namespace App\Http\Controllers\Goods\AlipayController;
use App\Http\Controllers\Controller;

class AlipayController extends Controller
{
        public function test1(){
            echo __METHOD__;
            $url = 'https://openapi.alipaydev.com/gateway.do';   //沙箱

            $common_param = [
                'out_trade_no'  =>  'test1906_'.time().'_'.mt_rand(11111,99999),
                'product_code'  =>  'FAST_INSTANT_TRADE_PAY',
                'total_amount'  => '0.01',
                'subject'       => '测试订单:'.mt_rand(11111,99999),
            ]

            $pub_param = [
                'app_id'    => env('ALIPAY_APPID'),
                'method'    => 'alipay.trade.page.pay',
                'charset'   => 'utf-8',
                'sign_type' => 'RSA2',
                'sign'      => '',
                'timestamp' =>  data('Y-m-d H:i:s'),
                'version'   =>  '1.0',
                'biz_content'   => json_encode($common_param)
            ];

            $params = array_merge($common_param,$pub_param);
            echo "排序前: <pre>";print_r($params);echo "</pre>";

            ksort($params);
            echo "排序后: <pre>";print_r($params);echo "</pre>";

            $str ='';
            foreach($params as $k => $v){
                $str .=$k . '=' . $v .'&';
            }
            $str = rtrim($str,'&');
            $request_url =$url .'?' .$str;
//            echo "request_url" . $request_url;

        }

}