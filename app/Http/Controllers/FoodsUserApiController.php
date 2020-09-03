<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Food;
use App\Foodcart;
use App\User;

use Illuminate\Support\Facades\Auth;

class FoodsUserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return response(json_encode('hellow'))
        //     ->header('Content-type', 'application/json')
        //     ->header('Access-Control-Allow-Origin', '*');

        // counting number of food item for a user
        $food_count = DB::table('foodcarts')
            ->where('user_id', '=', Auth::user()->id)
            ->distinct()->get(['food_id']);
        
        // to store food id vs number
        $food_id = [];

        foreach ($food_count as $key => $value) {

            // counting number of food by authenticated user
            $count = DB::table('foodcarts')
                ->where('food_id', '=', $value->food_id)
                ->where('user_id', '=', Auth::user()->id)
                ->get();

            // converting food id to food name by looking in foods table
            $food_item = DB::table('food')->where('id', $value->food_id)->select('food_item')->get();

            // generating an array to pass to vue componenet
            array_push($food_id, [$food_item[0]->food_item, count($count)]);
        }

        return response(json_encode($food_id))
            ->header('Content-type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $food)
    {
        // $food = new Foodcart();

        // food_item	food_price	food_quantity
        
        // $user = Auth::user()->id;

        // $foodcart->user_id = $user;
        // $foodcart->food_id = $food;

        // $food->save();

        // return redirect()->route('food.index')->with('success', 'Food item added to list');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // $food = Food::select('food_item', $id)->pluck('id');

        // $food = DB::table('foodcart')->where('food_item', '=', $food)->get();
        
        // $food = $food->food_item;
        // $food_quantity = (int) ($food[0]->food_quantity) + 1;
        
        // $t = DB::table('food')->where('food_item', '=', $id)->update(['food_quantity' => $food_quantity]);
        
        // $food = DB::table('food')->where('food_item', '=', $id)->get();
        // dd($food[0]->food_quantity);
        // dd($food);
    }
    
    public function quantityIncrement($id)
    {

        // return response(json_encode('hellow'))
        //     ->header('Content-type', 'application/json')
        //     ->header('Access-Control-Allow-Origin', '*');
        $foodid = DB::table('food')->where('food_item', $id)->pluck('id');
        
        // adding food to the cart
        $foods = new Foodcart();
        $foods->food_id = $foodid[0];
        $foods->user_id = Auth::user()->id;
        $foods->save();
        
        // $fo = DB::table('foodcarts')->where('food_id', '=', $foodid)->get();

        // counting number of food item for a user
        $food_count = DB::table('foodcarts')
            ->where('user_id', '=', Auth::user()->id)
            ->distinct()->get(['food_id']);
        
        // to store food id vs number
        $food_id = [];

        foreach ($food_count as $key => $value) {

            // counting number of food by authenticated user
            $count = DB::table('foodcarts')
                ->where('food_id', '=', $value->food_id)
                ->where('user_id', '=', Auth::user()->id)
                ->get();

            // converting food id to food name by looking in foods table
            $food_item = DB::table('food')->where('id', $value->food_id)->select('food_item')->get();

            // generating an array to pass to vue componenet
            array_push($food_id, [$food_item[0]->food_item, count($count)]);
        }

        // dd($food_id , $food_count);
        // DB::table('foodcarts')->truncate();

        return response(json_encode($food_id))
            ->header('Content-type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*');
    }
    
    public function quantityDecrement($id)
    {
        
        
        $foodid = DB::table('food')->where('food_item', $id)->pluck('id');
        
        
        $food = DB::table('foodcarts')->orderBy('id', 'ASC')
        ->where('user_id', Auth::user()->id)
        ->where('food_id', $foodid[0])->take(1);
        $food->delete();
        // dd($food);
        
        $food_count = DB::table('foodcarts')
        ->where('user_id', '=', Auth::user()->id)
        ->distinct()->get(['food_id']);
        
        // to store food id vs number
        $food_id = [];
        
        foreach ($food_count as $key => $value) {
            
            // counting number of food by authenticated user
            $count = DB::table('foodcarts')
            ->where('food_id', '=', $value->food_id)
            ->where('user_id', '=', Auth::user()->id)
            ->get();
            
            // converting food id to food name by looking in foods table
            $food_item = DB::table('food')->where('id', $value->food_id)->select('food_item')->get();
            // dd($food_item[0]->food_item, count($count));
            // generating an array to pass to vue componenet
            array_push($food_id, [$food_item[0]->food_item, count($count)]);
        }
        
        return response(json_encode($food_id))
            ->header('Content-type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*');
        // return response(json_encode($food_id))
        //     ->header('Content-type', 'application/json')
        //     ->header('Access-Control-Allow-Origin', '*');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
