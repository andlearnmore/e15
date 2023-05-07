@extends('layouts/main')

@section('title')
    My Wishlist
@endsection

@section('content')
    @if ($places->count() == 0)
        <p>You have not added any places to visit.</p>
        <p><a href='/cities'>Explore cities and places to add to your wishlist.</a></p>
    @else
    @endif
@endsection
