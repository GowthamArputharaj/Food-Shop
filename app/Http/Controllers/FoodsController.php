<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Food;
use App\User;
use App\Cart;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FoodsController extends Controller
{

    public function foods()
    {
        // fetch foods from db
        $foods = Food::all();

        // return response to api request
        return response(json_encode($foods), 200)
            ->header('Content-type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*');
                    
    }

    public function cart()
    {
        $foods = Food::all()->pluck('food_item');
        $resp = [];

        foreach ($foods as $key => $value) {
            array_push($resp, [$value, 0, 0]);
        }

        return response(json_encode($resp))
            ->header('Content-type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*');
    }
        
    public function buy(Request $request) 
    {
        $resp = 'stored to db';
        
        for ($i=0; $i < count($request->userfoods); $i++) { 
            
            if(($request->userfoods[$i][1] != 0) && ($request->userfoods[$i][2] != 0))
            {

                DB::table('carts')->insert([
                    'user_id' => Auth::user()->id,
                    'food_item' => $request->userfoods[$i][0],
                    'food_quantity' => $request->userfoods[$i][1],
                    'food_price' => floatval($request->userfoods[$i][2])
                ]);

                $quantity =  Food::where('food_item', $request->userfoods[$i][0])->pluck('food_quantity');
                $quantity = (int)$quantity[0] - (int)$request->userfoods[$i][1];
                $food = Food::where('food_item', $request->userfoods[$i][0])->update(['food_quantity' => $quantity]);

            }
        }
        
        return response(json_encode($resp))
            ->header('Content-type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*');
    }

    public function index()
    {
        $foods = Food::all();
        
        return view('foodsecond')->with('foods', $foods);
    }

    public function create()
    {
        // return view('food.create');
    }

    public function store(Request $request)
    {
        $req = $request->input();

        $food_item = $req['data'][0];
        $food_price = $req['data'][1];
        $food_quantity = $req['data'][2];

        $food = new Food();

        $food->food_item = $food_item;
        $food->food_price = $food_price;
        $food->food_quantity = $food_quantity;

        $food->save();

        return response(json_encode('Product registered in db'))
            ->header('Content-type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*');
    }

}
