<?php

namespace App\Http\Controllers\V1\Auth\Controllers;

use App\Http\Controllers\V1\Auth\Models\Order;
use App\Http\Controllers\V1\Auth\Models\Product;
use App\SERVICE;
use App\User;

class AdminController extends BaseController
{
    protected $model;

    public function __construct()
    {
        // $this->model = new AddressBook();
    }

    public function statistical(){
        $numUser = User::where('role_id',2)->where('is_active',1) ->count();
        $numOrder = Order::where('status_code','delivered')->count();
        $order = Order::where('status_code','delivered')->get();
        $totalRevenue = 0;
        foreach ($order as $item) {
            // dd($item->info_total_amount);
            array_filter($item->info_total_amount,function($a) use (&$totalRevenue){
                if($a['code'] == "total"){
                    $totalRevenue+=$a['value'];
                }
            });
        }
        $views = Product::sum('views');
        $data = [
            'num_user' =>$numUser,
            'num_order' => $numOrder,
            'revenue'=>$totalRevenue,
            'view' =>$views,
        ];
        return $this->responseSuccess(null,$data);
    }

    public function checkAdmin(){
        if(SERVICE::isAdminUser()){
            return $this->responseSuccess(null,["role"=>"admin"]);
            // return response()->json(["role"=>"admin"],200);
        }else{
            return $this->responseSuccess(null,["role"=>"user"]);
            // return response()->json(["role"=>"user"],200);
        }
    }
}