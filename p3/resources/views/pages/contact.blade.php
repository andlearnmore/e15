@extends('layouts/main')

@section('title')
    Contact
@endsection

@section('head')
@endsection

@section('content')
    <p>Contact us here:
        {{ config('mail.contactEmail') }}</p>
@endsection
