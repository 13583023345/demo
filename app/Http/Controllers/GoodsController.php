<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Category;

class GoodsController extends Controller
{
    /*
      * @content 全部商品
      * @params
      * */
    public function Allshops()
    {
        $data=Goods::get();
        $cate=Category::where('pid','0')->get();
        return view('Allshops',['data'=>$data],['cate'=>$cate]);
    }

    /*
     * @content  顶级分类下面的分类
     * @params
     * */
    public function category(Request $request)
    {
        $id=$request->cate_id;
        if(empty($id)){
            $cate_id=Category::pluck('cate_id');
        }else{
            $cate_id=Category::where('pid','=',$id)->pluck('cate_id');
        }
        $c_id=Category::whereIn('pid',$cate_id)->pluck('cate_id');
        $cateInfo=Category::where(['pid'=>0])->get();
        $goods=Goods::whereIn('cate_id',$c_id)->get();
        //var_dump($goods);exit;

        return view('all',['goods'=>$goods,'cateInfo'=>$cateInfo]);
    }
}
