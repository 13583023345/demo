<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopcartController extends Controller
{
    /*
     * @content 加入购物车
     * @params
     * */
    public function Shopcart()
    {
        return view('shopcart');
    }
}
