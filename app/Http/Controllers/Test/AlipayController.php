<?php

namespace App\Http\Controllers\Goods\AlipayController;
use App\Http\Controllers\Controller;

class AlipayController extends Controller
{
        public function test1(){
            echo __METHOD__;
            $url = 'https://openapi.alipaydev.com/gateway.do';   //沙箱

            $pub_param = [
                'app_id'    => env('ALIPAY_APPID'),
                'method'    => 'alipay.trade.page.pay',
            ];

        }

}