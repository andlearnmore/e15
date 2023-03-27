@extends('layouts/main')

@section('title')
    Contact us
@endsection

@section('content')
    <h1>Contact</h1>
    <p>Contact us at {{ config('mail.contact_email') }}.</p>
@endsection
