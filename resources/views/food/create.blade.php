@extends('layouts.app')

@section('content')

    <h2 class="m-3 p-3 text-monospace text-center text-white bg-warning">Sell food</h2>

    <form action="{{ route('food.store') }}" method="post" class="w-75 mx-auto">
        @csrf

        <div class="row justify-content-center p-3 m-2 ">
            <label for="food_item" class="col-6">Item Name</label>
            <input type="text" name="food_item"  class="col-6"> <br>
        </div>

        <div class="row justify-content-center p-3 m-2 ">
            <label for="food_price" class="col-6">price</label>
            <input type="text" name="food_price"  class="col-6"> <br>
        </div>

        <div class="row justify-content-center p-3 m-2 ">
            <label for="food_quantity" class="col-6">quantity Number</label>
            <input type="number" name="food_quantity"  class="col-6"> <br>
        </div>

        <input type="submit" value="submit">

    </form>

@endsection