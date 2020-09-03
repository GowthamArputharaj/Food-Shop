@extends('layouts.app')

@section('content')

    <a href="{{ route('food.create') }}" class="btn btn-primary"> Sell Food </a>
    <div class="row justify-content-center">
        <food-show></food-show>
    </div>
    
@endsection