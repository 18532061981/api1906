<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class Testcontroller extends Controller
{
    //redis 测试
    public function testredis(){
        $key ="1906";
        // $val="hello world";
        $val=time();
        Redis::set($key,$val);    //set 设置一个 键 并赋值
        $value=Redis::get($key);  //获取 key 的值
        echo 'value:'.$value;     //  展示  这个值
    }

    //file_get_contents   GET方式
    public  function file_get_contents(){
        $Appid='wx8bc80f5949fda528';
        $appsecret='f4852897a0b441624d7c845c878f2548';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$Appid.'&secret='.$appsecret;
        // echo $url;
        $json=file_get_contents($url);
        $arr=json_decode($json,true);
        dd($arr);
    }

    //CURL   get
    public function curl(){
        $Appid='wx8bc80f5949fda528';
        $appsecret='f4852897a0b441624d7c845c878f2548';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$Appid.'&secret='.$appsecret;

        $ch = curl_init($url);  //初始化   1
        curl_setopt($ch, CURLOPT_HEADER, 0);  //设置参数选项  2
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  //  2
        $response=curl_exec($ch);     //执行会话   3
        curl_close($ch);    //关闭会话   4

        $arr=json_decode($response,true);
        dd($arr);

    }

    //curl  POST
    public function curlPost(){

        $token='30_XCg_HQ7KEHZwL32a3IeeCSscd9Yon0pzcfVEGREV6lU_qJ4m_LnGt9R2z3835iK9AiLSvdR0l-H3lIjyFey0pnc2QFl0WfIil-5d1i80sbUajvL2dkSL8AbePc-bENg_zKA5GLPSqZZXYV_2XBEaACAKOR';
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$token;
        $ticket=[
            'expire_seconds'=>'604800',
            'action_name'=>'QR_STR_SCENE',
            'action_info'=>[
                'scene'=>[
                    'scene_str'=>'test'
                ]
            ]
        ];

        $ch=curl_init($url);    //初始化
        curl_setopt($ch, CURLOPT_HEADER, 0);  //设置参数选项  2
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1); //0启用浏览器输出 1 关闭浏览器输出，可用变量接收响应
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($ticket));

        $response=curl_exec($ch);   //执行

        //处理报错
        // $errno=curl_errno($ch);    //错误码
        // $error=curl_error($ch);    //错误信息

        curl_close($ch);  //关闭

        $arr=json_decode($response,true);
        // dd($arr);

        //转二维码
        $tickets=UrlEncode($arr['ticket']);
        $urls='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$tickets;
        // $file=file_get_contents($urls);
        return redirect($urls);

    }

    //Guzzle
    public function Guzzle(){
        $Appid='wx8bc80f5949fda528';
        $appsecret='f4852897a0b441624d7c845c878f2548';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$Appid.'&secret='.$appsecret;

        $client = new Client();
        $response =$client->request('GET',$url);
        $data =$response->getBody();

        $arr=json_decode($data,true);
        dd($arr);
        // echo $data;

    }

    //Guzzle  post
    public function GuzzlePost(){
        $token='30_XCg_HQ7KEHZwL32a3IeeCSscd9Yon0pzcfVEGREV6lU_qJ4m_LnGt9R2z3835iK9AiLSvdR0l-H3lIjyFey0pnc2QFl0WfIil-5d1i80sbUajvL2dkSL8AbePc-bENg_zKA5GLPSqZZXYV_2XBEaACAKOR';
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$token;
        $ticket=[
            'expire_seconds'=>'604800',
            'action_name'=>'QR_STR_SCENE',
            'action_info'=>[
                'scene'=>[
                    'scene_str'=>'test'
                ]
            ]
        ];


        $client = new Client();
        $response =$client->request('POST',$url,[
            'body'=>json_encode($ticket,JSON_UNESCAPED_UNICODE),
        ]);
        $t=$response->getBody();
        $arr=json_decode($t,true);
        // dd($arr);

        //转二维码
        $tickets=UrlEncode($arr['ticket']);
        $urls='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$tickets;
        // $file=file_get_contents($urls);
        return redirect($urls);

    }



    public function post1(){
        dump($_POST);
    }

    public function post2(){
        print_r($_POST);
    }

    public function post3(){
        echo "aaaa";
        $data=file_get_contents("php://input");
        $arr=json_decode($data,true);
        dump($arr);
        echo "aaaa";
    }

    public function upload(){
        print_r($_POST);
        echo "<br>";
        print_r($_FILES);
    }

    public function guzzleget(){
        print_r($_GET);
    }

    public function guzzlepost1(){
        echo "<pre>";print_r($_POST);"/pre";
    }

    public function guzzleupload(){
        print_r($_POST);

        print_r($_FILES);
    }

    public function guzzlejson(){
        $data=file_get_contents("php://input");
        $arr=json_decode($data,true);
        dump($arr);
    }


    public function redisfs(){
        //redis  key
        $ua_key="count:".substr(md5($_SERVER['HTTP_USER_AGENT']),5,5);
        echo "redis的key：".$ua_key;echo "<br>";

        //次数
        $count=Redis::incr($ua_key);
        echo "访问次数".$count."：正常访问"; echo "<br>";

        //过期时间
        // $time=Redis::ttl($ua_key);
        //判断
        $get=Redis::get($ua_key);
        if($get>=10){
            echo "刷新次数有限";
            Redis::expire($ua_key,10);
            die;
        }

        echo "正常访问";
    }


    public function md5get(){

        $key="key";   //签名的key
        echo "签名签名：".$key;echo "<br>";

        $data=$_GET['data'];  //发送前的数据
        echo "数据：".$data;echo "<br>";

        $sign=md5($data.$key); //数据  和 签名
        echo "加密的签名，没加密数据和签名key：".$sign;echo "<br>";
    }

    public function md5shou(){
        $key="key";            //签名的key
        echo "签名的key".$key;echo "<br>";
        $data=$_GET['data'];   //接受数据
        echo "接受的数据".$data;echo "<br>";
        $sign=$_GET['sign'];   //接受签名
        echo "接受加密的数据和签名".$sign;echo "<br>";
        $sign2=md5($data.$key);   //加密 数据和签名
        echo "给数据和签名加密".$sign2;echo "<br>";
        if($sign!==$sign2){
            echo "验证失败";die;
        }

        echo "哈喽";

    }

    public function verifySign(){
        $key="key";

        $data=$_GET['data'];
        $sign=$_GET['sign'];

        $sign2=md5($data.$key);

        if($sign==$sign2){
            echo "验证成功";
        }else{
            echo "验证失败";
        }
    }


    public function decrypt(){
        $yuanlaishuju=$_GET['data'];   //接受的数据

        $data=$_GET['miw'];  //接受密文

        $str=strlen($data);  //取字符串长度

        $code='';  //解密的 数据

        for($i=0;$i<$str;$i++){   //循环解密
            $miwen=$data[$i];  //密文
            $ord=ord($data[$i]);    //密文  转 数字
            echo "密文".$miwen."=>"."密文数字".$ord;echo "<br>";

            // echo "<hr>";
            $pass=ord($data[$i])-3;   //密文-3  得到 数据的 码
            echo "原数据的数字码".$pass; echo "<hr>";
            $code .=chr($pass);

        }
        echo "原来数据".$code;echo "<hr>";


        if($yuanlaishuju==$code){
            echo "验证成功";
        }else{
            echo "验证失败";
        }
    }

    //对称
    public function decrypt1(){
        $sign_key='sign';   //签名
        $sign=$_GET['sign']; //接收 签名
        $data=$_GET['data']; //接受 数据

        //解 对称 加密
        $key='key';
        $method="aes-128-cbc";  //算法
        $iv='asdzxcqwe1234rfh';   //十六个字节
        $base=base64_decode($data);   //将  base64  转为  密文
        // echo $base;
        $enc=openssl_decrypt($base,$method,$key,OPENSSL_RAW_DATA,$iv);  //解密
        $sign2=md5($enc.$sign_key);
        if($sign==$sign2){
            echo "验证成功,原来的数据：".$enc;
        }else{
            echo "验证失败";
        }
    }
    //接收数据 验证签名
    public function verifySign()
    {
        $key = '1907';

        $data = $_GET['data']; //接收到的数据
        $sign = $_GET['sign']; //接收到的签名

        //验签
        $sign1 = md5($data.$key);
        echo "接收端计算的签名:".$sign1;echo "<br>";
        //与接收到的签名对比
        if($sign1 == $sign)
        {
            echo "验签通过 数据完整";
        }else{
            echo "验签失败 数据损坏";
        }
    }

    //解密
    public function decrypt()
    {
        $data = $_GET['data'];

        //解密
        $length = strlen($data); //获取密文的长度

        $str='';

        for($i=0;$i<$length;$i++){
            echo  $data[$i].'>'.ord($data[$i]);echo "<br>";
            $code = ord($data[$i])-1;

            echo "解密:".$data[$i].'>'.chr($code);echo "<br>";
            $str .= chr($code);
        }
        echo "解密数据:".$str;
    }

    //验签加解密
    public function task()
    {
        //验签  key必须相同
        $key = '1907';
        $data = $_GET['data']; //接收到的数据
        $sign = $_GET['sign']; //接收到的签名


        //加密
        $method = 'aes-128-cbc'; //加算法
        $iv = 'abc123456a123456';  //vi 必须为16个字节 (16个ascii字符)
        echo "已接收到的数据";
        echo "<pre>";print_r($_GET);echo "</pre>";

        echo "<hr>";

        //base64编码
        $c_data = base64_decode($data);
        //解密
        $dec_data = openssl_decrypt($c_data,$method,$key,OPENSSL_RAW_DATA,$iv);
        echo "解密后的数据:";echo "<br>";
        var_dump($dec_data);echo "<br>";

        //验签
        $sign1 = md5($dec_data.$key);
        echo "接收端计算的签名:".$sign1;echo "<br>";

        //与接收到的签名对比
        if($sign1 == $sign)
        {
            echo "验签通过 数据完整";echo "<br>";
        }else{
            echo "验签失败 数据损坏";echo "<br>";
        }
    }

    //非对称解密
    public function  Connection()
    {
        // echo "API";
        // echo "<pre>";print_r($_GET);echo '</pre>';

        //解密base64   base64_decode用来解密数据
        $enc_data = base64_decode($_GET['data']);
        // var_dump($enc_data);  //得到解密后的base64

        //根据私钥来解密
        $priv = file_get_contents(storage_path('keys/priv-a.key'));
        openssl_private_decrypt($enc_data,$dec_data,$priv);
        // echo "解密后的数据:";echo "<br>";


        //响应数据
        $str = 'Hello world';
        //使用对方的公钥进行加密
        $key = file_get_contents(storage_path('keys/pub-b.key'));
        openssl_public_encrypt($str,$enc_str,$key);
        // echo "加密数据:".$enc_str;echo "<br>";

        $data = [
            'error' => 0,
            'msg' => '解密成功',
            'data' => base64_encode($enc_str)
        ];

        return $data;
    }
    public function verify()
    {
        echo "API1906";
        echo "<pre>";print_r($_GET);echo "</pre>";
        $data = $_GET['data'];
        $sign = $_GET['sign'];
        $b64_sign_str = base64_decode($sign);
        $priv_key_id = openssl_pkey_get_public("file://".storage_path('keys/pub-b.key'));
        //返回
        $ok = openssl_verify($data,$b64_sign_str,$priv_key_id,OPENSSL_ALGO_SHA256);
        return $ok;
    }

}