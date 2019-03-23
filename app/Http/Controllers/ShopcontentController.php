<?php

namespace App\Http\Controllers;
use App\Model\Goods;
use Illuminate\Http\Request;

class ShopcontentController extends Controller
{
    /*
     * @content  商品详情
     * @params
     * */

    public function Shopcontent(Request $request)
    {
        $id=$request->id;
        $data=Goods::where('goods_id',$id)->first();
        return view('shopcontent',['data'=>$data]);
    }
}
