@extends('layouts.app')

@section('content')

    <h2 class="m-3 p-3 text-monospace text-center text-white bg-warning">index blade php</h2>

    @if(count($foods) > 0)

        @foreach($foods as $food)
            <div class="row justify-content-center p-3 bg-info m-2">
                <!-- @foreach($foods as $food) -->
                    <small class="col-12 col-md-3">{{$food->food_item}}</small>
                    <small class="col-12 col-md-3">{{$food->food_price}} $</small>
                    <small class="col-12 col-md-3">{{$food->food_quantity}}</small>
                <!-- @endforeach -->
            </div>
        @endforeach
    @endif

@endsection