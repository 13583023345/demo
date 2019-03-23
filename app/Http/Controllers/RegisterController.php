<?php

namespace App\Http\Controllers;
use App\Model\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
     * @content 注册
     * @params
     * */
    public function Register()
    {
        return view('register');
    }
    /*
     * @content 注册执行
     * @params
     * */
    public function RegisterDo(Request $request)
    {
        //echo 11111;die;
        //echo encrypt(111111);die;
        $data=$request->post();

        $user_tel=$data['user_tel'];
        $data=User::where('user_tel',$user_tel)->count();
        if($data==1){
            echo 1;die;
        }else{
            $code=session('code',1111);
            if($code!=$data['code']){
                echo 2;die;
            }else{
                $data['user_pwd']=encrypt($data['user_pwd']);
                unset($data['code'],$data['_token']);
                $dataInfo=User::insert($data);
                if($dataInfo){
                    echo 3;die;
                }else{
                    echo 4;die;
                }
            }
        }
//
//

    }
    //短信验证
    public function code(Request $request)
    {
        $user_tel=$request->tel;
        $code=mt_rand(1111,9999);
        session('code',$code);
        $res=$this->Message($user_tel,$code);
        if(!empty($res)){
            echo 1;die;
        }else{
            echo 2;die;
        }

    }

    /*
     * @content 验证唯一性
     * @params
     * */
    public function Noe(Request $request)
    {
        $user_tel=$request->tel;
        $data=User::where('user_tel',$user_tel)->count();
        if($data==1){
            echo 1;die;
        }else{
            echo 2;die;
        }

    }

    /*
     * @content 短信验证
     * @params 
     */
    public function Message($user_tel,$code)
    {
        $host = env("MOBILE_HOST");
        $path = env("MOBILE_PATH");
        $method = "POST";
        $appcode =env("MOBILE_APPCODE");
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "phone=$user_tel&templateId=TP18040314&variable=code".$code;
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        return curl_exec($curl);
    }
}
