@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Add Category</h1>

        <form method="post" action="{{route('validateCategory')}}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter a name" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-info">Add Category</button>
            </div>

        </form>
    </div>
@endsection