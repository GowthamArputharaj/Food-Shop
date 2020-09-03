<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Food;
use Illuminate\Support\Facades\DB;

class FoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::all();

        // dd($foods);

        // return response(json_encode($foods), 200)->header('Content-type', 'application/json');


        return view('food')->with('foods', $foods);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $food = new Food();

        // food_item	food_price	food_quantity
        $food->food_item = $request->food_item;
        $food->food_price = $request->food_price;
        $food->food_quantity = $request->food_quantity;

        $food->save();

        return redirect()->route('food.index')->with('success', 'Food item added to list');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $food = Food::select('food_name', $id);
        // $food = DB::table('food')->where('food_item', '=', $id)->get();
        
        // // $food = $food->food_item;
        // $food_quantity = (int) ($food[0]->food_quantity) + 1;
        
        // $t = DB::table('food')->where('food_item', '=', $id)->update(['food_quantity' => $food_quantity]);
        
        // $food = DB::table('food')->where('food_item', '=', $id)->get();
        // dd($food[0]->food_quantity);
        // dd($food);
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
