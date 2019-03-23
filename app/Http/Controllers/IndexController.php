<?php

namespace App\Http\Controllers;
use App\Model\Index;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /*
     * @content 前台首页
     * @params
     *
     * */
    public function Index()
    {
        $data=Index::get();

        return view('Index',['data'=>$data]);
    }



    /*
     * @content 购物车
     * @params
     * */
    public function Shopcart()
    {
        return view('Shopcart');
    }

    /*
     * @content 我的潮购
     * @params
     * */
    public function Userpage()
    {
        return view('Userpage');
    }

    /*
     * @content 晒单
     * @params
     * */
    public function Willshare()
    {
        return view('Willshare');
    }


}
