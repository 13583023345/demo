<?php

namespace App\Http\Controllers;
use App\Tools\Captcha;
use App\Model\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
     * @content 登陆
     * @params
     * */
    public function Login()
    {
        return view('login');
    }
    /*
     * @content 登陆执行
     * @params
     * */
    public function LoginDo(Request $request)
    {
        $pwd=$request->pwd;
        $img=$request->img;
        $img2=session('verifycode');
        $data=User::where(['user_tel'=>$request->tel])->first();
        if($img!=$img2){
            echo 1;   //验证码错误
        }else if(empty($data)){
            echo 2;   //用户不存在
        }else if($pwd!=decrypt($data['user_pwd'])){

            echo 3; // 密码错误
        }else{
            session(['user_tel'=>$data['user_tel']]);
            echo 4;//登陆成功

        }


    }


    /*
      * @content 验证码
      * @params
      * */
    public function Captcha()
    {
        $verify = new Captcha();
        $code = $verify->getCode();
       // var_dump($code);
        session(['verifycode'=>$code]);
        return $verify->doimg();
    }
}
