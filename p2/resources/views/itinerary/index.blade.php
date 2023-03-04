@extends('layouts/main')

@section('title')
    Itinerary: Select
@endsection

@section('content')
    <div>
        <h1>The form will display here.</h1>
    </div>
    <div class="row" id="form">
        <div class="col-12">
            <div class="text-center">
                <form>
                    <div class="mb-3">
                        <label for="location" class="form-label">Where would you like to go?</label>
                        <input type="text" id="word" name="word" class="form-control" value="Tiergarten">
                        {{-- TODO: update value --}}


                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
